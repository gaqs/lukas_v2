<body>
<?php $uri = service('uri');?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-secondary">
  <div class="container">
    <div>
      <small>
        <ul class="navbar-nav text-secondary">
          <li>
            <i class="fa fa-envelope me-2"></i>lukasparaemprender@puertomontt.cl
            <i class="fa fa-phone ms-3 me-1"></i> (+65) 2 261315
          </li>
        </ul>
      </small>
    </div>
  </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?= base_url('/'); ?>">LUKAS PARA EMPRENDER</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar_content" aria-controls="navbar_content" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar_content">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= ($uri->getSegment(1) == 'catalogo' ? 'active' : null) ?>"  href="#">Catálogo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($uri->getSegment(1) == 'ganadores' ? 'active' : null) ?>"  href="#">Ganadores</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($uri->getSegment(1) == 'nosotros' ? 'active' : null) ?>"  href="#">Nosotros</a>
        </li>

        <?php if( session()->get('loggedIn') && session()->get('role') == 'user' ):?>

          <li class="nav-item dropdown nav_register">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?= session()->get('name').' '.session()->get('lastname') ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="<?= base_url('users/profile'); ?>">Perfil</a></li>
              <li><a class="dropdown-item mis_concursos" href="<?= base_url('users/profile'); ?>">Mis concursos</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logout_modal" >Logout</a></li>
            </ul>
          </li>

        <?php else: ?>

          <li class="nav-item nav_register">
            <a class="nav-link"  href="<?= base_url('users/register'); ?>">
              <i class="fas fa-user-plus ml-1"></i> Registrarse
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="<?= base_url('users'); ?>">
              <i class="fas fa-sign-in-alt ml-1"></i> Ingresar
            </a>
          </li>

        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>
