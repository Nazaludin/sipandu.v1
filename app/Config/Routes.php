<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->get('/login-best', 'AuthController::loginBest');

$routes->addRedirect('/', 'profil');
$routes->get('/profil', 'General\Profil::index');


$routes->get('/epp', 'Admin\Evaluasi::index', ['filter' => 'role:admin']);
$routes->get('/epp-fill', 'Admin\Evaluasi::indexBasic', ['filter' => 'role:user']);
$routes->get('/instrument', 'Admin\Evaluasi::instrument');

$routes->group('instrument', ['filter' => 'role:admin'], static function ($routes) {
    $routes->get('insert/(:num)', 'Admin\Evaluasi::insertInstrument/$1');
    $routes->group('insert', static function ($routes) {
        $routes->post('proses', 'Admin\Evaluasi::insertInstrumentProses');
        // $routes->post('proses/(:num)', 'Admin\Evaluasi::editInstrumentProses/$1');
    });
    $routes->get('edit/(:num)', 'Admin\Evaluasi::editInstrument/$1');
    $routes->group('edit', static function ($routes) {
        $routes->post('proses/(:num)', 'Admin\Evaluasi::editInstrumentProses/$1');
    });
    $routes->get('template', 'Admin\Evaluasi::templateInstrument');
    $routes->group('template', static function ($routes) {
        $routes->get('use/(:num)/(:num)', 'Admin\Evaluasi::useTemplateInstrument/$1/$2');
        $routes->get('course/(:num)', 'Admin\Evaluasi::courseTemplateInstrument/$1');
        $routes->get('preview/(:num)', 'Admin\Evaluasi::previewTemplateInstrument/$1');
        $routes->get('insert', 'Admin\Evaluasi::insertTemplateInstrument');
        $routes->get('delete/(:num)', 'Admin\Evaluasi::deleteTemplateInstrument/$1');
        $routes->get('edit/(:num)', 'Admin\Evaluasi::editTemplateInstrument/$1');
        $routes->group('edit', static function ($routes) {
            $routes->post('proses', 'Admin\Evaluasi::editTemplateInstrumentProses');
        });
        $routes->group('insert', static function ($routes) {
            $routes->post('proses', 'Admin\Evaluasi::insertTemplateInstrumentProses');
        });
    });
    // $routes->get('fill/(:num)', 'Admin\Evaluasi::fillInstrument/$1');
    $routes->get('perview/(:num)', 'Admin\Evaluasi::perviewInstrument/$1');
    $routes->get('rekap/(:num)', 'Admin\Evaluasi::rekapInstrument/$1');
});


$routes->group('question', ['filter' => 'role:user'], static function ($routes) {
    $routes->get('fill/(:num)', 'General\Evaluasi::fillInstrument/$1');
    $routes->group('fill', static function ($routes) {
        $routes->post('proses', 'General\Evaluasi::answerInstrument');
    });
});

// AUTH ROUTES
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::attemptLogin');
$routes->get('/logout', 'AuthController::logout');

// Registration
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::attemptRegister');

// Activation
$routes->get('activate-account', 'AuthController::activateAccount');
$routes->get('/resend-activate-account', 'AuthController::resendActivateAccount',);

// Forgot/Resets
$routes->get('/forgot', 'AuthController::forgotPassword');
$routes->post('/forgot', 'AuthController::attemptForgot');
$routes->get('/reset-password', 'AuthController::resetPassword');
$routes->post('/reset-password', 'AuthController::attemptReset');


// $routes->group('registrasi', static function ($routes) {
//     $routes->post('proses',  'General\Pelatihan::registrasiProses');
// });
$routes->group('service', static function ($routes) {
    $routes->get('test',  'APIControl::test');
    $routes->post('test',  'APIControl::testKoneksi');
    $routes->post('store-profil-image',  'APIControl::storeProfilImage');
    $routes->post('store-profil-image-final',  'APIControl::storeProfilImageFinal');
    $routes->get('pangkat-golongan',  'APIControl::dataPangkatGolongan');
    $routes->get('jenis-nakes',  'APIControl::dataJenisNakes');
    $routes->get('provinsi',  'APIControl::dataProvinsi');
    $routes->get('kabupaten',  'APIControl::dataKabupaten');
    $routes->get('kecamatan',  'APIControl::dataKecamatan');
});
$routes->group('profil', static function ($routes) {
    $routes->post('complete',  'General\Profil::completeProfil');
    $routes->get('edit',  'General\Profil::profilEdit');
    $routes->group('edit', static function ($routes) {
        $routes->post('proses',  'General\Profil::profilEditProses');
    });
    $routes->group('upload', static function ($routes) {
        $routes->match(['get', 'post'], 'foto',  'General\Profil::uploadFotoProfil');
    });
    $routes->post('update',  'General\Profil::updateUser');
    $routes->group('photo', static function ($routes) {
        $routes->get('edit',  'General\Profil::photoEdit');
        $routes->group('edit', static function ($routes) {
            $routes->post('proses',  'General\Profil::photoEditProses');
        });
    });
});
$routes->group('pelatihan', ['filter' => 'role:user'], static function ($routes) {
    $routes->get('batal/(:num)', 'General\Pelatihan::pelatihanBatal/$1', ['filter' => 'role:user']);

    $routes->get('agenda', 'General\Pelatihan::pelatihanAgenda', ['filter' => 'role:user']);
    $routes->group('agenda', ['filter' => 'role:user'], static function ($routes) {
        // $routes->post('detail', 'General\Pelatihan::detailAgendaProses');
        $routes->get('detail/(:num)',  'General\Pelatihan::detailAgendaProses/$1', ['filter' => 'role:user']);
        // $routes->group('detail', static function ($routes) {
        // });
        $routes->get('registrasi/(:num)', 'General\Pelatihan::pelatihanRegis/$1');
        $routes->group('registrasi', static function ($routes) {
            $routes->post('proses/(:num)', 'General\Pelatihan::pelatihanRegisProses/$1');
        });
    });

    $routes->get('daftar', 'General\Pelatihan::pelatihanDaftar', ['filter' => 'role:user']);
    $routes->group('daftar', ['filter' => 'role:user'], static function ($routes) {
        $routes->get('detail/(:num)',  'General\Pelatihan::detailDaftarProses/$1', ['filter' => 'role:user']);
        $routes->get('revisi/(:num)', 'General\Pelatihan::pelatihanRevisi/$1');

        $routes->group('revisi', static function ($routes) {
            $routes->post('proses/(:num)', 'General\Pelatihan::pelatihanRevisiProses/$1');
        });
    });

    $routes->get('berlangsung', 'General\Pelatihan::pelatihanBerlangsung', ['filter' => 'role:user']);
    $routes->group('berlangsung', ['filter' => 'role:user'], static function ($routes) {
        $routes->get('detail/(:num)',  'General\Pelatihan::detailBerlangsungProses/$1', ['filter' => 'role:user']);
    });
    $routes->get('riwayat', 'General\Pelatihan::pelatihanRiwayat');
    $routes->group('riwayat', ['filter' => 'role:user'], static function ($routes) {
        $routes->get('detail/(:num)',  'General\Pelatihan::detailRiwayatProses/$1', ['filter' => 'role:user']);
    });
});
$routes->get('pelatihan', 'Admin\Pelatihan::pelatihan', ['filter' => 'role:admin']);
$routes->group('pelatihan', ['filter' => 'role:admin'], static function ($routes) {
    // $routes->get('detail/(:num)', 'General\Pelatihan::pelatihanDetailProses/$1');
    $routes->get('rekap/(:num)', 'Admin\Pelatihan::rekap/$1');
    $routes->get('rekap/pengguna/(:num)/(:num)', 'Admin\Pelatihan::rekapPengguna/$1/$2');
    $routes->get('detail/(:num)',  'Admin\Pelatihan::pelatihanDetail/$1');
    $routes->get('insert',  'Admin\Pelatihan::pelatihanInsert');
    $routes->post('delete/(:num)',  'Admin\Pelatihan::pelatihanDelete/$1');

    $routes->group('status', static function ($routes) {
        $routes->get('edit/(:num)/(:num)',  'Admin\Pelatihan::pelatihanEditStatus/$1/$2');
    });

    $routes->group('insert', static function ($routes) {
        $routes->get('syarat/(:num)',  'Admin\Pelatihan::pelatihanInsertRule/$1');
        $routes->get('publis/(:num)',  'Admin\Pelatihan::pelatihanInsertPublish/$1');
        $routes->group('publis', static function ($routes) {
            $routes->post('proses/(:num)',  'Admin\Pelatihan::pelatihanInsertPublishProses/$1');
        });
        $routes->post('proses',  'Admin\Pelatihan::pelatihanInsertProses');
    });



    $routes->group('detail', static function ($routes) {
        $routes->get('edit/(:num)',  'Admin\Pelatihan::pelatihanDetailEdit/$1');
        $routes->get('user/(:num)',  'Admin\Pelatihan::pelatihanUser/$1');

        $routes->group('user', static function ($routes) {
            $routes->get('regis/(:num)/(:num)',  'Admin\Pelatihan::pelatihanUserDetail/$1/$2');
            $routes->match(['get', 'post'], 'regis/(:num)/(:num)/(:num)',  'Admin\Pelatihan::pelatihanUserRegis/$1/$2/$3');
            $routes->group('insert', static function ($routes) {
                $routes->post('certificate/(:num)',  'Admin\Pelatihan::insertCertificate/$1');
            });
        });

        $routes->group('edit', static function ($routes) {
            $routes->post('proses/(:num)',  'Admin\Pelatihan::pelatihanDetailEditProses/$1');
        });

        $routes->group('dokumen', static function ($routes) {
            $routes->post('download',  'Admin\Pelatihan::insertDownloadDocument');

            $routes->group('download', static function ($routes) {
                $routes->post('update-to-course/(:num)',  'Admin\Pelatihan::updateCourseDownloadDocument/$1');
                $routes->post('edit/(:num)',  'Admin\Pelatihan::editDownloadDocument/$1');
                $routes->get('delete/(:num)',  'Admin\Pelatihan::deleteDownloadDocument/$1');
            });

            $routes->post('upload',  'Admin\Pelatihan::insertUploadDocument');

            $routes->group('upload', static function ($routes) {
                $routes->post('update-to-course/(:num)',  'Admin\Pelatihan::updateCourseUploadDocument/$1');
                $routes->post('edit/(:num)',  'Admin\Pelatihan::editUploadDocument/$1');
                $routes->get('delete/(:num)',  'Admin\Pelatihan::deleteUploadDocument/$1');
            });
        });
    });
});

$routes->get('pengguna', 'Admin\Pengguna::index', ['filter' => 'role:admin']);
$routes->group('pengguna', ['filter' => 'role:admin'], static function ($routes) {
    $routes->get('testInsert',  'Admin\Pengguna::testRegis');
    $routes->group('template', static function ($routes) {
        $routes->get('download',  'Admin\Pengguna::downloadTemplate');
        $routes->post('upload',  'Admin\Pengguna::uploadTemplate');
    });
});

$routes->post('list-download-document', 'Admin\Pelatihan::listDownloadDocument', ['filter' => 'role:admin']);
$routes->post('list-user-course', 'Admin\Pelatihan::listUserCourse', ['filter' => 'role:admin']);
$routes->post('list-user-upload-document', 'Admin\Pelatihan::listUserUploadDocument', ['filter' => 'role:admin']);

// API RESPON
$routes->group('api', ['filter' => 'api'], static function ($routes) {
    $routes->get('getPelatihan',  'Api\ApiPelatihan::getPelatihan');
    $routes->post('getPelatihanFilter',  'Api\ApiPelatihan::getPelatihanFilter');
});


$routes->group('test', static function ($routes) {
    $routes->get('rekap',  'Admin\Pelatihan::testRekap');
});

$routes->group('sync', static function ($routes) {
    $routes->get('simpeg',  'Admin\Pelatihan::singkronSimpeg');
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
