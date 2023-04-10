<div id="authentication" class="bg-primary bg-gradient">
   <div id="authentication_content" class="my-5">
      <main role="main">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-md-12 p-0 mb-4">
                  <div class="card w-100" style="width: 18rem;">
                     <div class="card-body text-center">
                        <?php if (!empty($surveys)) { ?>
                           <h3 class="card-title pt-4">Mis Postulaciones</h3>
                           <div class="card-text px-2">
                              <table class="table table-responsive align-middle mt-3">
                                 <thead>
                                    <tr>
                                       <th scope="col">N°</th>
                                       <th scope="col">ID </th>
                                       <th scope="col">Concurso</th>
                                       <th scope="col">Ingresado</th>
                                       <th scope="col">Estado</th>
                                       <th scope="col">Accion</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    for ($i = 0; $i < count($surveys); $i++) {
                                       $r_id = $surveys[$i]['results_id'];
                                       echo '<tr scope="row" class="' . ($r_id == 3 ? 'text-decoration-line-through' : null) . '">
                                                <td>' . ($i + 1) . '</td>
                                                <td>' . $surveys[$i]['id'] . '</td>
                                                <td>' . $surveys[$i]['name'] . '</td>
                                                <td>' . $surveys[$i]['created_at'] . '</td>
                                                <td>' . $surveys[$i]['status'] . '</td>
                                                <td>
                                                   <div class="btn-group" role="group" aria-label="Acción">
                                                      <a href="' . base_url('home/forms?survey_id=' . $surveys[$i]['surveys_id']) . '" class="btn btn-primary ' . ($r_id != 1 && 2 ? 'disabled' : null) . '" data-bs-tooltip="true" data-bs-placement="top" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                                                      <button type="button" class="btn btn-danger ' . ($r_id != 1 && 2 ? 'disabled' : null) . '" data-bs-toggle="modal" data-bs-target="#delete_form_modal" data-bs-whatever="' . $surveys[$i]['id'] . '" data-bs-tooltip="true" data-bs-placement="top" title="Eliminar"><i class="fa-solid fa-trash-can"></i></button>
                                                   </div>
                                                </td>
                                             </tr>';
                                    }
                                    ?>
                                 </tbody>
                              </table>
                              <div class="col-12 text-end">
                                 ¿Elimino su postulación y desea probar nuevamente?<br>
                                 <a href="<?= base_url(); ?>/#concursos" class="btn btn-primary mt-2">
                                    Volver a postular
                                 </a>
                              </div>
                           </div>
                        <?php } else { ?>
                           <h2 class="card-title">¡Lukas para Empreder 2023!</h2>
                           <p class="card-text">
                              Para entrar al concurso, haga click en el boton <i>postular aquí</i> para seleccionar la categoría
                              a la cual quiera ingresar.
                           </p>
                           <a href="<?= base_url(); ?>/#concursos" class="btn btn-primary card-link px-5">Postular aquí</a>
                        <?php } ?>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row justify-content-center" id="profile_editor">
               <div class="col-md-12 bg-light py-4 px-4 rounded">
                  <div class="d-flex align-items-start">

                     <div class="nav flex-column nav-pills col-md-3 pe-4" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <button class="nav-link mb-3" id="v-pills-user-tab" data-bs-toggle="pill"
                           data-bs-target="#v-pills-user" type="button" role="tab" aria-controls="v-pills-user"
                           aria-selected="true">Perfil</button>
                        <button class="nav-link mb-3" id="v-pills-bank-tab" data-bs-toggle="pill"
                           data-bs-target="#v-pills-bank" type="button" role="tab" aria-controls="v-pills-bank"
                           aria-selected="false">Cuenta Bancaria</button>
                        <button class="nav-link mb-3" id="v-pills-password-tab" data-bs-toggle="pill"
                           data-bs-target="#v-pills-password" type="button" role="tab" aria-controls="v-pills-password"
                           aria-selected="false">Contraseña</button>
                     </div>

                     <div class="tab-content col-md-9" id="v-pills-tabContent">
                        <div class="tab-pane fade" id="v-pills-user" role="tabpanel" aria-labelledby="v-pills-user-tab">
                           <div class="col-md-12">
                              <div class="card">
                                 <div class="card-body">
                                    <h3 class="card-title">Perfil</h3>
                                    <hr>
                                    <form class="" action="<?= base_url('users/profile'); ?>" method="post">
                                       <div class="row mb-3">
                                          <div class="col-md-4 mb-3">
                                             <label for="input_name" class="form-label">Nombre<span class="text-danger">*</span></label>
                                             <span class="fas fa-user icon-input"></span>
                                             <input type="text" class="form-control" id="input_name" name="name"
                                                value="<?= set_value('name', $user['user_name']); ?>">
                                          </div>
                                          <div class="col-md-5 mb-3">
                                             <label for="input_lastname" class="form-label">Apellidos<span
                                                   class="text-danger">*</span></label>
                                             <span class="fas fa-user-friends icon-input"></span>
                                             <input type="text" class="form-control" id="input_lastname" name="lastname"
                                                value="<?= set_value('lastname', $user['user_lastname']); ?>">
                                          </div>
                                          <div class="col-md-3 mb-3">
                                             <label for="input_rut" class="form-label">RUT<span
                                                   class="text-danger">*</span></label>
                                             <i class="fa-solid fa-address-card icon-input"></i>
                                             <input type="text" class="form-control" id="input_rut" name="rut"
                                                value="<?= $user['user_rut']; ?>" readonly>
                                          </div>
                                          <div class="col-md-4 mb-3">
                                             <label for="sex_select" class="form-label">Sexo</label>
                                             <select class="form-select" id="sex_select" name="sex"
                                                aria-label="Default select example">
                                                <option value="" <?= $user['sex'] == '' ? 'selected=true' : null ?>
                                                   selected>No informar</option>
                                                <option value="F" <?= $user['sex'] == 'F' ? 'selected=true' : null ?>>
                                                   Femenino</option>
                                                <option value="M" <?= $user['sex'] == 'M' ? 'selected=true' : null ?>>
                                                   Masculino</option>
                                                <option value="O" <?= $user['sex'] == '0' ? 'selected=true' : null ?>>Otro
                                                </option>
                                             </select>
                                          </div>
                                          <div class="col-md-4 mb-3">
                                             <label for="birthday_input" class="form-label">Fecha de nacimiento</label>
                                             <input type="date" class="form-control" id="birthday_input" name="birthday"
                                                value="<?= set_value('birthday', $user['birthday']); ?>">
                                          </div>
                                          <div class="col-md-4 mb-3">
                                             <label for="input_phone" class="form-label">Teléfono celular<span
                                                   class="text-danger">*</span></label>
                                             <div class="input-group">
                                                <span class="input-group-text">+56 9</span>
                                                <input type="text" class="form-control" id="input_phone" name="phone"
                                                   aria-describedby=""
                                                   value="<?= set_value('phone', $user['user_phone']); ?>"
                                                   maxlength="8">
                                             </div>
                                          </div>
                                          <div class="col-md-3 mb-3">
                                             <label for="input_fix_phone" class="form-label">Teléfono fijo</label>
                                             <i class="fa-solid fa-phone icon-input"></i>
                                             <input type="text" class="form-control" id="input_fix_phone"
                                                name="fix_phone" aria-describedby=""
                                                value="<?= set_value('fix_phone', $user['fix_phone']); ?>"
                                                maxlength="10">
                                          </div>
                                          <div class="col-md-2 mb-3">
                                             <label for="sector_select" class="form-label">Sector</label>
                                             <select class="form-select" id="sector_select" name="sector"
                                                aria-label="Default select example">
                                                <option value="urbano" <?= $user['sector'] == 'urbano' ? 'selected=true' : null ?>>Urbano</option>
                                                <option value="rural" <?= $user['sector'] == 'rural' ? 'selected=true' : null ?>>Rural</option>
                                             </select>
                                          </div>
                                          <div class="col-md-7 mb-3">
                                             <label for="input_address" class="form-label">Dirección<span
                                                   class="text-danger">*</span></label>
                                             <i class="fa-solid fa-location-dot icon-input"></i>
                                             <input type="text" class="form-control" id="input_address" name="address"
                                                aria-describedby=""
                                                value="<?= set_value('address', $user['user_address']); ?>">
                                          </div>
                                          <div class="col-md-6 mb-3">
                                             <label for="input_email" class="form-label">Correo electrónico<span
                                                   class="text-danger">*</span></label>
                                             <span class="fas fa-envelope icon-input"></span>
                                             <input type="email" class="form-control" id="input_email" name="email"
                                                aria-describedby="" value="<?= $user['user_email']; ?>" readonly>
                                          </div>
                                          <div class="col-md-6 mb-3">
                                             <label for="input_optional_email" class="form-label">Correo
                                                opcional</label>
                                             <span class="fas fa-envelope icon-input"></span>
                                             <input type="email" class="form-control" id="input_optional_email"
                                                name="optional_email" aria-describedby=""
                                                value="<?= $user['optional_email']; ?>">
                                          </div>
                                          <div class="row">
                                             <small>
                                                <p class="text-end text-danger"><b>*</b>Obligatorio</p>
                                             </small>
                                          </div>
                                       </div>
                                       <!-- end row -->
                                       <?php if (isset($validation)): ?>
                                          <div class="col-12 error_list">
                                             <div class="alert alert-danger" role="alert">
                                                <?= $validation->listErrors() ?>
                                             </div>
                                          </div>
                                       <?php endif ?>
                                       <button type="submit" value="user" name="submit_form"
                                          class="btn btn-primary mt-0 w-100 submit_something"><i
                                             class="fas fa-edit"></i> Actualizar</button>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- /end user -->

                        <div class="tab-pane fade" id="v-pills-bank" role="tabpanel" aria-labelledby="v-pills-bank-tab">
                           <div class="col-md-12">
                              <div class="card">
                                 <div class="card-body">
                                    <h3 class="card-title">Cuenta Bancaria</h3>
                                    <hr>
                                    <form class="" action="<?= base_url('users/profile'); ?>" method="post">
                                       <div class="alert alert-warning" role="alert">
                                          Datos basicos de cuenta bancaria en caso de ser ganador de un concurso. El
                                          premio se depositará en la cuenta asociada a este usuario.
                                       </div>
                                       <div class="row mb-3">
                                          <div class="col-6 mb-3">
                                             <label for="input_name" class="form-label">Banco</label>
                                             <select class="form-select" aria-label="" name="bank_name"
                                                autocomplete="off">
                                                <?= bancos($user['user_bank_name']); ?>
                                             </select>
                                          </div>
                                          <div class="col-6 mb-3">
                                             <label for="input_type" class="form-label">Cuenta</label>
                                             <select class="form-select" aria-label="" name="type" autocomplete="off">
                                                <?= cuentas($user['type']); ?>
                                             </select>
                                          </div>
                                          <div class="col-12 mb-3">
                                             <label for="input_number" class="form-label">Número cuenta</label>
                                             <i class="fa-solid fa-address-card icon-input"></i>
                                             <input type="text" class="form-control" id="input_number" name="number"
                                                value="<?= set_value('number', $user['number']) ?>">
                                          </div>
                                       </div>
                                       <?php if (isset($validation)): ?>
                                          <div class="col-12 error_list">
                                             <div class="alert alert-danger" role="alert">
                                                <?= $validation->listErrors() ?>
                                             </div>
                                          </div>
                                       <?php endif ?>
                                       <button type="submit" name="submit_form" value="bank" class="btn btn-primary mt-5 w-100 submit_something"><i class="fas fa-edit"></i> Actualizar</button>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- /end bank -->

                        <!-- password -->
                        <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                           <div class="col-md-12">
                              <div class="card">
                                 <div class="card-body">
                                    <h3 class="card-title">Cambiar contraseña</h3>
                                    <hr>
                                    <div class="col-12">
                                       <div class="alert alert-warning" role="alert">
                                          <small><i class="fa-solid fa-circle-exclamation"></i> Luego de actualizar su contraseña, <b>se cerrará su sesion actual</b> y deberá ingresar nuevamente con su contraseña nueva.</small>
                                       </div>
                                    </div>

                                    <div class="row">

                                       <form id="change_password_form">
                                          <div class="col-12">
                                             <div class="mb-3">
                                                <label for="input_old_password" class="form-label">Contraseña
                                                   actual <span class="text-danger">*</span></label>
                                                <span class="fas fa-unlock-alt icon-input"></span>
                                                <input type="password" class="form-control" name="old_password"
                                                   id="input_old_password" autocomplete="false" placeholder="*******">
                                             </div>
                                             <div class="mb-3">
                                                <label for="input_new_password" class="form-label">Nueva
                                                   contraseña <span class="text-danger">*</span></label>
                                                <span class="fas fa-unlock-alt icon-input"></span>
                                                <input type="password" class="form-control" name="new_password"
                                                   id="input_new_password" autocomplete="false" placeholder="*******">
                                             </div>
                                             <div class="mb-3">
                                                <label for="repeat_new_password" class="form-label">Confirmar nueva
                                                   contraseña <span class="text-danger">*</span></label>
                                                <span class="fas fa-unlock-alt icon-input"></span>
                                                <input type="password" class="form-control" name="repeat_new_password" id="repeat_new_password" autocomplete="false" placeholder="********">
                                             </div>
                                             <div class="row">
                                             <small>
                                                <p class="text-end text-danger"><b>*</b>Obligatorio</p>
                                             </small>
                                          </div>
                                             <div class="text-center">
                                                <div class="col-12">
                                                   <div class="alert" role="alert" id="error_change_password">
                                                      Todos los campos son obligatorios.
                                                   </div>
                                                </div>
                                             </div>
                                          </div>

                                          <button id="update_password" name="submit_form" value="password" class="btn btn-primary mt-3 w-100"><i class="fas fa-edit"></i> Actualizar</button>

                                       </form>

                                    </div>

                                 </div>
                              </div>
                           </div>
                        </div><!-- /end password -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </main>
   </div>

   <script type="text/javascript">
      $(document).ready(function () {
         //check habilitar empresa
         var status = "<?= $user['status'] ?? null; ?>";
         if (status == '0' || status == '') {
            $('#business_form input').prop('disabled', true);
         }
         Check();
      });

      function Check() {
         var checkbox = document.getElementById("business_check");
         if( checkbox != null){
            if (checkbox.checked == true) {
            $('#business_form input').prop('disabled', false);
            } else {
               $('#business_form input').prop('disabled', true);
            }
         }
         }
         
   </script>