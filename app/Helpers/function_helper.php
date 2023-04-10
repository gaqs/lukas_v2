<?php
use CodeIgniter\Email\Email;

function email_valdiation($email) {
  // Validamos la sintaxis del correo electrónico
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return false;
  }
  // Obtenemos el nombre de dominio del correo electrónico
  $domain = substr(strrchr($email, "@"), 1);
  // Comprobamos si el nombre de dominio existe
  if (!getmxrr($domain, $mxhosts)) {
    return false;
  }
  
  return true;
}

function manage_files( $form_section, $array, $key_name, $directory_path ){
  $file = $array[$key_name];

  for ($i=0; $i < count($file); $i++) {
    if ( $file[$i]->getSize() != 0 ) {
        array_map('unlink', glob( $directory_path . $form_section.'_'.$i.'_'.$key_name.'.*' ));
        $oname = $file[$i]->getName(); //estar atento
        $ext = pathinfo( $oname, PATHINFO_EXTENSION );
        $name = $form_section.'_'.$i.'_'.$key_name.'.'.$ext;
        //nombre: [seccion]_[numero archivo]_comp.[extension]
        //old function $file[$i]->guessExtension()
        $file[$i]->move($directory_path, $name);
    }
  }
}

function reorder_answers($query){

  $order = [];
  for ($i=0; $i < count($query); $i++) {
    $key1 = $query[$i]['section'];
    $key2 = $query[$i]['question_number'];

    $order[$key1][$key2] = $query[$i]['answer'];
  }

  return $order;
}

function surveys_list(){
  $db = db_connect();
  $data = $db->table('surveys')->get()->getResultArray();
  $survey_list = '';

  for ($i=5; $i < count($data); $i++) {
    $survey_list .= '<a class="nav-link" href="'.base_url('admin/forms?survey_id=').$data[$i]['id'].'">'.($i+1).'. '.$data[$i]['name'].'</a>';
  }
  return $survey_list;
}

function generate_pass($chars){
  $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  return substr(str_shuffle($data), 0, $chars);
}

function send_email($send_to, $send_cc, $subject, $message, $attach){
  $email = \Config\Services::email();

  $config = Array(
							'protocol' => 'smtp',
							'SMTPHost' => 'mail.lukasparaemprender.com',
							'SMTPPort' => '587',
              'SMTPUser' => 'postmaster@lukasparaemprender.com',
              'SMTPPass' => 'g3@N1Phrd=JL',
							'mailType' => 'html',
							'charset'  => 'utf-8',
							'newline'	 => "\r\n"
						);
            //'SMTPUser' => 'postmaster@lukasparaemprender.com',
            //'SMTPPass' => 'g3@N1Phrd=JL',
            //'SMTPUser' => 'postmaster_3@lukasparaemprender.com',
            //'SMTPPass' => 'jI!m%S?z}0Gj',
            //'SMTPUser' => 'postmaster_4@lukasparaemprender.com',
            //'SMTPPass' => '^h+JZz}#q5t@',

  $email->initialize($config);

  $email->setFrom('postmaster@lukasparaemprender.com', 'Lukas para Emprender');
  $email->setTo($send_to);
  $send_cc != '' ? $email->setCC($send_cc): false;
  $attach != '' ? $email->attach($attach): false;
  $email->setSubject($subject);
  $email->setMessage($message);

  $email->send();
  return true;

  /*
  if ( $email->send() ){
    return true;
  } else {
    echo $email->printDebugger();
    return false;
  }
  */

}//end send_email

function bancos($selected){
  $bancos = array("Banco Estado","Banco de Chile","Banco Bci","Banco Santander","Banco BICE","Banco Condell","Banco CrediChile","Banco Edwards Citi","Banco Falabella","Banco Internacional","Banco Itaú","Banco Ripley","Banco Security","Scotiabank");

  for ($a=0; $a < count($bancos); $a++) {
    $aux = '';
    if( $bancos[$a] == $selected ){
      $aux = 'selected';
    }
    echo '<option value="'.$bancos[$a].'" '.$aux.'>'.$bancos[$a].'</option>';
  }
}

function cuentas($selected){
  $cuentas = array("Cuenta RUT","Cuenta Corriente","Cuenta Vista","Cuenta Ahorro");

  for ($a=0; $a < count($cuentas); $a++) {
    $aux = '';
    if( $cuentas[$a] == $selected ){
      $aux = 'selected';
    }
    echo '<option value="'.$cuentas[$a].'" '.$aux.'>'.$cuentas[$a].'</option>';
  }
}

function pass_generate($chars){
  $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  return substr(str_shuffle($data), 0, $chars);
}
