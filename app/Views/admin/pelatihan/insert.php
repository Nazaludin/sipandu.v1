<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Kelola
                    </div>
                    <h2 class="page-title">
                        Pelatihan
                    </h2>
                </div>

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card card-round">
                        <div class="card-body">
                            <div class="row px-3 mb-3">
                                <h4 class="card-title">Tambah Pelatihan</h4>
                                <div class="col-12">
                                    <div class="hr-text text-green">Progres</div>
                                    <div class="col-12">
                                        <div class="steps steps-counter steps-lime">
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
                                                <input type="text" class="form-control" id="floatingInputShortnameCourse" name="fullname" placeholder="Nama singkat pelatihan" required>
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
                                                <label for="floatingInputBatch">Gelombang/batch</label>
                                                <select class="custom-select" name="batch" id="floatingInputBatch" placeholder="Pilih Gelombang..." autocomplete="off" required>
                                                    <option value="">Pilih Gelombang...</option>
                                                    <?php for ($i = 1; $i <= 4; $i++) { ?>
                                                        <option value="<?= $i; ?>">Batch <?= $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
                                            <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
                                            <script>
                                                let categoryCourse = new TomSelect('#floatingInputCategoryCourse', {
                                                    hideSelected: true,
                                                    create: false,
                                                });

                                                let batchCourse = new TomSelect('#floatingInputBatch', {
                                                    hideSelected: true,
                                                    create: false,
                                                });
                                            </script>
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
                                                <label for="floatingInputPlace">Tempat Pelatihan</label>
                                                <input type="text" class="form-control" id="floatingInputPlace" name="place" placeholder="Tempat Pelatihan" value="">
                                            </div>
                                            <div class="col-2">
                                                <label for="floatingInputQuota">Kuota</label>
                                                <input type="number" class="form-control" id="floatingInputQuota" name="quota" placeholder="Kuota" value="">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label for="floatingInputContactPerson">Kontak Person</label>
                                                <input type="text" class="form-control" id="floatingInputContactPerson" name="contact_person" placeholder="Kontak Person" value="">
                                            </div>
                                            <div class="col-6 custom-file">
                                                <label for="floatingInputSchedule">Lampiran Jadwal</label>
                                                <input type="file" class="form-control custom-file-input" id="floatingInputSchedule" name="jadwal" lang="id">
                                            </div>

                                        </div>

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
                                            <div class="col-12 d-flex justify-content-end">
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