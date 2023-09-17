<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-fluid">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Pelatihan
                    </div>
                    <h2 class="page-title">
                        Proses Daftar
                    </h2>
                </div>
                <!-- Page title actions -->
                <!-- <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <span class="d-none d-sm-inline">
                            <a href="#" class="btn">
                                New view
                            </a>
                        </span>
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">

                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Create new report
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">

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
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-responsive">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Status</th>
                                        <th>Periode Pelatihan</th>
                                        <th>Jenis Pelatihan/Nama Pelatihan</th>
                                        <th>Sasaran Peserta</th>
                                        <th>Tempat Penyelenggara</th>
                                        <th>Gel. / Batch</th>
                                        <th>Kuota</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php if (isset(json_decode($pelatihan)->courses)) {
                                        foreach (json_decode($pelatihan)->courses as $key => $value) { ?>

                                            <tr>
                                                <th scope="row"><?= $key + 1; ?></th>
                                                <td><?php switch ($value->status) {
                                                        case 'register':
                                                            echo '<button class="btn btn-pill text-blue m-0 px-3 py-1"><span class="badge bg-blue badge-blink badge-pill me-2"></span>Daftar</button>';
                                                            break;
                                                        case 'revisi':
                                                            echo '<button class="btn btn-pill text-orange m-0 px-3 py-1"><span class="badge bg-orange badge-blink badge-pill me-2"></span>Revisi</button>';
                                                            break;
                                                        case 'reject':
                                                            echo '<button class="btn btn-pill text-red m-0 px-3 py-1"><span class="badge bg-red badge-blink badge-pill me-2"></span>Ditolak</button>';
                                                            break;

                                                        default:
                                                            echo '';
                                                            break;
                                                    }; ?>
                                                </td>

                                                <td><b><?= $value->startdatetime; ?></b> <br> <?= $value->enddatetime; ?></td>
                                                <td><b><?= $value->categoryname; ?></b> <br> <?= $value->fullname; ?></td>
                                                <td></td>
                                                <td></td>
                                                <td><?= $value->batch; ?></td>
                                                <td><?= $value->quota; ?></td>
                                                <td>
                                                    <a href="<?= base_url('pelatihan/daftar/detail/' . $value->id); ?>" class="btn btn-icon btn-outline-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                            <path d="M12 9h.01"></path>
                                                            <path d="M11 12h1v4h1"></path>
                                                        </svg>
                                                    </a>
                                                    <a class="btn btn-icon btn-outline-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dots-vertical" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                            <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                            <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu ">
                                                        <a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#modal-confirm-cancel" onclick="sendValuesCancel(<?= $value->id; ?>)">Batal Mengikuti</a>
                                                        <!-- <a class="dropdown-item text-danger" href="<?= base_url('pelatihan/batal/' . $value->id); ?>" data-bs-toggle="modal" data-bs-target="#modal-confirm-cancel">Batal Mengikuti</a> -->
                                                        <!-- <a class="dropdown-item" href="#">Publis</a> -->
                                                        <!-- <a class="dropdown-item active" href="#">Semua</a> -->
                                                    </div>

                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <!-- <div class="modal fade" id="modal-foto-profil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="<?php echo base_url('profil/upload/foto'); ?>" method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="form-group">
                                <label for="image">Upload Image</label>
                                <input type="file" class="form-control-file" id="image" name="foto_profil">
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Recent comment and chats -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- Modal Konfrimasi Batal -->
<div class="modal modal-blur fade" id="modal-confirm-cancel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                    <path d="M12 9v4" />
                    <path d="M12 17h.01" />
                </svg>
                <h3>Apakah anda yakin?</h3>
                <div class="text-secondary">Dengan membatalkan pelatihan, Anda <strong>tidak dapat mengikuti pelatihan</strong> dan semua <strong>persyaratan</strong> yang anda kirim akan <strong>terhapus</strong> dari sistem.</div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col"><a class="btn w-100" data-bs-dismiss="modal">
                                Kembali
                            </a></div>
                        <input type="hidden" id="url-cancel" value="<?= base_url('pelatihan/batal/'); ?>">
                        <div class="col"><a id="button-confirm-cancel" class="btn btn-danger w-100"> Lanjut</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function sendValuesCancel(id) {
        var url = document.getElementById('url-cancel').value;
        document.getElementById('button-confirm-cancel').href = url + id;
    }
</script>