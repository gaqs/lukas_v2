<?php
$json = json_decode($content);
$formulario =  (array)$json->formulario;
?>

<!-- form empresa/pregunta 4/ sin textbox solo archivo***  -->

  <div class="container mt-3 mb-5">
    <!--<form class="needs-validation" action="<?= base_url('home/forms') ?>" method="post" id="form" enctype="multipart/form-data">-->
    <form class="needs-valdiation" id="form" enctype="multipart/form-data" autocomplete="off">
      <input type="hidden" name="survey_id" value="<?= set_value('survey_id', $survey_id);?>">

      <div class="alert alert-warning" role="alert" id="error_form">
        <div class="row">
          <div class="col-md-1 text-center">
            <i class="fa-solid fa-circle-exclamation display-1"></i>
          </div>
          <div class="col-md-11 ps-3">
            <i><b>IMPORTANTE!</b><br><?= $json->importante; ?></i>
          </div>
        </div>
      </div>

<?php


  for ($i=0; $i < count($formulario); $i++) {
    echo '<div class="row">
            <div class="card p-0 mb-3 '.($formulario[$i]->titulo == '' ? 'd-none' : null).'">
              <div class="card-header pt-3">
              <h5>
                <i class="fas fa-pen-square"></i> '.$formulario[$i]->titulo.'
              </h5>
              </div>
              <div class="card-body">';

    if( isset($formulario[$i]->datos) && $formulario[$i]->datos != '' ){
      echo '<div class="row">';
      $count = 0;
      foreach ($formulario[$i]->datos as $key) {

        echo '<div class="mb-3 col-md-6">
                <label for="input_datos_'.$count.'" class="form-label mb-1">'.($count + 1).'.- '.$key->pregunta.'
                  <i class="fa-solid fa-circle-question help_icon" data-bs-toggle="popover"  data-bs-custom-class="custom_popover" data-bs-trigger="hover focus" data-bs-html="true" data-bs-content="<b>Ejemplo</b>. '.$key->ejemplo.'"></i>
                </label>
                <input type="text" class="form-control" id="input_datos_'.$count.'" name="data[0]['.$count.']" value="'.($answers[0][$count] ?? null).'">
              </div>';
        $count ++;
      }
      echo '</div>';
    }//datos

    if( isset($formulario[$i]->cuestionario) ){
      echo '<div class="row">';
      $count = 0; //contador numero formulario
      $aux   = 0; //contador numero archivo por orden de respuesta
      foreach ($formulario[$i]->cuestionario as $key) {

        echo '<div class="mb-4">
                <label for="textarea_cuestionario_'.$count.'" class="form-label label_questions">
                '.($count + 1).'.- '.$key->pregunta.'
                  <i tabindex=0 class="fa-solid fa-circle-question help_icon" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-custom-class="custom_popover" data-bs-html="true" data-bs-content="<b>Ejemplo.</b> '.$key->ejemplo.'"></i>
                  <span class="letter_count">2000</span>
                </label>
                <textarea class="form-control mb-3 textarea_cuestionario" id="textarea_cuestionario_'.$count.'" rows="5" data-limit=2000 name="data[1]['.$count.']">'.($answers[1][$count] ?? null).'</textarea>
              </div>';

        if( isset( $key->archivos ) ){
          echo '<div class="archivos_adjuntos ms-4">';
          foreach ($key->archivos as $row) {
            echo '<div class="mb-3 col-md-12">
                    <label for="formFile" class="form-label mb-0 file_label_'.($aux+1).'">'.($aux+1).'.- '.$row.'
                    </label>
                    <small class="form-text mt-0 mb-2 fw-light f-small d-block"> (Tamaño máximo 20 mb. Formatos permitidos .jpeg, .jpg, .png, .pdf, .doc, .xls, .docx, .xslx, .odt, y .odf)</small>
                    <div class="row mb-3 '.( !isset( $file_list[1][$aux] ) ? 'd-none' : null ).'" id="uploadedFile">
                        <div class="col-md-12">
                          <div class="input-group w-50">
                            <input type="text" class="form-control" value="DOCUMENTO COMPLEMENTARIO #'.($aux + 1).'" aria-label="" readonly>
                            <a href="'.base_url('public/files/usuarios').'/'.session()->get('rut').'/'.$survey_id.'/'.($file_list[1][$aux]  ?? null).'" class="btn btn-outline-success z_index_0" target="_blank" type="button" data-bs-tooltip="true" data-bs-placement="top" title="Ver/Descargar"><i class="fa-solid fa-eye"></i></a>
                            <button class="btn btn-outline-danger z_index_0" id="delete_file" type="button" value="'.($file_list[1][$aux] ?? null).'" data-bs-tooltip="true" data-bs-placement="top" title="Eliminar">
                              <i class="fa-solid fa-trash-can"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                  <input class="form-control w-50 mb-4  '.( isset( $file_list[1][$aux] ) ? 'd-none' : null ).'" type="file" id="formFile" name="comp[]">
                  <div class="feedback text-start mb-4"></div>
              </div>';
            $aux++;
          }
          echo '</div>';
        }//archivos adjuntos
        $count++;
      }
      echo '</div>';
    }//cuestionario

    if( isset($formulario[$i]->archivos) ){
      echo '<div class="row">';
      $count = 0;
      foreach ($formulario[$i]->archivos as $key) {
        echo '<div class="mb-3 col-md-12">
                <label for="formFile" class="form-label mb-0">'.($count + 1).'.- '.$key.'
                  <i class="fa-solid fa-circle-question help_icon" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-custom-class="custom_popover" data-bs-html="true" data-bs-content="<b>Ejemplo.</b> And heres some amazing content. Its very engaging. Right?"></i>
                </label>
                <small class="form-text mt-0 mb-2 fw-light f-small d-block"> (Tamaño máximo 20 mb. Formatos permitidos .jpeg, .jpg, .png, .pdf, .doc, .xls, .docx, .xslx, .odt, y .odf)</small>
                  <div class="row '.( !isset( $file_list[2][$count] ) ? 'd-none' : null ).'" id="uploadedFile">
                  <div class="col-md-12">
                    <div class="input-group w-50">
                      <input type="text" class="form-control" value="DOCUMENTO NECESARIO #'.($count + 1).'" aria-label="" readonly>
                      <a href="'.base_url('public/files/usuarios').'/'.session()->get('rut').'/'.$survey_id.'/'.($file_list[2][$count] ?? null).'" target="_blank" class="btn btn-outline-success z_index_0" type="button" data-bs-tooltip="true" data-bs-placement="top" title="Ver/Descargar"><i class="fa-solid fa-eye"></i></a>
                      <button class="btn btn-outline-danger z_index_0" id="delete_file" type="button" value="'.($file_list[2][$count] ?? null).'" data-bs-tooltip="true" data-bs-placement="top" title="Eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                      </button>
                    </div>
                  </div>
                </div>
              <input class="form-control w-50 '.( isset( $file_list[2][$count] ) ? 'd-none' : null ).'" type="file" id="formFile" name="file[]">
              <div class="feedback text-start mb-3"></div>
            </div>';
        $count++;
      }
      echo '</div>';
    }//archivos

    echo '</div>
      </div>
    </div>';

  }//formulario


  if( isset($validation) ){
    echo '<div class="col-12 mb-3">'.$validation->listErrors('custom').'</div>';
  }

 ?>
     <div class="row">
       <div class="col-6 mt-4 ps-0">
         <button type="submit" id="save_form" name="submit_button" class="btn btn-success btn-lg w-100 submit_something always_show" value="save_form"> <i class="fa-solid fa-floppy-disk"></i> Guardar</button>
       </div>
       <div class="col-6 d-flex align-items-center mt-4 pe-0">
         <button type="submit" id="send_form" name="submit_button" class="btn btn-primary btn-lg w-100 submit_something" value="send_form"><i class="fa-solid fa-paper-plane"></i> Enviar</button>
       </div>
     </div>
  </form>
  <!--</form>-->
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){

    //cuando boton send form aparece en pantalla, boton guardar vuelve a su posicion
    var observer = new IntersectionObserver(function(entries) {
      var btn = $('#save_form');
       if(entries[0].isIntersecting === true){
         btn.removeClass('always_show');
       }else{
         btn.addClass('always_show');
       }
       //console.log('Element is fully visible in screen')
    }, { threshold: [0.5] });
    observer.observe(document.querySelector("#send_form"))
  });
</script>
