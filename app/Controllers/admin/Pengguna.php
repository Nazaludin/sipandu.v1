<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use CodeIgniter\I18n\Time;
use Myth\Auth\Models\UserModel;
use Loncat\Moody\AppFactory;
use Loncat\Moody\Config;
use Loncat\Moody\Contract;
use \App\Models\CourseModel;
use \App\Models\UploadDocumentModel;
use \App\Models\DownloadDocumentModel;
use \App\Models\CourseUploadDocumentModel;
use \App\Models\CourseDownloadDocumentModel;
use \App\Models\UserCourseModel;
use \App\Models\UserUploadDocumentModel;

use Myth\Auth\Entities\User;
use Myth\Auth\Config\Auth as AuthConfig;

class Pengguna extends BaseController
{
    protected $config;
    protected $MoodyBest;

    public function __construct()
    {
        $this->config = config('Auth');
        // $apiKeyMoodle =  '6324f38717ff35569d486e633b0a31b1';
        $apiKeyMoody =  getenv('API_KEY_MOODY');
        $configBest = new Config("http://best-bapelkes.jogjaprov.go.id/webservice/rest/server.php", $apiKeyMoody);
        $this->MoodyBest = AppFactory::create($configBest);
    }
    function generateRandomUsername()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $usernameLength = rand(6, 8);
        $randomUsername = '';

        for ($i = 0; $i < $usernameLength; $i++) {
            $randomUsername .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomUsername;
    }
    public function index()
    {
        return view('layout/header',)
            . view('layout/sidebar')
            . view('admin/pengguna/index')
            . view('layout/footer');
    }
    public function testRegis()
    {
        $users = model(UserModel::class);

        // $dataRegis = $this->request->getPost();
        // d($dataRegis);
        $result = $this->MoodyBest->createUser(
            $this->generateRandomUsername(), //username
            'Sandisandi1*', //password
            'werwfsdfsre@gmail.com', //email
            'hello test', //firstname
            'akhir', //lastname
            'aceh', //provinsi
            "ID",
        );
        dd($result);

        // if (!empty($result['error'])) {
        //     d($result['error']);
        //     $akunBest = $this->MoodyBest->getUserByEmail($dataRegis['email']);
        //     if (!empty($akunBest['error'])) {
        //         // return redirect()->back()->withInput()->with('error', "Terjadi kesalahan dalam meproses akun Anda. Akun Anda mungkin sudah terdaftar.");
        //         dd($akunBest['error']);
        //         // return redirect()->back()->withInput()->with('error', );
        //     } else {
        //         // d($akunBest['data']);
        //         // updateUser(string $id, string $password, string $email, string $firstname, string $lastname, string $city, string $country)
        //         $updateakunBest = $this->MoodyBest->updateUser(
        //             $akunBest['data']['userid'],
        //             $dataRegis['password'],
        //             $dataRegis['email'],
        //             $dataRegis['firstname'],
        //             $dataRegis['lastname'],
        //             $dataRegis['provinsi'],
        //             "ID",
        //         );

        //         if (!empty($updateakunBest['error'])) {
        //             return redirect()->back()->withInput()->with('error', "Terjadi kesalahan dalam singkronisasi akun Sipandu dan akun Best.");
        //         }
        //         // dd($updateakunBest);
        //     }
        // }
        // $user              = new User(array_merge($this->request->getPost($allowedPostFields), ['status_sistem' => 'incomplete']));



        // $this->config->requireActivation === null ? $user->activate() : $user->generateActivateHash();

        // // Ensure default group gets assigned if set
        // if (!empty($this->config->defaultUserGroup)) {
        //     $users = $users->withGroup($this->config->defaultUserGroup);
        // }

        // if (!$users->save($user)) {
        //     return redirect()->back()->withInput()->with('errors', $users->errors());
        // }
    }

    // CODE PELATIHAN
    public function downloadTemplate()
    {
        require_once COMPOSER_PATH;
        $spreadsheet = new Spreadsheet();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $activeSheet = $spreadsheet->getActiveSheet();

        // Buat sebuah variabel untuk menampung pengaturan style judul
        $style_title = [
            'font' => [
                'bold'  => true,
                'size'  => 15,
                'name'  => 'Calibri'
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => [
                'bold' => true,
                'color' => [
                    'argb' => 'FFFFFF',
                ],
            ], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'outline' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border top dengan garis tipis
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '00985B',
                ],
                'endColor' => [
                    'argb' => '00985B',
                ],
            ]
        ];

        //judul
        $title = 'Format Tambah Pengguna ';
        $activeSheet->setCellValue('A2', $title); // Set kolom A1 dengan tulisan "DATA SISWA"
        $activeSheet->mergeCells('A2:H2'); // Set Merge Cell pada kolom A1 sampai F1
        $activeSheet->getStyle('A2')->applyFromArray($style_title);

        $activeSheet->setCellValue('A4', 'No');
        $activeSheet->setCellValue('B4', 'Nama Depan');
        $activeSheet->setCellValue('C4', 'Nama Belakang');
        $activeSheet->setCellValue('D4', 'Nama Lengkap');
        $activeSheet->setCellValue('E4', 'Email');
        $activeSheet->setCellValue('F4', 'Kata Sandi');
        $activeSheet->setCellValue('G4', 'Telepon');
        $activeSheet->setCellValue('H4', 'Provinsi');

        $activeSheet->getStyle('A4')->applyFromArray($style_col);
        $activeSheet->getStyle('B4')->applyFromArray($style_col);
        $activeSheet->getStyle('C4')->applyFromArray($style_col);
        $activeSheet->getStyle('D4')->applyFromArray($style_col);
        $activeSheet->getStyle('E4')->applyFromArray($style_col);
        $activeSheet->getStyle('F4')->applyFromArray($style_col);
        $activeSheet->getStyle('G4')->applyFromArray($style_col);
        $activeSheet->getStyle('H4')->applyFromArray($style_col);


        //mengatur weight pada cell
        $activeSheet->getColumnDimension('B')->setWidth(25);
        $activeSheet->getColumnDimension('C')->setWidth(25);
        $activeSheet->getColumnDimension('D')->setWidth(40);
        $activeSheet->getColumnDimension('E')->setWidth(25);
        $activeSheet->getColumnDimension('F')->setWidth(25);
        $activeSheet->getColumnDimension('G')->setWidth(25);
        $activeSheet->getColumnDimension('H')->setWidth(30);


        $filename = $title . '.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        die;
    }


    public function uploadTemplate()
    {
        //validation submit
        $input = $this->validate([
            'file_pengguna' => [
                'rules' => 'uploaded[file_pengguna]|ext_in[file_pengguna,xls,xlsx]',
                'errors' => [
                    'uploaded'  => 'Pilih file excel terlebih dahulu!',
                    'ext_in'   => 'Mohon pilih file dengan tipe excel!'
                ]
            ]
        ]);

        if (!$input) {
            return  redirect()->to(base_url('/pengguna'))->with('error', $this->validator->getError('file_pengguna'));
        }

        $fileExcel = $this->request->getFile('file_pengguna');

        // Excel Write
        require_once COMPOSER_PATH;
        $spreadsheetWrite = new Spreadsheet();
        $writer = IOFactory::createWriter($spreadsheetWrite, 'Xlsx');
        $activeSheet = $spreadsheetWrite->getActiveSheet();

        // Buat sebuah variabel untuk menampung pengaturan style judul
        $style_title = [
            'font' => [
                'bold'  => true,
                'size'  => 15,
                'name'  => 'Calibri'
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => [
                'bold' => true,
                'color' => [
                    'argb' => 'FFFFFF',
                ],
            ], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'outline' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border top dengan garis tipis
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '00985B',
                ],
                'endColor' => [
                    'argb' => '00985B',
                ],
            ]
        ];

        //judul
        $title = 'Status Proses Penambahan Pengguna ';
        $activeSheet->setCellValue('A2', $title); // Set kolom A1 dengan tulisan "DATA SISWA"
        $activeSheet->mergeCells('A2:H2'); // Set Merge Cell pada kolom A1 sampai F1
        $activeSheet->getStyle('A2')->applyFromArray($style_title);

        $activeSheet->setCellValue('A4', 'No');
        $activeSheet->setCellValue('B4', 'Nama Depan');
        $activeSheet->setCellValue('C4', 'Nama Belakang');
        $activeSheet->setCellValue('D4', 'Nama Lengkap');
        $activeSheet->setCellValue('E4', 'Email');
        $activeSheet->setCellValue('F4', 'Kata Sandi');
        $activeSheet->setCellValue('G4', 'Telepon');
        $activeSheet->setCellValue('H4', 'Provinsi');
        $activeSheet->setCellValue('I4', 'Status');
        $activeSheet->setCellValue('J4', 'Pesan');

        $activeSheet->getStyle('A4')->applyFromArray($style_col);
        $activeSheet->getStyle('B4')->applyFromArray($style_col);
        $activeSheet->getStyle('C4')->applyFromArray($style_col);
        $activeSheet->getStyle('D4')->applyFromArray($style_col);
        $activeSheet->getStyle('E4')->applyFromArray($style_col);
        $activeSheet->getStyle('F4')->applyFromArray($style_col);
        $activeSheet->getStyle('G4')->applyFromArray($style_col);
        $activeSheet->getStyle('H4')->applyFromArray($style_col);
        $activeSheet->getStyle('I4')->applyFromArray($style_col);
        $activeSheet->getStyle('J4')->applyFromArray($style_col);

        //mengatur weight pada cell
        $activeSheet->getColumnDimension('B')->setWidth(25);
        $activeSheet->getColumnDimension('C')->setWidth(25);
        $activeSheet->getColumnDimension('D')->setWidth(40);
        $activeSheet->getColumnDimension('E')->setWidth(25);
        $activeSheet->getColumnDimension('F')->setWidth(25);
        $activeSheet->getColumnDimension('G')->setWidth(25);
        $activeSheet->getColumnDimension('H')->setWidth(30);
        $activeSheet->getColumnDimension('I')->setWidth(20);
        $activeSheet->getColumnDimension('J')->setWidth(50);

        // Excel Read
        $spreadsheet = IOFactory::load($fileExcel);
        $sheet =  $spreadsheet->getActiveSheet()->toArray(-1, true, true, true);

        $username   = '';
        $firstname  = '';
        $lastname   = '';
        $fullname   = '';
        $email      = '';
        $password   = '';
        $telepon    = '';
        $provinsi   = '';
        $users = model(UserModel::class);

        // Proses multiple insert pengguna berdasarkan excel
        foreach ($sheet as $idx => $row) {

            //skip index sampai 4 tidak terpakai
            if ($idx <= 4) {
                continue;
            }
            $status     = '';
            $message    = '';
            $continue   = false;
            $username   = $this->generateRandomUsername();
            $firstname  = $row['B'];
            $lastname   = $row['C'];
            $fullname   = $row['D'];
            $email      = $row['E'];
            $password   = $row['F'];
            $telepon    = $row['G'];
            $provinsi   = $row['H'];

            $activeSheet->setCellValue('A' . $idx, $idx - 3);
            $activeSheet->setCellValue('B' . $idx, $firstname);
            $activeSheet->setCellValue('C' . $idx, $lastname);
            $activeSheet->setCellValue('D' . $idx, $fullname);
            $activeSheet->setCellValue('E' . $idx, $email);
            $activeSheet->setCellValue('F' . $idx, $password);
            $activeSheet->setCellValue('G' . $idx, $telepon);
            $activeSheet->setCellValue('H' . $idx, $provinsi);
            $activeSheet->setCellValue('I' . $idx, $status);
            $activeSheet->setCellValue('J' . $idx, $message);

            $result = $this->MoodyBest->createUser(
                $username, //username
                $password, //password
                $email, //email
                $firstname, //firstname
                $lastname, //lastname
                $provinsi, //provinsi
                "ID",
            );

            if (!empty($result['error'])) {
                // d($result['error']);
                $akunBest = $this->MoodyBest->getUserByEmail($email);
                if (!empty($akunBest['error'])) {
                    $status = 'Gagal';
                    $message = $akunBest['error'];
                    $continue = true;
                    // return redirect()->back()->withInput()->with('error', "Terjadi kesalahan dalam meproses akun Anda. Akun Anda mungkin sudah terdaftar.");
                    // dd($akunBest['error']);
                    // return redirect()->back()->withInput()->with('error', );
                } else {
                    $updateAkunBest = $this->MoodyBest->updateUser(
                        $akunBest['data']['userid'], //userid
                        $password, //password
                        $email, //email
                        $firstname, //firstname
                        $lastname, //lastname
                        $provinsi, //provinsi
                        "ID",
                    );

                    if (!empty($updateAkunBest['error'])) {
                        $status = 'Gagal';
                        $message = $updateAkunBest['error'];
                        $continue = true;

                        // return redirect()->back()->withInput()->with('error', "Terjadi kesalahan dalam singkronisasi akun Sipandu dan akun Best.");
                    }
                    // dd($updateakunBest);
                }
            }
            if ($continue) {
                $activeSheet->setCellValue('I' . $idx, $status);
                $activeSheet->setCellValue('J' . $idx, $message);
                continue;
            }
            // dd($issetUser);
            $user = new User(
                [
                    'username'         => $username,
                    'firstname'        => $firstname,
                    'lastname'         => $lastname,
                    'fullname'         => $fullname,
                    'email'            => $email,
                    'telepon'          => $telepon,
                    'provinsi'         => $provinsi,
                    'status_sistem'    => 'incomplete',
                ]
            );
            $user->setPassword($password);

            // Ensure default group gets assigned if set
            if (!empty($this->config->defaultUserGroup)) {
                $users = $users->withGroup($this->config->defaultUserGroup);
            }

            $userSipandu = $users->where('email', $email)->first();
            if (isset($userSipandu)) {
                if (!$users->update($userSipandu->toArray()['id'], array_diff_key($user->toArray(), array_flip(['email', 'status_sistem'])))) {
                    $status = 'Gagal';
                    $message = $users->errors();
                    // dd('failed update', $users->errors());
                    // return redirect()->back()->withInput()->with('errors', $users->errors());
                } else {
                    $status = 'Update';
                    $message = '';
                }
            } else {
                if (!$users->save($user)) {
                    $status = 'Gagal';
                    $message = $users->errors();
                    // dd('failed', $users->errors());
                    // return redirect()->back()->withInput()->with('errors', $users->errors());
                } else {
                    $status = 'Baru';
                    $message = '';
                }
            }

            $activeSheet->setCellValue('I' . $idx, $status);
            $activeSheet->setCellValue('J' . $idx, $message);
        }
        $filename = $title . '.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        die;
    }
}
