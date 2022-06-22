<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\UsersSurveysModel;
use App\Models\SurveyAnswersModel;
use CodeIgniter\Files\File;
use Dompdf\Dompdf;
use Dompdf\Options;

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
    $form_directory = ROOTPATH . 'public/files/concursos/' . $survey_id . '/';
    $scanned_dir = array_map('basename', glob($form_directory."*.json", GLOB_BRACE));
    $data['questions'] = file_get_contents( $form_directory . $scanned_dir[0] );

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

}
?>
