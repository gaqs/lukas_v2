<!-- Modal edit cuestionario y usuario -->
<div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="edit_modal_label" aria-hidden="true">
  <div class="modal-dialog modal-xl px-5 pt-0">
    <div class="modal-content">
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

<script type="text/javascript" src="<?= base_url('dist/bootstrap-5.1.3/js/bootstrap.bundle.js');?>"></script>
<script type="text/javascript" src="<?= base_url('js/scrollreveal.js');?>"></script>
<script type="text/javascript" src="<?= base_url('dist/datatables-1.11.3/datatables.js');?>"></script>
<script type="text/javascript" src="<?= base_url('dist/datatables-1.11.3/Responsive-2.2.9/js/responsive.bootstrap5.js');?>"></script>
<script type="text/javascript" src="<?= base_url('js/scripts.js?v=0.1');?>"></script>
<script type="text/javascript">

  $(document).ready(function() {

    var url = "<?= base_url()?>";

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

  });

</script>
