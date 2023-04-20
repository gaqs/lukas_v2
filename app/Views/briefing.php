<?php error_reporting(E_ERROR); ?>
<div id="authentication" class="bg-light bg-gradient">
  <div id="authentication_content" class="my-5">
    <main role="main">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
              <h1 class="fw-boldest passion-one-font carousel_lukas display-1">Atención!</h1>
              <h5>
                <a href="<?= base_url('public/files/concursos/docs/FONDO_CONCURSABLE_LUKASPARAEMPRENDER_2023.pdf?v=0.1'); ?>" class="mb-3 ms-3 text-decoration-none" target="_blank">
                  <i class="fa-solid fa-download"></i> Descargar aquí las bases del Concurso
                </a>
              </h5>
              <br>
              <ol>
                <li>
                  <b>LEA DETENIDAMENTE LAS BASES DE POSTULACIÓN.</b>
                </li>
                <li>
                  Proceda a completar el formulario, adjuntando los documentos solicitados en las bases de postulación.
                </li>
                <li>
                Recuerde que puede guardar sus avances en cualquier momento haciendo click en el botón <b>GUARDAR</b>.
                </li>
                <li>
                  Cuando haya completado TODOS los campos requeridos, haga click al botón <b>ENVIAR</b> ubicado al final del formulario.
                </li>
              </ol>

              <!--
              <div class="alert alert-warning" role="alert">
                <div class="form-check">
                  <input class="form-check-input border-secondary" type="checkbox" value="" id="accept_check" onclick="Check()" autocomplete="off">
                  <label class="form-check-label" for="accept_check">
                    <i>Reconozco que la postulación en este concurso implica la aceptación de las bases del concurso y condiciones, incluidos los requisitos de edad, residencia, entre otros y que he tenido la oportunidad de revisarlos antes de entrar.</i>
                  </label>
                </div>
              </div>
              -->

              <a href="<?= base_url('home/forms?survey_id='.$id);?>" type="button" class="btn btn-lg btn-primary w-100 mt-3" id="postulate_button" name="button">IR AL FORMULARIO <i class="fa-solid fa-forward ms-2"></i></a>
            </div>
            <div class="col-md-4">
              <img src="<?= base_url('public/img/lukitas_border.png'); ?>" class="w-100" alt="">
            </div>
        </div>
      </div>
    </main>
  </div><!-- /end authentication_content-->
  <script type="text/javascript">
  /*
  function Check(){
    var checkbox = document.getElementById("accept_check");
    if( checkbox.checked == true ){
      $('#postulate_button').removeClass('disabled');
    }else{
      $('#postulate_button').addClass('disabled');
    }
  }
  */
  </script>
