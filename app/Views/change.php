<div id="authentication" class="bg-primary bg-gradient">
  <div id="authentication_content" class="my-5">
    <main role="main">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header py-4">
                      <h3 class="text-center font-weight-light mt-4">
                        Recuperar contraseña
                      </h3>
                      <div class="text-center">
                        <small>Sistema de Administración</small>
                      </div>
                    </div>
                    <div class="card-body">
                      <?php

                      $uri = service('uri');

                      if( session()->get('success') ){
                        echo '<div class="alert alert-success alert-dismissible fade show">'.session()->get('success').'<button type="button" class="btn-close text-danger" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                      }else if( session()->get('failure') ){
                        echo '<div class="alert alert-danger alert-dismissible fade show">'.session()->get('failure').'<button type="button" class="btn-close text-danger" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                      }
                      ?>

                      <form action="<?= base_url('users/change_password')?>" method="post">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="input_token" type="hidden" name="token" value="<?= $token ?? set_value('token'); ?>">
                            <input class="form-control" id="input_email" type="email" name="email" value="<?= $key ?? set_value('email'); ?>" placeholder="" readonly/>
                            <label for="input_email">Correo electrónico</label>
                        </div>
                        <div class="form-floating input-group mb-3">
                            <input class="form-control" id="input_password" name="password" type="password" placeholder="" />
                            <button class="btn btn-light rounded-end border px-3" id="toggle_button" type="button"><i id="toggle_icon" class="fa-solid fa-eye-slash"></i></button>
                            <label for="input_password">Nueva contraseña</label>
                        </div>
                          <div class="form-floating mb-3">
                              <input class="form-control" id="repeat_password" type="password" name="repeat_password" placeholder="" />
                              <label for="input_email">Confirmar contraseña</label>
                          </div>
                          <?php if(isset($validation)): ?>
														<div class="col-12 mb-3">
															<?= $validation->listErrors('custom') ?>
														</div>
													<?php endif ?>
                          <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                              <button type="submit" class="btn btn-primary w-100"> <i class="fas fa-sign-in-alt"></i> Cambiar</button>
                          </div>
                      </form>

                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="<?= base_url('users/register'); ?>">Necesitas una cuenta? Registrate!</a></div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </main>
  </div><!-- /end authentication_content-->
