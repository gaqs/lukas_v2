<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class NoAuth implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    //filtro para evitar que trate de entrar sin sesion iniciada
    if(session()->get('loggedIn')){
      if( session()->get('role') == 'admin' ){
        return redirect()->to( base_url('admin') );
      }
      if( session()->get('role') == 'user' ){
        return redirect()->to( base_url('users') );
      }
    }


  }

  //---------------------------------------------------------------------

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {

  }
}
