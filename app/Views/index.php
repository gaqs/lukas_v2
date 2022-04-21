<div id="authentication" class=""> <!-- bg-primary bg-gradient  -->
  <!--
  <div class="container my-5" style="height: 800px;">
    <a href="<?= base_url('home/forms?survey_id=1'); ?>" type="button" class="btn btn-primary" name="button">PRUEBA FORMULARIO 1</a>
    <a href="<?= base_url('home/forms?survey_id=2'); ?>" type="button" class="btn btn-primary" name="button">PRUEBA FORMULARIO 2</a>
  </div>
  -->
  <style media="screen">
    .carousel-item .container{
      height: 500px;
    }
  </style>
  <div class="back"></div> <!-- background slider y menu header -->
  <div id="carousel_header" class="carousel slide" data-bs-ride="">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carousel_header" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carousel_header" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carousel_header" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="container d-grid">
          <div class="row justify-content-center">
            <div class="col-3 offset-md-2 align-self-center">
              <img src="<?= base_url('public/img/lukitas_border.png'); ?>" class="w-100" alt="">
            </div>
            <div class="col-6 fw-bolder align-self-center text-white">
              <h3>
                CONCURSO
              </h3>
              <h1 class="fw-bolder anton-font" style="font-size: 4rem;line-height: 1;">
                <span>LUKAS PARA</span><br><span>EMPRENDER</span><br>
                <span>2022</span><br>
              </h1>
              <hr>
              <h4>
                Subdireccion de Desarrollo Económico local<br>
                Subdirección de Desarrollo Comunitario
              </h4>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="container d-grid">
          <div class="row justify-content-center">
            <div class="col-7 align-self-center bg-danger">

            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="container d-grid">
          <div class="row justify-content-center">
            <div class="col-7 align-self-center bg-danger">

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
  <section id="registro">
    <div class="container my-5 pb-5">
      <div class="row title text-center mb-3">
        <h1>Registro</h1>
      </div>
      <div class="row">
        <div class="col-8">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam quis leo id neque bibendum egestas. In volutpat, nunc a pellentesque interdum, lorem metus pulvinar ipsum, iaculis posuere dolor libero ut nulla.
        </div>
        <div class="col-4 d-flex align-items-center">
          <button type="button" class="btn btn-success w-100" name="button">Registrarse</button>
        </div>
      </div>
    </div>
  </section>
  <section id="news" style="background: linear-gradient(180deg, #6c757d 60%, transparent 60%);">
    <div class="container my-5">
      <div class="row">
        <div class="col-3">

        </div>
        <div class="col-9 text-white">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce suscipit nibh sit amet dolor porttitor ultricies. Donec scelerisque eros ac fermentum viverra. Phasellus semper tortor id mi fermentum, quis vehicula neque malesuada. Proin varius imperdiet enim, in ornare purus rhoncus non.
        </div>
      </div>
    </div>
    <div class="container my-5">
      <div class="row title text-center text-white mb-3">
        <h1>Noticias</h1>
      </div>
      <div class="row">
        <?php for ($i=0; $i < 4; $i++) { ?>

          <div class="col-3">
            <div class="card text-white news_card_container">
              <img src="https://via.placeholder.com/800X600" class="card-img" alt="...">
              <div class="card-img-overlay">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <p class="card-text">Last updated 3 mins ago</p>
              </div>
            </div>
          </div>

        <?php } ?>

      </div>
    </div>

  </section>

  <section id="sponsor">
    	<div class="container my-5">
    		<div class="row justify-content-md-center">
    			<div class="col-md-2 col-5 align-self-center">
    				<a href="#" target="_blank">
              <img src="<?= base_url('public/img/ptomontt_border.png');?>" class="w-100 ">
            </a>
    			</div>
    			<div class="col-md-2 col-5 align-self-center">
    				<a href="#" target="_blank">
              <img src="<?= base_url('public/img/dideco_trans_border.png');?>" class="w-100 ">
            </a>
    			</div>
    			<div class="col-md-3 col-7 align-self-center">
    				<a href="#" target="_blank">
              <img src="<?= base_url('public/img/loslagos_border.png');?>" class="w-100 ">
            </a>
    			</div>
    			<div class="col-md-2 col-5 align-self-center">
    				<a href="#" target="_blank">
              <img src="<?= base_url('public/img/ptomontt_logo.png');?>" class="w-100 ">
            </a>
    			</div>
    		</div>
    	</div>
  </section>
