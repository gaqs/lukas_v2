<!-- Modal edit cuestionario,usuario, fechas, etc... -->
<div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="edit_modal_label" aria-hidden="true">
  <div class="modal-dialog modal-xl pt-0">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title" id="edit_modal_label">Editar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" name="button"></button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" name="button"><i class="fas fa-sign-out-alt"></i> Guardar</button>
      </div>
    </div>
  </div>
</div>

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

<!-- Toast prueba mensajes exito y error esquina inferior -->
<div class="position-fixed w-100" style="top:2rem;pointer-events: none; touch-action: none;z-index:1040;">
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

<script type="text/javascript" src="<?= base_url('dist/bootstrap-5.1.3/js/bootstrap.bundle.js');?>"></script>
<script type="text/javascript" src="<?= base_url('js/scrollreveal.js');?>"></script>
<script type="text/javascript" src="<?= base_url('dist/datatables-1.11.3/datatables.js');?>"></script>
<script type="text/javascript" src="<?= base_url('dist/datatables-1.11.3/Responsive-2.2.9/js/responsive.bootstrap5.js');?>"></script>
<script type="text/javascript" src="<?= base_url('js/scripts.js?v=0.1');?>"></script>
<script type="text/javascript">

  $(document).ready(function() {

    var url = "<?= base_url()?>";

    //cambia icono izq boton por icono carga y bloquea boton
    $('body').on('click', '.submit_something', function(){
      $(this).addClass('disabled')
      $(this).children().removeClass().addClass('fa-solid fa-circle-notch fa-spin').prop('disabled', true)
    });

    $('#users_table').DataTable({
        "language" : {
          "url" : "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
          "responsive": true
        },
        "bStateSave" : true,
        "fnStateSave" : function(oSettings, oData){
            localStorage.setItem('DataTables', JSON.stringify(oData));
        },
        "fnStateLoad": function(oSettings){
          return JSON.parse(localStoragegetItem('DataTables'));
        }
      });


      $('body').on('click', '#edit_form', function(){
        var id = $(this).val();
        $.ajax({
          url : url + "/admin/edit_form",
          type: "GET",
          data: "user_survey_id=" + id,
          success: function(html){
            $('#edit_modal .modal-dialog .modal-content').html(html);
            $('#edit_modal').modal('toggle');
          }
        });
      });

      $('body').on('click', '#submit_status', function(){
        var id = $(this).val();
        $.ajax({
          url : url + "/admin/edit_form",
          type: "GET",
          data: "user_survey_id=" + id,
          success: function(html){
            $('#edit_modal .modal-dialog .modal-content').html(html);
            $('#edit_modal').modal('toggle');
          }
        });
      });

      $('body').on('click', '#edit_survey', function(){
        var id = $(this).val();
        $.ajax({
          url : url + "/admin/edit_survey",
          type: "GET",
          data: "id=" + id,
          success: function(html){
            $('#edit_modal .modal-dialog .modal-content').html(html);
            $('#edit_modal').modal('toggle');
          }
        });
      });

      $('body').on('click', '#edit_user', function(){
        var id = $(this).val();
        $.ajax({
          url : url + "/admin/edit_user",
          type: "GET",
          data: "id=" + id,
          success: function(html){
            $('#edit_modal .modal-dialog .modal-content').html(html);
            $('#edit_modal').modal('toggle');
          }
        });
      });

      /*
      $('body').on('click', '#add_admin', function(){
        $.ajax({
          url : url + "/admin/add_admin",
          type: "GET",
          success: function(html){
            $('#edit_modal .modal-dialog .modal-content').html(html);
            $('#edit_modal').modal('toggle');
          }
        });
      });
      */


      $('body').on('click', '#button_random', function(){
        var length = 6;
        var charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        var retVal = "";
        for (var i = 0, n = charset.length; i < length; ++i) {
            retVal += charset.charAt(Math.floor(Math.random() * n));
        }
        $('#input_password_admin').val(retVal);
      });

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



      //scripts especificos para cada concurso.
      //1.- categoria empresa, pregunta 4 (presupuesto) sin textbox.
      var survey_id = '<?= $_GET['survey_id'] ?? null ; ?>';
      if( survey_id == '1' ){ $('#textarea_cuestionario_3').addClass('d-none'); }
      if( survey_id == '2' ){ $('#textarea_cuestionario_4').addClass('d-none'); }
      if( survey_id == '4' ){ $('#textarea_cuestionario_4').addClass('d-none'); }
      if( survey_id == '5' ){ $('#textarea_cuestionario_4').addClass('d-none'); }
  });


</script>
