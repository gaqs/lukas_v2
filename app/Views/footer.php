<!-- Footer -->
<footer class="page-footer font-small mdb-color pt-4 mt-0 text-white" style="background-color:#202020;">
  <div class="container text-start">
    <div class="row text-start mt-3 pb-3">
      <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold">DIDECO</h6>
        <p>
          <address>
            <strong>Subdirección de Desarrollo Económico Local<br>Dirección de Desarrollo Comunitario</strong>
            <br>
            <a href="https://www.puertomontt.cl/unidades-municipales/dideco/" target="_blank">Más información</a>
          </address>
        </p>
      </div>
      <div class="col-md-5 col-lg-4 col-xl-4 mx-auto mt-4">
        <h6 class="text-uppercase mb-4 font-weight-bold">CONTACTO</h6>
        <p><i class="fa fa-home mr-3"></i> Av. Presidente Ibañez #600.<br>Edificio Consistorial II<br></p>
        <p><i class="fa fa-envelope mr-3"></i> lukasparaemprender@puertomontt.cl</p>
        <p><i class="fa fa-phone mr-3"></i> (+65) 2 261315</p>
        <p><i class="fa fa-phone mr-3"></i> (+65) 2 261323</p>
      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold">Links Útiles</h6>
        <p><a class="text-decoration-none" href="https://www.puertomontt.cl/" target="_blank">Municipalidad Puerto Montt</a></p>
        <p><a class="text-decoration-none" href="http://www.ulagos.cl/" target="_blank">Universidad de los Lagos</a></p>
        <p><a class="text-decoration-none" href="http://www.ulagos.cl/category/campus-pto-montt/" target="_blank">ULL Campus Puerto Montt</a></p>
        <p><a class="text-decoration-none" href="<?= base_url('admin/login'); ?>" target="_blank" class="">Acceso Administrador</a></p>
      </div>

    </div>
    <!-- Footer links -->

    <hr>

    <!-- Grid row -->
    <div class="row d-flex align-items-center pb-2">

      <!-- Grid column -->
      <div class="col-md-12 col-lg-12">

        <!--Copyright-->
        <small class="text-center text-md-left"><b> Gustavo Quilodrán Sanhueza</b> | SUBDEL | Municipalidad de Puerto Montt | contact: gaqs.02@gmail.com</small>

      </div>
      <!-- Grid column -->
    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

</footer>
<!-- Footer -->

      </div><!-- /end sidenav_content && authentication_content-->
    </div><!-- /end sidenav && authentication -->

    <!-- Modals -->
    <!-- Modal confirmacion de cierre de sesion -->
    <div class="modal fade" id="logout_modal" tabindex="-1" aria-labelledby="logout_modal_label" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="logout_modal_label">Logout</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" name="button"></button>
          </div>
          <div class="modal-body">
            ¿Está seguro que desea cerrar su sesión actual?
          </div>
          <div class="modal-footer">
            <a href="<?= base_url('users/logout');?>">
              <button type="button" class="btn btn-primary" name="button"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal confirmacion de eliminacion de formulario -->
    <div class="modal fade" id="delete_form_modal" tabindex="-1" aria-labelledby="delete_form_modal_label" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="delete_form_modal_label">Eliminar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" name="button"></button>
          </div>
          <form action="<?= base_url('home/delete_survey'); ?>" method="post">

            <div class="modal-body">
              <input type="hidden" name="user_survey_id" value="">
              ¿Está seguro que desea eliminar su postulación?<br><b>No podrá volver a postular a este concurso</b>.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" name="button">Cerrar</button>
              <button type="submit" class="btn btn-danger" name="button"><i class="fa-solid fa-trash-can"></i> Eliminar</button>
            </div>

          </form>
        </div>
      </div>
    </div>

    <!-- Modal informacion -->
    <div class="modal fade" id="info_form_modal" tabindex="-1" aria-labelledby="info_form_modal_label" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="info_form_modal_label">Información</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" name="button"></button>
          </div>
          <div class="modal-body">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Toast prueba mensajes exito y error esquina inferior -->
    <div class="position-fixed w-100" style="top:2rem;pointer-events: none; touch-action: none;">
      <div id="alert_toast" class="toast border-0 fade" data-bs-delay="6000" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <i class="fa-solid fa-bell me-2"></i>
          <strong class="me-auto">¡Atención!</strong>
          <small></small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          Hello, world! This is a toast message.
        </div>
      </div>
    </div>


  </body>
</html>

<script type="text/javascript" src="<?= base_url('dist/bootstrap-5.1.3/js/bootstrap.bundle.js');?>"></script>
<script type="text/javascript" src="<?= base_url('dist/magnificpopup-1.1.0/jquery.magnific-popup.js')?>"></script>
<script type="text/javascript" src="<?= base_url('js/scrollreveal.js');?>"></script>
<script type="text/javascript" src="<?= base_url('js/file-validator.js');?>"></script>
<script type="text/javascript" src="<?= base_url('js/scripts.js?v=0.1');?>"></script>

<!-- Custom script -->
<script type="text/javascript">

$(document).ready(function(){
  var url = '<?= base_url();?>';

  $('.popup-youtube_1').magnificPopup({
    disableOn: 700,
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,
    fixedContentPos: false
  });

  /*
  setTimeout(function(){
    $('.popup-youtube_1').click(); // Will open the popup
  }, 1000);
  */

  $('input[type=file]').fileValidator({
    onInvalid:
      function(type, file){
        $(this).addClass('is-invalid').val('');
        $(this).next('.feedback').addClass('invalid-feedback').html('Archivo inválido.');
      },
    onValidation:
      function(files){
        $(this).removeClass('is-invalid');
        $(this).next('.feedback').removeClass('invalid-feedback').html('');
      },
    maxSize: '20000000',
    type: 'image/jpeg image/jpg image/png application/pdf application/msword application/vnd.ms-powerpoint application/vnd.ms-excel application/vnd.openxmlformats-officedocument.wordprocessingml.document application/vnd.openxmlformats-officedocument.spreadsheetml.sheet application/vnd.oasis.opendocument.spreadsheet application/vnd.oasis.opendocument.text'
    //.jpeg .jpg .png .pdf .doc .xls .docx .xslx .odt .odf
  });

  $('body').on('click', '#save_form, #send_form', function(event){
    event.preventDefault();
    var button = $(this).val();
    var send = false;
    //verifica que no haya inputs text y textarea vacios
    const fields = document.querySelectorAll("#form input[type=text], #form textarea:not(.d-none)");
    const emptyInputs = Array.from(fields).filter( input => input.value == "");
    //verifica que esten todos los archivos, o si falta uno que al menos tenga un archivo compatible
    const files = document.querySelectorAll("#form input[name='file[]']");
    const emptyFiles = Array.from(files).filter(
        input => input.classList[2] != "d-none" && input.value == ""
    );
    if(emptyInputs.length === 0 && emptyFiles.length == 0){
      send = true;
    }
    var formData = new FormData( $('#form')[0] );
    formData.append('send', send);
    formData.append('button', button);

    $.ajax({
      url : url + "/home/forms",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function(html){
        //console.log(html);
        var obj = JSON.parse(html);
        if( obj.status == 'error'){
          window.scrollTo(0, 0);
          setTimeout(function(){ location.reload() } , 1000);
        }else if( obj.status == 'success' ){
          location.reload();
        }
      }
    });


  });

  //borrar archivos dentro del formulario
  $('body').on('click', '#delete_file', function(){
    $(this).parents('#uploadedFile').addClass('d-none');
    $(this).parents('#uploadedFile').next('#formFile').removeClass('d-none').val('');

    var survey_id = $('input[name="survey_id"]').val();
    var file_name = $(this).val();

    $.ajax({
      url : url + "/home/delete_file",
      type: "POST",
      data: "survey_id=" + survey_id + "&file_name=" + file_name,
      success: function(html){}
    });
  });

  //recupera form info cuando se esta descalificado el usuario
  $('body').on('click', '#form_info', function(){
    var id = $(this).val();
    $.ajax({
      url : url + "/home/recover_info",
      type: "POST",
      data: "user_survey_id=" + id,
      success: function(html){
        var obj = JSON.parse(html);
        $('#info_form_modal .modal-dialog .modal-content .modal-body').html(obj.result_information);
        $('#info_form_modal').modal('toggle');
      }
    });
  });

  $('body').on('click', '#update_password', function(){
    event.preventDefault();
    var data = $('#change_password_form').serialize();
    $.ajax({
      url : url + "/users/update_password",
      type: "POST",
      data: data,
      success: function(html){
        console.log(html);
        var obj = JSON.parse(html);
        if( obj.status == 'error'){
          $('#error_change_password').addClass('alert-danger').html(obj.data);
        }else if(obj.status == 'success'){
          $('#error_change_password').addClass('alert-success').html(obj.data);
          setTimeout(function(){ window.location.href = url+'/users/logout'; } , 3000)
      }
    }
    });
  });

  //mantiene tab activo despues de reload
  if( localStorage.getItem('active_tab') == null ){
    localStorage.setItem('active_tab', 'v-pills-user-tab')
  }
  var triggerTabList = [].slice.call(document.querySelectorAll('button[data-bs-toggle="pill"]'))
  triggerTabList.forEach(function (triggerEl) {
    var tabTrigger = new bootstrap.Tab(triggerEl)

    triggerEl.addEventListener('click', function (event) {
      event.preventDefault()
      tabTrigger.show()
      localStorage.setItem('active_tab', $(this).attr('id'))
      $('.error_list').html('');
    })
  })

  var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
  var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl)
  })



  var active_tab = localStorage.getItem('active_tab')
  if( active_tab ){
    $( '#' + active_tab ).tab('show')
  }
  $('.navbar-brand').click(function(){ localStorage.removeItem('active_tab') })
  $('.mis_concursos').click(function(){ localStorage.setItem('active_tab', 'v-pills-surveys-tab') })

  //cambia icono izq boton por icono carga y bloquea boton
  $('body').on('click', '.submit_something', function(){
    $(this).addClass('disabled')
    $(this).children().removeClass().addClass('fa-solid fa-circle-notch fa-spin').prop('disabled', true)
  });

  //deshabilita link al hacer lick
  $('body').on('click', '.link_something', function(){
    $(this).addClass('pe-none')
  });

  //***verificado si se puede crear funcion
  var success = "<?= session()->get('success'); ?>";
  var failure = "<?= session()->get('failure'); ?>";
  if( success != ''){
    $('#alert_toast').addClass('text-white bg-success');
    $('#alert_toast .toast-header').addClass('text-white bg-success')
    $('#alert_toast .toast-body').html(success);
    $('#alert_toast').toast('show');
  }
  if( failure != ''){
    $('#alert_toast').addClass('text-white bg-danger');
    $('#alert_toast .toast-header').addClass('text-white bg-danger')
    $('#alert_toast .toast-body').html(failure);
    $('#alert_toast').toast('show');
  }
});//end document ready





  //scripts especificos para cada concurso.

  //1.- categoria empresa, pregunta 4 (presupuesto) sin textbox.
  var survey_id = '<?= $_GET['survey_id'] ?? null ; ?>';
  if( survey_id == '2' ){
    var textarea = $('#textarea_cuestionario_4');
    textarea.addClass('d-none');
  }
  if( survey_id == '1' ){
    var textarea = $('#textarea_cuestionario_3');
    textarea.addClass('d-none');
  }
  if( survey_id == '4' ){
    var textarea = $('#textarea_cuestionario_4');
    textarea.addClass('d-none');
  }
  if( survey_id == '5' ){
    var textarea = $('#textarea_cuestionario_4');
    textarea.addClass('d-none');
  }

  //validar que el textarea que no se muestra, no pase por validacion
</script>
