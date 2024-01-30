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
                        Kelola
                    </div>
                    <h2 class="page-title">
                        Pelatihan
                    </h2>
                    <ol class="breadcrumb mt-2" aria-label="breadcrumbs">
                        <li class="breadcrumb-item active"><a>Pelatihan</a></li>
                        <!-- <li class="breadcrumb-item"><a>Library</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#">Data</a></li> -->
                    </ol>

                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
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
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <style>
        th {
            background-color: red;
        }
    </style>
    <div class="page-body">
        <div class="container-fluid">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-between mb-2">

                                    <div class="align-self-end dropdown mb-2">
                                        <a id="selectedOption" class="dropdown-toggle text-secondary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><strong>Semua</strong></a>
                                        <div id="statusSistem" class="dropdown-menu" style="">
                                            <a class="dropdown-item" data-value="draft">Draft</a>
                                            <a class="dropdown-item" data-value="publish">Publis</a>
                                            <a class="dropdown-item active" data-value="semua">Semua</a>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">

                                        <div class="input-group mx-2">
                                            <input id="searchInput" type="text" class="form-control" placeholder="Nama Pelatihan...">
                                            <button id="searchButton" class="btn" type="button">Cari</button>
                                        </div>

                                        <div class="btn btn-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-list" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                                <path d="M9 12l.01 0"></path>
                                                <path d="M13 12l2 0"></path>
                                                <path d="M9 16l.01 0"></path>
                                                <path d="M13 16l2 0"></path>
                                            </svg>
                                            Rekap
                                        </div>
                                        <div class="dropdown-menu" style="width:fit-content;">
                                            <a class="dropdown-item" href="<?= base_url('pelatihan/rekap/1'); ?>">Bulan Ini</a>
                                            <a class="dropdown-item" href="<?= base_url('pelatihan/rekap/2'); ?>">Tahun Ini</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="tabel-pelatihan" class="table table-bordered table-hover">
                                    <thead class="text-center text-light bg-dark ">
                                        <tr>
                                            <th class="align-middle" scope="col">No</th>
                                            <th class="align-middle" scope="col">Kondisi</th>
                                            <th class="align-middle" scope="col">Mulai Pendaftaran / <br>Selesai Pendaftaran</th>
                                            <th class="align-middle" scope="col">Mulai Pelatihan / <br>Selesai Pelatihan</th>
                                            <th class="align-middle" scope="col">Jenis Pelatihan / Nama Pelatihan</th>
                                            <th class="align-middle" scope="col">Gel. / Batch</th>
                                            <th class="align-middle" scope="col">Pendaftar / <br> Kuota</th>
                                            <th class="align-middle" scope="col">Aksi</th>
                                            <!-- <th class="align-middle " scope="col">Detail</th> -->
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if (!empty($pelatihan)) {
                                            foreach ($pelatihan as $key => $value) { ?>
                                                <tr>
                                                    <th><?= $pager->getPerPage('group1') * ($pager->getCurrentPage('group1') - 1) + $key + 1; ?></th>
                                                    <td style="width: 5%;"><?= $value['condition']; ?></td>
                                                    <td><b><?= $value['start_registration']; ?></b> <br> <?= $value['end_registration']; ?></td>
                                                    <td><b><?= $value['startdatetime']; ?></b> <br> <?= $value['enddatetime']; ?></td>
                                                    <td style="width: 10%;"><b><?= $value['category']; ?></b> <br> <?= $value['fullname']; ?></td>
                                                    <td class="text-center"><?= $value['batch']; ?></td>
                                                    <td class="text-center">
                                                        <?php if (!empty($value['quota'])) {   ?>
                                                            <button class="btn btn-pill btn-outline-green my-0 py-2"><?= $value['participant']; ?> / <?= $value['quota']; ?></button><br>
                                                            <span class="mt-2 badge bg-green-lt">Diterima : <?= $value['accepted_participant']; ?></span>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="<?= base_url('pelatihan/detail/user/' . $value['id']); ?>" class="btn btn-icon btn-outline-primary position-relative m-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Pendaftar">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                                            </svg>
                                                            <?php if (!empty($value['registrar'])) {   ?>
                                                                <span class="badge bg-red text-red-fg badge-notification badge-pill"><?= $value['registrar']; ?></span>
                                                            <?php } ?>
                                                        </a>
                                                        <a href="<?= base_url('pelatihan/detail/' . $value['id']); ?>" class="btn btn-icon btn-outline-primary m-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                                <path d="M12 9h.01"></path>
                                                                <path d="M11 12h1v4h1"></path>
                                                            </svg>
                                                        </a>
                                                        <span data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <a class="btn btn-icon btn-outline-primary m-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Lainnya">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dots-vertical" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                                    <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                                    <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                                </svg>
                                                            </a>
                                                        </span>
                                                        <div class="dropdown-menu">
                                                            <a class=" dropdown-item btn text-primary justify-content-start" href="<?= base_url('pelatihan/detail/edit/' . $value['id']); ?>">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                                    <path d="M16 5l3 3"></path>
                                                                </svg>
                                                                Ubah
                                                            </a>
                                                            <a class="dropdown-item text-danger btn justify-content-start" data-bs-toggle="modal" data-bs-target="#modal-confirm-delete" onclick="sendIDPelatihan('<?= $value['id']; ?>')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M4 7l16 0"></path>
                                                                    <path d="M10 11l0 6"></path>
                                                                    <path d="M14 11l0 6"></path>
                                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                                </svg>
                                                                Hapus
                                                            </a>
                                                        </div>
                                                    </td>

                                                </tr>
                                        <?php }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- Display pagination links -->

                            <div id="tabel-pager" class="card-footer d-flex align-items-center">
                                <p class="m-0 text-secondary">Menampilkan <span><?= $pager->getCurrentPage('group1'); ?></span> - <span><?= $pager->getPageCount('group1'); ?></span> dari <span><?= $pager->getTotal('group1'); ?></span> data.</p>
                                <ul class="pagination m-0 ms-auto">
                                    <li class="page-item <?= $pager->getCurrentPage('group1') == 1 ? 'disabled' : ''; ?>">
                                        <a class="page-link" href="<?= $pager->getPreviousPageURI('group1'); ?>" tabindex="-1" aria-disabled="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M15 6l-6 6l6 6"></path>
                                            </svg>
                                            sebelum
                                        </a>
                                    </li>
                                    <?php if ($pager->getCurrentPage('group1') - 1 != 0) { ?>
                                        <li class="page-item"><a class="page-link" href="<?= $pager->getPageURI($pager->getCurrentPage('group1') - 1, 'group1');  ?>"><?= $pager->getCurrentPage('group1') - 1; ?></a></li>
                                    <?php } ?>
                                    <li class="page-item active"><a class="page-link" href="<?= $pager->getPageURI($pager->getCurrentPage('group1'), 'group1');  ?>"><?= $pager->getCurrentPage('group1') ?></a></li>
                                    <?php if ($pager->getCurrentPage('group1') != $pager->getPageCount('group1')) { ?>
                                        <li class="page-item"><a class="page-link" href="<?= $pager->getPageURI($pager->getCurrentPage('group1') + 1, 'group1');  ?>"><?= $pager->getCurrentPage('group1') + 1; ?></a></li>
                                    <?php } ?>

                                    <li class="page-item  <?= $pager->getCurrentPage('group1') == $pager->getPageCount('group1') ? 'disabled' : ''; ?>">
                                        <a class="page-link" href="<?= $pager->getNextPageURI('group1'); ?>">
                                            sesudah
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M9 6l6 6l-6 6"></path>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
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
<!-- Modal Konfrimasi Publish -->
<div class="modal modal-blur fade" id="modal-confirm-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-delete-course" action="" method="post">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                        <path d="M12 9v4" />
                        <path d="M12 17h.01" />
                    </svg>
                    <h3>Apakah Anda yakin?</h3>
                    <div class="text-secondary mb-2">Dengan menghapus pelatihan maka <strong>seluruh data pelatihan akan terhapus</strong> dari sistem.</div>
                    <br>
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="col">
                            <label class="form-check " style="text-align: left !important;">
                                <input id="checkbox-persetujuan" type="checkbox" class="form-check-input" name="delete_best" />
                                <span class="form-check-label">
                                    <strong>Hapus juga pelatihan dari Best. </strong>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col">
                                <a class="btn w-100" data-bs-dismiss="modal">Batal</a>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-danger w-100"> Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script>
    var status_sistem_val = 'semua'; // Ganti dengan nilai sesuai kebutuhan
    var keyword_val = ''; // Ganti dengan nilai sesuai kebutuhan
    // Panggil fungsi untuk memuat data saat halaman dimuat
    $(document).ready(function() {
        // pelatihanFilter();

        // Menangkap peristiwa perubahan pada elemen dropdown-menu
        $('#statusSistem').on('click', '.dropdown-item', function() {
            // Menghapus kelas active dari semua elemen
            $('.dropdown-item').removeClass('active');

            // Mengambil nilai dan data-value dari elemen yang dipilih
            var nilaiItem = $(this).text().trim();
            var dataValue = $(this).attr('data-value');

            console.log("Nilai yang dipilih: " + nilaiItem);
            console.log("Data-value yang dipilih: " + dataValue);

            status_sistem_val = dataValue;
            pelatihanFilter();

            // Menambahkan kelas active hanya pada elemen yang dipilih
            $(this).addClass('active');

            // Mengubah teks pada dropdown-toggle dengan nilai yang dipilih
            $('#selectedOption').html('<strong>' + nilaiItem + '</strong>');

            // Lakukan tindakan yang diinginkan setelah perubahan
            // Contoh: Ubah konten atau kirim permintaan AJAX

            // Anda dapat menyesuaikan tindakan ini sesuai kebutuhan Anda
        });

        $('#searchButton').on('click', function() {
            keyword_val = $('#searchInput').val();
            pelatihanFilter();

        });

    });

    function sendIDPelatihan(id_pelatihan) {
        console.log("MASUK");
        $('#form-delete-course').attr('action', "<?= base_url('pelatihan/delete/'); ?>" + id_pelatihan);
    }


    // Fungsi untuk memuat data pelatihan
    function pelatihanFilter() {
        $.ajax({
            url: '<?= base_url('api/getPelatihanFilter'); ?>', // Ganti dengan URL API yang sesuai
            method: 'POST',
            data: {
                status_sistem: status_sistem_val,
                keyword: keyword_val
            },
            dataType: 'json',
            headers: {
                'X-API-KEY': '$2y$10$HXBqz8piCPmDzA28fkcauOFt5L7N.khsoRyr0o57el9mj7js5vVcK' // Ganti dengan API Key yang sesuai
            },
            success: function(data) {
                console.log(data);
                updateTabel(data.pelatihan);
                updatePager(data.pager);
                // updateTabel(data); // Panggil fungsi untuk memperbarui tabel
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }

    function updateTabel(data) {
        var tbody = $('#tabel-pelatihan tbody');
        tbody.empty(); // Menghapus semua baris pada tabel

        if (data.length > 0) {
            for (var i = 0; i < data.length; i++) {
                var row = '<tr>' +
                    '<th>' + (i + 1) + '</th>' +
                    '<td style="width: 5%;">' + data[i].condition + '</td>' +
                    '<td><b>' + data[i].start_registration + '</b><br>' + data[i].end_registration + '</td>' +
                    '<td><b>' + data[i].startdatetime + '</b><br>' + data[i].enddatetime + '</td>' +
                    '<td style="width: 10%;"><b>' + data[i].category + '</b><br>' + data[i].fullname + '</td>' +
                    '<td class="text-center">' + data[i].batch + '</td>' +
                    '<td class="text-center">' +
                    (data[i].quota ? '<button class="btn btn-pill btn-outline-green my-0 py-2">' + data[i].participant + ' / ' + data[i].quota + '</button><br>' +
                        '<span class="mt-2 badge bg-green-lt">Diterima : ' + data[i].accepted_participant + '</span>' : '') +
                    '</td>' +
                    '<td class="text-center">' +
                    '<a href="<?= base_url('pelatihan/detail/user/'); ?>' + data[i].id + '" class="btn btn-icon btn-outline-primary position-relative m-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Pendaftar">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">' +
                    '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>' +
                    '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>' +
                    '<path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>' +
                    '</svg>' +
                    (data[i].registrar ? '<span class="badge bg-red text-red-fg badge-notification badge-pill">' + data[i].registrar + '</span>' : '') +
                    '</a>' +
                    '<a href="<?= base_url('pelatihan/detail/'); ?>' + data[i].id + '" class="btn btn-icon btn-outline-primary m-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">' +
                    '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>' +
                    '<path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>' +
                    '<path d="M12 9h.01"></path>' +
                    '<path d="M11 12h1v4h1"></path>' +
                    '</svg>' +
                    '</a>' +
                    '<span data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                    '<a class="btn btn-icon btn-outline-primary m-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Lainnya">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dots-vertical" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">' +
                    '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>' +
                    '<path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>' +
                    '<path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>' +
                    '<path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>' +
                    '</svg>' +
                    '</a>' +
                    '</span>' +
                    '<div class="dropdown-menu">' +
                    '<a class=" dropdown-item btn text-primary justify-content-start" href="<?= base_url('pelatihan/detail/edit/'); ?>' + data[i].id + '">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">' +
                    '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>' +
                    '<path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>' +
                    '<path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>' +
                    '<path d="M16 5l3 3"></path>' +
                    '</svg>' +
                    'Ubah' +
                    '</a>' +
                    '<a class="dropdown-item text-danger btn justify-content-start" data-bs-toggle="modal" data-bs-target="#modal-confirm-delete" onclick="sendIDPelatihan(\'' + data[i].id + '\')">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">' +
                    '<path stroke="none" d="M0 0h24v24H0z"></path>' +
                    '<path d="M4 7l16 0"></path>' +
                    '<path d="M10 11l0 6"></path>' +
                    '<path d="M14 11l0 6"></path>' +
                    '<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>' +
                    '<path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>' +
                    '</svg>' +
                    'Hapus' +
                    '</a>' +
                    '</div>' +
                    '</td>' +
                    '</tr>';
                tbody.append(row);
            }
        } else {
            // Tambahkan handling jika tidak ada data yang ditemukan
            var emptyRow = '<tr><td colspan="8" class="text-center">Tidak ada data yang ditemukan</td></tr>';
            tbody.append(emptyRow);
        }
    }

    function updatePager(data) {
        const pagerElement = document.getElementById('tabel-pager');
        const pagerTemplate = `
        <p class="m-0 text-secondary">Menampilkan <span>${data.current_page}</span> - <span>${data.page_count}</span> dari <span>${data.total_data}</span> data.</p>
        <ul class="pagination m-0 ms-auto">
            <li class="page-item ${data.current_page === 1 ? 'disabled' : ''}">
                <a class="page-link" href="${data.current_page === 1 ? '#' : data.page_uri + '&page_group1=' + (data.current_page - 1)}" tabindex="-1" aria-disabled="true">
                    sebelum
                </a>
            </li>
            ${data.current_page - 1 !== 0 ? `<li class="page-item"><a class="page-link" href="${data.page_uri + '&page_group1=' + (data.current_page - 1)}">${data.current_page - 1}</a></li>` : ''}
            <li class="page-item active"><a class="page-link" href="${data.page_uri + '&page_group1=' + data.current_page}">${data.current_page}</a></li>
            ${data.current_page !== data.page_count ? `<li class="page-item"><a class="page-link" href="${data.page_uri + '&page_group1=' + (data.current_page + 1)}">${data.current_page + 1}</a></li>` : ''}
            <li class="page-item ${data.current_page === data.page_count ? 'disabled' : ''}">
                <a class="page-link" href="${data.page_uri + '&page_group1=' + (data.current_page + 1)}">
                    sesudah
                </a>
            </li>
        </ul>
    `;
        pagerElement.innerHTML = pagerTemplate;
    }
</script>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->