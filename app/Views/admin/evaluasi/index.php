<!-- Tom select -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tom-select/2.2.2/css/tom-select.bootstrap5.min.css" integrity="sha512-mNN7o87hQqtNCCGWxFVdlVdaKF6d4S1wVMi3+ftJYnW572YIo0KPjK1Cns5SPlyCtKGp1Nu+z26MJUNXmpbjKA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/tom-select/2.2.2/js/tom-select.complete.min.js" integrity="sha512-nSCwMPJuzxtzxg73yUXuSuLmsfecNBt+/7dimMdC7VJisuxdr7XtYoCausZOSS6V5IHUOuJ7nQMXmylVt9+jeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>
    .custom-card {
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 10px;
        margin: 10px;
        cursor: pointer;
    }


    /* .card-number {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 5px;
        border-radius: 5px;
        font-weight: bold;
    } */

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
                        <li class="breadcrumb-item active"><a>instrument</a></li>
                        <!-- <li class="breadcrumb-item"><a>Library</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#">Data</a></li> -->
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
                    <form action="<?php echo base_url('postEPP'); ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    Tentang Instrumen
                                </div>
                                <div class="col-12">
                                    <label for="floatingInputFullnameCourse">Nama Instrument</label>
                                    <input type="text" class="form-control" id="floatingInputFullnameCourse" name="name" placeholder="Nama Instrument" required="">
                                </div>
                                <div class="col-12">
                                    <label for="floatingInputFullnameCourse">ID COURSE</label>
                                    <input type="text" class="form-control" id="floatingInputFullnameCourse" name="id_course" placeholder="Nama Instrument" required="">
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
                                        <input type="date" class="form-control" id="floatingInputStartRegistration" name="start_fill" value="" required autofocus>
                                    </div>
                                    <div class="col-6">
                                        <label for="floatingInputEndRegistration">Akhir Pengisian</label>
                                        <input type="date" class="form-control" id="floatingInputEndRegistration" name="end_fill" value="" required autofocus>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="floatingInputSummary">
                                            <h3> Deskripsi </h3>
                                        </label>
                                        <textarea class="form-control" name="description" id="floatingInputSummary" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-title">Soal
                        </div>
                        <!-- Container Card Soal -->
                        <div id="cardContainer">
                            <!-- Card Soal -->
                            <div class="custom-card" onclick="toggleCard(this)">
                                <div class="row mb-1">
                                    <span class="card-number fw-bold">No. 1</span>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-8 col-md-6 col-lg-6">
                                        <div class="container-question">
                                            <input data-input-name="pertanyaan" type="text" class="form-control-plaintext fw-bold question" name="example-text-input" placeholder="Pertanyaan Tanpa Judul">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-6 col-lg-6">
                                        <!-- Tools -->
                                        <div class="question-tools">
                                            <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
                                                <select data-input-name="tipe_soal" type="text" class="form-select select-type-answer" value="">
                                                    <option value="1" data-custom-properties="<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; class=&quot;icon icon-tabler icon-tabler-list&quot; width=&quot;24&quot; height=&quot;24&quot; viewBox=&quot;0 0 24 24&quot; stroke-width=&quot;2&quot; stroke=&quot;currentColor&quot; fill=&quot;none&quot; stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot;>
                                        <path stroke=&quot;none&quot; d=&quot;M0 0h24v24H0z&quot; fill=&quot;none&quot;></path>
                                        <path d=&quot;M9 6l11 0&quot;></path>
                                        <path d=&quot;M9 12l11 0&quot;></path>
                                        <path d=&quot;M9 18l11 0&quot;></path>
                                        <path d=&quot;M5 6l0 .01&quot;></path>
                                        <path d=&quot;M5 12l0 .01&quot;></path>
                                        <path d=&quot;M5 18l0 .01&quot;></path>
                                        </svg>">
                                                        Pilihan Ganda
                                                    </option>
                                                    <option value="2" data-custom-properties="<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; class=&quot;icon icon-tabler icon-tabler-align-justified&quot; width=&quot;24&quot; height=&quot;24&quot; viewBox=&quot;0 0 24 24&quot; stroke-width=&quot;2&quot; stroke=&quot;currentColor&quot; fill=&quot;none&quot; stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot;>
                                        <path stroke=&quot;none&quot; d=&quot;M0 0h24v24H0z&quot; fill=&quot;none&quot;></path>
                                        <path d=&quot;M4 6l16 0&quot;></path>
                                        <path d=&quot;M4 12l16 0&quot;></path>
                                        <path d=&quot;M4 18l12 0&quot;></path>
                                        </svg>
                                        ">
                                                        Isian Singkat
                                                    </option>
                                                    <option value="3" data-custom-properties="<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; class=&quot;icon icon-tabler icon-tabler-text-plus&quot; width=&quot;24&quot; height=&quot;24&quot; viewBox=&quot;0 0 24 24&quot; stroke-width=&quot;2&quot; stroke=&quot;currentColor&quot; fill=&quot;none&quot; stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot;>
                                        <path stroke=&quot;none&quot; d=&quot;M0 0h24v24H0z&quot; fill=&quot;none&quot;></path>
                                        <path d=&quot;M19 10h-14&quot;></path>
                                        <path d=&quot;M5 6h14&quot;></path>
                                        <path d=&quot;M14 14h-9&quot;></path>
                                        <path d=&quot;M5 18h6&quot;></path>
                                        <path d=&quot;M18 15v6&quot;></path>
                                        <path d=&quot;M15 18h6&quot;></path>
                                        </svg>
                                        ">
                                                        Isian Panjang
                                                    </option>
                                                </select>

                                                <a onclick="triggerRemoveCard.bind(this)()" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Hapus Pertanyaan" data-bs-original-title="Hapus Pertanyaan">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z"></path>
                                                        <path d="M9 9l6 6m0 -6l-6 6"></path>
                                                    </svg>
                                                </a>
                                                <a onclick="addQuestion.bind(this)()" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Tambah Pertanyaan" data-bs-original-title="Tambah Pertanyaan">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M9 12h6"></path>
                                                        <path d="M12 9v6"></path>
                                                        <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Isian Jawaban -->
                                <div class="card-content">
                                    <!-- Pilihan Ganda -->
                                    <div class="mb-3">
                                        <div>
                                            <label class="form-check d-flex align-items-center">
                                                <input class="form-check-input radio" type="radio" name="radios">
                                                <span class="form-check-label ps-2 w-100">
                                                    <input data-input-name="opsiA" type="text" class="form-control-plaintext radio" name="example-text-input" placeholder="Isikan Opsi A" readonly>
                                                </span>
                                            </label>
                                            <label class="form-check d-flex align-items-center">
                                                <input class="form-check-input radio" type="radio" name="radios">
                                                <span class="form-check-label ps-2 w-100">
                                                    <input data-input-name="opsiB" type="text" class="form-control-plaintext radio" name="example-text-input" placeholder="Isikan Opsi B" readonly>
                                                </span>
                                            </label>
                                            <label class="form-check d-flex align-items-center">
                                                <input class="form-check-input radio" type="radio" name="radios">
                                                <span class="form-check-label ps-2 w-100">
                                                    <input data-input-name="opsiC" type="text" class="form-control-plaintext radio" name="example-text-input" placeholder="Isikan Opsi C" readonly>
                                                </span>
                                            </label>
                                            <label class="form-check d-flex align-items-center">
                                                <input class="form-check-input radio" type="radio" name="radios">
                                                <span class="form-check-label ps-2 w-100">
                                                    <input data-input-name="opsiD" type="text" class="form-control-plaintext radio" name="example-text-input" placeholder="Isikan Opsi D" readonly>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- Isian singkat -->
                                    <input data-input-name="isianSingkat" type="text" class="form-control-plaintext" name="example-text-input" placeholder="Teks jawaban singkat" readonly>
                                    <!-- Isian Panjang -->
                                    <input data-input-name="isianPanjang" type="text" class="form-control-plaintext" name="example-text-input" placeholder="Teks jawaban panjang" readonly>
                                </div>
                            </div>




                        </div>
                        <button type="submit">SUbmit</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $('.radio').on('click', function(e) {
        e.preventDefault();
    });
</script>
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

<script>
    var currentCard = null;

    // Menampilkan fitur pada card pertama saat halaman dimuat pertama kali
    // window.onload = function() {
    //     var firstCard = document.querySelector('.custom-card');
    //     toggleCard(firstCard);
    // };

    function initializeTomSelect() {
        var selectTypeAnswers = document.querySelectorAll('.select-type-answer');

        selectTypeAnswers.forEach(function(select) {
            if (window.TomSelect) {
                new TomSelect(select, {
                    copyClassesToDropdown: false,
                    dropdownParent: 'body',
                    controlInput: '<input>',
                    render: {
                        item: function(data, escape) {
                            if (data.customProperties) {
                                return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                            }
                            return '<div>' + escape(data.text) + '</div>';
                        },
                        option: function(data, escape) {
                            if (data.customProperties) {
                                return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                            }
                            return '<div>' + escape(data.text) + '</div>';
                        },
                    },
                });
            }
        });
    }

    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {
        initializeTomSelect();
        // triggerRemoveCard();
        triggerSelectTypeAnswer();
    });

    // @formatter:on
    function toggleCard(card) {
        // Menyembunyikan fitur dari card saat ini jika ada
        if (currentCard !== null) {
            currentCard.classList.remove('active');
            toggleContent(currentCard);
            updateInputStatus(currentCard);

        }


        // if (currentCard !== card) {
        card.classList.add('active');
        toggleContent(card);
        updateInputStatus(card);
        currentCard = card;
        // } else {
        //     currentCard = null;
        // }
        // Menampilkan fitur dari card yang diklik
        // card.classList.add('active');
        // updateInputStatus(card);
        // toggleContent(card);

        // Menyimpan card yang diklik sebagai card saat ini
        // currentCard = card;
    }

    function updateInputStatus(card) {
        var input = card.querySelector('.container-question .question');

        // Mengubah atribut dan kelas input sesuai dengan status card (aktif atau tidak aktif)
        if (card.classList.contains('active')) {
            input.removeAttribute('readonly');
            input.classList.remove('form-control-plaintext', 'fw-bold');
            input.classList.add('form-control');
        } else {
            input.setAttribute('readonly', 'true');
            input.classList.remove('form-control');
            input.classList.add('form-control-plaintext', 'fw-bold');
        }
    }

    function toggleContent(card) {
        var content = card.querySelector('.question-tools');
        // Menampilkan konten jika card aktif, menyembunyikan jika tidak aktif
        content.style.display = card.classList.contains('active') ? 'block' : 'none';
    }

    function addQuestion() {
        var cardContainer = document.getElementById('cardContainer');
        var newCardHTML = `
        <div class="custom-card" onclick="toggleCard(this)">
                        <div class="row mb-3">
                            <div class="col-sm-8 col-md-6 col-lg-6">
                                <div class="container-question">
                                    <input data-input-name="pertanyaan" type="text" class="form-control-plaintext fw-bold question" name="example-text-input" placeholder="Pertanyaan Tanpa Judul">
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-6 col-lg-6">
                                <!-- Tools -->
                                <div class="question-tools">
                                    <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
                                        <select data-input-name="tipe_soal" type="text" class="form-select select-type-answer" value="">
                                            <option value="1" data-custom-properties="<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; class=&quot;icon icon-tabler icon-tabler-list&quot; width=&quot;24&quot; height=&quot;24&quot; viewBox=&quot;0 0 24 24&quot; stroke-width=&quot;2&quot; stroke=&quot;currentColor&quot; fill=&quot;none&quot; stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot;>
                                        <path stroke=&quot;none&quot; d=&quot;M0 0h24v24H0z&quot; fill=&quot;none&quot;></path>
                                        <path d=&quot;M9 6l11 0&quot;></path>
                                        <path d=&quot;M9 12l11 0&quot;></path>
                                        <path d=&quot;M9 18l11 0&quot;></path>
                                        <path d=&quot;M5 6l0 .01&quot;></path>
                                        <path d=&quot;M5 12l0 .01&quot;></path>
                                        <path d=&quot;M5 18l0 .01&quot;></path>
                                        </svg>">
                                                Pilihan Ganda
                                            </option>
                                            <option value="2" data-custom-properties="<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; class=&quot;icon icon-tabler icon-tabler-align-justified&quot; width=&quot;24&quot; height=&quot;24&quot; viewBox=&quot;0 0 24 24&quot; stroke-width=&quot;2&quot; stroke=&quot;currentColor&quot; fill=&quot;none&quot; stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot;>
                                        <path stroke=&quot;none&quot; d=&quot;M0 0h24v24H0z&quot; fill=&quot;none&quot;></path>
                                        <path d=&quot;M4 6l16 0&quot;></path>
                                        <path d=&quot;M4 12l16 0&quot;></path>
                                        <path d=&quot;M4 18l12 0&quot;></path>
                                        </svg>
                                        ">
                                                Isian Singkat
                                            </option>
                                            <option value="3" data-custom-properties="<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; class=&quot;icon icon-tabler icon-tabler-text-plus&quot; width=&quot;24&quot; height=&quot;24&quot; viewBox=&quot;0 0 24 24&quot; stroke-width=&quot;2&quot; stroke=&quot;currentColor&quot; fill=&quot;none&quot; stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot;>
                                        <path stroke=&quot;none&quot; d=&quot;M0 0h24v24H0z&quot; fill=&quot;none&quot;></path>
                                        <path d=&quot;M19 10h-14&quot;></path>
                                        <path d=&quot;M5 6h14&quot;></path>
                                        <path d=&quot;M14 14h-9&quot;></path>
                                        <path d=&quot;M5 18h6&quot;></path>
                                        <path d=&quot;M18 15v6&quot;></path>
                                        <path d=&quot;M15 18h6&quot;></path>
                                        </svg>
                                        ">
                                                Isian Panjang
                                            </option>
                                        </select>

                                        <a onclick="triggerRemoveCard.bind(this)()" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Hapus Pertanyaan" data-bs-original-title="Hapus Pertanyaan">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z"></path>
                                                <path d="M9 9l6 6m0 -6l-6 6"></path>
                                            </svg>
                                        </a>
                                        <a onclick="addQuestion.bind(this)()" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Tambah Pertanyaan" data-bs-original-title="Tambah Pertanyaan">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M9 12h6"></path>
                                                <path d="M12 9v6"></path>
                                                <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Isian Jawaban -->
                        <div class="card-content">
                            <!-- Pilihan Ganda -->
                            <div class="mb-3">
                                <div>
                                    <label class="form-check d-flex align-items-center">
                                        <input class="form-check-input radio" type="radio" name="radios">
                                        <span class="form-check-label ps-2 w-100">
                                            <input data-input-name="opsiA" type="text" class="form-control-plaintext radio" name="example-text-input" placeholder="Isikan Opsi A" readonly>
                                        </span>
                                    </label>
                                    <label class="form-check d-flex align-items-center">
                                        <input class="form-check-input radio" type="radio" name="radios">
                                        <span class="form-check-label ps-2 w-100">
                                            <input data-input-name="opsiB" type="text" class="form-control-plaintext radio" name="example-text-input" placeholder="Isikan Opsi B" readonly>
                                        </span>
                                    </label>
                                    <label class="form-check d-flex align-items-center">
                                        <input class="form-check-input radio" type="radio" name="radios">
                                        <span class="form-check-label ps-2 w-100">
                                            <input data-input-name="opsiC" type="text" class="form-control-plaintext radio" name="example-text-input" placeholder="Isikan Opsi C" readonly>
                                        </span>
                                    </label>
                                    <label class="form-check d-flex align-items-center">
                                        <input class="form-check-input radio" type="radio" name="radios">
                                        <span class="form-check-label ps-2 w-100">
                                            <input data-input-name="opsiD" type="text" class="form-control-plaintext radio" name="example-text-input" placeholder="Isikan Opsi D" readonly>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <!-- Isian singkat -->
                            <input data-input-name="isianSingkat" type="text" class="form-control-plaintext" name="example-text-input" placeholder="Teks jawaban singkat" readonly>
                            <!-- Isian Panjang -->
                            <input data-input-name="isianPanjang" type="text" class="form-control-plaintext" name="example-text-input" placeholder="Teks jawaban panjang" readonly>
                        </div>
                    </div>
    `;

        // Menyembunyikan fitur dari card saat ini jika ada
        if (currentCard !== null) {
            toggleContent(currentCard);
            currentCard.classList.remove('active');
        }

        // Menambahkan card baru setelah card yang diklik
        currentCard.insertAdjacentHTML('afterend', newCardHTML);

        // Menandai card baru sebagai card aktif
        var newCard = currentCard.nextElementSibling;
        newCard.classList.add('active');

        // Menjadikan card baru sebagai card saat ini
        currentCard = newCard;
        assignCardIDs();
        // initializeTomSelect();

        // Inisialisasi TomSelect untuk elemen baru yang ditambahkan
        // var newCard = currentCard.nextElementSibling;
        var selectInNewCard = newCard.querySelector('.select-type-answer');
        if (window.TomSelect && selectInNewCard) {
            try {
                new TomSelect(selectInNewCard, {
                    copyClassesToDropdown: false,
                    dropdownParent: 'body',
                    controlInput: '<input>',
                    render: {
                        item: function(data, escape) {
                            if (data.customProperties) {
                                return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                            }
                            return '<div>' + escape(data.text) + '</div>';
                        },
                        option: function(data, escape) {
                            if (data.customProperties) {
                                return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                            }
                            return '<div>' + escape(data.text) + '</div>';
                        },
                    },
                });
            } catch (error) {
                // Tangani kesalahan jika TomSelect sudah diinisialisasi sebelumnya
                console.error("TomSelect is already initialized for this element:", error);
            }
        }


        triggerSelectTypeAnswer();
        setUniqueNames();
    }

    // document.addEventListener('DOMContentLoaded', function() {
    function triggerRemoveCard(button) {
        var card = button.closest('.custom-card');
        if (card !== null) {
            card.remove();
        }
        setUniqueNames();
    }

    var deleteButtons = document.querySelectorAll('.btn[data-bs-original-title="Hapus Pertanyaan"]');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            triggerRemoveCard(button);
        });
    });
    // });


    // function selectCard() {




    // document.addEventListener('DOMContentLoaded', function() {
    function triggerSelectTypeAnswer() {


        var selectTypeAnswers = document.querySelectorAll('.select-type-answer');

        selectTypeAnswers.forEach(function(select) {
            select.addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                var optionValue = selectedOption.value;
                var cardContentDiv = this.closest('.custom-card').querySelector('.card-content');

                if (cardContentDiv) {
                    switch (optionValue) {
                        case '1':
                            cardContentDiv.innerHTML = `
                            <div class="mb-3">
                                <div>
                                    <label class="form-check d-flex align-items-center">
                                        <input class="form-check-input radio" type="radio" name="radios">
                                        <span class="form-check-label ps-2 w-100">
                                            <input data-input-name="opsiA" type="text" class="form-control-plaintext radio" name="example-text-input" placeholder="Isikan Opsi A" readonly>
                                        </span>
                                    </label>
                                    <label class="form-check d-flex align-items-center">
                                        <input class="form-check-input radio" type="radio" name="radios">
                                        <span class="form-check-label ps-2 w-100">
                                            <input data-input-name="opsiB" type="text" class="form-control-plaintext radio" name="example-text-input" placeholder="Isikan Opsi B" readonly>
                                        </span>
                                    </label>
                                    <label class="form-check d-flex align-items-center">
                                        <input class="form-check-input radio" type="radio" name="radios">
                                        <span class="form-check-label ps-2 w-100">
                                            <input data-input-name="opsiC" type="text" class="form-control-plaintext radio" name="example-text-input" placeholder="Isikan Opsi C" readonly>
                                        </span>
                                    </label>
                                    <label class="form-check d-flex align-items-center">
                                        <input class="form-check-input radio" type="radio" name="radios">
                                        <span class="form-check-label ps-2 w-100">
                                            <input data-input-name="opsiD" type="text" class="form-control-plaintext radio" name="example-text-input" placeholder="Isikan Opsi D" readonly>
                                        </span>
                                    </label>
                                </div>
                            </div>`;
                            break;
                        case '2':
                            cardContentDiv.innerHTML = `
                            <input data-input-name="isianSingkat" type="text" class="form-control-plaintext" name="example-text-input" placeholder="Teks jawaban singkat" readonly>`;
                            break;
                        case '3':
                            cardContentDiv.innerHTML = `
                            <input data-input-name="isianPanjang" type="text" class="form-control-plaintext" name="example-text-input" placeholder="Teks jawaban panjang" readonly>`;
                            break;
                        default:
                            cardContentDiv.innerHTML = ''; // Kosongkan jika tidak ada pilihan yang cocok
                    }
                }
            });
        });

        setUniqueNames();
        // });
    }

    // }


    document.addEventListener('click', function(event) {
        var clickedElement = event.target;

        var allInputs = document.querySelectorAll('input[type="text"]');
        allInputs.forEach(function(input) {
            if (input.classList.contains('radio')) {

                if (input === clickedElement) {
                    input.classList.remove('form-control-plaintext');
                    input.classList.add('form-control');
                    input.removeAttribute('readonly');
                } else {
                    input.classList.remove('form-control');
                    input.classList.add('form-control-plaintext');
                    input.setAttribute('readonly', 'true');
                }
            }
        });
        triggerSelectTypeAnswer();
    });
</script>