
        <div id="footer" class="mb-0">
          <footer class="py-4 bg-light mt-auto">
              <div class="container-fluid px-4">
                  <div class="d-flex align-items-center justify-content-between small">
                      <div class="text-muted">Copyright &copy; Gustavo Quilodrán | gaqs.02@gmail.com | Puerto Montt - 2022</div>
                      <div>
                          <a href="<?= base_url('admin/login'); ?>">Acceso Administrador</a>
                          &middot;
                          <a href="#">Terms &amp; Conditions</a>
                      </div>
                  </div>
              </div>
          </footer>
        </div> <!-- /end footer -->
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
    <div class="position-fixed bottom-0 end-0 p-5" style="z-index: 11">
      <div id="alert_toast" class="toast hide border-0 fade" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <i class="fa-solid fa-bell me-2"></i>
          <strong class="me-auto">Atención!</strong>
          <small>1 segundos atrás</small>
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
<script type="text/javascript" src="<?= base_url('js/scrollreveal.js');?>"></script>
<script type="text/javascript" src="<?= base_url('js/scripts.js?v=0.1');?>"></script>

<!-- Custom script -->
<script type="text/javascript">

$(document).ready(function(){
  var url = '<?= base_url();?>';

  //form validation
  $('body').on('click', '#send_form', function(){
    var data = new FormData( $('#form')[0] );
    $.ajax({
      url : url + "/home/forms",
      type: "POST",
      data: data,
      processData: false,
      contentType: false,
      success: function(html){
        var obj = JSON.parse(html);
        if( obj.status == 'error'){
          $('#error_form').addClass('alert-danger').html(obj.data);
          window.scrollTo(0, 0);
        }else if( obj.status == 'success' ){
          $('#alert_toast').addClass('text-white bg-success');
          $('#alert_toast .toast-header').addClass('text-white bg-success')
          $('#alert_toast .toast-body').html(obj.data);
          $('#alert_toast').toast('show');
          window.scrollTo(0, 0);
          setTimeout(function(){ location.reload() } , 2000)
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
  var active_tab = localStorage.getItem('active_tab')
  if( active_tab ){
    $( '#' + active_tab ).tab('show')
  }
  $('.navbar-brand').click(function(){ localStorage.removeItem('active_tab') })
  $('.mis_concursos').click(function(){ localStorage.setItem('active_tab', 'v-pills-surveys-tab') })

  //cambia icono izq boton por icono carga y bloquea boton
  $('body').on('click', '.submit_something', function(){
    console.log( $(this).children()[0] )
    $(this).addClass('disabled')
    $(this).children().removeClass().addClass('fa-solid fa-circle-notch fa-spin').prop('disabled', true)
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
</script>
