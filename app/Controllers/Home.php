<?php

namespace App\Controllers;
use App\Models\UsersSurveysModel;
use App\Models\SurveyAnswersModel;
use CodeIgniter\Files\File;

class Home extends BaseController
{
    public function index()
    {
      session()->remove('success');
      //session()->remove('failure');
      $data = [];
      echo view('header');
      echo view('navbar');
      echo view('index',$data);
      echo view('footer');
    }

    public function forms(){
      $db = db_connect();
      $data = [];
      $data['survey_id'] = $this->request->getVar('survey_id');

      $form_directory   = ROOTPATH . 'public/files/formularios/';
      $files_directory  = ROOTPATH . 'public/files/usuarios/' . session()->get('rut') . '/' . $data['survey_id'] . '/';

      if( $this->request->getMethod() == 'get' ){
        $scanned_dir = array_map('basename', glob($form_directory."\\*.json", GLOB_BRACE));

        for ($i=0; $i < count($scanned_dir); $i++) { //crear funcion
          $id = substr($scanned_dir[$i], 0,1);
          if( $id == $data['survey_id'] ){
            $data['content'] = file_get_contents( $form_directory . $scanned_dir[$i] );
            break;
          }//end if
        }//end for

        //respuestas formulario si existe
        $data['answers'] = [];
        $query = $db->table('survey_answers sa')
                    ->select('sa.section, sa.question_number, sa.answer, us.results_id')
                    ->join('users_surveys us', 'us.id = sa.users_surveys_id')
                    ->where('us.surveys_id', $data['survey_id'] )
                    ->where('us.user_id', session()->get('id'))
                    ->get()->getResultArray();

        if( !empty($query) ){
          if ($query[0]['results_id'] == '3') {
            return redirect()->to( base_url() )->with('failure','No es posible ingresar a este concurso. Usuario retirado.');
          }else if( $query[0]['results_id'] != '1' ){
            return redirect()->to( base_url() )->with('failure','Formulario en revision. No es posible editarlo.');
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

      }//end if get

      if( $this->request->getMethod() == 'post' ){
        $user_survey_id = 0;
        $userData = [];
        $resp = [];

        $query = $db->table('users_surveys')
                    ->where('user_id', session()->get('id') )
                    ->where('surveys_id', $data['survey_id'] )
                    ->get()
                    ->getResultArray();

        if( empty($query) ){ //primer formulario que llena el usuario
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
            if( $data['survey_id'] == $query[$i]['surveys_id'] ){//si respondio previamente el fom "x"
              $user_survey_id = $query[$i]['id'];
              break;
            }
          }
        }//end if empty

        $answers = new SurveyAnswersModel();

        $datos  = $this->request->getVar('data');
        $files  = $this->request->getFiles();

        if ( $files ) { //crear funcion
          $comp = $files['comp'];
          for ($i=0; $i < count($comp); $i++) {
            if ( $comp[$i]->getSize() != 0 ) {
                array_map('unlink', glob( $files_directory . '1_'.$i.'_comp.*' )); //deprecated??
                $name = '1_'.$i.'_comp.'.$comp[$i]->guessExtension(); //nombre: [seccion]_[numero archivo]_comp.[extension]
                $comp[$i]->move($files_directory, $name);
            }
          }

          $file = $files['file'];
          for ($j=0; $j < count($file); $j++) {
            if( $file[$j]->getSize() != 0 ){
              array_map('unlink', glob( $files_directory . '2_'.$j.'_file.*' ));
              $name = '2_'.$j.'_file.'.$file[$j]->guessExtension();
              $file[$j]->move($files_directory, $name);
            }
          }
        }

        for ($i=0; $i < count($datos); $i++) {
          for ($j=0; $j < count($datos[$i]); $j++) {

            $userAnswers = [];
            $query = $answers->select('id')
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

            $answers->save($userAnswers);

          }//end for
        }//end for
        $resp['status'] = 'success';
        $resp['data'] = 'Datos agregados correctamente. <b>Redireccionando...</b>';

        echo json_encode($resp);
      }//end request post

    }//end form function

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
        'results_id' => '3'
      ];
      $model->save($data);
      $model->delete($id);

      return redirect()->to( base_url('users/profile') )->with('success','Concurso <b>eliminado</b> correctamente.');

    }//end delete_survey

    public function delete_bank(){

    }//end delete_bank

    public function delete_business(){

    }//end delete_business

    public function delete_file(){
      $survey_id = $this->request->getVar('survey_id');
      $file_name = $this->request->getVar('file_name');
      $files_directory  = ROOTPATH . 'public/files/usuarios/' . session()->get('rut') . '/' . $survey_id . '/';
      array_map('unlink', glob( $files_directory . $file_name ));
    }//end delete_file

}
