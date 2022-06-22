<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\UserModel;

class Auth implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    //filtro para evitar que trate de entrar sin sesion iniciada
    if(!session()->get('loggedIn')){
      session()->setFlashdata('failure','Necesita iniciar sesión con su cuenta para poder acceder a esta sección.');
      return redirect()->to( base_url() );
    }

    /*
    $model = new UserModel();
    $user = $model->where('email', session()->get('email'))
                  ->first();

    if( !$user ){
      session()->setFlashdata('failure','Necesita iniciar sesión con su cuenta para poder postular.');
      return redirect()->to( base_url('users') );
    }
    */
    if( !in_array(session()->get('role'), $arguments) ){
      session()->setFlashdata('failure','No tiene permisos suficientes para poder ingresar a esta sección.');
      return redirect()->to( base_url() );
    }



  }

  //---------------------------------------------------------------------

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {

  }
}
