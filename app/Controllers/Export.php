<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\UsersSurveysModel;
use App\Models\SurveyAnswersModel;
use CodeIgniter\Files\File;
use Dompdf\Dompdf;
use Dompdf\Options;
use ZipArchive;

class Export extends BaseController
{
  public function index() {
    return view('pdfview');
  }
  
  public function export_user_survey(){
    require_once( APPPATH . "ThirdParty/dompdf/autoload.inc.php" );
    $user_model     = new UserModel();
    $user_surveys   = new UsersSurveysModel();
    $survey_answers = new SurveyAnswersModel();
    $data = [];

    $user_id   = $this->request->getVar('user_id');
    $survey_id = $this->request->getVar('survey_id');

    //preguntas
    $form_directory = ROOTPATH . 'public/files/concursos/';
    $data['questions'] = file_get_contents( $form_directory . $survey_id.'.json' );

    //respuestas
    $query = $survey_answers->survey_answers_per_user( $survey_id, $user_id );
    $data['answers'] = reorder_answers($query);

    //datos usuario
    $data['user'] = $user_model->select_user_data($user_id);

    //echo view('admin/pdfview', $data);

    $options = new Options();
    $options->set('defaultFont', 'sans-serif');
    $options->set('fontHeightRatio', '1');
    $options->set('defaultPaperSize', 'a4');

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml( view('admin/pdfview', $data) );
    $dompdf->render();
    $dompdf->stream('document.pdf', array("Attachment" => false));

  }

  public function export_zip(){
    //ini_set('memory_limit', '2048M');
    helper('filesystem');
    require_once( APPPATH . "ThirdParty/dompdf/autoload.inc.php" );
    $user_model     = new UserModel();
    $user_surveys   = new UsersSurveysModel();
    $survey_answers = new SurveyAnswersModel();
    $data = [];

    $user_id   = $this->request->getVar('user_id');
    $survey_id = $this->request->getVar('survey_id');

    //preguntas
    $form_directory = ROOTPATH . 'public/files/concursos/';
    $data['questions'] = file_get_contents( $form_directory . $survey_id.'.json' );

    //respuestas
    $query = $survey_answers->survey_answers_per_user( $survey_id, $user_id );
    $data['answers'] = reorder_answers($query);

    //datos usuario
    $data['user'] = $user_model->select_user_data($user_id);
    
    //echo view('admin/pdfview', $data);

    $options = new Options();
    $options->set('defaultFont', 'sans-serif');
    $options->set('fontHeightRatio', '1');
    $options->set('defaultPaperSize', 'a4');

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml( view('admin/pdfview', $data) );
    $dompdf->render();

    $files = [];

    //formulario usuario
    $user_form = '../public/files/temp/'.$data['user']['user_rut'].'.pdf';
    write_file( $user_form, $dompdf->output()); 

    //archivos usuario
    $directory = '../public/files/usuarios/' . $data['user']['user_rut'] . '/' . $survey_id . '/';
    $map = directory_map( $directory );
    if (($key = array_search('index.html',$map)) !== false) { unset($map[$key]); }

    foreach ($map as $key => $value) {
      array_push($files, $directory.$value);
    }
    array_push($files, $user_form);

    //creacion de zip
    $zipname = '../public/files/temp/'.$data['user']['user_rut'].'.zip';
    $zip = new \ZipArchive;
    $zip->open($zipname, ZipArchive::CREATE);
    foreach ($files as $key => $value) {
      $zip->addFile($value, basename($value));
    }
    $zip->close();

    header('Content-disposition: attachment; filename='.$data['user']['user_rut'].'.zip');
    header('Content-type: application/zip');
    readfile($zipname);

    unlink($zipname);
    unlink($user_form);
  }

  public function download_zip(){

    $files = ['public/files/usuarios/08802287-4/1/2_1_file.pdf'];

    //creacion de zip
    $zipname = '../public/files/temp/residencia.zip';
    $zip = new \ZipArchive;
    $zip->open($zipname, ZipArchive::CREATE);
    foreach ($files as $key => $value) {
      $newname = str_replace("/", "", substr($value, 22,10)).'.'.str_replace(".", "", substr($value,-4));
      echo $newname.'<br>';
      $zip->addFile(ROOTPATH . $value, $newname);
    }
    $zip->close();

    header('Content-disposition: attachment; filename=residencia.zip');
    header('Content-type: application/zip');
    readfile($zipname);

    unlink($zipname);

  }

}
?>
