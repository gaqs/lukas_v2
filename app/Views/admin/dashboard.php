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

        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success overflow-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-users"></i>
                </div>
                <div class="mr-5"><?= $users; ?> Usuarios</div>
              </div>
              <a href="<?= base_url('admin/users'); ?>" class="card-footer text-white clearfix small z-1">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary overflow-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-paste"></i>
              </div>
              <div class="mr-5"><?= $user_surveys; ?> Postulaciones</div>
            </div>
            <a href="<?= base_url('admin/applications '); ?>" class="card-footer text-white clearfix small z-1">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning overflow-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-paper-plane fa-flip-horizontal"></i>
              </div>
              <div class="mr-5"><?= $sended; ?> Enviados</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger overflow-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-fw fa-map-marked-alt"></i>
              </div>
              <div class="mr-5">0 Negocios</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
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
