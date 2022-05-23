<div id="authentication" class="bg-light bg-gradient">
  <div id="authentication_content" class="my-5">
    <main role="main">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
              <h1 class="fw-boldest passion-one-font carousel_lukas display-1">Atención!</h1>
              <a href="<?= $link; ?>" class="text-decoration-none" target="_blank">
                <h2>Descargar AQUI las bases del Concurso</h2>
              </a>
              <br>
              <ol>
                <li>
                  <b>LEA DETENIDAMENTE LAS BASES DE POSTULACIÓN, antes del ingresar al formulario.</b>
                </li>
                <li>
                  Proceda a completar el formulario, puede guardar sus avances en cualquier momento haciendo click en el botón <b>"GUARDAR"</b>.
                </li>
                <li>
                  Ingresando a "Mis Concursos", desde su perfil, puede editar nuevamente su postulación.
                </li>
                <li>
                  Adjunte los documentos solicitados en las bases en las bases de postulacion.
                </li>
                <li>
                  Cuando haya completado TODOS los campos, haga click al boton <b>"ENVIAR"</b> ubicado al final del formulario.
                </li>
                <li>
                  Recuerde, si concursa en la CATEGORIA EMPRESA, registre la suya en su perfil haciendo <a href="<?= base_url('users/profile'); ?>" target="_blank">click aqui</a>.
                </li>
              </ol>

              <div class="alert alert-warning" role="alert">
                <div class="form-check">
                  <input class="form-check-input border-secondary" type="checkbox" value="" id="accept_check" onclick="Check()" autocomplete="off">
                  <label class="form-check-label" for="accept_check">
                    <i>Acepto haber leído y aceptado las bases del concurso.</i>
                  </label>
                </div>
              </div>


              <a href="<?= base_url('home/forms?survey_id='.$id);?>" type="button" class="btn btn-lg btn-primary w-100 mt-3 disabled" id="postulate_button" name="button">POSTULAR <i class="fa-solid fa-angles-right"></i></a>
            </div>
            <div class="col-md-4">
              <img src="<?= base_url('public/img/lukitas_border.png'); ?>" class="w-100" alt="">
            </div>
        </div>
      </div>
    </main>
  </div><!-- /end authentication_content-->
  <script type="text/javascript">
  function Check(){
    var checkbox = document.getElementById("accept_check");
    if( checkbox.checked == true ){
      $('#postulate_button').removeClass('disabled');
    }else{
      $('#postulate_button').addClass('disabled');
    }
  }
  </script>
