<div id="sidenav_content">
<main class="main mt-3">
  <div class="container">
    <div class="row">

      <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('admin') ;?>">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
        </ol>
      </nav>

<table id="users_table" class="table table-striped display cell-border responsive w-100 align-middle">
<thead>
    <tr>
        <th>ID</th>
        <th>RUT</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Teléfono</th>
        <th>Creado</th>
        <th>Verificado</th>
        <th>Acción</th>
    </tr>
</thead>
<tbody>

  <?php
    for ($i=0; $i < count($users); $i++) {
      echo '<tr>
              <td>'.$users[$i]['id'].'</td>
              <td>'.$users[$i]['rut'].'</td>
              <td>'.$users[$i]['name'].' '.$users[$i]['lastname'].'</td>
              <td>'.$users[$i]['email'].'</td>
              <td>'.$users[$i]['phone'].'</td>
              <td>'.$users[$i]['created_at'].'</td>
              <td>'.$users[$i]['email_verified_at'].'</td>
              <td class="text-center">
                <div class="btn-group" role="group" aria-label="Acción">
                  <button type="button" id="edit_user" class="btn btn-primary" value="'.$users[$i]['id'].'" ><i class="fa-solid fa-user-pen"></i></button>
                  <button type="button" class="btn btn-danger disabled"><i class="fa-solid fa-user-large-slash"></i></button>
                </div>
              </td>
            </tr>';
    }
   ?>
</tbody>
<tfoot>
    <tr>
      <th>ID</th>
      <th>RUT</th>
      <th>Nombre</th>
      <th>Correo</th>
      <th>Teléfono</th>
      <th>Creado</th>
      <th>Teléfono</th>
      <th>Acción</th>
    </tr>
</tfoot>
</table>


      </div>

    </div><!-- /end container-->

  </main><!-- /end sidenav_content-->
