<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\SurveysModel;
use App\Models\SurveyAnswersModel;

class Admin extends BaseController
{
    public function index()
    {
      $data = [];
      $model = new SurveysModel();
      $data['surveys'] = $model->findAll();

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
            'password'  => ['label' => 'contraseña', 'rules' => 'required|min_length[6]|max_length[255]|validate_user[email,password]']
          ];
          $errors = [
            'password' => [
              'validate_user' => 'Correo electrónico o contraseña no coinciden'
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
            return redirect()->to( base_url('admin'));
          }
        }

        if( session()->get('loggedIn')){
            return redirect()->to( base_url('admin'));
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
                  ->select('u.*, us.id as users_surveys_id')
                  ->join('users_surveys us', 'u.id = us.user_id')
                  ->where('us.surveys_id', $survey_id);

      $data['users'] = $query->get()->getResultArray();

      echo view('admin/header');
      echo view('admin/navbar');
      echo view('admin/tables',$data);
      echo view('admin/footer');

    }

    public function edit_form(){
      $db = db_connect();
      $survey_answer_model = new SurveyAnswersModel();
      $data = [];
      $data['user_survey_id'] = $this->request->getVar('user_survey_id');

      $query = $db->table('users u')
                  ->select('u.rut, us.user_id, us.surveys_id')
                  ->join('users_surveys us', 'u.id = us.user_id')
                  ->where('us.id', $data['user_survey_id'])
                  ->get()->getResultArray();

      $user = $query[0];

      $form_directory   = ROOTPATH . 'public/files/formularios/';
      $files_directory  = ROOTPATH . 'public/files/usuarios/' . $user['rut'] . '/' . $user['surveys_id'] . '/';

      if( $this->request->getMethod() == 'get' ){
        $scanned_dir = array_map('basename', glob($form_directory."\\*.json", GLOB_BRACE));

        for ($i=0; $i < count($scanned_dir); $i++) {
          $id = substr($scanned_dir[$i], 0,1);
          if( $id == $user['surveys_id'] ){
            $data['content'] = file_get_contents( $form_directory . $scanned_dir[$i] );
            break;
          }//end if
        }//end for

        //respuestas formulario si existe
        $query = $survey_answer_model->survey_answers_per_user( $user['surveys_id'], $user['user_id']  );
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


}//end class
