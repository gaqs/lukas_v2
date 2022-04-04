<?php

namespace App\Models;
use CodeIgniter\Model;

class AdminModel extends Model{
  protected $table = 'administrators';
  protected $allowedFields = ['name', 'lastname', 'email', 'password', 'role', 'updated_at','deleted_at'];
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
}

 ?>
