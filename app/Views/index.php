<div id="authentication" class=""> <!-- bg-primary bg-gradient  -->
  <style media="screen">
    .carousel-item .container {
      height: 500px;
    }
  </style>

  <div class="back"></div> <!-- background slider y menu header -->
  <div id="carousel_header" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carousel_header" data-bs-slide-to="0" aria-label="Slide 1" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carousel_header" data-bs-slide-to="1" aria-label="Slide 2"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="container d-grid">
          <div class="row justify-content-center">
            <div class="col-3 offset-md-2 align-self-center">
              <img src="<?= base_url('public/img/lukitas_border.png'); ?>" class="w-100" alt="">
            </div>
            <div class="col-7 fw-bolder align-self-center text-white">
              <h3 class="d-inline">
                CONCURSO <h5 class="d-inline">(21 de Abril al 19 de Mayo)</h5>
              </h3>
              <h1 class="carousel_lukas display-1 text-primary" style="line-height:0.8;">
                <span>LUKAS PARA</span><br><span>EMPRENDER</span><br>
                <span class="d-inline">2023</span>
              </h1>
              <h4>MUNICIPALIDAD DE PUERTO MONTT</h4>
              <h4>
                <hr>
                Subdirección de Desarrollo Económico Local<br>
                Dirección de Desarrollo Comunitario
              </h4>
            </div>
          </div>
        </div>
      </div>

      
      <div class="carousel-item">
        <div class="container d-grid">
          <div class="row justify-content-center">
            <div class="col-7 text-center align-self-center">
              <h4 class="text-white"></h4>
              <h1 class="carousel_lukas display-3 fw-boldest passion-one-font text-primary" style="line-height:0.8;">
                  TALLERES ACLARACIÓN DE BASES
              </h1>
              <hr class="text-white">
              <h4 class="text-white">
                  Haga <a href="https://forms.gle/RGvG28Zr58WtqeJY9" target="_blank">CLICK AQUÍ</a> para inscribirse
              </h4>
              <h5 class="text-white mt-3">Del 28 de Abril al 10 de Mayo</h5>
            </div>
          </div>
        </div>
      </div>
      
    </div>


    <button class="carousel-control-prev" type="button" data-bs-target="#carousel_header" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carousel_header" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  
  <section id="nosotros" class="bg-white">

    <div class="container my-5 text-center">
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-info" role="alert">
            <h2 class="alert-heading"><b>¡ATENCIÓN!</b></h2>
            <h4><b>INSCRIPCIÓN A TALLERES ACLARACIÓN DE BASES</b></h4>
              Haga <a href="https://forms.gle/RGvG28Zr58WtqeJY9" target="_blank">CLICK AQUÍ</a> para inscribirse en los talleres de aclaración de bases.<br>Se realizarán 6 talleres entre el 28 de Abril y el 10 de Mayo.
          </div>
        </div>
      </div>
    </div>

    <div class="container my-5">
      <div class="row">
        <div class="col-md-6 d-flex align-items-center pe-5 text-end">
          <div class="row justify-content-center">
            <div class="col-12 title">
              <h1 class="display-1 passion-one-font fw-bold lh-1">Lukas para Emprender</h1>
            </div>
            <div class="col-12">
              A contar del año 2009, la Municipalidad de Puerto Montt a través de la Subdirección de
              Desarrollo Económico Local, ha puesto a disposición de la microempresa de la ciudad, un punto
              de atención directo, para apoyo a gestión, capacitación y acceso a nuevas tecnologías de la
              información para dar inicio o fortalecer una actividad económica.
              <br><br>
              Continuando con el apoyo del Municipio a los microempresarios y emprendedores de la comuna,
              este año corresponde a la <b>14va versión</b> del concurso “Lukas para Emprender” en convenio con la
              Universidad de Los Lagos.
            </div>
            <div class="col-12 mt-3 mb-3">
              <a href="#how" class="btn btn-lg btn-primary" type="button" name="button"> <i class="fa-solid fa-right-to-bracket" disabled></i> Quiero Postular!</a>
            </div>
          </div>

        </div>
        <div class="col-md-5">
          <img class="w-100" src="<?= base_url('public/img/people_working.png'); ?>" alt="">
        </div>
      </div>
    </div>
  </section>

  <section id="how" class="bg-light">
    <div class="container my-5">
      <div class="row title text-center mb-3">
        <h1 class="display-3 passion-one-font fw-bold">¿Como postular?</h1>
      </div>
      <div class="row">

        <div class="col-md-5 text-center">
          <h4 class="ms-3 mb-5">Video tutorial 2023</h4>
          <h1><b>...PRONTO...</b></h1>
          <!--
          <a class="popup-youtube_1 hvr-grow w-100 mb-5" href="https://www.youtube.com/watch?v=-AFDtaCkzDo">
            <i class="fas fa-play-circle play_yutu"></i>
            <img src="https://i3.ytimg.com/vi/-AFDtaCkzDo/maxresdefault.jpg" class="w-100 thumbnail" alt="">
          </a>
          -->
        </div>

        <div class="col-md-7">
          <h4 class="ms-3">Instrucciones</h4>
          <ol>
            <!-- concursar por postular -->
            <li><b>Registrarse es obligatorio</b>, puede crear una cuenta haciendo <a href="<?= base_url('users/register'); ?>">click aqui</a>.<br>Si ya posee una cuenta, puede iniciar sesión <a href="<?= base_url('users'); ?>">aquí</a>.</li>
            <li>Para postular, eliga una de las categorías que se encuentran en la sección <a href="<?= base_url('#concursos') ?>">concursos</a>.</li>
            <li>Siga detenidamente las indicaciones listadas al momento de entrar a uno de las categorías.</li>
          </ol>
          <h4 class="ms-3">Bases del Concurso</h4>
          <ul>
            <li>
              <a href="<?= base_url('public/files/concursos/docs/FONDO_CONCURSABLE_LUKASPARAEMPRENDER_2023.pdf?v=0.1');?>" class="" target="_blank">
                Bases del concurso Lukas para Emprender 2023
              </a>
            </li>
          </ul>
        </div>


      </div>
  </section>


  <section id="concursos" class="bg-light">
    <div class="container my-5 pb-5">
      <div class="row title text-center mb-3">
        <h1 class="display-3 passion-one-font fw-bold">Concursos 2023</h1>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading"><i class="fa-solid fa-triangle-exclamation"></i> Atención!</h4>
            <p>La 14ta version del concurso Lukas para Emprender año 2023, solo permitirá que los usuarios previamente registrados, concursen en UNA SOLA CATEGORIA de las dos que se encuentran operativas. </p>
            <hr>
            <p class="mb-0"><b>Recuerde mantener los datos de su perfil actualizados.</b></p>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-3 mb-3 d-flex align-items-stretch">
          <div class="card overflow-hidden card_concurso">
            <i class="fa-solid fa-house-laptop back_icon"></i>
            <div class="card-body" style="z-index:1;">
              <h4 class="card-title">Emprendimiento</h4>
              <p class="card-text">Corresponde a personas naturales mayores de 18 años de edad, sin iniciación de actividades en 1ª categoría en la comuna de Puerto Montt, que posean un negocio o emprendimiento vigente al momento de postular.</p>
            </div>
            <div class="card-footer" style="z-index:1009;">
              <a href="<?= base_url('home/briefing?survey_id=6'); ?>" class="btn btn-lg btn-primary mb-auto align-self-start">Postular <i class="fa-solid fa-angles-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3 d-flex align-items-stretch">
          <div class="card overflow-hidden card_concurso">
            <i class="fa-solid fa-tractor back_icon"></i>
            <div class="card-body" style="z-index:1;">
              <h4 class="card-title">Emprendimiento Rural</h4>
              <p class="card-text">Corresponde a emprendimientos basados en la producción y comercialización de productos que posean valor cultural, territorial, ambiental o similar, y cuya producción se realiza en zonas rurales de la comuna de Puerto Montt.</p>
            </div>
            <div class="card-footer" style="z-index:1009;">
              <a href="<?= base_url('home/briefing?survey_id=7'); ?>" class="btn btn-lg btn-primary mb-auto align-self-start">Postular <i class="fa-solid fa-angles-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3 d-flex align-items-stretch">
          <div class="card overflow-hidden card_concurso">
            <i class="fa-solid fa-fish back_icon"></i>
            <div class="card-body" style="z-index:1;">
              <h4 class="card-title">Mujer Pescadora Artesanal</h4>
              <p class="card-text">Corresponde a mujeres que realizan la actividad productiva de pesca artesanal, inscritas en cualquiera de sus categorías en el Registro Pesquero Artesanal (RPA) en las categorías recolector de orilla, pescador artesanal y/o armador artesanal.</p>
            </div>
            <div class="card-footer" style="z-index:1009;">
              <a href="<?= base_url('home/briefing?survey_id=8'); ?>" class="btn btn-lg btn-primary mb-auto align-self-start">Postular <i class="fa-solid fa-angles-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3 d-flex align-items-stretch">
          <div class="card overflow-hidden card_concurso">
            <i class="fa-solid fa-building back_icon"></i>
            <div class="card-body" style="z-index:1;">
              <h4 class="card-title">Empresa</h4>
              <p class="card-text">Corresponde a microempresas con negocios establecidos e iniciación de actividades en 1ª Categoría vigente, con ventas anuales inferiores a 2.400 UF y con todos los permisos de operación vigentes al momento del cierre de postulación.</p>
            </div>
            <div class="card-footer" style="z-index:1009;">
              <a href="<?= base_url('home/briefing?survey_id=9'); ?>" class="btn btn-lg btn-primary mb-auto align-self-start">Postular <i class="fa-solid fa-angles-right"></i></a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>


  <section id="sponsor" class="bg-white">
    <div class="container my-5">
      <div class="row justify-content-md-center">
        <div class="col-md-4 col-10 align-self-center">
          <a href="https://www.puertomontt.cl/" target="_blank">
            <img src="<?= base_url('public/img/logo_muni.png'); ?>" class="w-100 ">
          </a>
        </div>
        <div class="col-md-2 col-5 align-self-center">
          <a href="https://www.puertomontt.cl/unidades-municipales/dideco/" target="_blank">
            <img src="<?= base_url('public/img/dideco_trans_border.png'); ?>" class="w-100 ">
          </a>
        </div>
        <div class="col-md-3 col-7 align-self-center">
          <a href="https://www.ulagos.cl/" target="_blank">
            <img src="<?= base_url('public/img/loslagos_border.png'); ?>" class="w-100 ">
          </a>
        </div>
        <!--
          <div class="col-md-2 col-5 align-self-center">
            <a href="#" target="_blank">
              <img src="<?= base_url('public/img/ptomontt_logo.png'); ?>" class="w-100 ">
            </a>
          </div>
        -->
      </div>
    </div>
  </section>
  <section id="ayuda" class="bg-primary text-white">
    <div class="container my-5 pb-5">
      <div class="row">
        <div class="col-md-12">
          <h5><i class="fa-solid fa-angles-right"></i> Preguntas frecuentes</h5>
        </div>
        <div class="col-md-6">
          <h1 class="display-1 passion-one-font fw-bold lh-1 mb-3">Necesitas<br>ayuda?</h1>
          <p>Puede acercarse a nuestras oficinas ubicadas en:<br><b>Avda. Pdte. Ibáñez 600, 2do piso - Edificio Consistorial II</b>.<br><br>Comunicarse via correo electrónico a:<br> <b>lukasparaemprender@puertomontt.cl</b><br><br>o directamente haciendo click en en botón a continuación.</p>
          <a class="btn btn-light text-primary mb-3" href="<?= base_url('home/help'); ?>"><i class="fa-solid fa-circle-question"></i> Contactar soporte</a>
        </div>
        <div class="col-md-6">
          <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item bg-transparent border border-secondary rounded">
              <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed bg-primary text-white border-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                  1. ¿Que es?
                </button>
              </h2>
              <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  Es un financiamiento No reembolsable, que se adjudica al postulante por medio de un proceso
                  concursable para iniciar nuevos negocios y/o fortalecer los actuales.
                  Por lo tanto, no se trata de un crédito, ya que el dinero entregado a los(as) ganadores no debe ser
                  devuelto, pero sí, debe ser rendido íntegramente.
                  Dicho financiamiento está destinado a fortalecer diferentes ámbitos de gestión de la microempresa, así
                  como al ingreso de nuevos mercados y/o consolidación en los actuales mercados, que presenten reales
                  oportunidades de negocios a microempresas de la Comuna de Puerto Montt.
                </div>
              </div>
            </div>
            <div class="accordion-item bg-transparent border border-secondary rounded">
              <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed bg-primary text-white border-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                  2. ¿Cuál es su objetivo?
                </button>
              </h2>
              <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  Fortalecer y promover la consolidación de microempresas con proyectos de negocio que agreguen valor a
                  la oferta local y tengan un grado de diferenciación importante con los productos y servicios existentes,
                  que se encuentran imposibilitadas de dar por sí mismas el salto de competitividad que les permita
                  capturar una oportunidad de mercado a través de la innovación de productos, servicios y/o procesos,
                  desarrollo de nuevos mercados y consolidación en los actuales.
                </div>
              </div>
            </div>
            <div class="accordion-item bg-transparent border border-secondary rounded">
              <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed bg-primary text-white border-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                  3. ¿Quiénes pueden participar?
                </button>
              </h2>
              <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <b>Categoría / Línea Emprendimiento</b><br>
                  <ol>
                    <li>Hombres y mujeres sin iniciación de actividades de 1a categoría.</li>
                    <li>Mayores de 18 años cumplidos a la fecha de cierre de la postulación al concurso.</li>
                    <li>Que residan en la comuna de Puerto Montt.</li>
                    <li>Emprendimiento desarrollado en la comuna de Puerto Montt.</li>
                  </ol>
                  <br>
                  <b>Categoría / Línea Empresa</b><br>
                  Personas naturales o jurídicas que cumplan los siguientes requisitos<br>
                  <ol>
                    <li>Que tributen en primera categoría con una antigüedad hasta 9 años (2010 en adelante) máximo y
                      mínimo 3 meses, con patente municipal vigente, y los permisos que corresponden a cada
                      actividad o rubro (resolución sanitaria, permiso SAG, etc.) vigente.</li>
                    <li>En el caso de las personas jurídicas el representante para todos los efectos del concurso es el
                      representante legal.</li>
                    <li>Casa matriz en la comuna de Puerto Montt.</li>
                    <li>Ventas netas anuales iguales o inferiores a 2.400 UF.</li>
                    <li>El giro y patente municipal de la empresa del/la postulante deberá ser coherente con la
                      naturaleza del proyecto que postula.</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>