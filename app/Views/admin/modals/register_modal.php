<form class="" action="<?= base_url('admin/register');?>" method="post">
  <div class="card mb-3">
    <div class="card-header">
      <div class=""> Registro Administrador </div>
    </div>
    <div class="card-body">
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="input_name" class="form-label">Nombres</label>
          <span class="fas fa-user icon-input"></span>
          <input class="form-control" id="input_name" name="name" type="text" value="<?= set_value('name');?>" placeholder="Juan Andrés" />
        </div>
        <div class="col-md-6 mb-2">
          <label for="input_lastname" class="form-label">Apellidos</label>
          <span class="fas fa-user-friends icon-input"></span>
          <input class="form-control" id="input_lastname" type="text" name="lastname" value="<?= set_value('lastname');?>" placeholder="Perez Gonzales" />
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-md-6">
          <label for="input_email" class="form-label">Email</label>
          <span class="fas fa-envelope icon-input"></span>
          <input class="form-control" id="input_email" type="email" name="email" value="<?= set_value('email');?>" placeholder="" />
        </div>
        <div class="col-md-6">
          <label for="input_password" class="form-label">Contraseña</label>
          <div class="input-group mb-3">
            <span class="fas fa-user icon-input" style="z-index:999;"></span>
            <input class="form-control" id="input_password_admin" type="text" name="password" maxlength="6" placeholder="********" />
            <button class="btn btn-primary" type="button" id="button_random">Random</button>
          </div>
          <div class="form-text">La contraseña debe tener minimo 6 caracteres.</div>
        </div>
        <?php if( session()->get('superadmin') == '1' ):  ?>
        <div class="col-md-6">
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="check_superadmin" name="superadmin">
            <label class="form-check-label" for="check_superadmin">Dar privilegios de superadmin (crear administradores y contraseñas)</label>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="d-grid">
    <button type="submit" class="btn btn-primary btn-block submit_something">
      <i class="fas fa-user-plus"></i> Registrar </button>
  </div>
</form>
