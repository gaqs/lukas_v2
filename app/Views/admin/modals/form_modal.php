<div class="row">
  <div class="col-md-6 mb-3">
    <p>Estado Formulario.</p>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="status" id="radio1" value="2" <?= $status == 2 ? 'checked':null; ?> >
      <label class="form-check-label" for="radio1"> Enviado</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="status" id="radio2" value="1" <?= $status == 1 ? 'checked':null; ?> >
      <label class="form-check-label" for="radio2"> Guardado</label>
    </div>
  </div>
</div>

<div class="card mb-3">
  <div class="card-header pt-3">
    Usuario
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-3 mb-3">
        <label for="input_name" class="form-label">Nombre</label>
        <span class="fas fa-user icon-input"></span>
        <input type="text" class="form-control" id="input_name" name="name" readonly value="<?= set_value('name',$user['name']);?>">
      </div>
      <div class="col-md-3 mb-3">
        <label for="input_lastname" class="form-label">Apellidos</label>
        <span class="fas fa-user-friends icon-input"></span>
        <input type="text" class="form-control" id="input_lastname" name="lastname" readonly value="<?= set_value('lastname',$user['lastname']);?>">
      </div>
      <div class="col-md-3 mb-3">
        <label for="input_rut" class="form-label">RUT</label>
        <i class="fa-solid fa-address-card icon-input"></i>
        <input type="text" class="form-control" id="input_rut" name="rut" readonly value="<?= $user['rut']; ?>">
      </div>
      <div class="col-md-3 mb-3">
        <label for="input_optional_email" class="form-label">Correo</label>
        <span class="fas fa-envelope icon-input"></span>
        <input type="email" class="form-control" id="input_email" name="email" readonly value="<?= $user['email']; ?>">
      </div>
    </div>
  </div>
</div>
<form class="needs-valdiation" id="form" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="survey_id" id="survey_id" value="<?= set_value('survey_id', $survey_id);?>">
<input type="hidden" name="user_survey_id" id="user_survey_id" value="<?= $user_survey_id; ?>">
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

      if (isset($key->pregunta)) {

        echo '<div class="mb-4">
            <label for="textarea_cuestionario_' . $count . '" class="form-label label_questions">
            ' . ($count + 1) . '.- ' . $key->pregunta . '
              <i tabindex=0 class="fa-solid fa-circle-question help_icon" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-custom-class="custom_popover" data-bs-html="true" data-bs-content="<b>Ejemplo.</b> ' . $key->ejemplo . '"></i>
              <span class="letter_count">2000</span>
            </label>
            <textarea class="form-control mb-3 textarea_cuestionario" id="textarea_cuestionario_' . $count . '" rows="5" data-limit=2000 name="data[1][' . $count . ']">' . ($answers[1][$count] ?? null) . '</textarea>
          </div>';

      }
      if (isset($key->tabla)) {

        $jt = json_decode($answers[1][$count] ?? null);

        echo '<div class="mb-4">
              <label for="textarea_cuestionario_' . $count . '" class="form-label label_questions">
              ' . ($count + 1) . '.- ' . $key->tabla . '
                <i tabindex=0 class="fa-solid fa-circle-question help_icon" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-custom-class="custom_popover" data-bs-html="true" data-bs-content="<b>Ejemplo.</b> ' . $key->ejemplo . '"></i>
              </label>
              <table border="1" width="100%" class="table table-bordered" id="cotizacion" name="cotizacion">
                <thead>
                  <tr>
                    <th>Nombre Item</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>Total</th>
                    <th>Resultados esperados <span style="font-weight:200;">(¿En que le ayudará esta compra?)</span></th>
                  </tr>
                </thead>
                <tbody>';

        for ($k = 1; $k < 10; $k++) {
          echo '<tr>
                <td contenteditable="true">' . (isset($jt[$k]->c_0) ? $jt[$k]->c_0 : null) . '&nbsp;</td>
                <td contenteditable="true" class="allownumeric">' . (isset($jt[$k]->c_1) ? $jt[$k]->c_1 : null) . '&nbsp;</td>
                <td contenteditable="true" class="allownumeric">' . (isset($jt[$k]->c_2) ? $jt[$k]->c_2 : null) . '&nbsp;</td>
                <td contenteditable="true" class="allownumeric">' . (isset($jt[$k]->c_3) ? $jt[$k]->c_3 : null) . '&nbsp;</td>
                <td contenteditable="true">' . (isset($jt[$k]->c_4) ? $jt[$k]->c_4 : null) . '&nbsp;</td>
              </tr>';
        }

        echo '</tbody>
        </table>
      </div>';
      }

      if (isset($key->archivos)) {
        echo '<div class="archivos_adjuntos ms-md-4">';
        foreach ($key->archivos as $row) {
          echo '<div class="mb-3 col-md-12">
                <label for="formFile" class="form-label mb-0 file_label_' . ($aux + 1) . '">' . ($aux + 1) . '.- ' . $row . '
                </label>
                <small class="form-text mt-0 mb-2 fw-light f-small d-block"> (Tamaño máximo 20 mb. Formatos permitidos .jpeg, .jpg, .png, .pdf, .doc, .xls, .docx, .xslx, .odt, y .odf)</small>
                <div class="row mb-3 ' . (!isset($file_list[1][$aux]) ? 'd-none' : null) . '" id="uploadedFile">
                    <div class="col-md-12">
                      <div class="input-group w-50">
                        <input type="text" class="form-control" value="DOCUMENTO COMPLEMENTARIO #' . ($aux + 1) . '" aria-label="" readonly>
                        <a href="' . base_url('public/files/usuarios') . '/' . $user['rut']. '/' . $survey_id . '/' . ($file_list[1][$aux] ?? null) . '?v=' . rand(0, 50) . '" class="btn btn-outline-success z_index_0" target="_blank" type="button" data-bs-tooltip="true" data-bs-placement="top" title="Ver/Descargar"><i class="fa-solid fa-eye"></i></a>
                        <button class="btn btn-outline-danger z_index_0" id="delete_file" type="button" value="' . ($file_list[1][$aux] ?? null) . '" data-bs-tooltip="true" data-bs-placement="top" title="Eliminar">
                          <i class="fa-solid fa-trash-can"></i>
                        </button>
                      </div>
                    </div>
                  </div>
              <input class="form-control w-50 mb-4  ' . (isset($file_list[1][$aux]) ? 'd-none' : null) . '" type="file" id="formFile" name="comp[]">
              <div class="feedback text-start mb-4"></div>
          </div>';
          $aux++;
        }
        echo '</div>';
      } //archivos adjuntos
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
                      <a href="'.base_url('public/files/usuarios').'/'.$user['rut'].'/'.$user['surveys_id'].'/'.($file_list[2][$count] ?? null).'?v='.rand(10000,99999).'" target="_blank" class="btn btn-outline-success z_index_0" type="button" data-bs-tooltip="true" data-bs-placement="top" title="Ver/Descargar"><i class="fa-solid fa-eye"></i></a>
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

<div class="row mt-3 ms-2">
  <div class="col-md-12 text-end">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" name="button" id="update_form"><i class="fas fa-sync"></i> Actualizar</button>
  </div>
</div>

</form>
<script type="text/javascript">
var survey_id = $('#survey_id').val();

</script>
