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
                    <form action="<?php echo base_url('instrument/template/edit/proses'); ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <div class="row">
                                        <div class="col-6 d-flex justify-content-start">
                                            Edit Template
                                        </div>
                                        <div class="col-6 d-flex justify-content-end">
                                            <a href="<?= base_url('instrument/template/preview/' . $data[0]['id_template']); ?>" class="btn btn-outline-primary mx-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                </svg>
                                                Perview
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12 mb-3">
                                    <label for="floatingInputFullnameCourse">Nama Template</label>
                                    <input type="text" class="form-control" id="floatingInputFullnameCourse" name="name" placeholder="Nama Template" required="" value="<?= $data[0]['name_template']; ?>">
                                </div>
                                <input type="hidden" class="form-control" name="id_template" value="<?= $data[0]['id_template']; ?>">
                                <input type="hidden" class="form-control" name="id_instrument" value="<?= $data[0]['id_instrument']; ?>">

                            </div>
                        </div>
                        <!-- <div class="card-title mt-4">Soal
                        </div> -->
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
                        <div class="section-card" onclick="toggleSection(this)">
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label fw-bold">Bagian</label>
                                    <div class="row g-2">
                                        <div class="col">
                                            <div class="container-section">
                                                <input value="<?= $value['section']; ?>" data-input-name="bagian" type="text" class="form-control-plaintext fw-bold section the-section" name="example-text-input" placeholder="Bagian Tanpa Judul">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="section-tools">
                                                <div class="form-group">
                                                    <a onclick="triggerRemoveSection(this)()" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Hapus Bagian" data-bs-original-title="Hapus Bagian">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z"></path>
                                                            <path d="M9 9l6 6m0 -6l-6 6"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                        <!-- Card Soal -->
                        <div class="custom-card" onclick="toggleCard(this)">
                            <div class="row mb-1">
                                <span class="card-number fw-bold">No. 1</span>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-8 col-md-6 col-lg-6">
                                    <div class="container-question">
                                        <input value="<?= $value['question']; ?>" data-input-name="pertanyaan" type="text" class="form-control-plaintext fw-bold question" name="example-text-input" placeholder="Pertanyaan Tanpa Judul">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-6 col-lg-6">
                                    <!-- Tools -->
                                    <div class="question-tools">
                                        <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
                                            <select data-input-name="tipe_soal" type="text" class="form-select select-type-answer" value="">
                                                <option value="1" <?php echo ($value['type'] == '1') ? 'selected' : ''; ?> data-custom-properties="<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; class=&quot;icon icon-tabler icon-tabler-list&quot; width=&quot;24&quot; height=&quot;24&quot; viewBox=&quot;0 0 24 24&quot; stroke-width=&quot;2&quot; stroke=&quot;currentColor&quot; fill=&quot;none&quot; stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot;>
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
                                                <option value="2" <?php echo ($value['type'] == '2') ? 'selected' : ''; ?> data-custom-properties="<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; class=&quot;icon icon-tabler icon-tabler-align-justified&quot; width=&quot;24&quot; height=&quot;24&quot; viewBox=&quot;0 0 24 24&quot; stroke-width=&quot;2&quot; stroke=&quot;currentColor&quot; fill=&quot;none&quot; stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot;>
                                        <path stroke=&quot;none&quot; d=&quot;M0 0h24v24H0z&quot; fill=&quot;none&quot;></path>
                                        <path d=&quot;M4 6l16 0&quot;></path>
                                        <path d=&quot;M4 12l16 0&quot;></path>
                                        <path d=&quot;M4 18l12 0&quot;></path>
                                        </svg>
                                        ">
                                                    Isian Singkat
                                                </option>
                                                <option value="3" <?php echo ($value['type'] == '3') ? 'selected' : ''; ?> data-custom-properties="<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; class=&quot;icon icon-tabler icon-tabler-text-plus&quot; width=&quot;24&quot; height=&quot;24&quot; viewBox=&quot;0 0 24 24&quot; stroke-width=&quot;2&quot; stroke=&quot;currentColor&quot; fill=&quot;none&quot; stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot;>
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
                                <?php if ($value['type'] == 1) { ?>
                                    <!-- Pilihan Ganda -->
                                    <div class="mb-3">
                                        <div>
                                            <label class="form-check d-flex align-items-center">
                                                <input class="form-check-input radio" type="radio" name="radios">
                                                <span class="form-check-label ps-2 w-100">
                                                    <input value="<?= $value['option_a']; ?>" data-input-name="opsiA" type="text" class="form-control-plaintext radio" name="example-text-input" placeholder="Isikan Opsi A" readonly>
                                                </span>
                                            </label>
                                            <label class="form-check d-flex align-items-center">
                                                <input class="form-check-input radio" type="radio" name="radios">
                                                <span class="form-check-label ps-2 w-100">
                                                    <input value="<?= $value['option_b']; ?>" data-input-name="opsiB" type="text" class="form-control-plaintext radio" name="example-text-input" placeholder="Isikan Opsi B" readonly>
                                                </span>
                                            </label>
                                            <label class="form-check d-flex align-items-center">
                                                <input class="form-check-input radio" type="radio" name="radios">
                                                <span class="form-check-label ps-2 w-100">
                                                    <input value="<?= $value['option_c']; ?>" data-input-name="opsiC" type="text" class="form-control-plaintext radio" name="example-text-input" placeholder="Isikan Opsi C" readonly>
                                                </span>
                                            </label>
                                            <label class="form-check d-flex align-items-center">
                                                <input class="form-check-input radio" type="radio" name="radios">
                                                <span class="form-check-label ps-2 w-100">
                                                    <input value="<?= $value['option_d']; ?>" data-input-name="opsiD" type="text" class="form-control-plaintext radio" name="example-text-input" placeholder="Isikan Opsi D" readonly>
                                                </span>
                                            </label>
                                            <label class="form-check d-flex align-items-center">
                                                <input class="form-check-input radio" type="radio" name="radios">
                                                <span class="form-check-label ps-2 w-100">
                                                    <input value="<?= $value['option_e']; ?>" data-input-name="opsiE" type="text" class="form-control-plaintext radio" name="example-text-input" placeholder="Isikan Opsi E" readonly>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                <?php } else if ($value['type'] == 2) { ?>
                                    <input data-input-name="isianSingkat" type="text" class="form-control-plaintext" name="example-text-input" placeholder="Teks jawaban singkat" readonly>
                                <?php } else { ?>
                                    <input data-input-name="isianPanjang" type="text" class="form-control-plaintext" name="example-text-input" placeholder="Teks jawaban panjang" readonly>
                                <?php } ?>
                            </div>
                        </div>

                        <?php $id_section = $value['id_section'] ?>
                    <?php } ?>
                    <?php if ($id_section !== null) { ?>
                        </div> <!-- tutup div section terakhir -->
                    <?php } ?>


                </div>
                <div class="row mb-3">
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
                </div>
                <div class="row">
                    <div class="col-6 d-flex justify-content-start">
                        <a href="<?= base_url('instrument/template'); ?>" class="btn btn-outline-primary">Batal</a>
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
</div>
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/libs/tinymce/tinymce.min.js" defer></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let options = {
            selector: '#floatingInputDescription',
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script>
    // Fungsi untuk mengatur toggle pada card pertanyaan
    function toggleCard(card) {
        if (currentCard !== card) {
            deactivateSection(currentSection);
            deactivateCard(currentCard);
            activateCard(card);
            currentCard = card;
        } else {
            if (!card.classList.contains('active')) {
                activateCard(card);
                currentCard = card;
            }
        }
    }

    // Fungsi untuk mengatur toggle pada bagian section
    function toggleSection(section) {
        if (currentSection !== section) {
            deactivateCard(currentCard);
            deactivateSection(currentSection);
            activateSection(section);
            currentSection = section;
        } else {
            if (!section.classList.contains('active')) {
                activateSection(section);
                currentSection = section;
            }
        }
    }

    // Fungsi untuk mengaktifkan card pertanyaan
    function activateCard(card) {
        card.classList.add('active');
        toggleContent(card);
        updateInputStatus(card);
    }

    // Fungsi untuk menonaktifkan card pertanyaan
    function deactivateCard(card) {
        if (card !== null) {
            card.classList.remove('active');
            toggleContent(card);
            updateInputStatus(card);
        }
    }

    // Fungsi untuk mengaktifkan bagian section
    function activateSection(section) {
        section.classList.add('active');
        toggleContent(section);
        updateInputStatus(section);
    }

    // Fungsi untuk menonaktifkan bagian section
    function deactivateSection(section) {
        if (section !== null) {
            section.classList.remove('active');
            toggleContent(section);
            updateInputStatus(section);
        }
    }

    // Fungsi untuk memperbarui status input
    function updateInputStatus(element) {
        var input = element.querySelector('.question, .section');

        if (element.classList.contains('active')) {
            input.removeAttribute('readonly');
            input.classList.remove('form-control-plaintext', 'fw-bold');
            input.classList.add('form-control');
        } else {
            input.setAttribute('readonly', 'true');
            input.classList.remove('form-control');
            input.classList.add('form-control-plaintext', 'fw-bold');
        }
    }

    // Fungsi untuk mengatur tampilan konten
    function toggleContent(element) {
        var content = element.querySelector('.question-tools, .section-tools');

        content.style.display = element.classList.contains('active') ? 'block' : 'none';
    }

    // Variabel global untuk menyimpan card dan section yang aktif
    var currentCard = null;
    var currentSection = null;
</script>

<script type="text/javascript">
    $('.radio').on('click', function(e) {
        e.preventDefault();
    });
</script>
<script>
    function setUniqueNames() {
        console.log('Set Unique names');
        let totalCardCount = 0;

        const sectionCards = document.querySelectorAll('.section-card');

        sectionCards.forEach((section, sectionIndex) => {
            const currentSection = section;
            const customCards = currentSection.querySelectorAll('.custom-card');
            const sectionNumber = sectionIndex + 1;
            const sectionPrefix = `section${sectionNumber}`;

            customCards.forEach((card, cardIndex) => {
                totalCardCount++;
                const inputs = card.querySelectorAll('input, select');

                inputs.forEach((input, inputIndex) => {
                    const inputName = input.dataset.inputName;
                    if (inputName !== undefined) {
                        let uniqueName = `card${totalCardCount}_${sectionPrefix}_input_${inputName}`;
                        input.setAttribute('name', uniqueName);
                    }
                });

                const cardNumbers = card.querySelectorAll('.card-number');
                cardNumbers.forEach((cardNum, cardNumIndex) => {
                    cardNum.textContent = 'No. ' + totalCardCount;
                });
            });

            const containerSection = currentSection.querySelector('.container-section');
            const bagianInput = containerSection.querySelector('input[data-input-name="bagian"]');
            if (bagianInput) {
                const uniqueName = `${sectionPrefix}_bagian`;
                bagianInput.setAttribute('name', uniqueName);
            }
        });
    }







    function findCurrentSection(sections, card) {
        let currentSection = null;

        const sectionCards = document.querySelectorAll('.section-card');
        const customCards = document.querySelectorAll('.custom-card');

        for (let i = 0; i < customCards.length; i++) {
            if (customCards[i] === card) {
                // Temukan indeks section-card yang sesuai dengan custom-card saat ini
                const sectionIndex = Math.floor(i / customCards.length * sectionCards.length);

                // Dapatkan section-card yang sesuai dengan custom-card saat ini
                currentSection = sectionCards[sectionIndex];
                break;
            }
        }

        return currentSection;
    }


    function getSectionNumber(section) {
        const sectionCards = document.querySelectorAll('.section-card');
        return Array.from(sectionCards).indexOf(section) + 1;
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
</script>
<script>
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
        setUniqueNames()
        initializeTomSelect();
        // triggerRemoveCard();
        triggerSelectTypeAnswer();
    });

    function addQuestion() {
        var cardContainer = document.getElementById('cardContainer');
        var newCardHTML = `<div class="custom-card" onclick="toggleCard(this)">
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
                                            <label class="form-check d-flex align-items-center">
                                                <input class="form-check-input radio" type="radio" name="radios">
                                                <span class="form-check-label ps-2 w-100">
                                                    <input data-input-name="opsiE" type="text" class="form-control-plaintext radio" name="example-text-input" placeholder="Isikan Opsi E" readonly>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
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

        // Inisialisasi TomSelect untuk elemen baru yang ditambahkan
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

        var deleteButtons = document.querySelectorAll('.btn[data-bs-original-title="Hapus Pertanyaan"]');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                triggerRemoveCard(button);
            });
        });
        triggerSelectTypeAnswer();
        setUniqueNames();
    }

    function triggerRemoveCard(button) {
        var card = button.closest('.custom-card');
        if (card !== null && card !== undefined) {
            card.remove();
            setUniqueNames();
        } else {
            console.error("Parent element with class '.custom-card' not found");
        }
    }

    function triggerRemoveSection(button) {
        var sectionCard = button.closest('.section-card');
        if (sectionCard !== null && sectionCard !== undefined) {
            var customCards = sectionCard.querySelectorAll('.custom-card');
            customCards.forEach(function(card) {
                card.remove();
            });
            sectionCard.remove();
            setUniqueNames(); // Mungkin perlu penyesuaian tergantung pada implementasi setUniqueNames()
        } else {
            console.error("Parent element with class '.section-card' not found");
        }
    }
    var deleteButtons = document.querySelectorAll('.btn[data-bs-original-title="Hapus Pertanyaan"]');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            triggerRemoveCard(button);
        });
    });
    var deleteButtonSection = document.querySelectorAll('.btn[data-bs-original-title="Hapus Bagian"]');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            triggerRemoveSection(button);
        });
    });


    function addSection() {
        var cardContainer = document.getElementById('cardContainer');
        var newSectionHTML = `  <!-- Card Bagian -->
                            <div class="section-card" onclick="toggleSection(this)">
                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label fw-bold">Bagian</label>
                                        <div class="row g-2">
                                            <div class="col">
                                                <div class="container-section">
                                                    <input data-input-name="bagian" type="text" class="form-control-plaintext fw-bold section" name="example-text-input" placeholder="Bagian Tanpa Judul">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="section-tools">
                                                    <div class="form-group">
                                                        <a onclick="triggerRemoveSection(this)()" class="btn btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Hapus Bagian" data-bs-original-title="Hapus Bagian">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z"></path>
                                                                <path d="M9 9l6 6m0 -6l-6 6"></path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                                <label class="form-check d-flex align-items-center">
                                                    <input class="form-check-input radio" type="radio" name="radios">
                                                    <span class="form-check-label ps-2 w-100">
                                                        <input data-input-name="opsiE" type="text" class="form-control-plaintext radio" name="example-text-input" placeholder="Isikan Opsi E" readonly>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;

        // Menyembunyikan fitur dari card saat ini jika ada
        if (currentCard !== null) {
            toggleContent(currentCard);
            currentCard.classList.remove('active');
        }

        // Menambahkan card baru setelah card yang diklik
        cardContainer.insertAdjacentHTML('beforeend', newSectionHTML);
        // cardContainer.insertAdjacentHTML('afterend', newSectionHTML);

        // Menandai card baru sebagai card aktif
        // var newCard = currentCard.nextElementSibling;
        // newCard.classList.add('active');

        // Menjadikan card baru sebagai card saat ini
        // currentCard = newCard;
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

        var deleteButtons = document.querySelectorAll('.btn[data-bs-original-title="Hapus Pertanyaan"]');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                triggerRemoveCard(button);
            });
        });
        triggerSelectTypeAnswer();
        setUniqueNames();
    }


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
                                    <label class="form-check d-flex align-items-center">
                                        <input class="form-check-input radio" type="radio" name="radios">
                                        <span class="form-check-label ps-2 w-100">
                                            <input data-input-name="opsiE" type="text" class="form-control-plaintext radio" name="example-text-input" placeholder="Isikan Opsi E" readonly>
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
    }




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