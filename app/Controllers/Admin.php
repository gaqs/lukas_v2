<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\UsersBankModel;
use App\Models\AdminModel;
use App\Models\SurveysModel;
use App\Models\SurveyAnswersModel;
use App\Models\UsersSurveysModel;

class Admin extends BaseController
{
    public function index()
    {
      $data = [];
      $model = new SurveysModel();
      $data['surveys'] = $model->find([1,2,3,4]);

      $db = db_connect();
      $builder = $db->table('users');
      $data['users'] = $builder->countAll('rut');

      $builder2 = $db->table('users_surveys');
      $data['user_surveys'] = $builder2->where('results_id', '1')
                                      ->orWhere('results_id', '2')
                                      ->where('surveys_id !=', '0')->countAllResults();

      $builder3 = $db->table('users_surveys');
      $data['sended'] = $builder3->where('results_id', '2')
                                  ->where('surveys_id !=', '0')
                                  ->countAllResults();

      echo view('admin/header');
      echo view('admin/navbar');
      echo view('admin/dashboard',$data);
      echo view('admin/footer');
    }

    public function users()
    {
      $model = new UserModel();
      $data['users'] = $model->findAll();

      echo view('admin/header');
      echo view('admin/navbar');
      echo view('admin/users',$data);
      echo view('admin/footer');

    }

    public function login()
    {
      $data = [];

      if($this->request->getMethod() == 'post'){
        //validation rules
        $rules = [
          'email'     => ['label' => 'correo', 'rules' => 'required|min_length[6]|max_length[250]|valid_email'],
          'password'  => ['label' => 'contraseña', 'rules' => 'required|min_length[6]|max_length[255]|validate_email[email,password]']
        ];
        $errors = [
          'password' => [
            'validate_email' => 'Correo electrónico o contraseña no coinciden'
          ]
        ];

        if(!$this->validate($rules, $errors)){
          $data['validation'] = $this->validator;
        }else{
          $model = new AdminModel();
          $admin = $model->where('email', $this->request->getVar('email'))
                        ->first();

          $data = [
            //'id'        => $admin['id'],
            'name'        => $admin['name'],
            'lastname'    => $admin['lastname'],
            'email'       => $admin['email'],
            'role'        => 'admin',
            'superadmin'  => $admin['superadmin'],
            'loggedIn'    => true
          ];
          session()->set($data);
          return redirect()->to( base_url('admin/index'));
        }
      }

      echo view('admin/header');
      echo view('admin/login',$data);
      echo view('admin/footer');
    }

    public function forms()
    {
      $data = [];
      $survey_id = $this->request->getVar('survey_id');
      $db = db_connect();
      $query = $db->table('users as u')
                  ->select('u.*, us.id as users_surveys_id, us.results_id, us.surveys_id')
                  ->join('users_surveys us', 'u.id = us.user_id')
                  ->where('us.surveys_id', $survey_id);

      $data['users'] = $query->get()->getResultArray();

      echo view('admin/header');
      echo view('admin/navbar');
      echo view('admin/tables',$data);
      echo view('admin/footer');
    }

    public function applications(){
      $data = [];
      $db = db_connect();
      $query = $db->table('users as u')
                  ->select('u.*, us.id as users_surveys_id, us.results_id, us.surveys_id')
                  ->join('users_surveys us', 'u.id = us.user_id')
                  ->get();

      $data['users'] = $query->getResultArray();

      echo view('admin/header');
      echo view('admin/navbar');
      echo view('admin/tables', $data);
      echo view('admin/footer');
    }

    public function edit_form()
    {
      $db = db_connect();
      $survey_answer = new SurveyAnswersModel();
      $user_survey   = new UsersSurveysModel();
      $data = [];
      $data['user_survey_id'] = $this->request->getVar('user_survey_id');

      $query = $db->table('users u')
                  ->select('u.name, u.lastname, u.rut, u.email, us.user_id, us.surveys_id')
                  ->join('users_surveys us', 'u.id = us.user_id')
                  ->where('us.id', $data['user_survey_id'])
                  ->get()->getResultArray();
                  
      $data['user']       = $query[0];
      $data['survey_id']  = $data['user']['surveys_id'];

      $form_directory   = ROOTPATH . 'public/files/concursos/';
      $files_directory  = ROOTPATH . 'public/files/usuarios/' . $data['user']['rut'] . '/' . $data['user']['surveys_id'] . '/';

      if( $this->request->getMethod() == 'get' ){

        $data['status'] = $user_survey->where('id', $data['user_survey_id'])->withDeleted()->findColumn('results_id')[0];

        $data['content'] = file_get_contents( $form_directory . $data['user']['surveys_id'].'.json' );

        $query = $survey_answer->survey_answers_per_user( $data['user']['surveys_id'], $data['user']['user_id'] );

        $data['answers'] = reorder_answers($query);
        //archivos de la encuesta si es que existen
        $file_list = [];
        $list = directory_map($files_directory);

        foreach ($list as $key => $val) {
          $section  = substr($val, 0, 1);
          $number   = substr($val, 2, 1);

          $file_list[$section][$number] = $val;
        }

        $data['file_list'] = $file_list;

        echo view('admin/modals/form_modal', $data);

      }//end if get


      if( $this->request->getMethod() == 'post' ){

        $datos          = $this->request->getVar('data');
        $user_survey_id = $this->request->getVar('user_survey_id');
        $status         = $this->request->getVar('status');
        $files          = $this->request->getFiles();

        //manejo de archivos del formulario
        if ( $files ) {
          $aux = '1';
          foreach ($files as $key => $value) {
            manage_files( $aux, $files, $key, $files_directory ); //manage_files( $seccion formulario, $arreglo completo archivos, $key del array, $directorio )
            $aux++;
          }
        }
        
        //actualiza status formulario, enviado = 2 o guardado = 1 
        $user_survey->update($user_survey_id, ['results_id' => $status]);

        $userAnswers = [];
        for ($i=0; $i < count($datos); $i++) {
          for ($j=0; $j < count($datos[$i]); $j++) {
            
            $userAnswers = [];
            $query = $survey_answer->select('id')
                                  ->where('users_surveys_id', $user_survey_id)
                                  ->where('section', $i)
                                  ->where('question_number', $j)
                                  ->first();

            if( !empty($query) ){
              $userAnswers += [ 'id' => $query['id'] ];
            }

            $userAnswers += [
              'users_surveys_id' => $user_survey_id,
              'section'          => $i,
              'question_number'  => $j,
              'answer'           => $datos[$i][$j],
              'deleted_at'       => NULL
            ];

            $survey_answer->save($userAnswers);

          }//end for
        }//end for

      }//end request post

    }

    public function edit_survey()
    {
      $data = [];
      $id = $this->request->getVar('id');

      $model = new SurveysModel();
      $data['survey'] = $model->where('id', $id)
                              ->first();
      echo view('admin/modals/dates_modal', $data);

    }

    public function edit_user()
    {
      $data = [];
      $id = $this->request->getVar('id');

      $user_model       = new UserModel();
      $users_bank_model = new UsersBankModel();

      if( $this->request->getMethod() == 'post'){

        $userData = [
          'id'             => $id,
          'name'           => $this->request->getVar('name'),
          'lastname'       => $this->request->getVar('lastname'),
          'sex'            => $this->request->getVar('sex'),
          'birthday'       => $this->request->getVar('birthday'),
          'sector'         => $this->request->getVar('sector'),
          'phone'          => $this->request->getVar('phone'),
          'fix_phone'      => $this->request->getVar('fix_phone'),
          'email'          => $this->request->getVar('email'),
          'optional_email' => $this->request->getVar('optional_email'),
          'id_native'       => $this->request->getVar('id_native'),
          'agrupation'      => $this->request->getVar('agrupation'),
          'address'        => $this->request->getVar('address'),
          'occupation'     => $this->request->getVar('occupation'),
          'deleted_at'     => NULL
        ];

        if( $this->request->getVar('password') != '' ){
          $new_pass = ['password' => $this->request->getVar('password') ];
          $userData = array_merge( $userData, $new_pass  );
        }

        if( $this->request->getVar('email_verified_at') == 1 ){
          $email_verified_at = $user_model->where('id',$id)->findColumn('email_verified_at');
          if( $email_verified_at != '' ){
            $email_verified = ['email_verified_at' => date('y-m-d H:i:s') ];
            $userData = array_merge( $userData, $email_verified  );
          }
        }

        $user_model->save($userData);

        $bankData = [
          'user_id'   => $id,
          'name'      => $this->request->getVar('bank_name'),
          'type'      => $this->request->getVar('type'),
          'number'    => $this->request->getVar('number'),
          'deleted_at'=> NULL
        ];

        $bank = $users_bank_model->where('user_id', $id)
                                 ->first();
        if( $bank != null ){
          $user_id = [ 'id' => $bank['id'] ];
          $bankData = array_merge( $bankData, $user_id  );
        }
        $users_bank_model->save($bankData);

      }else{
        $data['user'] = $user_model->select_user_data($id);
        echo view('admin/modals/users_modal', $data);
      }
      
    }

    public function admins()
    {
      $data = [];
      $db = db_connect();
      $data['admin'] = $db->table('administrators')
                          ->get()->getResultArray();

      echo view('admin/header');
      echo view('admin/navbar');
      echo view('admin/admins', $data);
      echo view('admin/footer');
    }

    public function edit_admin()
    {
      error_reporting(E_WARNING);
      $admin_model   = new AdminModel();
      $data['id']    = $this->request->getVar('id');
      $data['admin'] = [];

      if( $this->request->getMethod() == 'post' ){
          $check = $this->request->getVar('superadmin');
          $superadmin = 0;
          if( isset($check) ){ $superadmin = 1; }

          $adminData = [
            'name'       => $this->request->getVar('name'),
            'lastname'   => $this->request->getVar('lastname'),
            'email'      => $this->request->getVar('email'),
            'superadmin' => $superadmin,
            'role'       => 'admin'
          ];
          if( $this->request->getVar('password') != ''){
            $admin_pass = [ 'password' => $this->request->getVar('password')  ];
            $adminData = array_merge( $adminData, $admin_pass );
          }

          if( $data['id'] != 0 ){
            $admin_id = [ 'id' => $data['id'] ];
            $adminData = array_merge( $adminData, $admin_id );
          }else{
            //enviar email confirmacion
            $message = view('emails/admin',$adminData);
            $send = send_email($adminData['email'], '', 'Cuenta Administrador Lukas para Emprender', $message, '');
          }

          $admin_model->save($adminData);
          
          $resp['status'] = 'success';
          echo json_encode($resp);

      }else if( $this->request->getMethod() == 'get' ){
        if( $data['id'] == 0 ){ //registro nuevo
          $data['admin']['superadmin'] = 0;
          echo view('admin/modals/admin_modal', $data);
        }else{//edicion de usuario previamente creado
          $data['admin'] = $admin_model->find($data['id']);
          echo view('admin/modals/admin_modal', $data);
        }
      }
    }

    public function delete_admin()
    {
      $admin_model = new AdminModel();
      $id = $this->request->getVar('id');

      $admin_model->delete( $id );

      return redirect()->to( base_url('admin/admins') )->with('success','Administrador eliminado correctamente.');
    }


    public function password()
    {
      $data = [];
      if( $this->request->getMethod() == 'post' ){
        $pass = $this->request->getVar('pass');

        $resp = password_hash($pass, PASSWORD_DEFAULT);

        echo $resp;
      }

      if( $this->request->getMethod() == 'get' ){
        echo view('admin/header');
        echo view('admin/navbar');
        echo view('admin/password',$data);
        echo view('admin/footer');

      }
    }
    
    public function review_form(){ //solo emprendimientos
      $id_form = 1;

      $db = db_connect();
      $users = $db->table('users as u')
                    ->select('u.id as user_id, us.id, u.rut, u.name, u.lastname')
                    ->join('users_surveys us', 'u.id = us.user_id')
                    ->where('us.surveys_id = '. $id_form)
                    ->where('us.results_id = 1')
                    ->get()->getResultArray();

    echo '<table>';
    for ($i=0; $i < count($users); $i++) {

      $todas_respuestas = true;
      $todos_archivos = false;
      //revision archivos
      $files_directory  = ROOTPATH . 'public/files/usuarios/' . $users[$i]['rut'] . '/'.$id_form.'/';
      $clean = [];
      $list = directory_map($files_directory);
      for ($k=0; $k < count($list); $k++) {
          $name = pathinfo($list[$k], PATHINFO_FILENAME);
          $clean[] = $name;
      }

      $obligatory = array('1_0_comp','2_0_file','2_1_file','2_3_file');
      if(count(array_intersect($obligatory, $clean)) == count($obligatory)){
        //var_dump($clean);
        $todos_archivos = true;
      }
      //revision respuestas
      $answers = $db->table('survey_answers')
                     ->select('*')
                     ->where('users_surveys_id = '.$users[$i]['id'])
                     ->get()->getResultArray();

      $answers = reorder_answers($answers);

      for ($j=0; $j <= count($answers); $j++) {
        if( empty($answers[1][$j]) ){
          $todas_respuestas = false;
          break;
        }
      }
      if( $todas_respuestas == true && $todos_archivos == true ){ //&& $todos_archivos == true
        echo '<tr>
                <td>'.$users[$i]['id'].'</td>
              </tr>';
      }
    }
    echo '</table>';
    }

    public function delete_file(){
      $survey_id  = $this->request->getVar('survey_id');
      $file_name  = $this->request->getVar('file_name');
      $rut        = $this->request->getVar('rut');
      $files_directory  = ROOTPATH . 'public/files/usuarios/' . $rut. '/' . $survey_id . '/';

      array_map('unlink', glob( $files_directory . $file_name ));
    }//end delete_file

    public function test_email(){
      $data = [
        'name'                      => 'Gustavo',
        'lastname'                  => 'Quilodran',
        'rut'                       => '17513256-2',
        'email'                     => 'gaqs.02@gmail.com',
        'password'                  => '132456',
        'email_verification_token'  => 'token',
        'link' => 'link'
      ];
      //'email_verified_at'         => date('y-m-d H:i:s')

      $message = view('emails/validation', $data);
      //$message = view('emails/registered', $data);

      $send = send_email($data['email'], '', 'Registrado correctamente', $message, '');
    }

}//end class
