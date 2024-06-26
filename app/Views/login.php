<div id="authentication" class="bg-primary bg-gradient">
<div id="authentication_content" class="my-5">
   <main role="main">
      <div class="container">
         <div class="row justify-content-center">
            <div class="col-lg-6">
               <div class="card shadow-lg border-0 rounded-lg">
                  <div class="card-header py-4">
                     <h3 class="text-center font-weight-light mt-4">
                        Iniciar sesión
                     </h3>
                     <div class="text-center">
                        <small>Concursos Lukas para Emprender</small>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="alert alert-warning" role="alert">
                        <small>Si se encuentra con algún problema y/o error al momento de ingresar, no dude en contactarse al correo <b>lukasparaemprender@gmail.com</b>.</small>
                     </div>
                     <form action="<?= base_url('users/index');?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-floating mb-3">
                           <input class="form-control" id="input_rut" type="text" name="rut" value="<?= set_value('rut');?>" placeholder="12356789-0" oninput="checkRut(this)" />
                           <label for="input_rut">RUT</label>
                        </div>
                        <div class="form-floating input-group mb-3">
                           <input class="form-control" id="input_password" name="password" type="password" placeholder="*************" />
                           <button class="btn btn-light rounded-end border px-3" id="toggle_button" type="button"><i id="toggle_icon" class="fa-solid fa-eye-slash"></i></button>
                           <label for="input_password" style="z-index:9;">Contraseña</label>
                        </div>
                        <div class="form-check mb-3">
                           <input class="form-check-input" id="input_remember" type="checkbox" value="" />
                           <label class="form-check-label" for="input_remember">Recordar contraseña</label>
                        </div>
                        <?php if(isset($validation)): ?>
                        <div class="col-12 mb-3">
                           <?= $validation->listErrors('custom') ?>
                        </div>
                        <?php endif ?>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                           <a class="small" href="<?= base_url('users/forgot'); ?>">No recuerdas tu contraseña?</a>
                           <button type="submit" class="btn btn-primary submit_something"> <i class="fas fa-sign-in-alt"></i> Ingresar</button>
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
<script type="text/javascript">
   const toggle_button = document.querySelector('#toggle_button');
   const password = document.querySelector('#input_password');
   
   toggle_button.addEventListener('click', function (e) {
   	// toggle the type attribute
   	const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
   	password.setAttribute('type', type);
   	// toggle the eye / eye slash icon
   	toggle_button.firstChild.classList.toggle('fa-eye-slash');
   	toggle_button.firstChild.classList.toggle('fa-eye');
   });
</script>
