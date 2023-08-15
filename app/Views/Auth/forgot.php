<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<div class="container">
    <!-- <div class="row">
        <div class="col-sm-6 offset-sm-3"> -->

    <div class="card my-5 border-0 shadow rounded-5 overflow-hidden">
        <h1 class="card-title text-center my-3 fw-bold fs-1"><?= lang('Auth.forgotPassword') ?></h1>
        <div class="card-body mx-3">

            <?= view('App\Views\Auth\_message_block') ?>

            <p><?= lang('Auth.enterEmailForInstructions') ?></p>

            <form action="<?= url_to('forgot') ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="email"><?= lang('Auth.emailAddress') ?></label>
                    <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" value="<?= old('email'); ?>" placeholder="<?= lang('Auth.email') ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.email') ?>
                    </div>
                </div>

                <br>

                <div class="d-grid mb-2">
                    <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.sendInstructions') ?></button>
                </div>
            </form>

        </div>
    </div>

    <!-- </div>
    </div> -->
</div>

<?= $this->endSection() ?>