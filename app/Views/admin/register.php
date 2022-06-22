<div id="sidenav_content">
  <main class="main mt-3">
    <div class="container">
      <div class="row">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ;?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Registro</li>
          </ol>
        </nav>
        <div class="col-md-3">
          <button type="button" id="add_admin" class="btn btn-success mb-3" name="button" data-bs-toggle="modal" data-bs-target="#register_admin">
            <i class="fa-solid fa-user-plus"></i> Agregar Administrador
          </button>
        </div>

        <table id="users_table" class="table table-striped display cell-border responsive w-100 align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Creado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>

          <?php
            for ($i=0; $i < count($admin); $i++) {
              echo '<tr>
                      <td>'.$admin[$i]['id'].'</td>
                      <td>'.$admin[$i]['name'].' '.$admin[$i]['lastname'].'</td>
                      <td>'.$admin[$i]['email'].'</td>
                      <td>'.$admin[$i]['created_at'].'</td>
                      <td class="text-center">
                        <div class="btn-group" role="group" aria-label="Acción">
                          <button type="button" id="edit_user" class="btn btn-primary" value="'.$admin[$i]['id'].'" ><i class="fa-solid fa-user-pen"></i></button>
                          <a href="'.base_url('admin/delete_admin?id=').$admin[$i]['id'].'" type="button" class="btn btn-danger"><i class="fa-solid fa-user-large-slash"></i></a>
                        </div>
                      </td>
                    </tr>';
            }
           ?>
        </tbody>
        <tfoot>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Creado</th>
              <th>Acción</th>
            </tr>
        </tfoot>
        </table>

      </div>
    </div>
  </main>
</div>


<!-- Modal edit cuestionario,usuario, fechas, etc... -->
<div class="modal fade" id="register_admin" tabindex="-1" aria-labelledby="register_admin_label" aria-hidden="true">
  <div class="modal-dialog modal-xl px-5 pt-0">
    <div class="modal-content p-3">

      <?= view('admin/modals/register_modal'); ?>

    </div>
  </div>
</div>
