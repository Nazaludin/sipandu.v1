<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<div class="container">
    <!-- <div class="row">
        <div class="col-sm-6 offset-sm-3"> -->

    <div class="card my-5 border-0 shadow rounded-5 overflow-hidden">
        <h1 class="card-title text-center my-3 fw-bold fs-1"><?= lang('Auth.register') ?></h1>
        <div class="card-body mx-3">

            <?= view('Myth\Auth\Views\_message_block') ?>

            <form action="<?= url_to('register') ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="email"><?= lang('Auth.email') ?></label>
                    <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                    <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
                </div>

                <div class="form-group">
                    <label for="username"><?= lang('Auth.username') ?></label>
                    <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
                </div>

                <div class="form-group">
                    <label for="password"><?= lang('Auth.password') ?></label>
                    <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                    <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="telepon"><?= lang('Auth.telepon') ?></label>
                    <input type="text" name="telepon" class="form-control <?php if (session('errors.telepon')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.telepon') ?>" autocomplete="off">
                </div>

                <br>
                <div class="d-grid mb-2">
                    <button type="submit" class="btn btn-success text-light fw-bold btn-block"><?= lang('Auth.register') ?></button>
                </div>
            </form>


            <hr class="mx-4">
            <div class="d-flex justify-content-center">
                <p><?= lang('Auth.alreadyRegistered') ?> <a class="text-success fw-bold" href="<?= url_to('login') ?>"><?= lang('Auth.signIn') ?></a></p>
            </div>

        </div>
    </div>
    <!-- 
        </div>
    </div> -->
</div>

<?= $this->endSection() ?>