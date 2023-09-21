<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<div class="container">
	<!-- <div class="row">
		<div class="col-sm-6 offset-sm-3"> -->

	<!-- comment -->

	<div class="card my-0 border-0 shadow-lg rounded-5 overflow-hidden" style="height: 500px;">
		<div class="row h-100">
			<div class="col d-flex">
				<img class="flex-fill" src="<?= base_url('assets/images/image_login.png'); ?>" alt="" style="height: 100%; width: 100%; object-fit: cover;">
			</div>
			<div class="col mb-3">
				<h1 class="card-title text-center my-3 fw-bold fs-1 text-green"><?= lang('Auth.loginTitle') ?></h1>
				<div class="card-body ps-0 overflow-auto" style="height: 58%; width: 100%;">

					<?= view('App\Views\Auth\_message_block') ?>

					<form action="<?= url_to('login') ?>" method="post">
						<?= csrf_field() ?>


						<div class="form-group mb-3">
							<label for="login"><?= lang('Auth.email') ?></label>
							<input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" value="<?= old('login'); ?>" placeholder="<?= lang('Auth.email') ?>">
							<!-- <div class="invalid-feedback"> -->

							<?= session('errors.login') ?>
							<!-- </div> -->
						</div>
						<div class="form-group mb-3">
							<label for="login"><?= lang('Auth.email') ?></label>
							<input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" value="<?= old('login'); ?>" placeholder="<?= lang('Auth.email') ?>">
							<!-- <div class="invalid-feedback"> -->

							<?= session('errors.login') ?>
							<!-- </div> -->
						</div>
						<div class="form-group mb-3">
							<label for="login"><?= lang('Auth.email') ?></label>
							<input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" value="<?= old('login'); ?>" placeholder="<?= lang('Auth.email') ?>">
							<!-- <div class="invalid-feedback"> -->

							<?= session('errors.login') ?>
							<!-- </div> -->
						</div>
						<div class="form-group mb-3">
							<label for="login"><?= lang('Auth.email') ?></label>
							<input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" value="<?= old('login'); ?>" placeholder="<?= lang('Auth.email') ?>">
							<!-- <div class="invalid-feedback"> -->

							<?= session('errors.login') ?>
							<!-- </div> -->
						</div>


						<div class="form-group mb-3">
							<label for="password"><?= lang('Auth.password') ?></label>
							<div class="input-group input-group-flat">
								<input id="password_login" type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" value="<?= old('password'); ?>" placeholder="<?= lang('Auth.password') ?>">
								<span class="input-group-text">
									<a class="link-secondary" data-bs-toggle="tooltip" aria-label="Show password" data-bs-original-title="Show password" onclick="if (password_login.type == 'text') password_login.type = 'password';
else password_login.type = 'text';">
										<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
											<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
											<circle cx="12" cy="12" r="2"></circle>
											<path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path>
										</svg>
									</a>
								</span>
							</div>
							<div class="invalid-feedback">
								<?= session('errors.password') ?>
							</div>
						</div>


				</div>


				<hr class="mx-4 my-1">


				<div class="d-flex flex-row justify-content-between">
					<div class="" style="font-size: 0.8rem;">
						<?php if ($config->allowRemembering) : ?>
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
									<?= lang('Auth.rememberMe') ?>
								</label>
							</div>
						<?php endif; ?>
					</div>
					<div class="" style="font-size: 0.8rem;">
						<?php if ($config->activeResetter) : ?>
							<p><a href="<?= url_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a></p>
						<?php endif; ?>
					</div>
				</div>


				<div class="d-grid mb-2">
					<button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.loginAction') ?></button>
				</div>
				<div class="d-flex justify-content-center">
					<?php if ($config->allowRegistration) : ?>
						<p><a href="<?= url_to('register') ?>"><?= lang('Auth.needAnAccount') ?></a></p>
					<?php endif; ?>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- 
		</div>
	</div> -->
</div>

<?= $this->endSection() ?>