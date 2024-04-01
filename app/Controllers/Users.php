<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UsersSurveysModel;
use App\Models\UsersBankModel;
use App\Models\UsersBusinessModel;

class Users extends BaseController
{
  public function index() //login
  {
    /* Validar login solo con rut, el correo se puede repetir  */
    $data = [];
    if ($this->request->getMethod() == 'post') {
      //validation rules
      $rules = [
        'rut'       => ['label' => 'rut', 'rules' => 'required|min_length[9]|max_length[12]|validate_rut[users.rut]|verified_user[users.rut]'],
        'password'  => ['label' => 'contraseña', 'rules' => 'required|min_length[6]|max_length[255]|validate_user[email,password]']
      ];
      $errors = [
        'rut' => [
          'validate_rut'  => 'El RUT ingresado contiene errores.',
          'verified_user' => 'Correo electrónico aún no validado.<br><b>Revise su carpeta SPAM</b>, de no encontrar el correo de validación, haga <a href="' . base_url('users/resend_validation') . '?rut={value}" class="link_something">click aquí</a> para reenviar.'
        ],
        'password' => [
          'validate_user' => 'RUT o contraseña no coinciden.'
        ]
      ];

      if (!$this->validate($rules, $errors)) {
        $data['validation'] = $this->validator;
      } else {
        $model = new UserModel();
        $user = $model->where('rut', $this->request->getVar('rut'))->first();
        $data = [
          'id'        => $user['id'],
          'name'      => $user['name'],
          'lastname'  => $user['lastname'],
          'email'     => $user['email'],
          'rut'       => $user['rut'],
          'role'      => 'user',
          'loggedIn'  => true,
        ];
        session()->set($data);

        session()->setFlashdata('success', 'Bienvenido! <b>' . $data['name'] . ' ' . $data['lastname'] . '</b>');

        return redirect()->to(base_url('users/profile'));
      }
    }

    echo view('header');
    echo view('navbar');
    echo view('login', $data);
    echo view('footer');
  } //end index


  public function register()
  {
    $data = [];
    if ($this->request->getMethod() == 'post') {
      //reglas de validacion
      $rules = [
        'name'            => ['label' => 'nombre', 'rules' => 'required|min_length[3]|max_length[20]'],
        'lastname'        => ['label' => 'apellido', 'rules' => 'required|min_length[3]|max_length[20]'],
        'email'           => ['label' => 'correo electrónico', 'rules' => 'required|min_length[6]|max_length[250]|email_exist[users.email]'],
        'rut'             => ['label' => 'rut', 'rules' => 'required|min_length[9]|max_length[12]|is_unique[users.rut]|validate_rut[users.rut]'],
        'password'        => ['label' => 'contraseña', 'rules' => 'required|min_length[6]|max_length[255]'],
        'repeat_password' => ['label' => 'confirmar contraseña', 'rules' => 'matches[password]']
      ];
      $errors = [
        'rut' => [
          'validate_rut'  => 'El RUT ingresado contiene errores.',
          'is_unique'     => 'RUT ya registrado. Inicie sesion o si no recuerda su contraseña puede recuperarlo haciendo <a href="#">click aquí</a>.'
        ],
        'email' => [
          'email_exist'   => 'Correo electrónico no existe o se encuentra mal ingresado.'
        ]
      ];

      if (!$this->validate($rules, $errors)) {
        $data['validation'] = $this->validator;
      } else {
        //guardar informacion de usuario
        $model = new UserModel();

        $data['name']     = $this->request->getVar('name');
        $data['lastname'] = $this->request->getVar('lastname');
        $data['email']    = $this->request->getVar('email');
        $data['rut']      = $this->request->getVar('rut');
        $data['password'] = $this->request->getVar('password');

        $token = bin2hex(openssl_random_pseudo_bytes(32));

        $data['link'] = base_url('users/email_validation?key=' . $data['rut'] . '&token=' . $token);

        $userData = [
          'name'                      => ucwords(strtolower($data['name'])),
          'lastname'                  => ucwords(strtolower($data['lastname'])),
          'rut'                       => $data['rut'],
          'email'                     => strtolower($data['email']),
          'password'                  => $data['password'],
          'email_verification_token'  => $token
        ];
        //'email_verified_at'         => date('y-m-d H:i:s')

        $model->save($userData);

        $message = view('emails/validation', $data);
        //$message = view('emails/registered', $data);

        $send = send_email($data['email'], '', 'Registrado correctamente', $message, '');

        if ($send) {
          return redirect()->to(base_url('users'))->with('success', 'Registrado correctamente. Hemos enviado un correo electrónico con sus datos. <b>Ya puede iniciar sesión.</b><br><br><small>(De no ver el correo de notificación, revise su carpeta <b>SPAM</b>).</small>');
        } else {
          return redirect()->to(base_url('users'))->with('failure', 'Error al enviar el correo con sus datos de registro.');
        }
      }
    } //end post

    echo view('header');
    echo view('navbar');
    echo view('register', $data);
    echo view('footer');

  } //end register

  
  public function email_validation()
  {
    $model = new UserModel();
    $data = [];
    if ($this->request->getMethod() == 'get') {
      $rut = $this->request->getVar('key');
      $token = $this->request->getVar('token');

      $user = $model->where('rut', $rut)->where('email_verification_token', $token)->first();

      if ($user != null) {
        //update database email_verified_at
        $userData = [
          'id' => $user['id'],
          'email_verified_at' => date('y-m-d H:i:s')
        ];

        $model->save($userData);

        if (!is_dir(ROOTPATH . 'public/files/usuarios/' . $rut)) {
          mkdir(ROOTPATH . 'public/files/usuarios/' . $rut, 0777, TRUE);
        }
        session()->setFlashdata('success', 'Correo validado correctamente. Ya puede iniciar sesión.');
      } else {
        session()->setFlashdata('success', 'Correo validado previamente. Ya puede iniciar sesión.');
      }
      return redirect()->to(base_url('users'));
    }
  } //end email_validation
  

  public function profile()
  {
    $data = [];
    $user_model           = new UserModel();
    $users_business_model = new UsersBusinessModel();
    $users_bank_model     = new UsersBankModel();
    $users_surveys_model  = new UsersSurveysModel();

    if ($this->request->getMethod() == 'post') {

      if ($this->request->getVar('submit_form') == 'user') {

        //reglas de validacion
        $rules = [
          'name'      => ['label' => 'nombre', 'rules' => 'required|min_length[3]|max_length[20]'],
          'lastname'  => ['label' => 'apellidos', 'rules' => 'required|min_length[3]|max_length[20]'],
        ];
        //solo si se envia via post la password
        if ($this->request->getPost('password') != '') {
          $rules = [
            'password'        => ['label' => 'contraseñas', 'rules' => 'required|min_length[6]|max_length[255]'],
            'repeat_password' => ['label' => 'repetir contraseña', 'rules' => 'matches[password]']
          ];
        }
        if (!$this->validate($rules)) {
          $data['validation'] = $this->validator;
        } else {
          //guardar informacion de usuario
          $userData = [
            'id'              => session()->get('id'),
            'name'            => $this->request->getVar('name'),
            'lastname'        => $this->request->getVar('lastname'),
            'sex'             => $this->request->getVar('sex'),
            'birthday'        => $this->request->getVar('birthday'),
            'sector'          => $this->request->getVar('sector'),
            'phone'           => $this->request->getVar('phone'),
            'fix_phone'       => $this->request->getVar('fix_phone'),
            'optional_email'  => $this->request->getVar('optional_email'),
            'id_native'       => $this->request->getVar('id_native'),
            'agrupation'      => $this->request->getVar('agrupation'),
            'address'         => $this->request->getVar('address'),
            'occupation'      => $this->request->getVar('occupation'),
            'deleted_at'      => NULL
          ];
          //solo si se envia via post la password
          if ($this->request->getPost('password') != '') {
            $userData['password'] = $this->request->getPost('password');
          }
          $user_model->save($userData);
          //actualiza cambios en el nombre y apellido
          session()->set('name', $userData['name']);
          session()->set('lastname', $userData['lastname']);

          redirect()->to(base_url('users/profile'))->with('success', 'Actualización usuario completa');
        } //end user
      } //end user

      if ($this->request->getVar('submit_form') == 'business') {
        //reglas de validacion
        $rules = [
          'business_rut'          => ['label' => 'rut', 'rules' => 'required|min_length[3]|max_length[20]'],
          'business_name'         => ['label' => 'nombre negocio', 'rules' => 'required|min_length[3]'],
          'business_address'      => ['label' => 'dirección', 'rules' => 'required|min_length[3]'],
          'business_phone'        => ['label' => 'teléfono', 'rules' => 'required|min_length[3]|max_length[8]'],
          'legal_representative'  => ['label' => 'representante legal', 'rules' => 'required|min_length[3]'],
        ];
        $errors = [
          'business_rut' => [
            'validate_rut' => 'El RUT ingresado contiene errores.'
          ]
        ];

        if (!$this->validate($rules, $errors)) {
          $data['validation'] = $this->validator;
        } else {
          $businessData = [
            'user_id'                 => session()->get('id'),
            'rut'                     => $this->request->getVar('business_rut'),
            'status'                  => '1',
            'business_name'           => $this->request->getVar('business_name'),
            'address'                 => $this->request->getVar('business_address'),
            'phone'                   => $this->request->getVar('business_phone'),
            'webpage'                 => $this->request->getVar('business_webpage'),
            'legal_representative'    => $this->request->getVar('legal_representative'),
            'position_representative' => $this->request->getVar('position_representative'),
            'deleted_at'              => NULL
          ];

          $business = $users_business_model->where('user_id', session()->get('id'))
            ->first();
          if ($business != null) {
            $user_id = ['id' => $business['id']];
            $businessData = array_merge($businessData, $user_id);
          }
          $users_business_model->save($businessData);
          session()->setFlashdata('success', 'Actualización negocio completa');
        }

      } //end business

      if ($this->request->getVar('submit_form') == 'bank') {
        $bankData = [
          'user_id'     => session()->get('id'),
          'name'        => $this->request->getVar('bank_name'),
          'type'        => $this->request->getVar('type'),
          'number'      => $this->request->getVar('number'),
          'deleted_at'  => NULL
        ];

        $bank = $users_bank_model->where('user_id', session()->get('id'))->first();
        if ($bank != null) {
          $user_id = ['id' => $bank['id']];
          $bankData = array_merge($bankData, $user_id);
        }

        $users_bank_model->save($bankData);
        session()->setFlashdata('success', 'Actualización banco completa');

      } //end bank

    } //end post

    $data['user'] = $user_model->select_all();
    $data['surveys'] = $users_surveys_model->recover_all_surveys_by_id();

    echo view('header');
    echo view('navbar');
    echo view('profile', $data);
    echo view('footer');

  } //end profile

  public function delete_business()
  {
    $id = $this->request->getVar('id');

    $users_business_model = new UsersBusinessModel();
    $users_business_model->delete(['id' => $id]);

    return redirect()->to(base_url('users/profile'))->with('success', 'Actualización negocio completa');
  }

  public function resend_validation()
  { //resend funciona solo previa validacion de login que correo existe
    $data['rut'] = $this->request->getVar('rut');

    $model = new UserModel();
    $user = $model->where('rut', $data['rut'])->first();
    $data['name'] = $user['name'];
    $data['lastname'] = $user['lastname'];
    $data['email'] = $user['email'];
    $data['link'] = base_url('users/email_validation?key=' . $data['rut'] . '&token=' . $user['email_verification_token']);

    $message = view('emails/validation', $data);

    $send = send_email($data['email'], '', 'Validacion correo electrónico', $message, '');

    if ($send) {
      session()->setFlashdata('success', 'Correo de validación enviado correctamente.');
    } else {
      session()->setFlashdata('failure', 'Error al enviar el correo de validación.');
    }

    return redirect()->to(base_url('users'));

  } //end resend_validation


  public function forgot()
  {
    $data = [];
    $model = new UserModel();

    if ($this->request->getMethod() == 'post') {
      $rules = [
        'rut'   => ['label' => 'rut', 'rules' => 'required|min_length[9]|max_length[12]|validate_rut[users.rut]'],
        'email' => ['label' => 'correo electrónico', 'rules' => 'required|min_length[6]|max_length[250]|valid_email|verified_user[email]']
      ];
      $errors = [
        'rut' => [
          'validate_rut' => 'El RUT ingresado contiene errores.'
        ],
        'email' => [
          'verified_user' => 'Correo electrónico no validado.<br>Haga <a href="' . base_url('users/resend_validation') . '?rut={value}">click aquí</a> para reenviar el correo de validación.'
        ]
      ];

      if (!$this->validate($rules, $errors)) {
        $data['validation'] = $this->validator;
      } else {
        $user = $model->where('rut', $this->request->getVar('rut'))
                      ->where('email', $this->request->getVar('email'))
                      ->first();

        if ($user != null) {
          //ver tiempo desde generado el hash
          $limit_time = strtotime($user['email_verified_at']) + 360; //6 min
          $wait = $limit_time - time();
          if (0 > 1) { //time() < $limit_time
            session()->setFlashdata('failure', 'Correo de recuperación ya enviado. Espere <b>' . $wait . '</b> segundos para intentar nuevamente.');
          } else {

            $userData = [
              'id' => $user['id'],
              'email_verification_token' => bin2hex(openssl_random_pseudo_bytes(32)),
              'email_verified_at' => date('y-m-d H:i:s')
            ];
            $model->save($userData);

            $data_e['link'] = base_url('users/change_password?key=' . $user['rut'] . '&token=' . $userData['email_verification_token']);

            $message = view('emails/recover', $data_e);
            $send = send_email($user['email'], '', 'Olvidaste tu contraseña', $message, '');

            if ($send) {
              session()->setFlashdata('success', 'Correo de recuperación enviado correctamente. Ve a tu correo electrónico.');
              return redirect()->to(base_url());
            } else {
              session()->setFlashdata('failure', 'Error al enviar el correo de recuperación.');
            }
          }
        } else {
          //redireccion a forgot con mensaje de correo invalidado
          session()->setFlashdata('failure', 'No fue posible enviar correo de recuperacion, RUT y/o correo electrónico no estan asociados.');
        }
      }
    }
    echo view('header');
    echo view('navbar');
    echo view('forgot', $data);
    echo view('footer');
  } //end forgot


  public function change_password()
  {
    $model = new UserModel();

    if ($this->request->getMethod() == 'get') {
      $data['key'] = $this->request->getVar('key');
      $data['token'] = $this->request->getVar('token');

      $user = $model->where('rut', $data['key'])
        ->where('email_verification_token', $data['token'])
        ->first();

      if ($user != '') {
        $data['email'] = $user['email'];

        $limit_time = strtotime($user['email_verified_at']) + 360; //6 min
        $wait = $limit_time - time();
        if (time() > $limit_time) {
          return redirect()->to(base_url('users'))->with('failure', 'Token de recuperacion vencido.');
        }
      } else {
        return redirect()->to(base_url('users/forgot'))->with('failure', 'No es posible cambiar su contraseña, token incorrecto.');
      }

    } //end get

    if ($this->request->getMethod() == 'post') {

      $rules = [
        'password'        => ['label' => 'contraseña', 'rules' => 'required|min_length[6]|max_length[255]'],
        'repeat_password' => ['label' => 'repetir contraseña', 'rules' => 'matches[password]']
      ];

      if (!$this->validate($rules)) {
        $data['validation'] = $this->validator;
      } else {

        $email = $this->request->getVar('rut');
        $password = $this->request->getVar('password');

        $user = $model->where('rut', $this->request->getVar('rut'))
          ->first();

        $userData = [
          'id'          => $user['id'],
          'password'    => $password,
          'updated_at'  => date('y-m-d H:i:s')
        ];
        $model->save($userData);
        return redirect()->to(base_url('users'))->with('success', 'Contraseña actualizada correctamente.');
      }
    }
    echo view('header');
    echo view('navbar');
    echo view('change', $data);
    echo view('footer');

  } //end change_password

  public function update_password(){
    $user_model = new UserModel();
    $rules = [
      'old_password'        => ['label' => 'contraseña actual', 'rules' => 'required|min_length[6]|max_length[255]'],
      'new_password'        => ['label' => 'contraseña nueva', 'rules' => 'required|min_length[6]|max_length[255]'],
      'repeat_new_password' => ['label' => 'repetir contraseña nueva', 'rules' => 'matches[new_password]']
    ];
    $errors = [
      'repeat_new_password' => [
        'matches' => 'Las contraseñas no coinciden.'
      ]
    ];

    if (!$this->validate($rules, $errors)) {
      $data['status'] = 'error';
      $data['data'] = $this->validator->listErrors();

    } else {
      $old_pass = $this->request->getVar('old_password');
      $user = $user_model->where('id', session()->get('id'))->first();

      if (password_verify($old_pass, $user['password'])) {
        $userData = [
          'id' => session()->get('id'),
          'password' => $this->request->getVar('new_password')
        ];
        $user_model->save($userData);
        $data['status'] = 'success';
        $data['data'] = 'Contraseña Actualizada. <b>Cerrando sesión...</b>';
      }else{
        $data['status'] = 'error';
        $data['data'] = 'Contraseña actual incorrecta';
      }
    } //end password
    echo json_encode($data);
  }

  public function logout()
  {
    session()->destroy();
    return redirect()->to(base_url('home'));
  }


}