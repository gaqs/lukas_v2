<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title></title>
</head>
<style>
  table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>

<body>
  <?php
  echo '<h3>[' . $user['user_id'] . '] ' . $user['user_name'] . ' ' . $user['user_lastname'] . '</h3>';

  echo '<b>Cumpleaños:</b> ' . $user['birthday'] . '
  <br><b>Sexo:</b> ' . $user['sex'] . '
  <br><b>RUT:</b> ' . $user['user_rut'] . '
  <br><b>Direccion:</b> ' . $user['user_address'] . '
  <br><b>Telefono:</b> ' . $user['user_phone'] . '
  <br><b>Telefo fijo:</b> ' . $user['fix_phone'] . '
  <br><b>Correo:</b> ' . $user['user_email'] . '
  <br><b>Correo opcional:</b> ' . $user['optional_email'] . '
  <br><b>Banco:</b> ' . $user['user_bank_name'] . '
  <br><b>Cuenta:</b> ' . $user['type'] . '
  <br><b>Numero:</b> ' . $user['number'] . '<br><br>';


  $json = json_decode($questions);
  $formulario = (array) $json->formulario;

  echo '<h3>Formulario</h3>';

  for ($i = 0; $i < count($formulario); $i++) {

    if (isset($formulario[$i]->datos) && $formulario[$i]->datos != '') {
      $count = 0;
      foreach ($formulario[$i]->datos as $key) {
        echo ($count + 1) . '<b>.- ' . $key->pregunta . '</b><br>';
        echo ($answers[0][$count] ?? null) . '<br><br>';
        $count++;
      }
    }

    if (isset($formulario[$i]->cuestionario)) {
      $count = 0; //contador numero formulario
      foreach ($formulario[$i]->cuestionario as $key) {
        if (isset($key->pregunta)) {
          echo ($count + 1) . '.- ' . $key->pregunta . '<br><b>Respuesta.</b><br>' . ($answers[1][$count] ?? null) . '<br><br>';
          $count++;
        } else if ($key->tabla) {
          echo ($count + 1) . '.- ' . $key->tabla . '<br><b>Respuesta.</b><br><br><br>';

          $jt = json_decode($answers[1][$count] ?? null);

          echo '<table border="1" width="100%">
                    <thead>
                      <tr>
                        <th>Nombre Item</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>Total</th>
                        <th>Resultados esperados</th>
                      </tr>
                    </thead>
                    <tbody>';
          $sum = 0;
          for ($k = 1; $k < 11; $k++) {
            $sum = $sum + (int)$jt[$k]->c_3;
            echo '<tr>
                    <td contenteditable="true">' . (isset($jt[$k]->c_0) ? $jt[$k]->c_0 : null) . '&nbsp;</td>
                    <td contenteditable="true" class="allownumeric">' . (isset($jt[$k]->c_1) ? $jt[$k]->c_1 : null) . '&nbsp;</td>
                    <td contenteditable="true" class="allownumeric">' . (isset($jt[$k]->c_2) ? $jt[$k]->c_2 : null) . '&nbsp;</td>
                    <td contenteditable="true" class="allownumeric">' . (isset($jt[$k]->c_3) ? $jt[$k]->c_3 : null) . '&nbsp;</td>
                    <td contenteditable="true">' . (isset($jt[$k]->c_4) ? $jt[$k]->c_4 : null) . '&nbsp;</td>
                  </tr>';

            
            
          }

          echo '<tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align=right><b>Total:</b></td>
                  <td>&nbsp;'.$sum.'</td>
                  <td>&nbsp;</td>
                </tr>
              </tbody>
            </table><br>';

          $count++;

        }

      }
    }

  }
  ?>
</body>

</html>