<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-fluid">

            <?php if (session()->has('message')) : ?>
                <div class="alert alert-important alert-success alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
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

            <?php if (session()->has('errors')) {
                foreach (session('errors') as $error) { ?>
                    <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                        <div class="d-flex">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                    <path d="M12 8v4"></path>
                                    <path d="M12 16h.01"></path>
                                </svg>
                            </div>
                            <div>
                                <?= $error; ?>
                            </div>
                        </div>
                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
            <?php }
            } ?>
            <?php if (session()->has('errors.edit.profil')) {
                foreach (session('errors.edit.profil') as $error) { ?>
                    <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                        <div class="d-flex">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                    <path d="M12 8v4"></path>
                                    <path d="M12 16h.01"></path>
                                </svg>
                            </div>
                            <div>
                                <?= $error; ?>
                            </div>
                        </div>
                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
            <?php }
            } ?>
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Profil
                    </div>
                    <h2 class="page-title">
                        Ubah Foto
                    </h2>
                    <ol class="breadcrumb mt-2" aria-label="breadcrumbs">
                        <li class="breadcrumb-item "><a href="<?= base_url('profil'); ?>">Profil</a></li>
                        <li class="breadcrumb-item active"><a>Edit</a></li>
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
                    <div class="row px-3">
                        <div class="card card-round">

                            <div class="card-header">
                                <h3 class="card-title">Ubah Foto Diri</h3>
                            </div>
                            <div class="card-body">
                                <div class="card">
                                    <div class="row g-0">
                                        <div class="col-lg-4 col-md-5 col-sm-12 border-end">
                                            <div class="card-body">
                                                <!-- <h4 class="subheader"></h4> -->
                                                <h3 class="card-title text-center">Penyesuaian Foto</h3>
                                                <div id="container-display" class="list-group list-group-flush list-group-hoverable overflow-auto" style="max-height: 50rem">
                                                    <div class="d-flex justify-content-center">
                                                        <div class="row">
                                                            <div class="col">
                                                                <button class="btn btn-icon" type="button" id="move-top" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Geser Atas"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                        <path d="M12 5l0 14"></path>
                                                                        <path d="M16 9l-4 -4"></path>
                                                                        <path d="M8 9l4 -4"></path>
                                                                    </svg></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-center">
                                                        <div class="col m-auto">
                                                            <button class="btn btn-icon" type="button" id="move-left" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Geser Kiri"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M5 12l14 0"></path>
                                                                    <path d="M5 12l4 4"></path>
                                                                    <path d="M5 12l4 -4"></path>
                                                                </svg></button>
                                                        </div>
                                                        <div id="previewContainer" class="m-auto">
                                                            <img id="previewImage" src="#" alt="Preview">
                                                        </div>
                                                        <div class="col m-auto">
                                                            <button class="btn btn-icon" type="button" id="move-right" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Geser Kanan"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M5 12l14 0"></path>
                                                                    <path d="M15 16l4 -4"></path>
                                                                    <path d="M15 8l4 4"></path>
                                                                </svg></button>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 d-flex justify-content-center">
                                                        <div class="row">
                                                            <div class="col">
                                                                <button class="btn btn-icon me-2" type="button" id="move-bottom" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Geser Bawah"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                        <path d="M12 5l0 14"></path>
                                                                        <path d="M16 15l-4 4"></path>
                                                                        <path d="M8 15l4 4"></path>
                                                                    </svg></button>
                                                            </div>
                                                        </div>
                                                    </div>




                                                    <div id="cropper-toolbar" class="d-flex justify-content-center">
                                                        <button class="btn btn-primary me-2" type="button" id="crop" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Crop"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-crop" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M8 5v10a1 1 0 0 0 1 1h10"></path>
                                                                <path d="M5 8h10a1 1 0 0 1 1 1v10"></path>
                                                            </svg>Crop</button>
                                                        <button class="btn btn-icon" type="button" id="zoom-in" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Perbesar"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-zoom-in" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                                <path d="M7 10l6 0"></path>
                                                                <path d="M10 7l0 6"></path>
                                                                <path d="M21 21l-6 -6"></path>
                                                            </svg></button>
                                                        <button class="btn btn-icon me-2" type="button" id="zoom-out" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Perkecil"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-zoom-out" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                                <path d="M7 10l6 0"></path>
                                                                <path d="M21 21l-6 -6"></path>
                                                            </svg></button>
                                                        <!-- <button class="btn btn-icon" type="button" id="move-left" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Geser Kiri"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M5 12l14 0"></path>
                                                                    <path d="M5 12l4 4"></path>
                                                                    <path d="M5 12l4 -4"></path>
                                                                </svg></button>
                                                            <button class="btn btn-icon" type="button" id="move-right" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Geser Kanan"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M5 12l14 0"></path>
                                                                    <path d="M15 16l4 -4"></path>
                                                                    <path d="M15 8l4 4"></path>
                                                                </svg></button>
                                                            <button class="btn btn-icon" type="button" id="move-top" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Geser Atas"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M12 5l0 14"></path>
                                                                    <path d="M16 9l-4 -4"></path>
                                                                    <path d="M8 9l4 -4"></path>
                                                                </svg></button>
                                                            <button class="btn btn-icon me-2" type="button" id="move-bottom" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Geser Bawah"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M12 5l0 14"></path>
                                                                    <path d="M16 15l-4 4"></path>
                                                                    <path d="M8 15l4 4"></path>
                                                                </svg></button> -->
                                                        <button class="btn btn-icon" type="button" id="reset" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reset"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-reload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M19.933 13.041a8 8 0 1 1 -9.925 -8.788c3.899 -1 7.935 1.007 9.425 4.747"></path>
                                                                <path d="M20 4v5h-5"></path>
                                                            </svg></button>
                                                    </div>
                                                    <div id="recrop-toolbar" class="d-flex justify-content-center">
                                                        <button class="btn btn-primary" type="button" id="recrop" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Crop Ulang">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-frame" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M4 7l16 0"></path>
                                                                <path d="M4 17l16 0"></path>
                                                                <path d="M7 4l0 16"></path>
                                                                <path d="M17 4l0 16"></path>
                                                            </svg>Crop Ulang</button>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-lg-8 col-md-7 col-sm-12 d-flex flex-column">
                                            <form action="<?= base_url('profil/photo/edit/proses'); ?>" method="post" enctype="multipart/form-data">
                                                <input type="hidden" id="csrf" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                                <div class="card-body">
                                                    <h3 class="card-title">Unggah Foto diri</h3>
                                                    <div class="card bg-yellow-lt text-dark mb-3">
                                                        <div class="card-body m-1">
                                                            <div class="card-subheader h3 m-0 text-warning">Ketentuan :</div>
                                                            <ul>
                                                                <li>
                                                                    Foto peserta wajib menggunakan pakaian rapi dan sopan dengan atasan berwarna putih dan bawahan berwarna hitam.
                                                                </li>
                                                                <li>
                                                                    Foto harus berwarna dengan background berwarna biru dan berukuran 3 x 4.
                                                                </li>
                                                                <li>
                                                                    Foto yang diunggah harus memiliki kualitas yang baik dengan gambar yang tajam (tidak buram) dan memiliki pencahayaan yang cukup (tidak berbayang).
                                                                </li>
                                                                <li>
                                                                    Foto yang diunggah dengan mengeklik input dibawah ini dan pastikan ukuran foto yang diunggah <strong>tidak melebihi 500kb</strong>.
                                                                </li>
                                                                <li>
                                                                    Sebelum klik tombol <strong>"Simpan"</strong> peserta wajib menyesuikan foto dan klik tombol<strong>"Crop"</strong> terlebih dahulu.
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <input class="form-control" type="file" id="fileFotoInsert" name="foto" accept="image/jpg, image/jpeg">
                                                            <input type="hidden" id="cropDir" name="crop_dir">
                                                            <input type="hidden" id="cropStatus" name="isCropped" value="false">
                                                        </div>

                                                        <!-- <div>
                                                                            <button class="btn btn-primary" type="button" id="cropButton">Simpan</button>
                                                                        </div> -->
                                                    </div>

                                                    <button class="btn btn-primary mt-3 w-100" id="submit-form" type="submit">Simpan Foto</button>

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
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.css" integrity="sha512-bs9fAcCAeaDfA4A+NiShWR886eClUcBtqhipoY5DM60Y1V3BbVQlabthUBal5bq8Z8nnxxiyb1wfGX2n76N1Mw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script>
    var csrfName = '<?= csrf_token() ?>';
    var csrfHash = '<?= csrf_hash() ?>';
    const fileInput = document.getElementById('fileFotoInsert');
    const previewContainer = document.getElementById('previewContainer');

    const reCrop = document.getElementById('recrop');
    // const cropperToolbar = document.getElementById('cropper-toolbar');
    const previewImage = document.getElementById('previewImage');
    const cropButton = document.getElementById('cropButton');
    const zoomInButton = document.getElementById('zoom-in');
    const zoomOutButton = document.getElementById('zoom-out');
    const moveLeftButton = document.getElementById('move-left');
    const moveRightButton = document.getElementById('move-right');
    const moveTopButton = document.getElementById('move-top');
    const moveBottomButton = document.getElementById('move-bottom');
    const resetButton = document.getElementById('reset');

    let cropper;

    $(document).ready(function() {
        $('#submit-form').attr('style', 'visibility:hidden;');
        $('#cropper-toolbar').attr('style', 'visibility:hidden;');
        $('#recrop-toolbar').attr('style', 'visibility:hidden;');
        $('#button-selanjutnya-simpan').attr('disabled', 'true');
        $('#container-display').attr('style', 'visibility:hidden;');
    });
    fileInput.addEventListener('change', function() {
        makeCropper();
    });

    function makeCropper() {
        $('#cropper-toolbar').attr('style', 'visibility:visible;');
        $('#recrop-toolbar').attr('style', 'visibility:hidden;');
        $('#container-display').attr('style', 'visibility:visible;');
        $('#cropStatus').val('false');
        const file = fileInput.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.innerHTML = '';
                previewContainer.appendChild(previewImage);
                previewContainer.style.display = 'block';

                if (cropper) {
                    cropper.destroy();
                }

                cropper = new Cropper(previewImage, {
                    aspectRatio: 3 / 4, // Mengatur rasio aspek yang diinginkan
                    viewMode: 2,
                    // movable: false, // Disable image movement
                    zoomOnWheel: false, // Disable zoom on touch
                    cropBoxMovable: false,
                    cropBoxResizable: false,
                    // scalable: false,
                    // zoomable: false, // Mengaktifkan mode pemandangan kanvas
                    // Hentikan zoom melalui interaksi mouse
                    // zoom: function(event) {
                    //     if (event.type === 'wheel') {
                    //         event.preventDefault();

                    //     }
                    // },
                });
            };

            reader.readAsDataURL(file);
        }
    }
    // Fungsi untuk melakukan crop
    document.getElementById('crop').addEventListener('click', function() {
        if (cropper) {
            cropper.getCroppedCanvas().toBlob((blob) => {
                const formData = new FormData();

                // Pass the image file name as the third parameter if necessary.
                formData.append('croppedImage', blob /*, 'example.png' */ );
                formData.append([csrfName], csrfHash);

                // Use `jQuery.ajax` method for example
                $.ajax('<?= base_url('service/store-profil-image'); ?>', {
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success(data) {
                        console.log(data);
                        var jsonData = JSON.parse(data);
                        console.log(jsonData.temp_dir);
                        $('#button-selanjutnya-simpan').removeAttr('disabled');
                        $('#cropStatus').val('true');
                        $('#cropDir').val(jsonData.temp_dir);
                        $('#csrf').val(jsonData.csrf_name);
                        $('#cropper-toolbar').attr('style', 'visibility:hidden;');
                        $('#recrop-toolbar').attr('style', 'visibility:visible;');
                        $('#submit-form').attr('style', 'visibility:visible;');
                        previewImage.src = cropper.getCroppedCanvas().toDataURL('image/jpeg');
                        csrfHash = jsonData.csrf_name;
                        console.log('Upload success');
                        if (cropper) {
                            cropper.destroy();
                        }
                    },
                    error() {
                        console.log('Upload error');
                    },
                });
            }, 'image/jpg');
        }
    });
    reCrop.addEventListener('click', function() {
        makeCropper()
    });
    // Fungsi untuk zoom in
    zoomInButton.addEventListener('click', function() {
        if (cropper) {
            console.log(cropper, "ZOOM IN");
            cropper.zoom(0.1); // Sesuaikan angka zoom sesuai kebutuhan
        }
    });

    // Fungsi untuk zoom out
    zoomOutButton.addEventListener('click', function() {
        if (cropper) {
            cropper.zoom(-0.1); // Sesuaikan angka zoom sesuai kebutuhan
        }
    });
    // Fungsi untuk move right
    moveRightButton.addEventListener('click', function() {
        if (cropper) {
            cropper.move(-10, 0); // Pindahkan 10 piksel ke kanan
        }
    });

    // Fungsi untuk move left
    moveLeftButton.addEventListener('click', function() {
        if (cropper) {
            cropper.move(10, 0); // Pindahkan 10 piksel ke kiri
        }
    });
    // Fungsi untuk move top
    moveTopButton.addEventListener('click', function() {
        if (cropper) {
            cropper.move(0, 10); // Pindahkan 10 piksel ke atas

        }
    });

    // Fungsi untuk move bottom
    moveBottomButton.addEventListener('click', function() {
        if (cropper) {
            cropper.move(0, -10); // Pindahkan 10 piksel ke bawah
        }
    });
    // Fungsi untuk move bottom
    resetButton.addEventListener('click', function() {
        if (cropper) {
            cropper.reset();
        }
    });



    cropButton.addEventListener('click', function() {
        if (cropper) {
            cropper.getCroppedCanvas().toBlob((blob) => {
                const formData = new FormData();

                // Pass the image file name as the third parameter if necessary.
                formData.append('croppedImage', blob /*, 'example.png' */ );
                formData.append([csrfName], csrfHash);

                // Use `jQuery.ajax` method for example
                $.ajax('/service/test', {
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success(data) {
                        console.log(data);
                        $('#button-selanjutnya-simpan').removeAttr('disabled');
                        var jsonData = JSON.parse(data);
                        console.log(jsonData.temp_dir);
                        $('#cropDir').val(jsonData.temp_dir);
                        $('#csrf').val(jsonData.csrf_name);
                        console.log('Upload success');
                    },
                    error() {
                        console.log('Upload error');
                    },
                });
            }, 'image/jpg');
        }
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.js" integrity="sha512-Zt7blzhYHCLHjU0c+e4ldn5kGAbwLKTSOTERgqSNyTB50wWSI21z0q6bn/dEIuqf6HiFzKJ6cfj2osRhklb4Og==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>