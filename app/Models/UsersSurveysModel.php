<?php

namespace App\Models;
use CodeIgniter\Model;

class UsersSurveysModel extends Model{
  protected $table = 'users_surveys';
  protected $primaryKey = 'id';

  protected $useSoftDeletes = true;
  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';

  protected $allowedFields = ['user_id', 'surveys_id', 'results_id', 'result_information','created_at', 'updated_at','deleted_at'];
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

  public function recover_surveys_by_id(){
    $db = db_connect();
    $query = $db->table('users_surveys us')
                ->select('us.id, us.user_id, us.surveys_id, s.name, us.results_id, rc.status, us.result_information, us.created_at, us.updated_at, us.deleted_at')
                ->join('surveys s', 's.id = us.surveys_id')
                ->join('users u', 'u.id = us.user_id')
                ->join('results_category rc', 'us.results_id = rc.id')
                ->where('us.user_id', session()->get('id') )
                ->where('us.deleted_at IS NULL')
                ->get()->getResultArray();
    return $query;
  }

  public function recover_all_surveys_by_id(){
    $db = db_connect();
    $query = $db->table('users_surveys us')
                ->select('us.id, us.user_id, us.surveys_id, s.name, us.results_id, rc.status, us.result_information, us.created_at, us.updated_at, us.deleted_at')
                ->join('surveys s', 's.id = us.surveys_id')
                ->join('users u', 'u.id = us.user_id')
                ->join('results_category rc', 'us.results_id = rc.id')
                ->where('us.user_id', session()->get('id') )
                ->get()->getResultArray();
    return $query;
  }


}

 ?>
