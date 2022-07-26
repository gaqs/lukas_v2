<div class="container-fluid">
  <div class="row">

    <div class="col-md-12 p-0">
      <div class="card">
        <div class="card-body">
          <div class="card-title">Perfil</div>
          <hr>
          <form class="" action="<?= base_url('users/profile');?>" method="post">
            <input type="hidden" name="" value="<?= $user['user_id']; ?>">
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="input_name" class="form-label">Nombre<span class="text-danger">*</span></label>
                <span class="fas fa-user icon-input"></span>
                <input type="text" class="form-control" id="input_name" name="name" value="<?= set_value('name',$user['user_name']);?>">
              </div>
              <div class="col-md-5 mb-3">
                <label for="input_lastname" class="form-label">Apellidos<span class="text-danger">*</span></label>
                <span class="fas fa-user-friends icon-input"></span>
                <input type="text" class="form-control" id="input_lastname" name="lastname" value="<?= set_value('lastname',$user['user_lastname']);?>">
              </div>
              <div class="col-md-3 mb-3">
                <label for="input_rut" class="form-label">RUT<span class="text-danger">*</span></label>
                <i class="fa-solid fa-address-card icon-input"></i>
                <input type="text" class="form-control" id="input_rut" name="rut" value="<?= $user['user_rut']; ?>">
              </div>
              <div class="col-md-4 mb-3">
                <label for="sex_select" class="form-label">Sexo</label>
                <select class="form-select" id="sex_select" name="sex" aria-label="Default select example">
                  <option value="" <?= $user['sex'] == '' ? 'selected=true' : null ?> selected>No informar</option>
                  <option value="F" <?= $user['sex'] == 'F' ? 'selected=true' : null ?>>Femenino</option>
                  <option value="M" <?= $user['sex'] == 'M' ? 'selected=true' : null ?>>Masculino</option>
                  <option value="O" <?= $user['sex'] == '0' ? 'selected=true' : null ?>>Otro</option>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label for="birthday_input" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="birthday_input" name="birthday" value="<?= set_value('birthday', $user['birthday']);?>">
              </div>
              <div class="col-md-4 mb-3">
                <label for="input_phone" class="form-label">Teléfono celular<span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text">+56 9</span>
                  <input type="text" class="form-control" id="input_phone" name="phone" aria-describedby="" value="<?= set_value('phone',$user['user_phone']);?>" maxlength="8">
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="input_fix_phone" class="form-label">Teléfono fijo</label>
                <i class="fa-solid fa-phone icon-input"></i>
                <input type="text" class="form-control" id="input_fix_phone" name="fix_phone" aria-describedby="" value="<?= set_value('fix_phone',$user['fix_phone']);?>" maxlength="10">
              </div>

              <div class="col-md-8 mb-3">
                <label for="input_address" class="form-label">Dirección<span class="text-danger">*</span></label>
                <i class="fa-solid fa-location-dot icon-input"></i>
                <input type="text" class="form-control" id="input_address" name="address" aria-describedby="" value="<?= set_value('address',$user['user_address']);?>" >
              </div>

              <div class="col-md-7 mb-3">
                <label for="input_email" class="form-label">Correo electrónico<span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-text">
                    <input class="form-check-input mt-0 me-2" type="checkbox" name="email_verified_at" value="" <?= ($user['email_verified_at'] != NULL ? 'checked' : '') ?> autocomplete="off"> Correo validado
                  </div>
                  <input type="email" class="form-control" id="input_email" name="email" aria-describedby="" value="<?= $user['user_email']; ?>" >
                </div>
              </div>

              <div class="col-md-5 mb-3">
                <label for="input_optional_email" class="form-label">Correo opcional</label>
                <span class="fas fa-envelope icon-input"></span>
                <input type="email" class="form-control" id="input_optional_email" name="optional_email" aria-describedby="" value="<?= $user['optional_email']; ?>">
              </div>

              <div class="row mb-3">
                <div class="col-md-6 mb-3">
                  <label for="input_name" class="form-label">Banco</label>
                  <select class="form-select" aria-label="" name="bank_name" autocomplete="off">
                    <?= bancos( $user['user_bank_name'] ); ?>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="input_type" class="form-label">Cuenta</label>
                  <select class="form-select" aria-label="" name="type" autocomplete="off">
                    <?= cuentas( $user['type'] ); ?>
                  </select>
                </div>
                <div class="col-md-12">
                  <label for="input_number" class="form-label">Número cuenta</label>
                  <i class="fa-solid fa-address-card icon-input"></i>
                  <input type="text" class="form-control" id="input_number" name="number" value="<?= set_value('number', $user['number']) ?>">
                </div>
              </div>
            </div><!-- end row -->
          </form>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-md-12 text-end">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" name="button"><i class="fas fa-sign-out-alt"></i> Actualizar</button>
        </div>
      </div>

    </div>

  </div>

</div>
