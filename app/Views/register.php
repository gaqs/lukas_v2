<div id="authentication" class="bg-primary bg-gradient">
	<div id="authentication_content" class="my-5">
		<main role="main">
		  <div class="container">
		      <div class="row justify-content-center">
		          <div class="col-lg-7">
		              <div class="card shadow-lg border-0 rounded-lg">
		                  <div class="card-header py-4">
												<h3 class="text-center font-weight-light mt-4">
													Registro
												</h3>
												<div class="text-center">
													<small>Sistema de Administración</small>
												</div>
											</div>
		                  <div class="card-body">
												<?php
												if( session()->get('success') ){
													echo '<div class="alert alert-success alert-dismissible fade show">'.session()->get('success').'<button type="button" class="btn-close text-danger" data-bs-dismiss="alert" aria-label="Close"></button></div>';
												}else if( session()->get('failure') ){
													echo '<div class="alert alert-danger alert-dismissible fade show">'.session()->get('failure').'<button type="button" class="btn-close text-danger" data-bs-dismiss="alert" aria-label="Close"></button></div>';
												}
												?>
		                      <form class="" action="<?= base_url('users/register');?>" method="post">
		                          <div class="row mb-3">
		                              <div class="col-md-6">
		                                  <div class="form-floating mb-3 mb-md-0">
		                                      <input class="form-control" id="input_name" name="name" type="text" value="<?= set_value('name');?>" placeholder="Juan Andrés" />
		                                      <label for="input_name">Nombres</label>
		                                  </div>
		                              </div>
		                              <div class="col-md-6">
		                                  <div class="form-floating">
		                                      <input class="form-control" id="input_lastname" type="text" name="lastname" value="<?= set_value('lastname');?>" placeholder="Perez Gonzales" />
		                                      <label for="input_lastname">Apellidos</label>
		                                  </div>
		                              </div>
		                          </div>
															<div class="row mb-3">
																<div class="col-md-4">
																	<div class="form-floating">
				                              <input class="form-control" id="input_rut" type="text" name="rut" value="<?= set_value('rut');?>" placeholder="111111111-1" oninput="checkRut(this)" />
				                              <label for="input_rut">RUT</label>
				                          </div>
																</div>
																<div class="col-md-8">
																	<div class="form-floating">
				                              <input class="form-control" id="input_email" type="email" name="email" value="<?= set_value('email');?>" placeholder="nombre@ejemplo.com" />
				                              <label for="input_email">Correo electrónico</label>
				                          </div>
																</div>
															</div>
		                          <div class="row mb-3">
		                              <div class="col-md-6">
		                                  <div class="form-floating mb-3 mb-md-0">
		                                      <input class="form-control" id="input_password" type="password" name="password" placeholder="********" />
		                                      <label for="input_password">Contraseña</label>
		                                  </div>
		                              </div>
		                              <div class="col-md-6">
		                                  <div class="form-floating mb-3 mb-md-0">
		                                      <input class="form-control" id="repeat_password" type="password" name="repeat_password" placeholder="Confirm password" />
		                                      <label for="repeat_password">Confirmar contraseña</label>
		                                  </div>
		                              </div>
		                          </div>
															<?php if(isset($validation)): ?>
																<div class="col-12 mb-3">
																	<?= $validation->listErrors('custom') ?>
																</div>
															<?php endif ?>
		                          <div class="mt-4 mb-0">
		                              <div class="d-grid">
																		<button type="submit" class="btn btn-primary btn-block submit_something">
																			<i class="fas fa-user-plus"></i> Registrarse
																		</button>
																	</div>
		                          </div>
		                      </form>
		                  </div>
		                  <div class="card-footer text-center py-3">
		                      <div class="small"><a href="<?= base_url('users'); ?>">Ya posees una cuenta? Logeate!</a></div>
		                  </div>
		              </div>
		          </div>
		      </div>
		  </div>
		</main>
</div><!-- /end authentication_content -->
