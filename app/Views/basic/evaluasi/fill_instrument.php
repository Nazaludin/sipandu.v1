<!-- Tom select -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tom-select/2.2.2/css/tom-select.bootstrap5.min.css" integrity="sha512-mNN7o87hQqtNCCGWxFVdlVdaKF6d4S1wVMi3+ftJYnW572YIo0KPjK1Cns5SPlyCtKGp1Nu+z26MJUNXmpbjKA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/tom-select/2.2.2/js/tom-select.complete.min.js" integrity="sha512-nSCwMPJuzxtzxg73yUXuSuLmsfecNBt+/7dimMdC7VJisuxdr7XtYoCausZOSS6V5IHUOuJ7nQMXmylVt9+jeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>
    .custom-card {
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 10px;
        margin: 10px 0px;
        cursor: pointer;
    }


    .section-card {
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 10px;
        margin: 10px 0px;
        cursor: pointer;
    }

    /* .card-content {
                            display: none;
                        } */

    .active {
        background-color: #F7FCFA;
        /* Ganti warna latar yang sesuai */
    }
</style>
<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-fluid">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        EPP
                    </div>
                    <h2 class="page-title">
                        Evaluasi Pasca Pelatihan
                    </h2>
                    <ol class="breadcrumb mt-2" aria-label="breadcrumbs">
                        <li class="breadcrumb-item active"><a href="<?= base_url('epp-fill'); ?>">Pengisian Epp</a></li>
                        <li class="breadcrumb-item active"><a>Instrumen</a></li>
                    </ol>

                </div>
                <!-- Page title actions -->
                <!-- <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="<?= base_url('pelatihan/insert'); ?>" class="btn btn-primary d-none d-sm-inline-block">

                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Pelatihan Baru
                        </a>
                        <a href="" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">

                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                        </a>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo base_url('question/fill/proses'); ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <div class="row">
                                        <div class="col-6 d-flex justify-content-start">
                                            Tentang Instrumen
                                        </div>
                                        <!-- <div class="col-6 d-flex justify-content-end">
                                            <a href="<?= base_url('instrument/perview/' . $id_course); ?>" class="btn btn-outline-primary mx-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                </svg>
                                                Perview
                                            </a>
                                        </div> -->
                                    </div>

                                </div>
                                <div class="col-12 mb-3">
                                    <label for="floatingInputFullnameCourse">Nama Instrument</label>
                                    <input readonly type="text" class="form-control-plaintext" id="floatingInputFullnameCourse" name="name" placeholder="Nama Instrument" required="" value="<?= $data[0]['name']; ?>">
                                </div>
                                <div class="col-12">
                                    <!-- <label for="floatingInputFullnameCourse">ID COURSE</label> -->
                                    <input type="hidden" class="form-control-plaintext" id="floatingInputFullnameCourse" name="id_instrument" value="<?= $data[0]['id_instrument']; ?>">
                                    <input type="hidden" class="form-control-plaintext" id="floatingInputFullnameCourse" name="id_course" value="<?= $id_course; ?>">

                                </div>
                                <!-- <div class="col-12">
                                    <label for="floatingInputFullnameCourse">Nama Pelatihan</label>
                                    <select data-input-name="id_course" type="text" class="form-select select-type-answer" value="">
                                        <option value="1">
                                            Pilihan Ganda
                                        </option>
                                        <option value="2">
                                            Isian Singkat
                                        </option>
                                        <option value="3">
                                            Isian Panjang
                                        </option>
                                    </select>
                                </div> -->
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="floatingInputStartRegistration">Mulai Pengisian</label>
                                        <input readonly type="date" class="form-control-plaintext" id="floatingInputStartRegistration" name="start_fill" value="<?= $data[0]['start_fill']; ?>" required autofocus>
                                    </div>
                                    <div class="col-6">
                                        <label for="floatingInputEndRegistration">Akhir Pengisian</label>
                                        <input readonly type="date" class="form-control-plaintext" id="floatingInputEndRegistration" name="end_fill" value="<?= $data[0]['end_fill']; ?>" required autofocus>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="floatingInputDescription">
                                            <h3> Deskripsi </h3>
                                        </label>
                                        <p><?= $data[0]['description']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-title mt-4">Soal
                        </div>
                        <!-- Container Card Soal -->
                        <div id="cardContainer" class="mb-3">
                            <?php $id_section = null;
                            $id_section_before = 0; ?>
                            <?php foreach ($data as $key => $value) { ?>
                                <?php if ($id_section !== null && $id_section != $value['id_section']) { ?>
                                    <!-- Tutup div section sebelumnya jika ID section berbeda -->
                        </div> <!-- tutup div section -->
                    <?php } ?>

                    <?php if ($id_section != $value['id_section']) { ?>

                        <!-- Card Bagian -->
                        <div class="section-card mb-5" onclick="toggleSection(this)">
                            <div class="row mb-3">
                                <div class="col">
                                    <!-- <label class="form-label fw-bold">Bagian</label> -->
                                    <div class="row g-2">
                                        <div class="col">
                                            <div class="container-section">
                                                <input value="<?= $value['section']; ?>" data-input-name="bagian" type="text" class="form-control-plaintext fw-bold section the-section" name="example-text-input" placeholder="Bagian Tanpa Judul" readonly>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                        <!-- Card Soal -->
                        <div class="custom-card" onclick="toggleCard(this)">
                            <div class="row mb-1">
                                <span class="card-number fw-bold form-label required"><?= $value['number']; ?>. <?= $value['question']; ?></span>
                            </div>
                            <!-- <div class="row mb-3">
                                <div class="col">
                                    <div class="container-question">
                                        <input value="<?= $value['question']; ?>" data-input-name="pertanyaan" type="text" class="form-control-plaintext fw-bold question" name="example-text-input" placeholder="Pertanyaan Tanpa Judul" readonly>
                                    </div>
                                </div>

                            </div> -->

                            <!-- Isian Jawaban -->
                            <div class="card-content">
                                <?php if ($value['type'] == 1) { ?>
                                    <!-- Pilihan Ganda -->
                                    <div class="mb-3">
                                        <div>
                                            <label class="form-check d-flex align-items-center">
                                                <input class="form-check-input radio " required type="radio" name="<?= 'question' . $value['id_question'] . '_type' . $value['type'] . '_skor' ?>" value="1">
                                                <span class="form-check-label ps-2 w-100">
                                                    <?= $value['option_a']; ?>
                                                </span>
                                            </label>
                                            <label class="form-check d-flex align-items-center">
                                                <input class="form-check-input radio " required type="radio" name="<?= 'question' . $value['id_question'] . '_type' . $value['type'] . '_skor' ?>" value="2">
                                                <span class="form-check-label ps-2 w-100">
                                                    <?= $value['option_b']; ?>
                                                </span>
                                            </label>
                                            <label class="form-check d-flex align-items-center">
                                                <input class="form-check-input radio " required type="radio" name="<?= 'question' . $value['id_question'] . '_type' . $value['type'] . '_skor' ?>" value="3">
                                                <span class="form-check-label ps-2 w-100">
                                                    <?= $value['option_c']; ?>
                                                </span>
                                            </label>
                                            <label class="form-check d-flex align-items-center">
                                                <input class="form-check-input radio " required type="radio" name="<?= 'question' . $value['id_question'] . '_type' . $value['type'] . '_skor' ?>" value="4">
                                                <span class="form-check-label ps-2 w-100">
                                                    <?= $value['option_d']; ?>
                                                </span>
                                            </label>
                                            <label class="form-check d-flex align-items-center">
                                                <input class="form-check-input radio " required type="radio" name="<?= 'question' . $value['id_question'] . '_type' . $value['type'] . '_skor' ?>" value="5">
                                                <span class="form-check-label ps-2 w-100">
                                                    <?= $value['option_e']; ?>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                <?php } else if ($value['type'] == 2) { ?>
                                    <input type="text" class="form-control" required name="<?= 'question' . $value['id_question'] . '_type' . $value['type'] . '_answer' ?>" placeholder="Isikan jawaban singkat">
                                <?php } else { ?>
                                    <textarea class="form-control" required name="<?= 'question' . $value['id_question'] . '_type' . $value['type'] . '_answer' ?>" cols="30" rows="10" placeholder="Isikan jawaban uraian"></textarea>
                                <?php } ?>
                            </div>
                        </div>

                        <?php $id_section = $value['id_section'] ?>
                    <?php } ?>
                    <?php if ($id_section !== null) { ?>
                        </div> <!-- tutup div section terakhir -->
                    <?php } ?>


                </div>
                <!-- <div class="row mb-3">
                    <div class="col">
                        <button onclick="addSection()" type="button" class="btn btn-outline-success w-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Tambahkan Bagian
                        </button>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-6 d-flex justify-content-start">
                        <a href="<?= base_url('epp'); ?>" class="btn btn-outline-primary">Batal</a>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success mx-2">Simpan</button>
                    </div>
                </div>
                <!-- <button type="submit">Submit</button> -->
                </form>


            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
    function setUniqueNames() {
        const customCards = document.querySelectorAll('.custom-card');
        customCards.forEach((card, cardIndex) => {
            const inputs = card.querySelectorAll('input, select');
            inputs.forEach((input, inputIndex) => {
                const inputName = input.dataset.inputName;
                //     const inputType = input.getAttribute('type');
                if (inputName !== undefined) {

                    const uniqueName = `card${cardIndex+1}_input_${inputName}`;
                    console.log(uniqueName);
                    input.setAttribute('name', uniqueName);
                }
            });
        });
    }
</script>
<!-- Script ID -->
<script>
    function assignCardIDs() {
        var customCards = document.querySelectorAll('#cardContainer .custom-card');
        customCards.forEach(function(card, index) {
            card.id = 'custom-card-' + (index + 1);
            card.addEventListener('click', function() {
                toggleCard(this);
            });
        });
    }
    // document.addEventListener("DOMContentLoaded", function() {


    //     var cardContainer = document.getElementById('cardContainer');

    //     var observer = new MutationObserver(function(mutations) {
    //         mutations.forEach(function(mutation) {
    //             if (mutation.addedNodes.length > 0) {
    //                 mutation.addedNodes.forEach(function(node) {
    //                     if (node.nodeType === Node.ELEMENT_NODE && node.classList.contains('custom-card')) {
    //                         assignCardIDs();
    //                     }
    //                 });
    //             }
    //         });
    //     });

    //     var config = {
    //         childList: true,
    //         subtree: true
    //     };
    //     observer.observe(cardContainer, config);

    //     // Panggil fungsi untuk memberikan ID pada elemen saat halaman dimuat
    //     assignCardIDs();
    // });
</script>