<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-fluid">
            <?php if (session()->has('message')) : ?>
                <div class="alert alert-important alert-success alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l5 5l10 -10"></path>
                            </svg>
                        </div>
                        <div>
                            <?= session('message') ?>
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            <?php endif ?>

            <?php if (session()->has('error')) : ?>
                <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <!-- Download SVG icon from http://tabler-icons.io/i/alert-circle -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                <path d="M12 8v4"></path>
                                <path d="M12 16h.01"></path>
                            </svg>
                        </div>
                        <div>
                            <?= session('error') ?>
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            <?php endif ?>

            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Pelatihan
                    </div>
                    <h2 class="page-title">
                        Tambah
                    </h2>
                    <ol class="breadcrumb mt-2" aria-label="breadcrumbs">
                        <li class="breadcrumb-item"><a href="<?= base_url('pelatihan'); ?>">Pelatihan</a></li>
                        <li class="breadcrumb-item active"><a href="">Tambah</a></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-fluid">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card card-round">
                        <div class="card-body">
                            <div class="row px-3 mb-3">
                                <h4 class="card-title">Tambah Pelatihan</h4>
                                <div class="col-12">
                                    <div class="hr-text text-green">Progres</div>
                                    <div class="col-12">
                                        <div class="steps steps-counter steps-primary">
                                            <span class="step-item active">
                                                Buat Pelatihan
                                            </span>
                                            <span class="step-item">
                                                Persyaratan Pelatihan
                                            </span>
                                            <span class="step-item">
                                                Status Publikasi
                                            </span>
                                        </div>
                                    </div>
                                    <!-- <hr> -->
                                </div>
                                <!-- </div> -->
                                <!-- Comment Row -->
                                <div class="row px-3">
                                    <!-- <table class="table">
                                    <tbody> -->
                                    <form action="<?= base_url('pelatihan/insert/proses'); ?>" method="post" enctype='multipart/form-data'>
                                        <?= csrf_field() ?>
                                        <div class="hr-text hr-text-left mb-3">Data Pelatihan</div>
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <label for="floatingInputFullnameCourse">Nama Lengkap Pelatihan</label>
                                                <input type="text" class="form-control" id="floatingInputFullnameCourse" name="fullname" placeholder="Nama lengkap pelatihan" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label for="floatingInputShortnameCourse">Nama Singkat Pelatihan</label>
                                                <input type="text" class="form-control" id="floatingInputShortnameCourse" name="shortname" placeholder="Nama singkat pelatihan" required>
                                            </div>
                                            <div class="col-4">
                                                <label for="floatingInputCategoryCourse">Jenis Pelatihan</label>
                                                <select class="custom-select" name="categoryid" id="floatingInputCategoryCourse" placeholder="Pilih Jenis Pelatihan..." autocomplete="off" required>
                                                    <option value="">Pilih Jenis Pelatihan...</option>
                                                    <?php foreach ($kategori_pelatihan as $kp => $valueKP) { ?>
                                                        <option value="<?= $valueKP->id; ?>"><?= $valueKP->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-2">
                                                <label for="floatingInputBatch">Angkatan/batch</label>
                                                <select class="custom-select" name="batch" id="floatingInputBatch" placeholder="Pilih Angkatan..." autocomplete="off" required>
                                                    <option value="">Pilih Gelombang...</option>
                                                    <?php for ($i = 1; $i <= 4; $i++) { ?>
                                                        <option value="<?= $i; ?>"><?= $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>


                                        </div>

                                        <!-- <div class="row">
                                            <div class="col-6">
                                                <label for="floatingInputStartCourse">Periode Pelatihan</label>
                                            </div>
                                            <div class="col-6">
                                                <label for="tanggalLahir">Periode Pendaftaran</label>
                                            </div>
                                        </div> -->

                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label for="floatingInputTargetParticipant">Sasaran Pelatihan</label>
                                                <input type="text" class="form-control" id="floatingInputTargetParticipant" name="target_participant" placeholder="Sasaran Pelatihan" value="">
                                            </div>
                                            <div class="col-4">
                                                <label for="floatingInputPlace">Tempat Pelaksanaan</label>
                                                <input type="text" class="form-control" id="floatingInputPlace" name="place" placeholder="Tempat Pelaksanaan" value="">
                                            </div>
                                            <div class="col-2">
                                                <label for="floatingInputQuota">Kuota</label>
                                                <input type="number" class="form-control" id="floatingInputQuota" name="quota" placeholder="Kuota" value="">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label for="floatingInputSourceFunds">Sumber Dana</label>
                                                <select class="custom-select" name="source_funds" id="floatingInputSourceFunds" placeholder="Pilih Sumber Dana..." autocomplete="off" required>
                                                    <option value="">Pilih Sumber Dana...</option>
                                                    <option value="APBD">APBD</option>
                                                    <option value="APBN">APBN</option>
                                                    <option value="BLUD">BLUD</option>
                                                </select>
                                            </div>
                                            <div class="col-6 custom-file">
                                                <label for="floatingInputMethod">Metode</label>
                                                <select class="custom-select" name="method" id="floatingInputMethod" placeholder="Pilih Metode..." autocomplete="off" required>
                                                    <option value="">Pilih Metode...</option>
                                                    <option value="Clasical">Clasical</option>
                                                    <option value="Blanded">Blanded</option>
                                                    <option value="Full Daring">Full Daring</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label for="floatingInputContactPerson">Kontak Person</label>
                                                <input type="text" class="form-control" id="floatingInputContactPerson" name="contact_person" placeholder="Kontak Person" value="">
                                            </div>
                                            <div class="col-6 custom-file">
                                                <label for="floatingInputSchedule">Lampiran Jadwal</label>
                                                <input type="file" class="form-control custom-file-input" id="floatingInputSchedule" name="jadwal" lang="id" accept="application/pdf">
                                            </div>

                                        </div>
                                        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
                                        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
                                        <script>
                                            var category = '<?= old('catgoryid'); ?>';
                                            var batch = '<?= old('batch'); ?>';
                                            var source_funds = '<?= old('source_funds'); ?>';
                                            var method = '<?= old('method'); ?>';

                                            let categoryCourse = new TomSelect('#floatingInputCategoryCourse', {
                                                hideSelected: true,
                                                create: false,
                                            });

                                            let batchCourse = new TomSelect('#floatingInputBatch', {
                                                hideSelected: true,
                                                create: true,
                                            });
                                            let sourceFunds = new TomSelect('#floatingInputSourceFunds', {
                                                hideSelected: true,
                                                create: false,
                                            });
                                            let methodCourse = new TomSelect('#floatingInputMethod', {
                                                hideSelected: true,
                                                create: false,
                                            });

                                            if (category !== '') {
                                                categoryCourse.setValue(category);
                                            }
                                            if (batch !== '') {
                                                batchCourse.setValue(batch);
                                            }
                                            if (source_funds !== '') {
                                                sourceFunds.setValue(source_funds);
                                            }
                                            if (method !== '') {
                                                methodCourse.setValue(method);
                                            }
                                        </script>
                                        <br>
                                        <div class="hr-text hr-text-left my-3">Waktu Pelaksanaan</div>
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <h3 class="card-title">Periode Pendaftaran</h3>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-6">
                                                                <label for="floatingInputStartRegistration">Mulai Pendaftaran</label>
                                                                <input type="date" class="form-control" id="floatingInputStartRegistration" name="start_registration" value="" required autofocus>
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="floatingInputEndRegistration">Akhir Pendaftaran</label>
                                                                <input type="date" class="form-control" id="floatingInputEndRegistration" name="end_registration" value="" required autofocus>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <h3 class="card-title">Periode Pelatihan</h3>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">

                                                            <div class="col-6">
                                                                <label for="floatingInputStartCourse">Mulai Pelatihan</label>
                                                                <input type="date" class="form-control" id="floatingInputStartCourse" name="startdate" value="" required autofocus>
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="floatingInputEndCourse">Akhir Pelatihan</label>
                                                                <input type="date" class="form-control" id="floatingInputEndCourse" name="enddate" value="" required autofocus>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="hr-text hr-text-left my-3">Detail Pelatihan</div>
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <label for="floatingInputSummary">
                                                    <h3> Ringkasan </h3>
                                                </label>
                                                <textarea class="form-control" name="summary" id="floatingInputSummary" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <br>



                                        <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/libs/tinymce/tinymce.min.js" defer></script>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                let options = {
                                                    selector: '#floatingInputSummary',
                                                    height: 300,
                                                    menubar: false,
                                                    statusbar: false,
                                                    plugins: [
                                                        'advlist autolink lists link image charmap print preview anchor',
                                                        'searchreplace visualblocks code fullscreen',
                                                        'insertdatetime media table paste code help wordcount'
                                                    ],
                                                    toolbar: 'undo redo | formatselect | ' +
                                                        'bold italic backcolor | alignleft aligncenter ' +
                                                        'alignright alignjustify | bullist numlist outdent indent | ' +
                                                        'removeformat',
                                                    content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }'
                                                }
                                                if (localStorage.getItem("tablerTheme") === 'dark') {
                                                    options.skin = 'oxide-dark';
                                                    options.content_css = 'dark';
                                                }
                                                tinyMCE.init(options);
                                            })
                                        </script>

                                        <div class="row justify-content-end">
                                            <div class="col-12 d-flex justify-content-between">
                                                <a href="<?= base_url('pelatihan'); ?>" class="btn btn-outline-primary mx-2">Batal</a>
                                                <button type="submit" class="btn btn-primary">Buat Pelatihan</button>
                                            </div>
                                        </div>

                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Recent comment and chats -->
    <!-- ============================================================== -->


</div>


<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->