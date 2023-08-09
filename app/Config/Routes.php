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
$routes->addRedirect('/', 'profil');
// $routes->addRedirect('/', 'login');
$routes->get('/profil', 'Pages::index');
// $routes->get('/login', 'Pages::login');
// $routes->group('login', static function ($routes) {
//     $routes->post('proses',  'Pages::loginProses');
// });
// $routes->get('/logout', 'Pages::logout');
// $routes->get('/registrasi', 'Pages::registrasi');
// $routes->group('registrasi', static function ($routes) {
//     $routes->post('proses',  'Pages::registrasiProses');
// });
$routes->group('service', static function ($routes) {
    $routes->get('provinsi',  'Pages::dataProvinsi');
    $routes->get('kabupaten/(:num)',  'Pages::dataKabupaten/$1');
    $routes->get('kecamatan/(:segment)',  'Pages::dataKecamatan/$1');
});
$routes->group('profil', static function ($routes) {
    $routes->group('upload', static function ($routes) {
        $routes->match(['get', 'post'], 'foto',  'Pages::uploadFotoProfil');
    });
    $routes->post('update',  'Pages::updateUser');
});
$routes->group('pelatihan', ['filter' => 'role:user'], static function ($routes) {
    $routes->get('berlangsung', 'Pages::pelatihanBerlangsung', ['filter' => 'role:user']);
    $routes->get('agenda', 'Pages::pelatihanAgenda', ['filter' => 'role:user']);
    $routes->group('agenda', ['filter' => 'role:user'], static function ($routes) {
        // $routes->post('detail', 'Pages::detailAgendaProses');
        $routes->get('detail/(:num)',  'Pages::detailAgendaProses/$1', ['filter' => 'role:user']);
        // $routes->group('detail', static function ($routes) {
        // });
        $routes->get('registrasi/(:num)', 'Pages::pelatihanRegis/$1');
        $routes->group('registrasi', static function ($routes) {
            $routes->post('proses/(:num)', 'Pages::pelatihanRegisProses/$1');
        });
    });

    $routes->get('riwayat', 'Pages::pelatihanRiwayat');
});
$routes->get('pelatihan', 'Admin::pelatihanKelola', ['filter' => 'role:admin']);
$routes->group('pelatihan', ['filter' => 'role:admin'], static function ($routes) {
    // $routes->get('detail/(:num)', 'Pages::detailKelolaProses/$1');
    $routes->get('detail/(:num)',  'Admin::detailKelola/$1');

    $routes->group('detail', static function ($routes) {
        $routes->get('edit/(:num)',  'Admin::detailKelolaEdit/$1');
        $routes->get('user/(:num)',  'Admin::pelatihanUser/$1');

        $routes->group('edit', static function ($routes) {
            $routes->post('proses/(:num)',  'Admin::detailKelolaEditProses/$1');
        });

        $routes->group('dokumen', static function ($routes) {
            $routes->post('download/(:num)',  'Admin::insertDownloadDocument/$1');

            $routes->group('download', static function ($routes) {
                $routes->post('update-to-course/(:num)',  'Admin::updateCourseDownloadDocument/$1');
            });

            $routes->post('upload/(:num)',  'Admin::insertUploadDocument/$1');

            $routes->group('upload', static function ($routes) {
                $routes->post('update-to-course/(:num)',  'Admin::updateCourseUploadDocument/$1');
            });
        });
    });
});
$routes->post('list-download-document', 'Admin::listDownloadDocument', ['filter' => 'role:admin']);
$routes->post('list-user-course', 'Admin::listUserCourse', ['filter' => 'role:admin']);
$routes->post('list-user-upload-document', 'Admin::listUserUploadDocument', ['filter' => 'role:admin']);

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
