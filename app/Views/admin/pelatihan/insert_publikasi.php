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
                                            <span class="step-item">
                                                Buat Pelatihan
                                            </span>
                                            <span class="step-item ">
                                                Persyaratan Pelatihan
                                            </span>
                                            <span class="step-item active">
                                                Status Publikasi
                                            </span>
                                        </div>
                                    </div>
                                    <!-- <hr> -->
                                </div>
                                <!-- </div> -->
                                <!-- Comment Row -->
                                <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
                                <div class="row px-3">
                                    <form action="<?= base_url('pelatihan/insert/publis/proses/' . $id_pelatihan); ?>" method="post">
                                        <?= csrf_field() ?>
                                        <div class="hr-text hr-text-left mb-3">Data Pelatihan</div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label class="form-check">
                                                    <input id="checkbox-persetujuan" type="checkbox" class="form-check-input" name="confirm_publish" oninvalid="this.setCustomValidity('Anda harus menyetujui persyaratan ini untuk mempublikasi.')" oninput="this.setCustomValidity('')" />
                                                    <span class="form-check-label required">
                                                        Dengan ini saya menyatakan dengan sesungguhnya bahwa semua data yang saya input adalah benar dan saya ingin membagikannya kepada pengguna Sipandu. </span>
                                                </label>
                                                <input type="hidden" name="publish" id="input-publis" value="false">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6 d-flex justify-content-start">
                                                <a href="<?= base_url('pelatihan'); ?>" class="btn btn-outline-primary">Batal</a>
                                            </div>
                                            <div class="col-6 d-flex justify-content-end">
                                                <button type="button" class="btn btn-success mx-2" onclick="$('#button-submit').click()">Simpan</button>
                                                <button type="button" class="btn btn-danger" onclick="savePublish()">Simpan & Publish</button>
                                            </div>
                                        </div>

                                        <button id="button-submit" type="submit" hidden></button>
                                    </form>

                                </div>

                                <script>
                                    function savePublish() {
                                        $('#input-publis').val('true');
                                        $('#checkbox-persetujuan').prop('required', true);
                                        $('#button-submit').click();
                                    }
                                </script>
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