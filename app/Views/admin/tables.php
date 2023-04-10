<div id="sidenav_content">
  <main class="main mt-3">

    <div class="container">
      <div class="row">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ;?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Postulaciones</li>
          </ol>
        </nav>

        <table id="users_table" class="table table-striped display cell-border responsive w-100 align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th> <!-- qt = id usuario/cuestionario -->
                <th>RUT</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Formulario</th>
                <th>Estado</th>
                <th>Última actualización</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>

          <?php
            for ($i=0; $i < count($users); $i++) {
              echo '<tr>
                      <td>'.$users[$i]['users_surveys_id'].'</td>
                      <td>'.$users[$i]['id'].'</td>
                      <td>'.$users[$i]['rut'].'</td>
                      <td>'.$users[$i]['name'].' '.$users[$i]['lastname'].'</td>
                      <td>'.$users[$i]['email'].'</td>
                      <td>'.$users[$i]['surveys_id'].'</td>
                      <td>'.$users[$i]['results_id'].'</td>
                      <td>'.$users[$i]['updated_at'].'</td>
                      <td class="text-center">
                        <div class="btn-group" role="group" aria-label="Acción">
                          <button type="button" class="btn btn-primary" id="open_form" value="'.$users[$i]['users_surveys_id'].'"><i class="fa-solid fa-pen-to-square"></i></button>

                          <a href="'.base_url('export/export_user_survey?user_id='.$users[$i]['id'].'&survey_id='.$users[$i]['surveys_id']).'" target="_blank" type="button" class="btn btn-success" id="export_form" ><i class="fa-solid fa-file-export"></i></a>

                          <a href="'.base_url('export/export_zip?user_id='.$users[$i]['id'].'&survey_id='.$users[$i]['surveys_id']).'" target="_blank" type="button" class="btn btn-danger" id="export_form" ><i class="fa-solid fa-download"></i></i></a>

                        </div>
                      </td>
                    </tr>';
            }
           ?>
        </tbody>
        <tfoot>
            <tr>
              <th>ID</th>
              <th>User ID</th> <!-- qt = id usuario/cuestionario -->
              <th>RUT</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Formulario</th>
              <th>Estado</th>
              <th>Última actualización</th>
              <th>Acción</th>
            </tr>
        </tfoot>
    </table>


      </div>
    </div><!-- /end container-->

  </main><!-- /end main-->
