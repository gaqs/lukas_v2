  <div class="card">
    <div class="card-header">
      Editar Cuestionario
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-12 mb-3">
          <label for="input_name" class="form-label">Nombre Concurso</label>
            <input type="text" class="form-control" id="input_name" name="name" value="<?= $survey['name'] ?? null; ?>" >
        </div>
        <div class="col-3 mb-3">
          <label for="start_date" clasS="form-label">Fecha inicio concurso</label>
          <input type="datetime-local" class="form-control" id="start_date" name="" value="<?= $survey['begin_date'] ?? null; ?>">
        </div>
        <div class="col-3 mb-3">
          <label for="start_date" clasS="form-label">Fecha cierre concurso</label>
          <input type="datetime-local" class="form-control" id="start_date" name="" value="<?= $survey['close_date'] ?? null; ?>">
        </div>
        <div class="col-3 mb-3">
          <label for="start_date" clasS="form-label">Fecha anuncio seleccionados</label>
          <input type="datetime-local" class="form-control" id="start_date" name="" value="<?= $survey['selected_date'] ?? null; ?>">
        </div>
        <div class="col-3 mb-3">
          <label for="start_date" clasS="form-label">Fecha anuncio ganadores</label>
          <input type="datetime-local" class="form-control" id="start_date" name="" value="<?= $survey['winners_date'] ?? null; ?>">
        </div>
        <div class="row">
          Limitaciones concurso.

        </div>
        <div class="row">
          <!-- input files -->

        </div>
      </div>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-12">
      <button type="submit" class="btn btn-primary w-100" name="button">Guardar</button>
    </div>
  </div>
