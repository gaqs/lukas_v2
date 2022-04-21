  <div class="container mt-3 mb-5">
    <!--<form class="needs-validation" action="<?= base_url('home/forms') ?>" method="post" id="form" enctype="multipart/form-data">-->
    <form class="needs-valdiation" id="form" enctype="multipart/form-data" autocomplete="off">
      <input type="hidden" name="survey_id" value="<?= set_value('survey_id', $survey_id);?>">

      <div class="alert text-center" role="alert" id="error_form">
        <i>Todos los datos son obligatorios.</i>
      </div>

<?php
  $json = json_decode($content);
  $formulario =  (array)$json->formulario;

  for ($i=0; $i < count($formulario); $i++) {
    echo '<div class="row">
            <div class="card p-0 mb-3">
              <div class="card-header pt-3">
              <h5>
                <i class="fas fa-pen-square"></i> '.$formulario[$i]->titulo.'
              </h5>
              </div>
              <div class="card-body">';

    if( isset($formulario[$i]->datos) ){
      echo '<div class="row">';
      $count = 0;
      foreach ($formulario[$i]->datos as $key) {

        echo '<div class="mb-3 col-md-6">
                <label for="input_datos" class="form-label mb-1">'.($count + 1).'.- '.$key->pregunta.'</label>
                <input type="text" class="form-control" id="input_datos" name="data[0]['.$count.']" value="'.($answers[0][$count] ?? null).'">
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

        echo '<div class="mb-3">
                <label for="textarea_cuestionario" class="form-label mb-1">'.($count + 1).'.- '.$key->pregunta.'</label>
                <textarea class="form-control" id="textarea_cuestionario" rows="5" name="data[1]['.$count.']">'.($answers[1][$count] ?? null).'</textarea>
              </div>';

        if( isset( $key->archivos ) ){
          echo '<div class="archivos_adjuntos">';
          foreach ($key->archivos as $row) {
            echo '<div class="mb-3 col-md-7">
                    <label for="formFile" class="form-label mb-0">'.$row.'</label>
                    <div class="form-text mt-0 mb-2"> (Tamaño máximo 20 mb. Formatos permitidos.jpeg, .jpg, .png, .pdf, .doc, .xls, .docx, .xslx, .odt, y .odf)</div>
                    <div class="row mb-3 '.( !isset( $file_list[1][$aux] ) ? 'd-none' : null ).'" id="uploadedFile">
                        <div class="col-md-12">
                          <div class="input-group">
                            <input type="text" class="form-control" value="DOCUMENTO COMPLEMENTARIO #'.($aux + 1).'" aria-label="" readonly>
                            <a href="'.base_url('public/files/usuarios').'/'.session()->get('rut').'/'.$survey_id.'/'.($file_list[1][$aux]  ?? null).'" class="btn btn-outline-primary" type="button" data-bs-tooltip="true" data-bs-placement="top" title="Descargar" download><i class="fa-solid fa-download"></i></a>
                            <button class="btn btn-outline-danger" id="delete_file" type="button" value="'.($file_list[1][$aux] ?? null).'" data-bs-tooltip="true" data-bs-placement="top" title="Eliminar">
                              <i class="fa-solid fa-trash-can"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                  <input class="form-control '.( isset( $file_list[1][$aux] ) ? 'd-none' : null ).'" type="file" id="formFile" name="comp[]">
                  <div class="feedback text-end"></div>
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
        echo '<div class="mb-3 col-md-7">
                <label for="formFile" class="form-label mb-0">'.($count + 1).'.- '.$key.'</label>
                <div class="form-text mt-0 mb-3 ms-3"> (Tamaño máximo 20 mb. Formatos permitidos .jpeg, .jpg, .png, .pdf, .doc, .xls, .docx, .xslx, .odt, y .odf)</div>
                  <div class="row '.( !isset( $file_list[2][$count] ) ? 'd-none' : null ).'" id="uploadedFile">
                  <div class="col-md-12">
                    <div class="input-group">
                      <input type="text" class="form-control" value="DOCUMENTO NECESARIO #'.($count + 1).'" aria-label="" readonly>
                      <a href="'.base_url('public/files/usuarios').'/'.session()->get('rut').'/'.$survey_id.'/'.($file_list[2][$count] ?? null).'" class="btn btn-outline-primary" type="button" data-bs-tooltip="true" data-bs-placement="top" title="Descargar" download><i class="fa-solid fa-download"></i></a>
                      <button class="btn btn-outline-danger" id="delete_file" type="button" value="'.($file_list[2][$count] ?? null).'" data-bs-tooltip="true" data-bs-placement="top" title="Eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                      </button>
                    </div>
                  </div>
                </div>
              <input class="form-control '.( isset( $file_list[2][$count] ) ? 'd-none' : null ).'" type="file" id="formFile" name="file[]">
              <div class="feedback text-end"></div>
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
  </form>
      <div class="row">
        <div class="d-flex align-items-center mt-4 p-0">
          <button type="button" id="send_form" class="btn btn-primary btn-lg w-100 submit_something"> <i class="fas fa-sign-in-alt"></i> Guardar</button>
        </div>
      </div>
    <!--</form>-->
  </div>
</div>
