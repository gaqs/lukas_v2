<?php
$json = json_decode($content);
$formulario = (array) $json->formulario;
?>

<!-- form empresa/pregunta 4/ sin textbox solo archivo***  -->

<div class="container mt-3 mb-5">
  <div class="row text-center mb-3 text-white bg-dark pt-2 pb-1 rounded">
    <div class="col-md-12">
      <h3>
        <?= $json->nombre; ?>
      </h3>
    </div>
  </div>

  <form class="needs-valdiation" id="form" enctype="multipart/form-data" autocomplete="off">
  <?= csrf_field() ?>
    <input type="hidden" name="survey_id" value="<?= set_value('survey_id', $survey_id); ?>">

    <div class="row">
      <div class="card p-0 mb-3">
        <div class="card-header pt-3">
          <h5><i class="fas fa-pen-square"></i> Datos Básicos</h5>
        </div>
        <div class="card-body">
          <div class="row">

            <div class="col-md-4 mb-3">
              <label for="input_name" class="form-label">Nombre<span class="text-danger">*</span></label>
              <span class="fas fa-user icon-input"></span>
              <input type="text" class="form-control" id="input_name" name="name" value="<?= set_value('name', $user['user_name']); ?>">
            </div>
            <div class="col-md-5 mb-3">
              <label for="input_lastname" class="form-label">Apellidos<span class="text-danger">*</span></label>
              <span class="fas fa-user-friends icon-input"></span>
              <input type="text" class="form-control" id="input_lastname" name="lastname" value="<?= set_value('lastname', $user['user_lastname']); ?>">
            </div>
            <div class="col-md-3 mb-3">
              <label for="input_rut" class="form-label">RUT<span class="text-danger">*</span></label>
              <i class="fa-solid fa-address-card icon-input"></i>
              <input type="text" class="form-control" id="input_rut" name="rut" value="<?= $user['user_rut']; ?>" readonly>
            </div>
            <div class="col-md-3 mb-3">
              <label for="sex_select" class="form-label">Sexo</label>
              <select class="form-select" id="sex_select" name="sex" aria-label="Default select example">
                <option value=" " <?= $user['sex'] == '' ? 'selected=true' : null ?> selected>No informar</option>
                <option value="F" <?= $user['sex'] == 'F' ? 'selected=true' : null ?>>Femenino</option>
                <option value="M" <?= $user['sex'] == 'M' ? 'selected=true' : null ?>>Masculino</option>
                <option value="O" <?= $user['sex'] == '0' ? 'selected=true' : null ?>>Otro</option>
              </select>
            </div>
            <div class="col-md-3 mb-3">
              <label for="birthday_input" class="form-label">Fecha de nacimiento</label>
              <input type="date" class="form-control optional" id="birthday_input" name="birthday" value="<?= set_value('birthday', $user['birthday']); ?>">
            </div>
            <div class="col-md-3 mb-3">
              <label for="input_phone" class="form-label">Teléfono celular<span class="text-danger">*</span></label>
              <div class="input-group">
                <span class="input-group-text">+56 9</span>
                <input type="text" class="form-control" id="input_phone" name="phone" aria-describedby="" value="<?= set_value('phone', $user['user_phone']); ?>" maxlength="8">
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="input_fix_phone" class="form-label">Teléfono fijo</label>
              <i class="fa-solid fa-phone icon-input"></i>
              <input type="text" class="form-control optional" id="input_fix_phone" name="fix_phone" aria-describedby="" value="<?= set_value('fix_phone', $user['fix_phone']); ?>" maxlength="10">
            </div>
            <div class="col-md-3 mb-3">
              <label for="sector_select" class="form-label">Sector</label>
              <select class="form-select" id="sector_select" name="sector" aria-label="Default select example">
                <option value="urbano" <?= $user['sector'] == 'urbano' ? 'selected=true' : null ?>>Urbano</option>
                <option value="rural" <?= $user['sector'] == 'rural' ? 'selected=true' : null ?>>Rural</option>
              </select>
            </div>
            <div class="col-md-9 mb-3">
              <label for="input_address" class="form-label">Dirección<span class="text-danger">*</span></label>
              <i class="fa-solid fa-location-dot icon-input"></i>
              <input type="text" class="form-control" id="input_address" name="address" aria-describedby="" value="<?= set_value('address', $user['user_address']); ?>">
            </div>
            <div class="col-md-6 mb-3">
              <label for="input_email" class="form-label">Correo electrónico<span class="text-danger">*</span></label>
              <span class="fas fa-envelope icon-input"></span>
              <input type="email" class="form-control" id="input_email" name="email" aria-describedby="" value="<?= $user['user_email']; ?>" readonly>
            </div>
            <div class="col-md-6 mb-3">
              <label for="input_optional_email" class="form-label">Correo opcional</label>
              <span class="fas fa-envelope icon-input"></span>
              <input type="email" class="form-control optional" id="input_optional_email" name="optional_email" aria-describedby="" value="<?= $user['optional_email']; ?>">
            </div>

            <div class="col-md-4 mb-3">
              <label for="native_group_select" class="form-label">Pueblo originario</label>
              <select class="form-select" id="native_group_select" name="id_native">
                <option value="0">No</option>
                <?= native_group(set_value('id_native', $user['id_native'])); ?>
              </select>
            </div>
            <div class="col-md-8 mb-3">
              <label for="input_agrupation" class="form-label">Agrupación</label>
                <input type="text" class="form-control optional" id="input_agrupation" name="agrupation" aria-describedby="" value="<?= set_value('agrupation', $user['agrupation']); ?>">
                <small class="form-text">*De no pertenecer a alguna, dejar el campo vacio.</small>
              </div>

            <div class="col-md-4 mb-3">
              <label for="input_name" class="form-label">Banco<span class="text-danger">*</span></label>
              <select class="form-select" aria-label="" name="bank_name" autocomplete="off">
                <?= bancos($user['user_bank_name']); ?>
              </select>
            </div>
            <div class="col-md-4 mb-3">
              <label for="input_type" class="form-label">Cuenta<span class="text-danger">*</span></label>
              <select class="form-select" aria-label="" name="type" autocomplete="off">
                <?= cuentas($user['type']); ?>
              </select>
            </div>
            <div class="col-md-4 mb-3">
              <label for="input_number" class="form-label">Número cuenta<span class="text-danger">*</span></label>
              <i class="fa-solid fa-address-card icon-input"></i>
              <input type="text" class="form-control" id="input_number" name="number" value="<?= set_value('number', $user['number']) ?>">
            </div>
            <div class="row">
              <small>
                <p class="text-end text-danger"><b>*</b>Obligatorio</p>
              </small>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php

    for ($i = 0; $i < count($formulario); $i++) {
      echo '<div class="row">
            <div class="card p-0 mb-3 ' . ($formulario[$i]->titulo == '' ? 'd-none' : null) . '">
              <div class="card-header pt-3">
              <h5>
                <i class="fas fa-pen-square"></i> ' . $formulario[$i]->titulo . '
              </h5>
              </div>
              <div class="card-body">';

      if (isset($formulario[$i]->datos) && $formulario[$i]->datos != '') {
        echo '<div class="row">';
        $count = 0;
        foreach ($formulario[$i]->datos as $key) {

          echo '<div class="mb-3 col-md-6">
                <label for="input_datos_' . $count . '" class="form-label mb-1">' . ($count + 1) . '.- ' . $key->pregunta . '
                  <i class="fa-solid fa-circle-question help_icon" data-bs-toggle="popover"  data-bs-custom-class="custom_popover" data-bs-trigger="hover focus" data-bs-html="true" data-bs-content="<b>Ejemplo</b>. ' . $key->ejemplo . '"></i>
                </label>
                <input type="text" class="form-control" id="input_datos_' . $count . '" name="data[0][' . $count . ']" value="' . ($answers[0][$count] ?? null) . '">
              </div>';
          $count++;
        }
        echo '</div>';
      } //datos (nombre proyecto)
    
      if (isset($formulario[$i]->cuestionario)) {
        echo '<div class="row">';
        $count = 0; //contador numero formulario
        $aux = 0; //contador numero archivo por orden de respuesta
        foreach ($formulario[$i]->cuestionario as $key) {

          if (isset($key->pregunta)) {

            echo '<div class="mb-4">
                <label for="textarea_cuestionario_' . $count . '" class="form-label label_questions">
                ' . ($count + 1) . '.- ' . $key->pregunta . '
                  <i tabindex=0 class="fa-solid fa-circle-question help_icon" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-custom-class="custom_popover" data-bs-html="true" data-bs-content="<b>Considere las siguientes preguntas orientadoras.</b> ' . $key->ejemplo . '"></i>
                  <span class="letter_count">3000</span>
                </label>
                <textarea class="form-control mb-3 textarea_cuestionario" id="textarea_cuestionario_' . $count . '" rows="5" data-limit=3000 name="data[1][' . $count . ']">' . set_value('data[1]['.$count.']', $answers[1][$count] ?? null ) . '</textarea>
              </div>';

          }
          if (isset($key->tabla)) {

            $jt = json_decode($answers[1][$count] ?? '');

            echo '<div class="mb-4">
                  <label for="textarea_cuestionario_' . $count . '" class="form-label label_questions">
                  ' . ($count + 1) . '.- ' . $key->tabla . '
                    <i tabindex=0 class="fa-solid fa-circle-question help_icon" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-custom-class="custom_popover" data-bs-html="true" data-bs-content="<b>Ejemplo.</b> ' . $key->ejemplo . '"></i>
                  </label>
                  <div class="table-responsive">
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

            for ($k = 1; $k < 11; $k++) {
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
            </div>
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
                            <a href="' . base_url('public/files/usuarios') . '/' . session()->get('rut') . '/' . $survey_id . '/' . ($file_list[1][$aux] ?? null) . '?v=' . rand(0, 50) . '" class="btn btn-outline-success z_index_0" target="_blank" type="button" data-bs-tooltip="true" data-bs-placement="top" title="Ver/Descargar"><i class="fa-solid fa-eye"></i></a>
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
      } //cuestionario
    
      if (isset($formulario[$i]->archivos)) {
        echo '<div class="row">';
        $count = 0;
        foreach ($formulario[$i]->archivos as $key) {
          echo '<div class="mb-3 col-md-12">
                <label for="formFile" class="form-label mb-0">' . ($count + 1) . '.- ' . $key . '</label>
                <small class="form-text mt-0 mb-2 fw-light f-small d-block"> (Tamaño máximo 20 mb. Formatos permitidos .jpeg, .jpg, .png, .pdf, .doc, .xls, .docx, .xslx, .odt, y .odf)</small>
                  <div class="row ' . (!isset($file_list[2][$count]) ? 'd-none' : null) . '" id="uploadedFile">
                  <div class="col-md-12">
                    <div class="input-group w-50">
                      <input type="text" class="form-control" value="DOCUMENTO NECESARIO #' . ($count + 1) . '" aria-label="" readonly>
                      <a href="' . base_url('public/files/usuarios') . '/' . session()->get('rut') . '/' . $survey_id . '/' . ($file_list[2][$count] ?? null) . '?v=' . rand(0, 50) . '" target="_blank" class="btn btn-outline-success z_index_0" type="button" data-bs-tooltip="true" data-bs-placement="top" title="Ver/Descargar"><i class="fa-solid fa-eye"></i></a>
                      <button class="btn btn-outline-danger z_index_0" id="delete_file" type="button" value="' . ($file_list[2][$count] ?? null) . '" data-bs-tooltip="true" data-bs-placement="top" title="Eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                      </button>
                    </div>
                  </div>
                </div>
              <input class="form-control w-50 ' . (isset($file_list[2][$count]) ? 'd-none' : null) . ($count+1 == 3 ? 'optional':'').'" type="file" id="formFile" name="file[]">
              <div class="feedback text-start mb-3"></div>
            </div>';
          $count++;
        }
        echo '</div>';
      } //archivos
    
      echo '</div>
      </div>
    </div>';

    } //formulario
    

    if (isset($validation)) {
      echo '<div class="col-12 mb-3">' . $validation->listErrors('custom') . '</div>';
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
  $(document).ready(function () {

    //cuando boton send form aparece en pantalla, boton guardar vuelve a su posicion
    var observer = new IntersectionObserver(function (entries) {
      var btn = $('#save_form');
      if (entries[0].isIntersecting === true) {
        btn.removeClass('always_show');
      } else {
        btn.addClass('always_show');
      }
      //console.log('Element is fully visible in screen')
    }, { threshold: [0.5] });
    observer.observe(document.querySelector("#send_form"))
  });

  $(".allownumeric").on("keypress keyup blur", function (event) {
    $(this).val($(this).val().replace(/[^\d].+/, ""));
    if ((event.which < 48 || event.which > 57)) {
      event.preventDefault();
    }
  });

  //limita la cantidad de caracteres ingresados en la tabla
  const tds = document.querySelectorAll('td[contenteditable="true"]');

  tds.forEach(td => {
    td.addEventListener('keypress', event => {
      const maxLength = 500;
      const currentLength = td.innerText.length;
      if (currentLength >= maxLength) {
        event.preventDefault();
      }
    });
  });


  /*calculo del total
  const total = document.querySelector('#cotizacion tr:last-child td:nth-last-child(2)');
  const valores = document.querySelectorAll('#cotizacion tr:not(:last-child) td:nth-of-type(4)');
  var totalPrice = 0;

  valores.forEach(valor => {
    indPrice = (valor.innerText.trim() != "") ? valor.innerText : 0;
    indPrice = parseInt(indPrice);
    totalPrice = totalPrice + indPrice;
  });
  total.innerText = totalPrice;
  */

</script>