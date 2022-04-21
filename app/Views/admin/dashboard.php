  <div id="sidenav_content">
  <main class="main mt-3">
    <div class="container">
      <div class="row">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ;?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
          </ol>
        </nav>

        <div class="row mb-5">
          <div class="col-sm-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              </div>
              <a class="card-footer">
                <small class="text-muted">Saber más</small>
              </a>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              </div>
              <a class="card-footer">
                <small class="text-muted">Saber más</small>
              </a>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              </div>
              <a class="card-footer">
                <small class="text-muted">Saber más</small>
              </a>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              </div>
              <a class="card-footer">
                <small class="text-muted">Saber más</small>
              </a>
            </div>
          </div>
        </div>

        <table id="users_table" class="table table-striped display cell-border responsive w-100 align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Concurso</th>
                <th>Fecha inicio</th>
                <th>Fecha cierre</th>
                <th>Fecha creación</th>
                <th>Última actualización</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>

          <?php
            for ($i=0; $i < count($surveys); $i++) {
              echo '<tr>
                      <td>'.$surveys[$i]['id'].'</td>
                      <td>'.$surveys[$i]['name'].'</td>
                      <td>'.$surveys[$i]['begin_date'].'</td>
                      <td>'.$surveys[$i]['close_date'].'</td>
                      <td>'.$surveys[$i]['created_at'].'</td>
                      <td>'.$surveys[$i]['updated_at'].'</td>
                      <td class="text-center">
                        <div class="btn-group" role="group" aria-label="Acción">
                          <button type="button" class="btn btn-primary" id="edit_survey" value="'.$surveys[$i]['id'].'"><i class="fa-solid fa-pen-to-square"></i></button>
                          <button type="button" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                      </td>
                    </tr>';
            }
           ?>
        </tbody>
        <tfoot>
            <tr>
              <th>ID</th>
              <th>Concurso</th>
              <th>Fecha inicio</th>
              <th>Fecha cierre</th>
              <th>Fecha creación</th>
              <th>Última actualización</th>
              <th>Acción</th>
            </tr>
        </tfoot>
        </table>


      </div>
    </div><!-- /end container-->
  </main><!-- /end sidenav_content-->
