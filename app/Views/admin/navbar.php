<body>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
  <!-- Navbar Brand-->
  <a class="navbar-brand ps-3" href="<?= base_url('admin') ;?>">Administración</a>
  <!-- Sidebar Toggle-->
  <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebar_toggle" href="#!"><i class="fas fa-bars"></i></button>
  <!-- Navbar Search-->
  <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
      <div class="input-group">
          <!--
          <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
          <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
          -->
      </div>
  </form>
  <!-- Navbar-->
  <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span><?= substr( session()->get('name'), 0,1); ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#!">Perfil</a></li>
              <li><a class="dropdown-item" href="#!">Log de Actividad</a></li>
              <li><hr class="dropdown-divider" /></li>
              <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logout_modal" href="#">Logout</a></li>
          </ul>
      </li>
  </ul>
</nav>

<div id="sidenav">

  <div id="sidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
          <div class="sb-sidenav-menu">
              <div class="nav">
                  <div class="sb-sidenav-menu-heading">Core</div>
                  <a class="nav-link" href="<?= base_url('admin');?>">
                      <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                      Dashboard
                  </a>
                  <div class="sb-sidenav-menu-heading">Interface</div>
                  <a class="nav-link" href="<?= base_url('admin/users'); ?>">
                      <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                      Usuarios
                  </a>
                  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#applications_layout" aria-expanded="false" aria-controls="applications_layout">
                      <div class="sb-nav-link-icon"><i class="fa-solid fa-paste"></i></div>
                        Postulaciones
                      <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="applications_layout" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                      <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= base_url('admin/applications'); ?>">29/05/2022 - 19/06/2022</a>
                      </nav>
                  </div>
                  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#surveys_layout" aria-expanded="false" aria-controls="surveys_layout">
                      <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Concursos
                      <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="surveys_layout" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                      <nav class="sb-sidenav-menu-nested nav">

                        <?= surveys_list(); ?>

                      </nav>
                  </div>
                  <?php if( session()->get('superadmin') == '1' ):  ?>
                  <div class="sb-sidenav-menu-heading">Addons</div>
                  <a class="nav-link" href="<?= base_url('admin/password'); ?>">
                      <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                      Contraseñas
                  </a>
                  <a class="nav-link" href="<?= base_url('admin/register'); ?>">
                      <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                      Administradores
                  </a>
                  <?php endif; ?>
              </div>
          </div>
          <div class="sb-sidenav-footer">
              <div class="small">Logeado como:</div>
              <?= session()->get('name').' '.session()->get('lastname')?>
          </div>
      </nav>
  </div> <!-- /end layoutSidenav_nav  -->
