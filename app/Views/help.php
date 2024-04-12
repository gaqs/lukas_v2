<div id="authentication" class="bg-primary bg-gradient">
  <div id="authentication_content" class="my-5">
    <main role="main">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-5 map-responsive mb-3">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2989.9058013904387!2d-72.93980168488679!3d-41.46295835924439!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x96183af88b9f7211%3A0x787f6c3c86477910!2sMunicipalidad%20Puerto%20Montt%20edificio%20consistorial%20II!5e0!3m2!1ses-419!2scl!4v1651779781328!5m2!1ses-419!2scl" width="100%" height="100%" style="border:0;" allowfullscreen></iframe>
          </div>
            <div class="col-md-7">
                <h1 class="display-5 fw-boldest text-white mb-3">Dudas? Consultas?<br>Escribenos...</h1>
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header py-4">
                      <h3 class="text-center font-weight-light mt-4">
                        Contactar
                      </h3>
                      <div class="text-center">
                        <small>Concursos Lukas para Emprender</small>
                      </div>
                    </div>
                    <div class="card-body">
                      <form class="" action="<?= base_url('home/help');?>" method="post">
                      <?= csrf_field() ?>
                      <div class="row">
                        <div class="col-md-7">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="input_name" name="name" placeholder="">
                            <label for="input_name">Nombre Completo</label>
                          </div>
                        </div>
                        <div class="col-md-5">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="input_phone" name="phone" placeholder="">
                            <label for="input_phone">Teléfono</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="input_email" name="email" placeholder="">
                            <label for="input_email">Correo electrónico</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="input_subject" name="subject" placeholder="">
                            <label for="input_subject">Asunto</label>
                          </div>
                        </div>
                        <div class="col-md-12 mb-3">
                          <div class="form-floating">
                            <textarea class="form-control" placeholder="" id="textarea_message" name="message" style="height:100px;"></textarea>
                            <label for="textarea_message">Mensaje</label>
                          </div>
                        </div>
                      </div>
                      <?php if(isset($validation)): ?>
                        <div class="col-12 mb-3">
                          <?= $validation->listErrors('custom') ?>
                        </div>
                      <?php endif ?>
                      <div class="mt-4 mb-0">
                          <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-block submit_something">
                              <i class="fa-solid fa-paper-plane"></i> Enviar mensaje
                            </button>
                          </div>
                      </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </main>
  </div><!-- /end authentication_content-->
