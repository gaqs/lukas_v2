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
                      <small>Concursos Lukas para Emprender</small>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="alert alert-info" role="alert">
                        <small><b>¿Olvidaste tu contraseña?</b> No te preocupes! Sólo ingresa tu RUT y correo electrónico asociado y te enviaremos un link para que la puedas cambiar.</small>
                     </div>
                     <form action="<?= base_url('users/forgot');?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-floating mb-3">
                          <input class="form-control" id="input_rut" type="text" name="rut" value="<?= set_value('rut');?>" placeholder="12356789-0" oninput="checkRut(this)" maxlength="12"/>
                          <label for="input_rut">RUT</label>
                        </div>
                        <div class="form-floating mb-3">
                          <input class="form-control" id="input_email" type="email" name="email" value="<?= set_value('email');?>" placeholder="nombre@ejemplo.com" />
                          <label for="input_email">Correo electrónico</label>
                        </div>
                        <?php if(isset($validation)): ?>
                        <div class="col-12 mb-3">
                          <?= $validation->listErrors('custom') ?>
                        </div>
                        <?php endif ?>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                          <button type="submit" class="btn btn-primary w-100 submit_something"> <i class="fas fa-sign-in-alt"></i> Recuperar</button>
                        </div>
                     </form>
                  </div>
                  <div class="card-footer text-center py-3">
                     <div class="small"><a href="<?= base_url('users/register'); ?>">Necesitas una cuenta? Regístrate!</a></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </main>
</div>
<!-- /end authentication_content-->

