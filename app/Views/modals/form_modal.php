<div class="container my-5">
  <form class="needs-valdiation" id="form" enctype="multipart/form-data" autocomplete="off">
    <?php
    if( session()->get('success') ){
      echo '<div class="alert alert-success alert-dismissible fade show">'.session()->get('success').'<button type="button" class="btn-close text-danger" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }else if( session()->get('failure') ){
      echo '<div class="alert alert-danger alert-dismissible fade show">'.session()->get('failure').'<button type="button" class="btn-close text-danger" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
    ?>

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
                  <label for="formFile" class="form-label mb-1">'.$row.'</label>
                  <div class="row mb-3 '.( !isset( $file_list[1][$aux] ) ? 'd-none' : null ).'" id="uploadedFile">
                      <div class="col-md-12">
                        <div class="input-group">
                          <input type="text" class="form-control" value="DOCUMENTO COMPLEMENTARIO #'.($aux + 1).'" aria-label="" readonly>
                          <button class="btn btn-outline-primary" type="button"><i class="fa-solid fa-download"></i></button>
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
    echo '</div>';
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
    </div>
  </div>';

}//formulario


if( isset($validation) ){
  echo '<div class="col-12 mb-3">'.$validation->listErrors('custom').'</div>';
}

?>
</form>
</div>
</div>
