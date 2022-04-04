<div id="sidenav_content">
  <main class="main mt-5">

    <div class="container">
      <div class="row">

        <table id="users_table" class="table table-striped display cell-border responsive w-100 align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>QT</th> <!-- qt = id usuario/cuestionario -->
                <th>RUT</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>

          <?php
            for ($i=0; $i < count($users); $i++) {
              echo '<tr>
                      <td>'.$users[$i]['id'].'</td>
                      <td>'.$users[$i]['users_surveys_id'].'</td>
                      <td>'.$users[$i]['rut'].'</td>
                      <td>'.$users[$i]['name'].' '.$users[$i]['lastname'].'</td>
                      <td>'.$users[$i]['email'].'</td>
                      <td>'.$users[$i]['phone'].'</td>
                      <td class="text-center">
                        <div class="btn-group" role="group" aria-label="Acción">
                          <button type="button" class="btn btn-primary" id="edit_form" value="'.$users[$i]['users_surveys_id'].'"><i class="fa-solid fa-user-pen"></i></button>
                          <button type="button" class="btn btn-success" id="export_form" ><i class="fa-solid fa-file-export"></i></button>
                          <button type="button" class="btn btn-danger" id="delete_form"><i class="fa-solid fa-user-large-slash"></i></button>
                        </div>
                      </td>
                    </tr>';
            }
           ?>
        </tbody>
        <tfoot>
            <tr>
              <th>ID</th>
              <th>QT</th>
              <th>RUT</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Teléfono</th>
              <th>Acción</th>
            </tr>
        </tfoot>
    </table>


      </div>
    </div><!-- /end container-->

  </main><!-- /end main-->
