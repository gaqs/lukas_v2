<?php error_reporting(E_ERROR); ?>
<div id="authentication" class="bg-light bg-gradient">
  <div id="authentication_content" class="my-5">
    <main role="main">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
              <h1 class="display-3 passion-one-font fw-bold">¡Atención!</h1>
              <h5>
                <a href="<?= base_url('public/files/docs/FONDO_CONCURSABLE_LUKASPARAEMPRENDER_2024.pdf?v=0.1'); ?>" class="mb-3 text-decoration-none" target="_blank">
                  <i class="fa-solid fa-download"></i> Bases del Concurso Lukas para Emprender 2024 
                </a>
              </h5>
              <br>
              <ol class="ps-0">
                <li>
                  <b>LEA DETENIDAMENTE LAS BASES DE POSTULACIÓN.</b>
                </li>
                <li>
                  Llene el formulario y adjunte los documentos solicitados según lo indicado en las bases de postulación.
                </li>
                <li>
                  Guarde su progreso haciendo clic en el botón <b>"Guardar"</b>. Puede volver a editar su postulación accediendo desde su perfil.
                </li>
                <li>
                  Una vez que haya completado todos los campos requeridos, haga clic en el botón <b>"Enviar"</b> ubicado al final del formulario.
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

              <a href="<?= base_url('home/forms?survey_id='.$id);?>" type="button" class="btn btn-lg btn-primary w-100 mt-3" id="postulate_button" name="button">Ir al formulario <i class="fa-solid fa-angles-right fs-6"></i></a>
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
