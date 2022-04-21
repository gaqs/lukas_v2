<?php

namespace App\Models;
use CodeIgniter\Model;

class SurveyAnswersModel extends Model{
  protected $table = 'survey_answers';
  protected $primaryKey = 'id';

  protected $useSoftDeletes = true;
  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';

  protected $allowedFields = ['users_surveys_id', 'section', 'question_number', 'answer','category_number','score','deleted_at'];
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];

  //antes de insertar, el modelo devuelve las pass cifrada
  protected function beforeInsert(array $data){
    $data['data']['created_at'] = date('Y-m-d H:i:s');
    return $data;
  }

  protected function beforeUpdate(array $data){
    $data['data']['updated_at'] = date('Y-m-d H:i:s');
    return $data;
  }

  public function survey_answers_per_user( $survey_id, $user_id ){
    $db = db_connect();
    $query = $db->table('survey_answers sa')
                ->select('sa.section, sa.question_number, sa.answer, us.results_id')
                ->join('users_surveys us', 'us.id = sa.users_surveys_id')
                ->where('us.surveys_id', $survey_id )
                ->where('us.user_id', $user_id)
                ->get()->getResultArray();
    return $query;
  }

}

 ?>
