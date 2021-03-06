<div id="authentication" class="bg-primary bg-gradient">
	<div id="authentication_content" class="my-5">
    <main role="main">
    	<div class="container">
    		<div class="row justify-content-center">

					<div class="col-md-12 bg-light py-4 px-4 rounded">
						<div class="d-flex align-items-start">
						  <div class="nav flex-column nav-pills col-md-3 pe-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">

						    <button class="nav-link mb-3" id="v-pills-user-tab" data-bs-toggle="pill" data-bs-target="#v-pills-user" type="button" role="tab" aria-controls="v-pills-user" aria-selected="true">Perfil</button>
								<button class="nav-link mb-3" id="v-pills-bank-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bank" type="button" role="tab" aria-controls="v-pills-bank" aria-selected="false">Cuenta Bancaria</button>
								<!--
								<button class="nav-link mb-3" id="v-pills-business-tab" data-bs-toggle="pill" data-bs-target="#v-pills-business" type="button" role="tab" aria-controls="v-pills-business" aria-selected="false">Empresa*</button>
								-->
								<button class="nav-link mb-3" id="v-pills-surveys-tab" data-bs-toggle="pill" data-bs-target="#v-pills-surveys" type="button" role="tab" aria-controls="v-pills-surveys" aria-selected="false"><b>Mis Postulaciones</b></button>

						  </div>
						  <div class="tab-content col-md-9" id="v-pills-tabContent">
						    <div class="tab-pane fade" id="v-pills-user" role="tabpanel" aria-labelledby="v-pills-user-tab">

									<div class="col-md-12">
				    				<div class="card">
				    					<div class="card-body">
				    						<h2 class="card-title">Perfil</h2>
				    						<hr>
				    						<form class="" action="<?= base_url('users/profile');?>" method="post">
				                  <div class="row mb-3">
				                    <div class="col-md-4 mb-3">
				                      <label for="input_name" class="form-label">Nombre<span class="text-danger">*</span></label>
				    									<span class="fas fa-user icon-input"></span>
				                      <input type="text" class="form-control" id="input_name" name="name" value="<?= set_value('name',$user['user_name']);?>">
				                    </div>
				                    <div class="col-md-5 mb-3">
				                      <label for="input_lastname" class="form-label">Apellidos<span class="text-danger">*</span></label>
				    									<span class="fas fa-user-friends icon-input"></span>
				                      <input type="text" class="form-control" id="input_lastname" name="lastname" value="<?= set_value('lastname',$user['user_lastname']);?>">
				                    </div>
														<div class="col-md-3 mb-3">
				                      <label for="input_rut" class="form-label">RUT<span class="text-danger">*</span></label>
				    									<i class="fa-solid fa-address-card icon-input"></i>
				                      <input type="text" class="form-control" id="input_rut" name="rut" value="<?= $user['user_rut']; ?>" readonly>
				                    </div>
														<div class="col-md-4 mb-3">
															<label for="sex_select" class="form-label">Sexo</label>
															<select class="form-select" id="sex_select" name="sex" aria-label="Default select example">
																<option value="" <?= $user['sex'] == '' ? 'selected=true' : null ?> selected>No informar</option>
																<option value="F" <?= $user['sex'] == 'F' ? 'selected=true' : null ?>>Femenino</option>
																<option value="M" <?= $user['sex'] == 'M' ? 'selected=true' : null ?>>Masculino</option>
																<option value="O" <?= $user['sex'] == '0' ? 'selected=true' : null ?>>Otro</option>
															</select>
														</div>
														<div class="col-md-4 mb-3">
															<label for="birthday_input" class="form-label">Fecha de nacimiento</label>
															<input type="date" class="form-control" id="birthday_input" name="birthday" value="<?= set_value('birthday', $user['birthday']);?>">
														</div>
														<div class="col-md-4 mb-3">
															<label for="input_phone" class="form-label">Tel??fono celular<span class="text-danger">*</span></label>
															<div class="input-group">
																<span class="input-group-text">+56 9</span>
						    								<input type="text" class="form-control" id="input_phone" name="phone" aria-describedby="" value="<?= set_value('phone',$user['user_phone']);?>" maxlength="8">
															</div>
					    							</div>
														<div class="col-md-4 mb-3">
															<label for="input_fix_phone" class="form-label">Tel??fono fijo</label>
															<i class="fa-solid fa-phone icon-input"></i>
						    							<input type="text" class="form-control" id="input_fix_phone" name="fix_phone" aria-describedby="" value="<?= set_value('fix_phone',$user['fix_phone']);?>" maxlength="10">
					    							</div>

														<div class="col-md-8 mb-3">
					    								<label for="input_address" class="form-label">Direcci??n<span class="text-danger">*</span></label>
					    								<i class="fa-solid fa-location-dot icon-input"></i>
					    								<input type="text" class="form-control" id="input_address" name="address" aria-describedby="" value="<?= set_value('address',$user['user_address']);?>" >
					    							</div>

														<div class="col-md-6 mb-3">
					    								<label for="input_email" class="form-label">Correo electr??nico<span class="text-danger">*</span></label>
					    								<span class="fas fa-envelope icon-input"></span>
					    								<input type="email" class="form-control" id="input_email" name="email" aria-describedby="" value="<?= $user['user_email']; ?>" readonly>
					    							</div>
														<div class="col-md-6 mb-3">
					    								<label for="input_optional_email" class="form-label">Correo opcional</label>
					    								<span class="fas fa-envelope icon-input"></span>
					    								<input type="email" class="form-control" id="input_optional_email" name="optional_email" aria-describedby="" value="<?= $user['optional_email']; ?>">
					    							</div>
														<div class="row">
															<small><p class="text-end text-danger"><b>*</b>Obligatorio</p></small>
														</div>



														<div class="col-12 mb-3 text-start">
															<a class="text-decoration-none" href="" data-bs-toggle="modal" data-bs-target="#edit_pass_modal">Deseo cambiar mi contrase??a</a>
														</div>

													</div><!-- end row -->

				                  <?php if(isset($validation)): ?>
				                    <div class="col-12 error_list">
				                      <div class="alert alert-danger" role="alert">
				                        <?= $validation->listErrors() ?>
				                      </div>
				                    </div>
				                  <?php endif ?>

				    							<button type="submit" value="user" name="submit_form" class="btn btn-primary mt-0 w-100 submit_something"><i class="fas fa-edit"></i> Actualizar</button>
				    						</form>
				    					</div>
				    				</div>
				    			</div>
								</div> <!-- /end user -->

								<!--
						    <div class="tab-pane fade" id="v-pills-business" role="tabpanel" aria-labelledby="v-pills-business-tab">
									<div class="col-md-12">
				    				<div class="card">
				    					<div class="card-body">
				    						<h2 class="card-title">Empresa</h2>
				    						<hr>
												<div class="alert alert-warning" role="alert">
													<p>*ESTOS DATOS NO SON OBLIGATORIOS. Pero de querer postular en un concurso asociado a empresas, estos datos ser??n solicitados. </p>
													<input class="form-check-input border-secondary" type="checkbox" value="" id="business_check" <?= ($user['status'] == '1' ? 'checked disabled' : null) ?> onclick="Check()" autocomplete="off">
												  <label class="form-check-label" for="business_check">
												    <b>DESEO INGRESAR MI EMPRESA</b>
												  </label>
												</div>
				    						<form id="business_form" class="" action="<?= base_url('users/profile');?>" method="post">
													<input type="hidden" name="business_id" value="<?= $user['user_business_id'] ?? null ?>">
				                  <div class="row mb-3">
				                    <div class="col-md-12 mb-3">
				                      <label for="input_name" class="form-label">Nombre negocio</label>
				    									<i class="fa-solid fa-building icon-input	"></i>
				                      <input type="text" class="form-control" id="input_name" name="business_name" value="<?= set_value('business_name',$user['business_name']);?>">
				                    </div>
														<div class="col-md-4 mb-3">
				                      <label for="input_rut" class="form-label">RUT</label>
				    									<i class="fa-solid fa-address-card icon-input"></i>
				                      <input type="text" class="form-control" id="input_rut" name="business_rut" oninput="checkRut(this)" value="<?= set_value('business_rut', $user['user_business_rut']); ?>">
				                    </div>
				                    <div class="col-md-8 mb-3">
				                      <label for="input_lastname" class="form-label">Direcci??n</label>
				    									<i class="fa-solid fa-location-dot icon-input"></i>
				                      <input type="text" class="form-control" id="input_address" name="business_address" value="<?= set_value('business_address',$user['user_business_address']);?>">
				                    </div>
														<div class="col-md-4 mb-3">
															<label for="input_phone" class="form-label">Telefono</label>
															<div class="input-group">
																<span class="input-group-text">+56 9</span>
						    								<input type="text" class="form-control" id="input_phone" name="business_phone" value="<?= set_value('business_phone',$user['user_business_phone']);?>" maxlength="8">
															</div>
					    							</div>
					    							<div class="col-md-8 mb-3">
					    								<label for="input_email" class="form-label">P??gina web</label>
					    								<i class="fa-brands fa-chrome icon-input"></i>
					    								<input type="url" class="form-control" id="input_webpage" name="business_webpage" placeholder="https://example.com" pattern="https://.*" value="<?= set_value('business_webpage', $user['webpage']) ?>">
					    							</div>
														<div class="col-md-6 mb-3">
					    								<label for="input_address" class="form-label">Representante legal</label>
					    								<i class="fa-solid fa-user-tie icon-input"></i>
					    								<input type="text" class="form-control" id="input_legal_representative" name="legal_representative" aria-describedby="" value="<?= set_value('legal_representative',$user['legal_representative']);?>" >
					    							</div>
														<div class="col-md-6 mb-3">
					    								<label for="input_address" class="form-label">Posicion representante</label>
					    								<i class="fa-solid fa-briefcase icon-input"></i>
					    								<input type="text" class="form-control" id="input_position_representative" name="position_representative" aria-describedby="" value="<?= set_value('position_representative',$user['position_representative']);?>" >
					    							</div>
													</div>

													<?php if(isset($validation)): ?>
														<div class="col-12 mb-3 error_list">
															<?= $validation->listErrors('custom') ?>
														</div>
													<?php endif ?>

													<div class="row">
														<div class="col-md-6">
																<a href="<?= base_url('users/delete_business?id='.$user['user_business_id']); ?>" class="btn btn-danger mt-5 w-100 submit_something"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
														</div>
														<div class="col-md-6">
																<button type="submit" value="business" name="submit_form" class="btn btn-primary mt-5 w-100 submit_something"><i class="fas fa-edit"></i> Actualizar</button>
														</div>
													</div>

				    						</form>
				    					</div>
				    				</div>
				    			</div>

								</div> /end business -->

								<div class="tab-pane fade" id="v-pills-bank" role="tabpanel" aria-labelledby="v-pills-bank-tab">
									<div class="col-md-12">
				    				<div class="card">
				    					<div class="card-body">
				    						<h2 class="card-title">Cuenta Bancaria</h2>
				    						<hr>
				    						<form class="" action="<?= base_url('users/profile');?>" method="post">

													<div class="alert alert-warning" role="alert">
													  Datos basicos de cuenta bancaria en caso de ser ganador de un concurso. El premio se depositar?? en la cuenta asociada a este usuario.
													</div>
				                  <div class="row mb-3">
				                    <div class="col-6 mb-3">
				                      <label for="input_name" class="form-label">Banco</label>
															<select class="form-select" aria-label="" name="bank_name" autocomplete="off">
															  <?= bancos( $user['user_bank_name'] ); ?>
															</select>
				                    </div>
														<div class="col-6 mb-3">
				                      <label for="input_type" class="form-label">Cuenta</label>
															<select class="form-select" aria-label="" name="type" autocomplete="off">
															  <?= cuentas( $user['type'] ); ?>
															</select>
				                    </div>
														<div class="col-12 mb-3">
				                      <label for="input_number" class="form-label">N??mero cuenta</label>
				    									<i class="fa-solid fa-address-card icon-input"></i>
				                      <input type="text" class="form-control" id="input_number" name="number" value="<?= set_value('number', $user['number']) ?>">
				                    </div>
													</div>

				                  <?php if(isset($validation)): ?>
				                    <div class="col-12 error_list">
				                      <div class="alert alert-danger" role="alert">
				                        <?= $validation->listErrors() ?>
				                      </div>
				                    </div>
				                  <?php endif ?>

				    							<button type="submit" name="submit_form" value="bank" class="btn btn-primary mt-5 w-100 submit_something"><i class="fas fa-edit"></i> Actualizar</button>
				    						</form>
				    					</div>
				    				</div>
				    			</div>
								</div> <!-- /end bank -->

								<div class="tab-pane fade" id="v-pills-surveys" role="tabpanel" aria-labelledby="v-pills-surveys-tab">
									<div class="col-md-12">
				    				<div class="card">
				    					<div class="card-body">
				    						<h2 class="card-title">Mis Postulaciones</h2>
												<hr>
												<table class="table table-responsive align-middle mb-5">
												  <thead>
												    <tr>
												      <th scope="col">N??</th>
															<th scope="col">ID </th>
												      <th scope="col">Concurso</th>
												      <th scope="col">Ingresado</th>
												      <th scope="col">Estado</th>
															<th scope="col">Accion</th>
												    </tr>
												  </thead>
												  <tbody>
														<?php
															for ($i=0; $i < count($surveys); $i++) {
																$r_id = $surveys[$i]['results_id'];
																echo '<tr scope="row" class="'.( $r_id == 3 ? 'text-decoration-line-through' : null ).'">
																				<td>'.($i+1).'</td>
																				<td>'.$surveys[$i]['id'].'</td>
																				<td>'.$surveys[$i]['name'].'</td>
																				<td>'.$surveys[$i]['created_at'].'</td>
																				<td>'.$surveys[$i]['status'].'</td>
																				<td>
																					<div class="btn-group" role="group" aria-label="Acci??n">
																						<a href="'.base_url('home/forms?survey_id='.$surveys[$i]['surveys_id']).'" class="btn btn-primary disabled '.( $r_id != 1 && 2 ? 'disabled' : null ).'" data-bs-tooltip="true" data-bs-placement="top" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>

																						<button type="button" class="btn btn-danger disabled '.( $r_id != 1 && 2  ? 'disabled' : null ).'" data-bs-toggle="modal" data-bs-target="#delete_form_modal" data-bs-whatever="'.$surveys[$i]['id'].'" data-bs-tooltip="true" data-bs-placement="top" title="Eliminar"><i class="fa-solid fa-trash-can"></i></button>

																						<button type="button" id="form_info" class="btn btn-warning '.( $r_id != 4 ? 'disabled' : null ).' text-white" data-bs-tooltip="true" data-bs-placement="top" title="Justificaciones" value="'.$surveys[$i]['surveys_id'].'"><b>???</b></button>
																					</div>
																				</td>
																			</tr>';
															}
														 ?>
												  </tbody>
												</table>

												<div class="col-12 text-end">
													??Desea postular en alg??n concurso de Lukas para Emprender?<br>
													<a href="<?= base_url('home#how'); ?>" class="btn btn-primary mt-2">
														<i class="fa-solid fa-share-from-square"></i> Click aqui para postular!
													</A>
												</div>
											</div>
										</div>
									</div>
								</div> <!-- /end surveys -->

							</div><!-- /end tab-content -->
						</div>
					</div><!-- /end col-md-12 -->
				</div><!-- /end row -->
			</div><!-- /end container -->
    </main>
  </div><!-- /end authentication_content -->


	<!-- modal edit password -->
	<!-- Modal informacion -->
	<div class="modal fade" id="edit_pass_modal" tabindex="-1" aria-labelledby="edit_pass_modal_label" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="edit_pass_modal_label">Cambiar contrase??a</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" name="button"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-12">
							<div class="alert alert-warning" role="alert">
							  <small><i class="fa-solid fa-circle-exclamation"></i> Luego de actualizar su contrase??a, <b>se cerrar?? su sesion actual</b> y deber?? ingresar nuevamente con su contrase??a nueva.</small>
							</div>
						</div>
					</div>
					<div class="row">
						<form id="change_password_form">
							<div class="col-12">
								<div class="mb-3">
									<label for="input_old_password" class="form-label">Contrase??a actual</label>
									<span class="fas fa-unlock-alt icon-input"></span>
									<input type="password" class="form-control" name="old_password" id="input_old_password" autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" placeholder="*******">
								</div>
								<div class="mb-3">
									<label for="input_new_password" class="form-label">Nueva contrase??a</label>
									<span class="fas fa-unlock-alt icon-input"></span>
									<input type="password" class="form-control" name="new_password" id="input_new_password" autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" placeholder="*******">
								</div>
								<div class="mb-3">
									<label for="repeat_new_password" class="form-label">Confirmar nueva contrase??a</label>
									<span class="fas fa-unlock-alt icon-input"></span>
									<input type="password" class="form-control" name="repeat_new_password" id="repeat_new_password" autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" placeholder="********">
								</div>
								<div class="mb-3 error_list text-center">
									<div class="alert" role="alert" id="error_change_password">
										Todos los campos son obligatorios.
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" id="update_password" class="btn btn-primary submit_something"><i class="fa-solid fa-pen-to-square"></i> Actualizar</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">

		$(document).ready(function(){
			//check habilitar empresa
		  var status = "<?= $user['status'] ?? null; ?>";
		  if( status == '0' || status == '' ){
		    $('#business_form input').prop('disabled', true);
		  }
			Check();
		});

		function Check(){
			var checkbox = document.getElementById("business_check");
			if( checkbox.checked == true ){
				$('#business_form input').prop('disabled', false);
			}else{
				$('#business_form input').prop('disabled', true);
			}
		}
	</script>
