<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<div class="container">
	<!-- <div class="row">
		<div class="col-sm-6 offset-sm-3"> -->

	<div class="card my-5 border-0 shadow rounded-5 overflow-hidden">
		<h1 class="card-title text-center my-3 fw-bold fs-1"><?= lang('Auth.loginTitle') ?></h1>
		<div class="card-body mx-3">

			<?= view('Myth\Auth\Views\_message_block') ?>

			<form action="<?= url_to('login') ?>" method="post">
				<?= csrf_field() ?>

				<?php if ($config->validFields === ['email']) : ?>
					<div class="form-group ">
						<label for="login"><?= lang('Auth.email') ?></label>
						<input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" value="<?= old('login'); ?>" placeholder="<?= lang('Auth.email') ?>">
						<div class="invalid-feedback">
							<?= session('errors.login') ?>
						</div>
					</div>
				<?php else : ?>
					<div class="form-group">
						<label for="login"><?= lang('Auth.emailOrUsername') ?></label>
						<input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
						<div class="invalid-feedback">
							<?= session('errors.login') ?>
						</div>
					</div>
				<?php endif; ?>

				<div class="form-group">
					<label for="password"><?= lang('Auth.password') ?></label>
					<input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" value="<?= old('password'); ?>" placeholder="<?= lang('Auth.password') ?>">
					<div class="invalid-feedback">
						<?= session('errors.password') ?>
					</div>
				</div>

				<div class="d-flex flex-row justify-content-between">
					<div class="">
						<?php if ($config->allowRemembering) : ?>
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
									<?= lang('Auth.rememberMe') ?>
								</label>
							</div>
						<?php endif; ?>
					</div>
					<div class="">
						<?php if ($config->activeResetter) : ?>
							<p><a href="<?= url_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a></p>
						<?php endif; ?>
					</div>
				</div>


				<div class="d-grid mb-2">
					<button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.loginAction') ?></button>
				</div>
		</div>

		</form>

		<hr class="mx-4">
		<div class="d-flex justify-content-center">
			<?php if ($config->allowRegistration) : ?>
				<p><a href="<?= url_to('register') ?>"><?= lang('Auth.needAnAccount') ?></a></p>
			<?php endif; ?>
		</div>
	</div>
</div>
<!-- 
		</div>
	</div> -->
</div>

<?= $this->endSection() ?>