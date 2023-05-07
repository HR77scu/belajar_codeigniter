<div class="container">

	<!-- Outer Row -->
	<div class="row justify-content-center">

		<div class="col-sm-6">

			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
					<!-- Nested Row within Card Body -->
					<div class="row">
						<!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
						<div class="col-lg-12">
							<?= $this->session->flashdata('message'); ?>
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Halaman Login</h1>
								</div>
								<form action="<?= base_url('auth/index'); ?>" method="post" class="user">
									<div class="form-group">
										<input type="text"  class="form-control form-control-user" id="email"
											name="email" aria-describedby="emailHelp"
											placeholder="Enter Email Address...">
										<?= form_error('email','<span class="badge badge-danger">','</span>'); ?>
									</div>
									<div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user"
                                        id="password" placeholder="Password">
                                        <?= form_error('password','<span class="badge badge-danger">','</span>'); ?>
									</div>
									<div class="form-group">
										<div class="custom-control custom-checkbox small">
											<input type="checkbox" name="rememberme" class="custom-control-input"
												id="customCheck">
											<label class="custom-control-label" for="customCheck">Remember
												Me</label>
										</div>
									</div>
									<button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
								</form>
								<hr>
								<!-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div> -->
								<div class="text-center">
									<a class="small" href="<?= base_url("auth/register"); ?>">Create an Account!</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>

</div>