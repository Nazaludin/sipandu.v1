<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->


<!-- Sidebar -->
<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href=".">
                Sipandu
                <!-- <img src="./static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image"> -->
            </a>
        </h1>
        <div class="nav-item dropdown  d-xl-none d-sm-block">
            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url(<?php echo isset(user()->toArray()['lokasi_foto']) ? user()->toArray()['lokasi_foto'] : base_url('assets/images/users/default-profil.png'); ?>)"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="<?php echo base_url('logout'); ?>" class="dropdown-item">Logout</a>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <?php if (in_groups('user')) { ?>

                    <li class="nav-item justify-content-center">
                        <a class="nav-link" href="<?= base_url('profil'); ?>">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Profil
                            </span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                    <path d="M12 12l8 -4.5" />
                                    <path d="M12 12l0 9" />
                                    <path d="M12 12l-8 -4.5" />
                                    <path d="M16 5.25l-8 4.5" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Pelatihan
                            </span>
                        </a>
                        <div class="dropdown-menu  show">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item" href="<?= base_url('pelatihan/agenda'); ?>">
                                    Agenda
                                </a>
                                <a class="dropdown-item" href="<?= base_url('pelatihan/daftar'); ?>">
                                    Daftar
                                </a>
                                <a class="dropdown-item" href="<?= base_url('pelatihan/berlangsung'); ?>">
                                    Berlangsung
                                </a>
                                <a class="dropdown-item" href="<?= base_url('pelatihan/riwayat'); ?>">
                                    Riwayat
                                </a>
                            </div>

                        </div>
                    </li>
                <?php } ?>
                <?php if (in_groups('admin')) { ?>
                    <li class="nav-item justify-content-center">
                        <a class="nav-link" href="<?php echo base_url('profil'); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-2 me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                <path d="M10 12h4v4h-4z"></path>
                            </svg>
                            <span class="nav-link-title">
                                Beranda
                            </span>
                        </a>
                    </li>
                    <li class="nav-item justify-content-center">
                        <a class="nav-link" href="<?php echo base_url('pelatihan'); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book-2 me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"></path>
                                <path d="M19 16h-12a2 2 0 0 0 -2 2"></path>
                                <path d="M9 8h6"></path>
                            </svg>
                            <span class="nav-link-title">
                                Pelatihan
                            </span>
                        </a>
                    </li>
                <?php } ?>


            </ul>
        </div>
    </div>
</aside>

<!-- HEADER -->
<header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
    <div class="container-fluid d-flex justify-content-end">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url(<?php echo isset(user()->toArray()['lokasi_foto']) ? user()->toArray()['lokasi_foto'] : base_url('assets/images/users/default-profil.png'); ?>)"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div><?php echo isset(user()->toArray()['nama']) ? user()->toArray()['nama'] : 'Pandu' ?></div>
                        <div class="mt-1 small text-secondary"><?php echo isset(user()->toArray()['jabatan']) ? user()->toArray()['jabatan'] : 'Pengguna' ?></div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="<?php echo base_url('logout'); ?>" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>

    </div>
</header>


<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->