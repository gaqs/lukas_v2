<!--
<div class="row">
  <div class="col-md-12">
    <div class="card border-primary mb-3">
      <form class="form" action="" method="post">
        <div class="card-header bg-primary text-white pt-3">
          Status
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-5">
              <div class="mb-3">
                <label for="status_radio_2" class="form-label">Estado postulacion</label>
                <br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="status" id="status_radio_2" value="2">
                  <label class="form-check-label" for="status_radio_2">En revisión</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="status" id="status_radio_3" value="3">
                  <label class="form-check-label" for="status_radio_3">Retirado</label>
                </div>
                <br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="status" id="status_radio_5" value="5">
                  <label class="form-check-label" for="status_radio_5">Ganador</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="status" id="status_radio_4" value="4">
                  <label class="form-check-label" for="status_radio_4">Descalificado</label>
                </div>
              </div>
            </div>
            <div class="col-md-7">
              <div class="mb-3">
                <label for="descalification_form" class="form-label">Causa descalificacion</label>
                <textarea class="form-control" id="descalification_form" name="descalification" rows="3"></textarea>
              </div>
            </div>
          </div>
          <button id="submit_status" type="button" class="btn btn-primary submit_something" name="button">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
-->

<form class="needs-valdiation" id="form" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="survey_id" id="survey_id" value="<?= set_value('survey_id', $survey_id);?>">
<?php
$json = json_decode($content);
$formulario =  (array)$json->formulario;

for ($i=0; $i < count($formulario); $i++) {
  echo '<div class="card mb-3">
            <div class="card-header pt-3">
              '.$formulario[$i]->titulo.'
            </div>
            <div class="card-body">';

  if( isset($formulario[$i]->datos) ){
    echo '<div class="row">';
    $count = 0;
    foreach ($formulario[$i]->datos as $key) {

      echo '<div class="mb-3 col-md-6">
              <label for="input_datos_'.$count.'" class="form-label mb-1">'.($count + 1).'.- '.$key->pregunta.'
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
                  <div class="row mb-3 '.( !isset( $file_list[1][$aux] ) ? 'd-none' : null ).'" id="uploadedFile">
                      <div class="col-md-12">
                        <div class="input-group w-50">
                          <input type="text" class="form-control" value="DOCUMENTO COMPLEMENTARIO #'.($aux + 1).'" aria-label="" readonly>
                          <a href="'.base_url('public/files/usuarios').'/'.$user['rut'].'/'.$user['surveys_id'].'/'.($file_list[1][$aux]  ?? null).'" class="btn btn-outline-success z_index_0" target="_blank" type="button" data-bs-tooltip="true" data-bs-placement="top" title="Ver/Descargar"><i class="fa-solid fa-eye"></i></a>
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
              <label for="formFile" class="form-label mb-0">'.($count + 1).'.- '.$key.'</label>
                <div class="row '.( !isset( $file_list[2][$count] ) ? 'd-none' : null ).'" id="uploadedFile">
                <div class="col-md-12">
                  <div class="input-group w-50">
                    <input type="text" class="form-control" value="DOCUMENTO NECESARIO #'.($count + 1).'" aria-label="" readonly>
                    <a href="'.base_url('public/files/usuarios').'/'.$user['rut'].'/'.$user['surveys_id'].'/'.($file_list[2][$count] ?? null).'" target="_blank" class="btn btn-outline-success z_index_0" type="button" data-bs-tooltip="true" data-bs-placement="top" title="Ver/Descargar"><i class="fa-solid fa-eye"></i></a>
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
    </div>';

}//formulario


if( isset($validation) ){
  echo '<div class="col-12 mb-3">'.$validation->listErrors('custom').'</div>';
}
?>
<!--
<div class="row">
  <div class="col-12">
    <button type="submit" class="btn btn-primary w-100 submit_something" name="button">Guardar</button>
  </div>
</div>
-->
</form>
<script type="text/javascript">
var survey_id = $('#survey_id').val();
if( survey_id == '1' ){ $('#textarea_cuestionario_3').addClass('d-none'); }
if( survey_id == '2' ){ $('#textarea_cuestionario_4').addClass('d-none'); }
if( survey_id == '4' ){ $('#textarea_cuestionario_4').addClass('d-none'); }
if( survey_id == '5' ){ $('#textarea_cuestionario_4').addClass('d-none'); }
</script>
