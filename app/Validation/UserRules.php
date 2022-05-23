<?php
namespace App\Validation;
use App\Models\UserModel;

class UserRules
{

  public function validate_user(string $str, string $fields,array $data){
    $model = new UserModel();
    $user = $model->where('rut', $data['rut'])
                  ->first();

    if( !$user ){
      return false;
    }

    return password_verify($data['password'], $user['password']);
  }


  //es necesario validar a correo
  public function verified_user(string $str, string $fields,array $data){
    $model = new UserModel();
    $user = $model->where('rut', $data['rut'])
                  ->first();

    if($user != null){
      if( $user['email_verified_at'] == NULL ){ return false; }
    }
    return true;
  }

  public function validate_rut(string $str, string $fields, array $data){
    $rut = $data['rut'] ?? $data['business_rut'];
    $rut = str_replace('.', '', strtoupper($rut));
    if (strlen($rut) < 9 || strlen($rut) > 10) {
        return false;
    }else {
        if (substr($rut, -2, 1) != '-') {
            return false;
        }else {
            if (!ctype_digit(substr($rut, 0, strlen($rut)-2))) {
                return false;
            }else {
                $k          = [2, 3, 4, 5, 6, 7, 2, 3];
                $dv         = substr($rut, -1);
                $rut        = substr($rut, 0, strlen($rut)-2);
                $rut_array  = array_reverse(str_split($rut));

                $result     = [];
                for ($j=0; $j < count($rut_array); $j++) {
                    $result[]   = $rut_array[$j] * $k[$j];
                }
                $suma           = array_sum($result);
                $resto          = $suma % 11;
                $verificador    = 11 - $resto;
                switch ($verificador) {
                    case 11:
                        $verificador = 0;
                        break;
                    case 10:
                        $verificador = 'K';
                        break;
                    default:
                        $verificador = $verificador;
                        break;
                }
                return ($verificador == $dv) ? true : false ;
            }
        }
    }
  }


}
