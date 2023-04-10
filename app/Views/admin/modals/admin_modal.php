<form id="admin_info" class="" action="<?= base_url('admin/edit_admin');?>" method="post">
  <div class="card mb-3">
    <div class="card-header">
      <div class=""> Editar Administrador </div>
    </div>
    <div class="card-body">
      <div class="row">
         <input type="hidden" name="id" value="<?= $id; ?>">
        <div class="col-md-12 mb-2">
          <label for="input_name" class="form-label">Nombres</label>
          <span class="fas fa-user icon-input"></span>
          <input class="form-control" id="input_name" name="name" type="text" value="<?= set_value('name', $admin['name'] ?? null);?>" placeholder="Juan Andrés" />
        </div>
        <div class="col-md-12 mb-2">
          <label for="input_lastname" class="form-label">Apellidos</label>
          <span class="fas fa-user-friends icon-input"></span>
          <input class="form-control" id="input_lastname" type="text" name="lastname" value="<?= set_value('lastname',$admin['lastname'] ?? null); ?>" placeholder="Perez Gonzales" />
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mb-2">
          <label for="input_email" class="form-label">Email</label>
          <span class="fas fa-envelope icon-input"></span>
          <input class="form-control" id="input_email" type="email" name="email" value="<?= set_value('email',$admin['email']?? null); ?>" placeholder="" />
        </div>
        <div class="col-md-12 mb-4">
         <label for="input_password" class="form-label">Actualizar contraseña</label>
         <div class="input-group">
            <i class="fa-solid fa-unlock-alt icon-input" style="z-index:9;"></i>
            <input type="text" class="form-control" id="input_password_admin" name="password" placeholder="******" readonly onfocus="this.removeAttribute('readonly');">
            <button class="btn btn-primary" type="button" id="button_random">
               <i class="fas fa-random"></i> Aleatorio
            </button>
         </div>
      
         </div>
        <?php if( session()->get('superadmin') == '1' ):  ?>
        <div class="col-md-12">
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="check_superadmin" name="superadmin" <?= ($admin['superadmin'] == 1 ? 'checked' : '') ?>>
            <label class="form-check-label" for="check_superadmin">Dar privilegios de superadmin (crear administradores y contraseñas)</label>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="row mt-3">
      <div class="col-md-12 text-end">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
         <button type="button" class="btn btn-primary submit_something" name="button" id="update_admin"><i class="fas fa-sync"></i> Actualizar</button>
      </div>
   </div>
</form>
