<div class="row">
  <div class="col-md-7">
    <div class="card border-primary mb-3">
      <form class="form" action="" method="post">
        <div class="card-header bg-primary text-white pt-3">
          Status
        </div>
        <div class="card-body">
          <div class="row">
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
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="status_radio_5" value="5">
                <label class="form-check-label" for="status_radio_5">Ganador</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="status_radio_4" value="4">
                <label class="form-check-label" for="status_radio_4">Descalificado</label>
              </div>
            </div>
            <div class="mb-3">
              <label for="descalification_form" class="form-label">Causa descalificacion</label>
              <textarea class="form-control" id="descalification_form" name="descalification" rows="3"></textarea>
            </div>
          </div>
          <button id="submit_status" type="button" class="btn btn-primary submit_something" name="button">Guardar</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-6">

  </div>

</div>


<form class="needs-valdiation" id="form" enctype="multipart/form-data" autocomplete="off">
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
              <label for="input_datos" class="form-label mb-1">'.($count + 1).'.- '.$key->pregunta.'</label>
              <input type="text" class="form-control" id="input_datos" name="data[0]['.$count.']" value="'.($answers[0][$count] ?? null).'">
            </div>';
      $count ++;
    }
    echo '</div>';
  }//datos

  if( isset($formulario[$i]->cuestionario) ){

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
                  <label for="formFile" class="form-label mb-1">'.$row.'</label>
                  <div class="row mb-3 '.( !isset( $file_list[1][$aux] ) ? 'd-none' : null ).'" id="uploadedFile">
                      <div class="col-md-12">
                        <div class="input-group">
                          <input type="text" class="form-control" value="DOCUMENTO COMPLEMENTARIO #'.($aux + 1).'" aria-label="" readonly>
                          <a href="" class="btn btn-outline-primary" type="button"><i class="fa-solid fa-download"></i></a>
                          <button class="btn btn-outline-danger" id="delete_file" type="button" value="'.($file_list[1][$aux] ?? null).'">
                            <i class="fa-solid fa-trash-can"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                <input class="form-control '.( isset( $file_list[1][$aux] ) ? 'd-none' : null ).'" type="file" id="formFile" name="comp[]">
            </div>';
          $aux++;
        }
        echo '</div>';
      }//archivos adjuntos
      $count++;
    }

  }//cuestionario

  if( isset($formulario[$i]->archivos) ){
    echo '<div class="row">';
    $count = 0;
    foreach ($formulario[$i]->archivos as $key) {
      echo '<div class="mb-3 col-md-7">
              <label for="formFile" class="form-label mb-1">'.($count + 1).'.- '.$key.'</label>
                <div class="row '.( !isset( $file_list[2][$count] ) ? 'd-none' : null ).'" id="uploadedFile">
                <div class="col-md-12">
                  <div class="input-group">
                    <input type="text" class="form-control" value="DOCUMENTO NECESARIO #'.($count + 1).'" aria-label="" readonly>
                    <button class="btn btn-outline-primary" type="button"><i class="fa-solid fa-download"></i></button>
                    <button class="btn btn-outline-danger" id="delete_file" type="button" value="'.($file_list[2][$count] ?? null).'">
                      <i class="fa-solid fa-trash-can"></i>
                    </button>
                  </div>
                </div>
              </div>
            <input class="form-control '.( isset( $file_list[2][$count] ) ? 'd-none' : null ).'" type="file" id="formFile" name="file[]">
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

<div class="row">
  <div class="col-12">
    <button type="submit" class="btn btn-primary w-100 submit_something" name="button">Guardar</button>
  </div>
</div>
</form>
