<?php

namespace App\Controllers;
use App\Models\UserModel;
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
      $data['surveys'] = $model->findAll();

      $db = db_connect();
      $builder = $db->table('users');
      $data['users'] = $builder->countAll('rut');

      $builder2 = $db->table('users_surveys');
      $data['user_surveys'] = $builder2->countAll('id');

      $builder3 = $db->table('users_surveys');
      $data['sended'] = $builder3->where('results_id', '2')
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

    public function login(){
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
              'name'      => $admin['name'],
              'lastname'  => $admin['lastname'],
              'email'     => $admin['email'],
              'role'      => 'admin',
              'loggedIn'  => true
            ];
            session()->set($data);
            return redirect()->to( base_url('admin/index'));
          }
        }

        echo view('admin/header');
        echo view('admin/login',$data);
        echo view('admin/footer');
    }

    public function forms(){
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

    public function edit_form(){
      $db = db_connect();
      $survey_answer = new SurveyAnswersModel();
      $data = [];
      $data['user_survey_id'] = $this->request->getVar('user_survey_id');

      $query = $db->table('users u')
                  ->select('u.rut, us.user_id, us.surveys_id')
                  ->join('users_surveys us', 'u.id = us.user_id')
                  ->where('us.id', $data['user_survey_id'])
                  ->get()->getResultArray();

      $data['user'] = $query[0];
      $data['survey_id'] = $data['user']['surveys_id'];

      $form_directory   = ROOTPATH . 'public/files/concursos/' . $data['user']['surveys_id'] . '/';
      $files_directory  = ROOTPATH . 'public/files/usuarios/' . $data['user']['rut'] . '/' . $data['user']['surveys_id'] . '/';

      if( $this->request->getMethod() == 'get' ){
        $scanned_dir = array_map('basename', glob($form_directory."*.json", GLOB_BRACE));
        $data['content'] = file_get_contents( $form_directory . $scanned_dir[0] );

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

      $model = new UserModel();
      $data['user'] = $model->select_user_data($id);
      echo view('admin/modals/users_modal', $data);

    }

    public function register(){
      $data = [];
      $admin_model = new AdminModel();
      $db = db_connect();
      $data['admin'] = $db->table('administrators')
                          ->get()->getResultArray();

      if( $this->request->getMethod() == 'post' ){
        $rules = [
          'email'     => ['label' => 'correo', 'rules' => 'required|min_length[6]|max_length[250]|is_unique[administrators.email]|valid_email'],
        ];

        if(!$this->validate($rules)){
          return redirect()->to( base_url('admin/register') )->with('failure','Error al registrar al administrador.');
        }else{

          $adminData = [
            'name'     => $this->request->getVar('name'),
            'lastname' => $this->request->getVar('lastname'),
            'email'    => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'role'     => 'admin'
          ];

          $admin_model->save($adminData);
          //enviar email confirmacion
          $message = view('emails/admin',$adminData);
          $send = send_email_puertomontt($adminData['email'], '', 'Cuenta Administrador Lukas para Emprender', $message, '');

          return redirect()->to( base_url('admin/register') )->with('success','Administrador ingresado correctamente.');

        }
      }

      echo view('admin/header');
      echo view('admin/navbar');
      echo view('admin/register', $data);
      echo view('admin/footer');
    }

    public function delete_admin(){
      $admin_model = new AdminModel();
      $id = $this->request->getVar('id');

      $admin_model->delete( $id );

      return redirect()->to( base_url('admin/register') )->with('success','Administrador eliminado correctamente.');
    }


    public function password(){
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

    public function test_email(){
      $send = send_email_puertomontt('gaqs.02@gmail.com', '', 'Prueba', 'prueba', '');
      var_dump($send);
    }

    public function review_form(){ //solo emprendimiento

      $data = [];
      $file_list = [];
      $descalificado = 0;

      $db = db_connect();
      $users = $db->table('users as u')
                    ->select('u.id as user_id, us.id, u.rut, u.name, u.lastname')
                    ->join('users_surveys us', 'u.id = us.user_id')
                    ->where('surveys_id = 1')
                    ->where('results_id = 1')
                    ->get()->getResultArray();

    echo '<table>';
    for ($i=0; $i < count($users); $i++) {

      $todas_respuestas = true;
      $todos_archivos = false;
      //revision archivos
      $files_directory  = ROOTPATH . 'public/files/usuarios/' . $users[$i]['rut'] . '/1/';
      $clean = [];
      $list = directory_map($files_directory);
      for ($k=0; $k < count($list); $k++) {
          $name = pathinfo($list[$k], PATHINFO_FILENAME);
          $clean[] = $name;
      }

      $obligatory = array('2_0_file','2_1_file','2_3_file');
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


}//end class
