<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\UsersBankModel;
use App\Models\UsersSurveysModel;
use App\Models\SurveyAnswersModel;
use CodeIgniter\Files\File;

class Home extends BaseController
{
    public function index()
    {
      $data = [];
      echo view('header');
      echo view('navbar');
      echo view('index',$data);
      echo view('footer');
    }

    public function forms(){
      $db = db_connect();
      $survey_answer    = new SurveyAnswersModel();
      $users_surveys    = new UsersSurveysModel();

      //Datos basicos y bancarios del usuario
      $user_model       = new UserModel();
      $users_bank_model = new UsersBankModel();

      $data = [];
      $data['survey_id'] = $this->request->getVar('survey_id');
      $data['content']    = '';

      $form_directory   = ROOTPATH . 'public/files/concursos/';
      $files_directory  = ROOTPATH . 'public/files/usuarios/' . session()->get('rut') . '/' . $data['survey_id'] . '/';

      if( $this->request->getMethod() == 'get' ){
        $data['content']  = file_get_contents( $form_directory.$data['survey_id'].'.json' );
        $data['answers']  = [];//respuestas formulario si existe
        $data['user']     = $user_model->select_all();
        
        //NEED FIX
        $surveys = $users_surveys->recover_surveys_by_id();
        
        if( !empty($surveys) ){
          if( $surveys[0]['surveys_id'] != $data['survey_id'] ){
              return redirect()->to( base_url() )->with('failure','No es posible participar en otro concurso.');
          }
        }
        $query = $survey_answer->survey_answers_per_user( $data['survey_id'], session()->get('id') );
        if( !empty($query) ){
          if ($query[0]['results_id'] == '4') {
            return redirect()->to( base_url() )->with('failure','No es posible ingresar a este concurso. Usuario retirado.');
          }else if( $query[0]['results_id'] != '1' ){
            return redirect()->to( base_url() )->with('success','Formulario correctamente enviado, no es posible editarlo.');
          }else{
            $data['answers'] = reorder_answers($query);
          }
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

        echo view('header');
        echo view('navbar');
        echo view('forms', $data);
        echo view('footer');
      }//end get

      if( $this->request->getMethod() == 'post' ){
        $user_survey_id = 0;
        $userData = [];
        $resp = [];

        $datos  = $this->request->getVar('data');
        $send   = $this->request->getVar('send');
        $button = $this->request->getVar('button');
        $files  = $this->request->getFiles();

        $query = $db->table('users_surveys')
                    ->where('user_id', session()->get('id') )
                    ->where('surveys_id', $data['survey_id'] )
                    ->get()
                    ->getResultArray();

        if( empty($query) ){ //( && $button == 'save_form') primer formulario que llena el usuario
          $userData = [
            'user_id'     => session()->get('id'),
            'surveys_id'  => $data['survey_id'],
            'created_at'  => date('y-m-d H:i:s'),
            'updated_at'  => date('y-m-d H:i:s'),
            'deleted_at'  => NULL
          ];
          $db->table('users_surveys')->insert($userData);
          $user_survey_id = $db->insertID();

        }else{

          for ($i=0; $i < count($query); $i++) { //todos los formularios
            if( $data['survey_id'] == $query[$i]['surveys_id'] ){//si respondio previamente el form "x"
              $user_survey_id = $query[$i]['id'];
              break;
            }
          }
        }//end if empty

        //datos basicos de usuario
        $userForm = [
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

        $user_model->save($userForm);
        //actualiza cambios en el nombre y apellido
        session()->set('name', $userForm['name']);
        session()->set('lastname', $userForm['lastname']);

        $bankData = [
          'user_id'   => session()->get('id'),
          'name'      => $this->request->getVar('bank_name'),
          'type'      => $this->request->getVar('type'),
          'number'    => $this->request->getVar('number'),
          'deleted_at'=> NULL
        ];

        $bank = $users_bank_model->where('user_id', session()->get('id'))
                                 ->first();
        if( $bank != null ){
          $user_id = [ 'id' => $bank['id'] ];
          $bankData = array_merge( $bankData, $user_id);
        }

        $users_bank_model->save($bankData);

        //manejo de archivos del formulario
        if ( $files ) {
          $aux = '1';
          foreach ($files as $key => $value) {
            manage_files( $aux, $files, $key, $files_directory ); //manage_files( $seccion formulario, $arreglo completo archivos, $key del array, $directorio )
            $aux++;
          }
        }

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

        if( $button == 'send_form'){
          if( $send == 'true'){
            $data = [
              'id'         => $user_survey_id,
              'results_id' => '2'
            ];
            $users_surveys->save($data);

            $data = [
              'nombre'      => session()->get('name'),
              'apellido'    => session()->get('lastname'),
              'update_date' => date('y-m-d H:i:s'),
              'link'        => base_url(),
            ];
            //correo envio postulacion
            $message = view('emails/sended', $data);
            $send = send_email(session()->get('email'), '', 'Postulación confirmada', $message, '');

            $resp['status'] = 'success';
            session()->setFlashdata('success','Postulación enviada correctamente.');
          }else{
            $resp['status'] = 'error';
            session()->setFlashdata('failure','Tiene campos sin completar, <b>SU POSTULACIÓN NO SE HA ENVIADO</b>.');
          }
        }else{
          $data = [
            'id'         => $user_survey_id,
            'updated_at' => date('y-m-d H:i:s'),
          ];
          $users_surveys->save($data);

          $resp['status'] = 'success';
          session()->setFlashdata('success','Datos guardados correctamente.<br><b>RECUERDE QUE SU POSTULACIÓN AUN NO SE HA ENVIADO.</b>');
        }//end if send_form

        echo json_encode($resp);
      }//end request post

    }//end form function


    public function briefing(){
      $users_surveys = new UsersSurveysModel();
      $data['id']    = $this->request->getVar('survey_id');
      
      //$data['link']  = '#';
      //link cambia dependiendo de la id del formulario y su esta posee otro documento
      //$data['link'] = base_url('public/files/concursos/docs/Fondo_Concursable_Lukas_para_Emprender_2022.pdf');

      echo view('header');
      echo view('navbar');
      echo view('briefing', $data);
      echo view('footer');
    }

    public function recover_info(){
      $db = db_connect();
      $id = $this->request->getVar('user_survey_id');

      $model = new UsersSurveysModel();
      $info  = $model->where( 'id', $id )
                     ->first();

      echo json_encode($info);
    }

    public function delete_survey(){
      $id = $this->request->getVar('user_survey_id');
      $model = new UsersSurveysModel();
      $data = [
        'id'         => $id,
        'results_id' => '4'
      ];
      $model->save($data);
      $model->delete($id);

      return redirect()->to( base_url('users/profile') )->with('success','Concurso <b>eliminado</b> correctamente.');

    }//end delete_survey

    public function delete_bank(){

    }//end delete_bank

    public function delete_file(){
      $survey_id = $this->request->getVar('survey_id');
      $file_name = $this->request->getVar('file_name');
      $files_directory  = ROOTPATH . 'public/files/usuarios/' . session()->get('rut') . '/' . $survey_id . '/';
      //var_dump($files_directory);
      array_map('unlink', glob( $files_directory . $file_name ));
    }//end delete_file

    public function help(){
      $data = []; 

      if( $this->request->getMethod() == 'post' ){

        $rules = [
          'name'    => ['label' => 'nombre', 'rules' => 'required|min_length[3]|max_length[20]'],
          'phone'   => ['label' => 'teléfono', 'rules' => 'min_length[6]|max_length[20]'],
          'email'   => ['label' => 'correo electrónico', 'rules' => 'required|min_length[3]|valid_email'],
          'subject' => ['label' => 'asunto', 'rules' => 'required|min_length[3]|max_length[20]'],
          'message' => ['label' => 'mensaje', 'rules' => 'required|min_length[10]']
        ];

        if(!$this->validate($rules)){
          $data['validation'] = $this->validator;
        }else{
          $data = [
            'name'    => $this->request->getVar('name'),
            'phone'   => $this->request->getVar('phone'),
            'email'   => $this->request->getVar('email'),
            'subject' => $this->request->getVar('subject'),
            'message' => $this->request->getVar('message')
          ];

          $message = view('emails/help',$data);

          $send = send_email('lukasparaemprender@gmail.com', '', $data['subject'], $message, '');

          if( $send ){
            return redirect()->to( base_url() )->with('success','Mensaje enviado correctamente. Nos comunicaremos contigo prontamente.');
          }else{
            return redirect()->to( base_url() )->with('failure','Error al enviar el mensaje.');
          }

        }
      }

      echo view('header');
      echo view('navbar');
      echo view('help', $data);
      echo view('footer');
    }

}
