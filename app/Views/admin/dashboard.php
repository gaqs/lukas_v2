  <div id="sidenav_content">
  <main class="main mt-5">
    <div class="container">
      <div class="row">


        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Library</li>
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
                      <td>'.$users[$i]['rut'].'</td>
                      <td>'.$users[$i]['name'].' '.$users[$i]['lastname'].'</td>
                      <td>'.$users[$i]['email'].'</td>
                      <td>'.$users[$i]['phone'].'</td>
                      <td class="text-center">
                        <div class="btn-group" role="group" aria-label="Acción">
                          <button type="button" class="btn btn-primary"><i class="fa-solid fa-user-pen"></i></button>
                          <button type="button" class="btn btn-danger"><i class="fa-solid fa-user-large-slash"></i></button>
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
              <th>Acción</th>
            </tr>
        </tfoot>
    </table>

      </div>

    </div><!-- /end container-->

  </main><!-- /end sidenav_content-->
