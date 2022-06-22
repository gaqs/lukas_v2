<div id="sidenav_content">
  <main class="main mt-3">
    <div class="container">
      <div class="row">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ;?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contraseña</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-md-4">
          <form>
            <div class="mb-3">
              <label for="input_pass" class="form-label">Contraseña</label>
              <input type="text" class="form-control" id="input_pass" name="" value="">
            </div>
            <button type="button" class="btn btn-primary" name="button" id="cifrar_pass">Cifrar</button>
          </form>
        </div>
        <div class="col-md-8">
          <div class="mb-3">
            <label for="textarea_cifrado" class="form-label">Resultado</label>
            <textarea class="form-control" id="textarea_cifrado" rows="3"></textarea>
          </div>
        </div>
      </div>
    </div><!-- /end container-->

  </main><!-- /end main-->
  <script type="text/javascript">
    var url = "<?= base_url()?>";
    $(document).ready(function(){

      $('body').on('click', '#cifrar_pass', function(){
        var pass = $('#input_pass').val();
        $.ajax({
          url : url + "/admin/password",
          type: "POST",
          data: "pass=" + pass,
          success: function(html){
            $('#textarea_cifrado').text(html);
          }
        });
      });



    });
  </script>
