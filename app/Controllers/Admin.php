<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AdminModel;

class Admin extends BaseController
{
    public function index()
    {
      $data = [];

      echo view('admin/header');
      echo view('admin/navbar');

      $model = new UserModel();
      $data['users'] = $model->findAll();

      echo view('admin/dashboard',$data);
      echo view('admin/footer');

    }

    public function login(){
      $data = [];

        if($this->request->getMethod() == 'post'){
          //validation rules
          $rules = [
            'email'     => ['label' => 'correo', 'rules' => 'required|min_length[6]|max_length[50]|valid_email'],
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
      $data = [];
      $data['user_survey_id'] = $this->request->getVar('user_survey_id');

      $query = $db->table('users_surveys us')
                  ->select('u.*, us.surveys_id')
                  ->join('users u', 'u.id = us.user_id')
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
        $data['answers'] = [];
        $query = $db->table('survey_answers sa')
                    ->select('sa.section, sa.question_number, sa.answer')
                    ->join('users_surveys us', 'us.id = sa.users_surveys_id')
                    ->where('us.surveys_id', $user['surveys_id'] )
                    ->where('us.user_id', session()->get('id'))
                    ->get()->getResultArray();

        if( !empty($query) ){
            $data['answers'] = reorder_answers($query);
        }

        //archivos de la encuesta si es que existen
        $file_list = [];
        $list = directory_map($files_directory);

        foreach ($list as $key => $val) {
          $section  = substr($val, 0, 1);
          $number   = substr($val, 2, 1);

          $file_list[$section][$number] = $val;
        }

        $data['file_list'] = $file_list;


        echo view('modals/form_modal', $data);

      }//end if get

    }


}//end class
