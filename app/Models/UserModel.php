<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model{
  protected $table = 'users';
  protected $primaryKey = 'id';

  protected $useSoftDeletes = true;
  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';

  protected $allowedFields = ['name','lastname','birthday','sector','sex','email','optional_email','rut','address','phone','fix_phone','password','email_verification_token','deleted_at', 'email_verified_at'];
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];

  //antes de insertar, el modelo devuelve las pass cifrada
  protected function beforeInsert(array $data){
    $data = $this->passwordHash($data);
    $data['data']['created_at'] = date('Y-m-d H:i:s');
    return $data;
  }

  protected function beforeUpdate(array $data){
    $data = $this->passwordHash($data);
    $data['data']['updated_at'] = date('Y-m-d H:i:s');
    return $data;
  }

  protected function passwordHash(array $data){
    if(isset($data['data']['password'])){
      $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
    }
    return $data;
  }

  public function select_all(){
    $db = db_connect();
    $query = $db->table('users u')
                ->select('u.id as user_id,
                          u.name as user_name,
                          u.lastname as user_lastname,
                          u.birthday,
                          u.sex,
                          u.rut as user_rut,
                          u.birthday,
                          u.sector,
                          u.address as user_address,
                          u.phone as user_phone,
                          u.fix_phone,
                          u.email as user_email,
                          u.optional_email,
                          u.email_verified_at,

                          ub.id as user_bank_id,
                          ub.name as user_bank_name,
                          ub.type,
                          ub.number,

                          ubs.id as user_business_id,
                          ubs.status,
                          ubs.rut as user_business_rut,
                          ubs.business_name,
                          ubs.address as user_business_address,
                          ubs.phone as user_business_phone,
                          ubs.webpage,
                          ubs.legal_representative,
                          ubs.position_representative')

                ->join('users_bank ub', 'u.id = ub.user_id','left')
                ->join('users_business ubs', 'u.id = ubs.user_id','left')
                ->where('u.id', session()->get('id') )
                ->get()->getResultArray();

      return $query[0];
  }

  public function select_user_data($id){
    $db = db_connect();

    if( $id == '' ){ $id = session()->get('id'); }

    $query = $db->table('users u')
                ->select('u.id as user_id,
                          u.name as user_name,
                          u.lastname as user_lastname,
                          u.birthday,
                          u.sector,
                          u.sex,
                          u.rut as user_rut,
                          u.birthday,
                          u.address as user_address,
                          u.phone as user_phone,
                          u.fix_phone,
                          u.email as user_email,
                          u.optional_email,
                          u.email_verified_at,

                          ub.id as user_bank_id,
                          ub.name as user_bank_name,
                          ub.type,
                          ub.number')

                ->join('users_bank ub', 'u.id = ub.user_id','left')
                ->where('u.id', $id )
                ->get()->getResultArray();

      return $query[0];
  }

}//end class


//SELECT u.id as user_id, us.id, u.rut, u.name, u.lastname, u.email
//FROM users u, users_surveys us
//WHERE us.user_id = u.id AND us.results_id = 2 AND us.surveys_id = 2
//ORDER BY u.id

//SELECT * FROM users_surveys WHERE surveys_id = 2 AND results_id = 2

?>
