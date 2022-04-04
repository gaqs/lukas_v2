<div id="authentication" class="bg-primary bg-gradient">
		<div id="authentication_content" class="my-5">
			<main role="main">
				<div class="container">
					<div class="row justify-content-center">
							<div class="col-lg-5">
									<div class="card shadow-lg border-0 rounded-lg">
											<div class="card-header py-4">
												<h3 class="text-center font-weight-light mt-4">
													Login Administrador
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
												<form action="<?= base_url('admin/login');?>" method="post">
														<div class="form-floating mb-3">
																<input class="form-control" id="input_email" type="email" name="email" value="<?= set_value('email');?>" placeholder="nombre@ejemplo.com" />
																<label for="input_email">Correo electrónico</label>
														</div>
														<div class="form-floating input-group mb-3">
																<input class="form-control" id="input_password" name="password" type="password" placeholder="*************" />
																<button class="btn btn-light rounded-end border px-3" id="toggle_button" type="button"><i id="toggle_icon" class="fa-solid fa-eye-slash"></i></button>
																<label for="input_password">Contraseña</label>
														</div>
														<div class="form-check mb-3">
																<input class="form-check-input" id="input_remember" type="checkbox" value="" />
																<label class="form-check-label" for="input_remember">Recordar contraseña</label>
														</div>
														<?php if(isset($validation)): ?>
															<div class="col-12 mb-3">
																<?= $validation->listErrors('custom') ?>
															</div>
														<?php endif ?>
														<div class="d-flex align-items-center justify-content-between mt-4 mb-0">
																<a class="small" href="<?= base_url('users/forgot'); ?>">No recuerdas tu contraseña?</a>
																<button type="submit" class="btn btn-primary"> <i class="fas fa-sign-in-alt"></i> Ingresar</button>
														</div>
												</form>
											</div>
									</div>
							</div>
					</div>
				</div>
			</main>
		</div><!-- /end authentication_content-->
		<script type="text/javascript">
			const toggle_button = document.querySelector('#toggle_button');
			const password = document.querySelector('#input_password');

			toggle_button.addEventListener('click', function (e) {
				// toggle the type attribute
				const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
				password.setAttribute('type', type);
				// toggle the eye / eye slash icon
				toggle_button.firstChild.classList.toggle('fa-eye-slash');
				toggle_button.firstChild.classList.toggle('fa-eye');
			});
		</script>
