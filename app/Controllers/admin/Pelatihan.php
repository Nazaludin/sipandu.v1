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
use App\Libraries\UserLibrary;

class Pelatihan extends BaseController
{
    protected $MoodyBest;
    protected $UserLibrary;
    protected $pager;


    public function __construct()
    {
        // $apiKeyMoodle =  '6324f38717ff35569d486e633b0a31b1';
        $apiKeyMoody =  getenv('API_KEY_MOODY');
        $configBest = new Config("http://best-bapelkes.jogjaprov.go.id/webservice/rest/server.php", $apiKeyMoody);
        $this->MoodyBest = AppFactory::create($configBest);
        $this->UserLibrary = new UserLibrary($configBest);
        $this->pager = \Config\Services::pager();
    }

    // FUNNCITON UMUM
    public function toLocalTime($timestamp)
    {
        $time = Time::createFromTimestamp($timestamp, 'Asia/Jakarta');
        $bulan = ['Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $tgl = $time->toLocalizedString('dd --- yyyy');
        $tgl_formatted = str_replace("---", $bulan[$time->getMonth() - 1], $tgl);
        return $tgl_formatted;
    }

    public function dateToLocalTime($date)
    {
        $time = Time::parse($date, 'Asia/Jakarta');
        $bulan = ['Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $tgl = $time->toLocalizedString('dd --- yyyy');
        $tgl_formatted = str_replace("---", $bulan[$time->getMonth() - 1], $tgl);
        return $tgl_formatted;
    }

    public function toDMY($timestamp)
    {
        $time = Time::createFromTimestamp($timestamp, 'Asia/Jakarta');
        $tgl = $time->toDateString('Y-m-d');
        return $tgl;
    }

    function adjustTimeTo2359($timeString, $timezone = 'Asia/Jakarta')
    {
        // Convert the time string to a DateTime object
        $dateTime = new \DateTime($timeString, new \DateTimeZone($timezone));

        // Set the time to 23:59:59
        $dateTime->setTime(23, 59, 59);

        // Format the DateTime object back to string
        return $dateTime->format('Y-m-d H:i:s');
        // return $dateTime;
    }
    public function generateTo2359()
    {
        try {
            // Load semua data pelatihan
            $courseModel = model(CourseModel::class);
            $allCourses = $courseModel->findAll();

            // Loop melalui setiap data pelatihan
            foreach ($allCourses as $course) {
                // Mengubah endDate
                $course['enddate'] = $this->adjustTimeTo2359($course['enddate']);

                // Mengubah end_registration
                $course['end_registration'] = $this->adjustTimeTo2359($course['end_registration']);

                // Simpan perubahan ke dalam database
                $courseModel->update($course['id'], $course);

                try {
                    // Update course menggunakan MoodyBest
                    $dataBest = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field&field=id&value=' .   $course['id'] . ''));
                    $MoodyEdit = $this->MoodyBest->updateCourse(
                        $course['id'],
                        $dataBest->courses[0]->shortname,
                        $dataBest->courses[0]->fullname,
                        $dataBest->courses[0]->categoryid,
                        $dataBest->courses[0]->summary,
                        new \DateTime($course['startdate']),
                        new \DateTime($this->adjustTimeTo2359($course['enddate']))
                    );
                } catch (\Exception $e) {
                    // Tangani pengecualian di sini untuk MoodyBest->updateCourse()
                    // Contoh: Log pesan kesalahan
                    log_message('error', 'MoodyBest->updateCourse Exception: ' . $e->getMessage());
                    continue;
                }
            }
        } catch (\Exception $e) {
            // Tangani pengecualian di sini
            // Contoh: Log pesan kesalahan
            log_message('error', 'Exception: ' . $e->getMessage());
        }
    }
    public function deleteFileExists($filePath)
    {
        // Periksa apakah file ada
        if (file_exists($filePath)) {
            // Jika file ada, hapus file tersebut
            unlink($filePath);
        }

        return true;
    }

    // public function convertCondition($condition)
    // {
    //     $result = '';
    //     switch (true) {
    //         case $condition == 'coming':
    //             $result = 'Pendaftaran Belum Aktif';
    //             break;
    //         case $condition == 'going':
    //             $result = 'Pendaftaran Aktif';
    //             break;
    //         case $condition == 'passed':
    //             $result = 'Pendaftaran Telah Berakhir';
    //             break;

    //         default:
    //             $result = '';
    //             break;
    //     }
    //     return $result;
    // }
    public function convertCondition($condition, $id_pelatihan = null, $startregis = null, $endregis = null, $startdate = null, $enddate = null)
    {
        $now = now('Asia/Jakarta');
        // dd($now);
        // $nowTimestamp = $now->getTimestamp();
        $result = '';

        if (isset($id_pelatihan)) {
            switch (true) {
                case ($enddate <= $now):
                    $condition = 'passed';
                    $result = 'Pelatihan Berakhir';
                    break;
                case ($startdate <= $now):
                    $condition = 'begin';
                    $result = 'Pelatihan Dimulai';
                    break;
                case ($endregis <= $now):
                    $condition = 'end';
                    $result = 'Pendaftaran Berkahir';
                    break;
                case ($startregis <= $now):
                    $condition = 'going';
                    $result = 'Pendaftaran Aktif';
                    break;
                default:
                    $condition = 'coming';
                    $result = 'Pendaftaran Belum Aktif';
                    break;
            }

            model(CourseModel::class)->update($id_pelatihan, ['condition' => $condition]);
        } else {
            switch ($condition) {
                case 'coming':
                    $result = 'Pendaftaran Belum Aktif';
                    break;
                case 'going':
                    $result = 'Pendaftaran Aktif';
                    break;
                case 'end':
                    $result = 'Pendaftaran Berkahir';
                    break;
                case 'begin':
                    $result = 'Pelatihan Dimulai';
                    break;
                case 'passed':
                    $result = 'Pelatihan Berakhir';
                    break;
                default:
                    $result = '';
                    break;
            }
        }

        return $result;
    }
    public function convertStatusUserPelatihan($condition)
    {
        $result = '';
        switch (true) {
            case $condition == 'register':
                $result = 'Baru';
                break;
            case $condition == 'accept':
                $result = 'Diterima';
                break;
            case $condition == 'reject':
                $result = 'Ditolak';
                break;
            case $condition == 'revisi':
                $result = 'Revisi';
                break;

            default:
                $result = '';
                break;
        }
        return $result;
    }

    public function controlAPI($URL, $method = 'GET')
    {
        $body = [];
        $client = \Config\Services::curlrequest();
        $response = $client->request($method, $URL);
        if (strpos($response->header('content-type'), 'application/json') !== false) {
            $body = json_decode($response->getBody());
        }
        return $body;
    }
    public function moodleUrlAPI($function)
    {
        $apiKeyMoodle =  getenv('API_KEY_MOODLE_MOBILE');
        $url = 'http://best-bapelkes.jogjaprov.go.id/webservice/rest/server.php?wstoken=' . $apiKeyMoodle . $function . '&moodlewsrestformat=json';
        return $url;
    }



    // CODE PELATIHAN
    public function rekap($tipe)
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
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
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
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row_center = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'outline' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];

        $style_row_left = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
        //judul
        $title = $tipe == 1 ? 'Rekap Pelatihan ' . $bulan[date('n')] . ' Tahun ' . date('Y') : 'Rekap Pelatihan Tahun ' . date('Y');
        $activeSheet->setCellValue('A2', $title); // Set kolom A1 dengan tulisan "DATA SISWA"
        $activeSheet->mergeCells('A2:N2'); // Set Merge Cell pada kolom A1 sampai F1
        $activeSheet->getStyle('A2')->applyFromArray($style_title);

        $activeSheet->setCellValue('A4', 'No');
        $activeSheet->mergeCells('A4:A5');
        $activeSheet->setCellValue('B4', 'Nama Pelatihan');
        $activeSheet->mergeCells('B4:B5');
        $activeSheet->setCellValue('C4', 'Jenis Pelatihan');
        $activeSheet->mergeCells('C4:C5');
        $activeSheet->setCellValue('D4', 'Periode Pendaftaran');
        $activeSheet->mergeCells('D4:E4');
        $activeSheet->setCellValue('D5', 'Mulai Pendaftaran');
        $activeSheet->setCellValue('E5', 'Akhir Pendaftaran');
        $activeSheet->setCellValue('F4', 'Periode Pelatihan');
        $activeSheet->mergeCells('F4:G4');
        $activeSheet->setCellValue('F5', 'Mulai Pelatihan');
        $activeSheet->setCellValue('G5', 'Akhir Pelatihan');
        $activeSheet->setCellValue('H4', 'Angkatan');
        $activeSheet->mergeCells('H4:H5');
        $activeSheet->setCellValue('I4', 'Sasaran Pelatihan');
        $activeSheet->mergeCells('I4:I5');
        $activeSheet->setCellValue('J4', 'Tempat Pelaksanaan');
        $activeSheet->mergeCells('J4:J5');
        $activeSheet->setCellValue('K4', 'Kontak Person');
        $activeSheet->mergeCells('K4:K5');
        $activeSheet->setCellValue('L4', 'Kuota');
        $activeSheet->mergeCells('L4:L5');
        $activeSheet->setCellValue('M4', 'Metode');
        $activeSheet->mergeCells('M4:M5');
        $activeSheet->setCellValue('N4', 'Sumber Dana');
        $activeSheet->mergeCells('N4:N5');


        for ($i = 4; $i <= 5; $i++) {
            $activeSheet->getStyle('A' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('B' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('C' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('D' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('E' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('F' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('G' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('H' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('I' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('J' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('K' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('L' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('M' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('N' . $i)->applyFromArray($style_col);
        }

        // DATA
        if ($tipe == 1) {
            $data = model(CourseModel::class)->getDataCourseMonth();
        } else {
            $data = model(CourseModel::class)->getDataCourseYear();
        }
        $index = 6;
        foreach ($data as $dt => $value) {
            // DATA BEST
            $dataBest = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field&field=id&value=' . $value['id'] . ''));

            if (isset($dataBest->courses[0])) {
                $activeSheet->setCellValue('A' . $index, $index - 5);
                $activeSheet->setCellValue('B' . $index, $dataBest->courses[0]->fullname);
                $activeSheet->setCellValue('C' . $index, $dataBest->courses[0]->categoryname);
                $activeSheet->setCellValue('D' . $index, date('Y-m-d', strtotime($value['start_registration'])));
                $activeSheet->setCellValue('E' . $index, date('Y-m-d', strtotime($value['end_registration'])));
                $activeSheet->setCellValue('F' . $index, $this->toDMY($dataBest->courses[0]->startdate));
                $activeSheet->setCellValue('G' . $index, $this->toDMY($dataBest->courses[0]->enddate));
                $activeSheet->setCellValue('H' . $index, $value['batch']);
                $activeSheet->setCellValue('I' . $index, $value['target_participant']);
                $activeSheet->setCellValue('J' . $index, $value['place']);
                $activeSheet->setCellValue('K' . $index, $value['contact_person']);
                $activeSheet->setCellValue('L' . $index, $value['quota']);
                $activeSheet->setCellValue('M' . $index, $value['method']);
                $activeSheet->setCellValue('N' . $index, $value['source_funds']);
            }

            $activeSheet->getStyle('A' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('B' . $index)->applyFromArray($style_row_left);
            $activeSheet->getStyle('C' . $index)->applyFromArray($style_row_left);
            $activeSheet->getStyle('D' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('E' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('F' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('G' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('H' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('I' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('J' . $index)->applyFromArray($style_row_left);
            $activeSheet->getStyle('K' . $index)->applyFromArray($style_row_left);
            $activeSheet->getStyle('L' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('M' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('N' . $index)->applyFromArray($style_row_center);
            $index++;
        }

        //mengatur warptext disetiap kolom
        foreach (range('A', $activeSheet->getHighestDataColumn()) as $col) {
            $activeSheet->getStyle($col)->getAlignment()->setWrapText(true);
        }

        //mengatur weight pada cell
        $activeSheet->getColumnDimension('B')->setWidth(25);
        $activeSheet->getColumnDimension('C')->setWidth(25);
        $activeSheet->getColumnDimension('D')->setWidth(25);
        $activeSheet->getColumnDimension('E')->setWidth(25);
        $activeSheet->getColumnDimension('F')->setWidth(25);
        $activeSheet->getColumnDimension('G')->setWidth(25);
        $activeSheet->getColumnDimension('I')->setWidth(20);
        $activeSheet->getColumnDimension('J')->setWidth(25);
        $activeSheet->getColumnDimension('K')->setWidth(25);
        $activeSheet->getColumnDimension('L')->setWidth(15);
        $activeSheet->getColumnDimension('M')->setWidth(15);
        $activeSheet->getColumnDimension('N')->setWidth(15);

        $filename = $title . '.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        die;
    }
    public function testRekap()
    {
        require_once COMPOSER_PATH;
        $spreadsheet = new Spreadsheet();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $activeSheet = $spreadsheet->getActiveSheet();

        $tipe = 1;
        // Buat sebuah variabel untuk menampung pengaturan style judul
        $style_title = [
            'font' => [
                'bold'  => true,
                'size'  => 15,
                'name'  => 'Calibri'
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
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
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row_center = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'outline' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];

        $style_row_left = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
        //judul
        $title = $tipe == 1 ? 'Rekap Pelatihan ' . $bulan[date('n')] . ' Tahun ' . date('Y') : 'Rekap Pelatihan Tahun ' . date('Y');
        $activeSheet->setCellValue('A2', $title); // Set kolom A1 dengan tulisan "DATA SISWA"
        $activeSheet->mergeCells('A2:N2'); // Set Merge Cell pada kolom A1 sampai F1
        $activeSheet->getStyle('A2')->applyFromArray($style_title);

        $activeSheet->setCellValue('A4', 'No');
        $activeSheet->mergeCells('A4:A5');
        $activeSheet->setCellValue('B4', 'Nama Pelatihan');
        $activeSheet->mergeCells('B4:B5');
        $activeSheet->setCellValue('C4', 'Jenis Pelatihan');
        $activeSheet->mergeCells('C4:C5');
        $activeSheet->setCellValue('D4', 'Periode Pendaftaran');
        $activeSheet->mergeCells('D4:E4');
        $activeSheet->setCellValue('D5', 'Mulai Pendaftaran');
        $activeSheet->setCellValue('E5', 'Akhir Pendaftaran');
        $activeSheet->setCellValue('F4', 'Periode Pelatihan');
        $activeSheet->mergeCells('F4:G4');
        $activeSheet->setCellValue('F5', 'Mulai Pelatihan');
        $activeSheet->setCellValue('G5', 'Akhir Pelatihan');
        $activeSheet->setCellValue('H4', 'Angkatan');
        $activeSheet->mergeCells('H4:H5');
        $activeSheet->setCellValue('I4', 'Sasaran Pelatihan');
        $activeSheet->mergeCells('I4:I5');
        $activeSheet->setCellValue('J4', 'Tempat Pelaksanaan');
        $activeSheet->mergeCells('J4:J5');
        $activeSheet->setCellValue('K4', 'Kontak Person');
        $activeSheet->mergeCells('K4:K5');
        $activeSheet->setCellValue('L4', 'Kuota');
        $activeSheet->mergeCells('L4:L5');
        $activeSheet->setCellValue('M4', 'Metode');
        $activeSheet->mergeCells('M4:M5');
        $activeSheet->setCellValue('N4', 'Sumber Dana');
        $activeSheet->mergeCells('N4:N5');


        for ($i = 4; $i <= 5; $i++) {
            $activeSheet->getStyle('A' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('B' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('C' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('D' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('E' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('F' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('G' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('H' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('I' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('J' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('K' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('L' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('M' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('N' . $i)->applyFromArray($style_col);
        }

        // DATA
        $data = model(CourseModel::class)->getDataCourseMonth();

        $index = 6;
        foreach ($data as $dt => $value) {
            // DATA BEST
            $dataBest = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field&field=id&value=' . $value['id'] . ''));

            $activeSheet->setCellValue('A' . $index, $index - 5);
            $activeSheet->setCellValue('B' . $index, $dataBest->courses[0]->fullname);
            $activeSheet->setCellValue('C' . $index, $dataBest->courses[0]->categoryname);
            $activeSheet->setCellValue('D' . $index, date('Y-m-d', strtotime($value['start_registration'])));
            $activeSheet->setCellValue('E' . $index, date('Y-m-d', strtotime($value['end_registration'])));
            $activeSheet->setCellValue('F' . $index, $this->toDMY($dataBest->courses[0]->startdate));
            $activeSheet->setCellValue('G' . $index, $this->toDMY($dataBest->courses[0]->enddate));
            $activeSheet->setCellValue('H' . $index, $value['batch']);
            $activeSheet->setCellValue('I' . $index, $value['target_participant']);
            $activeSheet->setCellValue('J' . $index, $value['place']);
            $activeSheet->setCellValue('K' . $index, $value['contact_person']);
            $activeSheet->setCellValue('L' . $index, $value['quota']);
            $activeSheet->setCellValue('M' . $index, $value['method']);
            $activeSheet->setCellValue('N' . $index, $value['source_funds']);

            $activeSheet->getStyle('A' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('B' . $index)->applyFromArray($style_row_left);
            $activeSheet->getStyle('C' . $index)->applyFromArray($style_row_left);
            $activeSheet->getStyle('D' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('E' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('F' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('G' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('H' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('I' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('J' . $index)->applyFromArray($style_row_left);
            $activeSheet->getStyle('K' . $index)->applyFromArray($style_row_left);
            $activeSheet->getStyle('L' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('M' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('N' . $index)->applyFromArray($style_row_center);
            $index++;
        }

        //mengatur warptext disetiap kolom
        foreach (range('A', $activeSheet->getHighestDataColumn()) as $col) {
            $activeSheet->getStyle($col)->getAlignment()->setWrapText(true);
        }

        //mengatur weight pada cell
        $activeSheet->getColumnDimension('B')->setWidth(25);
        $activeSheet->getColumnDimension('C')->setWidth(25);
        $activeSheet->getColumnDimension('D')->setWidth(25);
        $activeSheet->getColumnDimension('E')->setWidth(25);
        $activeSheet->getColumnDimension('F')->setWidth(25);
        $activeSheet->getColumnDimension('G')->setWidth(25);
        $activeSheet->getColumnDimension('I')->setWidth(20);
        $activeSheet->getColumnDimension('J')->setWidth(25);
        $activeSheet->getColumnDimension('K')->setWidth(25);
        $activeSheet->getColumnDimension('L')->setWidth(15);
        $activeSheet->getColumnDimension('M')->setWidth(15);
        $activeSheet->getColumnDimension('N')->setWidth(15);

        $filename = $title . '.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        die;
    }
    // CODE PELATIHAN
    public function rekapPengguna($id_pelatihan, $tipe)
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
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row_center = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'outline' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];

        $style_row_left = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // $bulan = [
        //     1 => 'Januari',
        //     2 => 'Februari',
        //     3 => 'Maret',
        //     4 => 'April',
        //     5 => 'Mei',
        //     6 => 'Juni',
        //     7 => 'Juli',
        //     8 => 'Agustus',
        //     9 => 'September',
        //     10 => 'Oktober',
        //     11 => 'November',
        //     12 => 'Desember',
        // ];
        $pelatihan = model(CourseModel::class)->find($id_pelatihan);
        // $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field&field=id&value=' . $id_pelatihan . ''));
        // dd($pelatihan, $dataPelatihan);
        //judul
        $title = 'Rekap Pendaftar';
        if (isset($pelatihan['fullname'])) {
            $title = 'Rekap Pendaftar ' .   ucwords((string)$pelatihan['fullname']);
        }
        $activeSheet->setCellValue('A2', $title); // Set kolom A1 dengan tulisan "DATA SISWA"
        $activeSheet->mergeCells('A2:AD2'); // Set Merge Cell pada kolom A1 sampai F1
        $activeSheet->getStyle('A2')->applyFromArray($style_title);

        $activeSheet->setCellValue('A4', 'No');
        $activeSheet->mergeCells('A4:A5');
        $activeSheet->setCellValue('B4', 'Nama Lengkap');
        $activeSheet->mergeCells('B4:B5');
        $activeSheet->setCellValue('C4', 'NIK');
        $activeSheet->mergeCells('C4:C5');
        $activeSheet->setCellValue('D4', 'NIP');
        $activeSheet->mergeCells('D4:D5');
        $activeSheet->setCellValue('E4', 'NRP');
        $activeSheet->mergeCells('E4:E5');
        $activeSheet->setCellValue('F4', 'Nomor STR');
        $activeSheet->mergeCells('F4:F5');
        $activeSheet->setCellValue('G4', 'Jenis Kelamin');
        $activeSheet->mergeCells('G4:G5');
        $activeSheet->setCellValue('H4', 'Tempat Lahir');
        $activeSheet->mergeCells('H4:H5');
        $activeSheet->setCellValue('I4', 'Tanggal Lahir');
        $activeSheet->mergeCells('I4:I5');
        $activeSheet->setCellValue('J4', 'Agama');
        $activeSheet->mergeCells('J4:J5');
        $activeSheet->setCellValue('K4', 'Email');
        $activeSheet->mergeCells('K4:K5');
        $activeSheet->setCellValue('L4', 'Telepon');
        $activeSheet->mergeCells('L4:L5');
        $activeSheet->setCellValue('M4', 'Alamat Domisili');
        $activeSheet->mergeCells('M4:Q4');
        $activeSheet->setCellValue('M5', 'Nama Jalan');
        $activeSheet->setCellValue('N5', 'Desa');
        $activeSheet->setCellValue('O5', 'Kecamatan');
        $activeSheet->setCellValue('P5', 'Kabutapen/Kota');
        $activeSheet->setCellValue('Q5', 'Provinsi');
        // $activeSheet->mergeCells('L4:L5');
        $activeSheet->setCellValue('R4', "Pendidikan \rTerakhir");
        $activeSheet->mergeCells('R4:R5');
        $activeSheet->setCellValue('S4', 'Jurusan');
        $activeSheet->mergeCells('S4:S5');
        $activeSheet->setCellValue('T4', 'Jabatan / Pekerjaan');
        $activeSheet->mergeCells('T4:T5');
        $activeSheet->setCellValue('U4', 'Tipe Pegawai');
        $activeSheet->mergeCells('U4:U5');
        $activeSheet->setCellValue('V4', 'Jenis Nakes');
        $activeSheet->mergeCells('V4:V5');
        $activeSheet->setCellValue('W4', 'Pangkat/Golongan');
        $activeSheet->mergeCells('W4:W5');
        $activeSheet->setCellValue('X4', 'Nama Instansi');
        $activeSheet->mergeCells('X4:X5');
        $activeSheet->setCellValue('Y4', 'Alamat Instansi');
        $activeSheet->mergeCells('Y4:AC4');
        $activeSheet->setCellValue('Y5', 'Nama Jalan');
        $activeSheet->setCellValue('Z5', 'Desa');
        $activeSheet->setCellValue('AA5', 'Kecamatan');
        $activeSheet->setCellValue('AB5', 'Kabutapen/Kota');
        $activeSheet->setCellValue('AC5', 'Provinsi');
        $activeSheet->setCellValue('AD4', 'Status Pelatihan');
        $activeSheet->mergeCells('AD4:AD5');


        for ($i = 4; $i <= 5; $i++) {
            $activeSheet->getStyle('A' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('B' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('C' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('D' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('E' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('F' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('G' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('H' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('I' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('J' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('K' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('L' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('M' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('N' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('O' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('P' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('Q' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('R' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('S' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('T' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('U' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('V' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('W' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('X' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('Y' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('Z' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('AA' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('AB' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('AC' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('AD' . $i)->applyFromArray($style_col);
        }

        // DATA
        if ($tipe == 1) {
            $data = model(UserCourseModel::class)->where('id_course', $id_pelatihan)->whereIn('status', ['accept', 'passed'])->findAll();
            $data_final = [];
            foreach ($data as $key => $value) {
                try {
                    if (isset($value['id_user'])) {
                        $data_user = model(UserModel::class)->find($value['id_user']);
                        $data_final[$key] = $data_user->toArray();
                        $data_final[$key]['status_pelatihan'] = $value['status'];
                    }
                } catch (\Throwable $exception) {
                    continue;
                }
            }
        } else {
            $data = model(UserCourseModel::class)->where('id_course', $id_pelatihan)->findAll();
            $data_final = [];
            foreach ($data as $key => $value) {
                try {
                    if (isset($value['id_user'])) {
                        $data_user = model(UserModel::class)->find($value['id_user']);
                        $data_final[$key] = $data_user->toArray();
                        $data_final[$key]['status_pelatihan'] = $value['status'];
                    }
                } catch (\Throwable $exception) {
                    continue;
                }
            }
        }
        $index = 6;
        // dd($data_final);
        if (!empty($data_final)) {
            foreach ($data_final as $dt => $value) {
                $activeSheet->setCellValue('A' . $index, $index - 5);
                $activeSheet->setCellValue('B' . $index,  $value['fullname']);
                $activeSheet->setCellValueExplicit('C' . $index, (string) $value['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $activeSheet->setCellValueExplicit('D' . $index, (string) $value['nip'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $activeSheet->setCellValueExplicit('E' . $index, (string) $value['nrp'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $activeSheet->setCellValueExplicit('F' . $index, (string) $value['nomor_str'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $activeSheet->setCellValue('G' . $index, $value['jenis_kelamin']);
                $activeSheet->setCellValue('H' . $index, $value['tempat_lahir']);
                $activeSheet->setCellValue('I' . $index, $value['tanggal_lahir']);
                $activeSheet->setCellValue('J' . $index, $value['agama']);
                $activeSheet->setCellValue('K' . $index, $value['email']);
                $activeSheet->setCellValueExplicit('L' . $index, (string) $value['telepon'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $activeSheet->setCellValue('M' . $index, $value['nama_jalan_domisili']);
                $activeSheet->setCellValue('N' . $index, $value['desa_domisili']);
                $activeSheet->setCellValue('O' . $index, $value['kecamatan_domisili']);
                $activeSheet->setCellValue('P' . $index, $value['kabupaten_domisili']);
                $activeSheet->setCellValue('Q' . $index, $value['provinsi_domisili']);
                $activeSheet->setCellValue('R' . $index, $value['pendidikan_terakhir']);
                $activeSheet->setCellValue('S' . $index, $value['jurusan']);
                $activeSheet->setCellValue('T' . $index, $value['jabatan']);
                $activeSheet->setCellValue('U' . $index, $value['tipe_pegawai']);
                $activeSheet->setCellValue('V' . $index, $value['jenis_nakes']);
                $activeSheet->setCellValue('W' . $index, $value['pangkat_golongan']);
                $activeSheet->setCellValue('X' . $index, $value['nama_instansi']);
                $activeSheet->setCellValue('Y' . $index, $value['nama_jalan_instansi']);
                $activeSheet->setCellValue('Z' . $index, $value['desa_instansi']);
                $activeSheet->setCellValue('AA' . $index, $value['kecamatan_instansi']);
                $activeSheet->setCellValue('AB' . $index, $value['kabupaten_instansi']);
                $activeSheet->setCellValue('AC' . $index, $value['provinsi_instansi']);
                switch ($value['status_pelatihan']) {
                    case 'register':
                        $activeSheet->setCellValue('AD' . $index, 'Mendaftar');
                        // break;
                    case 'accept':
                        $activeSheet->setCellValue('AD' . $index, 'Diterima');
                        // break;
                    case 'reject':
                        $activeSheet->setCellValue('AD' . $index, 'Ditolak');
                        // break;
                    case 'revisi':
                        $activeSheet->setCellValue('AD' . $index, 'Revisi');
                        // break;
                    case 'renew':
                        $activeSheet->setCellValue('AD' . $index, 'Perbaikan');
                        // break;
                    case 'passed':
                        $activeSheet->setCellValue('AD' . $index, 'Diterima');
                        // break;
                    default:
                        $activeSheet->setCellValue('AD' . $index, '');
                        // break;
                }
            }

            $activeSheet->getStyle('A' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('B' . $index)->applyFromArray($style_row_left);
            $activeSheet->getStyle('C' . $index)->applyFromArray($style_row_left);
            $activeSheet->getStyle('D' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('E' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('F' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('G' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('H' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('I' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('J' . $index)->applyFromArray($style_row_left);
            $activeSheet->getStyle('K' . $index)->applyFromArray($style_row_left);
            $activeSheet->getStyle('L' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('M' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('N' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('O' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('P' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('Q' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('R' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('S' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('T' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('U' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('V' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('W' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('X' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('Y' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('Z' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('AA' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('AB' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('AC' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('AD' . $index)->applyFromArray($style_row_center);

            $activeSheet->getCell('C' . $index)->getIgnoredErrors()->setNumberStoredAsText(true);
            $activeSheet->getCell('D' . $index)->getIgnoredErrors()->setNumberStoredAsText(true);
            $activeSheet->getCell('E' . $index)->getIgnoredErrors()->setNumberStoredAsText(true);
            $activeSheet->getCell('F' . $index)->getIgnoredErrors()->setNumberStoredAsText(true);
            $activeSheet->getCell('L' . $index)->getIgnoredErrors()->setNumberStoredAsText(true);
            $index++;
        }

        //mengatur warptext disetiap kolom
        foreach (range('A', $activeSheet->getHighestDataColumn()) as $col) {
            $activeSheet->getStyle($col)->getAlignment()->setWrapText(true);
        }

        // //mengatur weight pada cell
        $activeSheet->getColumnDimension('B')->setWidth(30);
        $activeSheet->getColumnDimension('C')->setWidth(30);
        $activeSheet->getColumnDimension('D')->setWidth(30);
        $activeSheet->getColumnDimension('E')->setWidth(30);
        $activeSheet->getColumnDimension('F')->setWidth(30);
        $activeSheet->getColumnDimension('G')->setWidth(15);
        $activeSheet->getColumnDimension('H')->setWidth(20);
        $activeSheet->getColumnDimension('I')->setWidth(20);
        $activeSheet->getColumnDimension('J')->setWidth(20);
        $activeSheet->getColumnDimension('K')->setWidth(30);
        $activeSheet->getColumnDimension('L')->setWidth(30);
        $activeSheet->getColumnDimension('M')->setWidth(40);
        $activeSheet->getColumnDimension('N')->setWidth(25);
        $activeSheet->getColumnDimension('O')->setWidth(25);
        $activeSheet->getColumnDimension('P')->setWidth(25);
        $activeSheet->getColumnDimension('Q')->setWidth(25);
        $activeSheet->getColumnDimension('R')->setWidth(15);
        $activeSheet->getColumnDimension('S')->setWidth(20);
        $activeSheet->getColumnDimension('T')->setWidth(20);
        $activeSheet->getColumnDimension('U')->setWidth(20);
        $activeSheet->getColumnDimension('V')->setWidth(15);
        $activeSheet->getColumnDimension('W')->setWidth(20);
        $activeSheet->getColumnDimension('X')->setWidth(20);
        $activeSheet->getColumnDimension('Y')->setWidth(40);
        $activeSheet->getColumnDimension('Z')->setWidth(25);
        $activeSheet->getColumnDimension('AA')->setWidth(25);
        $activeSheet->getColumnDimension('AB')->setWidth(25);
        $activeSheet->getColumnDimension('AC')->setWidth(25);
        $activeSheet->getColumnDimension('AD')->setWidth(25);

        $filename = $title . '.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        die;
    }
    public function pelatihan()
    {
        // dd($MoodyUser = $this->UserLibrary->getUserIdByEmail('ludinnaza344@gmail.com'));
        // $result = $this->MoodyBest->getUserByEmail("admsipandu@gmail.com");
        // var_dump($result);
        // $result = model(CourseModel::class)->getDataCourseYear();
        // dd($result);
        // $result = $this->MoodyBest->enrolUserToCourse("203", "2821", Contract::ROLE_ID_STUDENT);
        // $result = $this->MoodyBest->getEnroledUsersByCourseId("203");
        // var_dump($result);

        // Data Pelatihan API
        // $pelatihan = model(CourseModel::class)->findAll();

        $courseModel = model(CourseModel::class);
        $perPage = 10; // Number of items per page
        // Get paginated data
        $pelatihan = $courseModel->orderBy('start_registration', 'desc')->paginate($perPage, 'group1'); // 'group1' is a named group
        $pager = $courseModel->pager;


        if (!empty($pelatihan)) {
            $now = new Time('now', 'Asia/Jakarta');
            // $now = Time::createFromFormat('j-M-Y', '1-Jul-2023', 'Asia/Jakarta');
            // $year = Time::createFromFormat('j-M-Y', '1-Jan-' . $now->getYear(), 'Asia/Jakarta');
            $dataPelatihan = [];
            foreach ($pelatihan as $key => $value) {
                // Data Pelatihan API
                // d($value['condition']);
                // d($value, $dataPelatihan);
                $value['condition']               = isset($value['condition']) ? $this->convertCondition(
                    $value['condition'],
                    $value['id'],
                    isset($value['start_registration']) ? strtotime($value['start_registration']) : null,
                    isset($value['end_registration']) ? strtotime($value['end_registration']) : null,
                    isset($value['startdate']) ? $value['startdate'] : null,
                    isset($value['enddate']) ? $value['enddate'] : null,
                ) : '';
                $value['start_registration']      = isset($value['start_registration']) ? $this->dateToLocalTime($value['start_registration']) : '';
                $value['end_registration']        = isset($value['end_registration']) ? $this->dateToLocalTime($value['end_registration']) :  '';
                $value['target_participant']      = $value['target_participant'] ?? '';
                $value['batch']                   = $value['batch'] ?? '';
                $value['quota']                   = $value['quota'] ?? '';
                $value['place']                   = $value['place'] ?? '';
                $value['contact_person']          = $value['contact_person'] ?? '';
                $value['schedule_file']           = $value['schedule_file'] ?? '';
                $value['startdatetime']           = isset($value['startdate']) ? $this->toLocalTime(strtotime($value['startdate'])) : '';
                $value['enddatetime']             = isset($value['enddate']) ? $this->toLocalTime(strtotime($value['enddate'])) : '';
                $value['registrar']               = model(UserCourseModel::class)->where('id_course', $value['id'])->where('status', 'register')->countAllResults();
                $value['accepted_participant']    = model(UserCourseModel::class)->where('id_course', $value['id'])->whereIn('status', ['accept', 'passed'])->countAllResults();
                $value['participant']             = model(UserCourseModel::class)->where('id_course', $value['id'])->countAllResults();
                array_push($dataPelatihan, $value);
                // $pelatihan['courses'][$key]   = $dataPelatihan->courses[0];
            }
            // dd($pelatihan);
            // $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field&field=id&value=' . $value['id'] . ''));
            // foreach ($pelatihan as $key => $value) {
            //     // Data Pelatihan API
            //     $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field&field=id&value=' . $value['id'] . ''));
            //     // d($value['condition']);
            //     // d($value, $dataPelatihan);
            //     $dataPelatihan->courses[0]->condition               = isset($value['condition']) ? $this->convertCondition(
            //         $value['condition'],
            //         $value['id'],
            //         isset($value['start_registration']) ? strtotime($value['start_registration']) : null,
            //         isset($value['end_registration']) ? strtotime($value['end_registration']) : null,
            //         isset($dataPelatihan->courses[0]->startdate) ? $dataPelatihan->courses[0]->startdate : null,
            //         isset($dataPelatihan->courses[0]->enddate) ? $dataPelatihan->courses[0]->enddate : null,
            //     ) : '';
            //     $dataPelatihan->courses[0]->start_registration      = isset($value['start_registration']) ? $this->dateToLocalTime($value['start_registration']) : '';
            //     $dataPelatihan->courses[0]->end_registration        = isset($value['end_registration']) ? $this->dateToLocalTime($value['end_registration']) :  '';
            //     $dataPelatihan->courses[0]->target_participant      = $value['target_participant'] ?? '';
            //     $dataPelatihan->courses[0]->batch                   = $value['batch'] ?? '';
            //     $dataPelatihan->courses[0]->quota                   = $value['quota'] ?? '';
            //     $dataPelatihan->courses[0]->place                   = $value['place'] ?? '';
            //     $dataPelatihan->courses[0]->contact_person          = $value['contact_person'] ?? '';
            //     $dataPelatihan->courses[0]->schedule_file           = $value['schedule_file'] ?? '';
            //     $dataPelatihan->courses[0]->startdatetime           = isset($dataPelatihan->courses[0]->startdate) ? $this->toLocalTime($dataPelatihan->courses[0]->startdate) : '';
            //     $dataPelatihan->courses[0]->enddatetime             = isset($dataPelatihan->courses[0]->enddate) ? $this->toLocalTime($dataPelatihan->courses[0]->enddate) : '';
            //     $dataPelatihan->courses[0]->registrar               = model(UserCourseModel::class)->where('id_course', $value['id'])->where('status', 'register')->countAllResults();
            //     $dataPelatihan->courses[0]->accepted_participant    = model(UserCourseModel::class)->where('id_course', $value['id'])->whereIn('status', ['accept', 'passed'])->countAllResults();
            //     $dataPelatihan->courses[0]->participant             = model(UserCourseModel::class)->where('id_course', $value['id'])->countAllResults();
            //     $pelatihan['courses'][$key]   = $dataPelatihan->courses[0];
            // }
        }
        // dd($pelatihan);
        // dd($dataPelatihan);
        $data['pelatihan'] = $dataPelatihan;

        $data['pager'] =   $pager;
        // $data['pelatihan'] = isset($dataPelatihan) ? json_encode($dataPelatihan) : json_encode([]);
        // dd($data, empty(json_decode($data['pelatihan'])));
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('admin/pelatihan/index')
            . view('layout/footer');
    }

    // BACKUP PELATIHAN
    // public function pelatihan()
    // {
    //     // dd();
    //     $result = $this->MoodyBest->getUserByEmail("admsipandu@gmail.com");
    //     var_dump($result);
    //     // dd($result);
    //     // $result = $this->MoodyBest->enrolUserToCourse("203", "2821", Contract::ROLE_ID_STUDENT);
    //     $result = $this->MoodyBest->getEnroledUsersByCourseId("203");
    //     var_dump($result);

    //     // Data Pelatihan API
    //     $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field'));
    //     // dd($dataPelatihan);

    //     $pelatihan = [];
    //     $i = 0;

    //     // $now = new Time('now', 'Asia/Jakarta');
    //     $now = Time::createFromFormat('j-M-Y', '1-Jul-2023', 'Asia/Jakarta');
    //     foreach ($dataPelatihan->courses as $key => $value) {
    //         if ($now->getTimestamp() < $value->startdate) {
    //             $value->startdatetime   = $this->toLocalTime($value->startdate);
    //             $value->enddatetime     = $this->toLocalTime($value->enddate);

    //             $courseLocal = model(CourseModel::class)->find($value->id);
    //             $value->condition           = isset($courseLocal['condition']) ? $this->convertCondition($courseLocal['condition']) : '';
    //             $value->start_registration  = isset($courseLocal['start_registration']) ? $this->dateToLocalTime($courseLocal['start_registration']) : '';
    //             $value->end_registration    = isset($courseLocal['end_registration']) ? $this->dateToLocalTime($courseLocal['end_registration']) : '';
    //             $value->batch               = $courseLocal['batch'] ?? '';
    //             $value->quota               = $courseLocal['quota'] ?? '';
    //             $value->registrar           = model(UserCourseModel::class)->where('id_course', $value->id)->where('status', 'register')->countAllResults();
    //             $value->participant         = model(UserCourseModel::class)->where('id_course', $value->id)->countAllResults();

    //             $pelatihan['courses'][$i] = $value;
    //             $i++;
    //         }
    //     }

    //     $data['pelatihan'] = json_encode($pelatihan);
    //     // dd($data);
    //     return view('layout/header', $data)
    //         . view('layout/sidebar')
    //         . view('admin/pelatihan/index')
    //         . view('layout/footer');
    // }

    // Menu Insert
    public function pelatihanInsert()
    {
        $categoryPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_categories'));
        $data['kategori_pelatihan']      = $categoryPelatihan;
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('admin/pelatihan/insert')
            . view('layout/footer');
    }
    public function pelatihanDelete($id_pelatihan)
    {
        $delete_best =  $this->request->getPost('delete_best');
        if (isset($delete_best)) {
            $MoodyDelete = $this->MoodyBest->deleteCourse($id_pelatihan);
            if (!empty($MoodyDelete['error'])) {
                return redirect()->to(base_url('pelatihan'))->withInput()->with('error', 'Pelatihan Moodle ' . $MoodyDelete['error']['message']);
            }
        }

        model(CourseModel::class)->delete($id_pelatihan);
        return redirect()->to(base_url('pelatihan'))->withInput()->with('message', 'Pelatihan berhasil dihapus!');
    }

    public function getCategoryById($id)
    {
        $category = '';
        $categoryPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_categories'));
        foreach ($categoryPelatihan as $key => $value) {
            if ($value->id == $id) {
                $category = $value->name;
                break;
            }
        }
        return $category;
    }

    public function pelatihanInsertProses()
    {
        $data =  $this->request->getPost();
        // dd($data);
        $file_schedule =  $this->request->getFile('jadwal');

        // Insert Course Moodle Best
        $result = $this->MoodyBest->createCourse(
            $data['shortname'],
            $data['fullname'],
            $data['categoryid'],
            $data['summary'],
            new \DateTime($data['startdate']),
            new \DateTime($this->adjustTimeTo2359($data['enddate']))
        );

        // dd($categoryPelatihan, $category);
        // Insert Course to Lokal Databases
        if (!empty($result['data'])) {
            $dataLokal = [
                // 'id'                    => 202,
                // Belum ada di db
                'shortname'             => $data['shortname'],
                'fullname'             => $data['fullname'],
                'category'             => $this->getCategoryById($data['categoryid']),
                'categoryid'             => $data['categoryid'],
                'summary'             => $data['summary'],

                'startdate'             => $data['startdate'],
                'enddate'               => $this->adjustTimeTo2359($data['enddate']),
                'id'                    => $result['data']['courseid'],
                'condition'             => 'coming',
                'place'                 => $data['place'],
                'start_registration'    => $data['start_registration'],
                'end_registration'      => $this->adjustTimeTo2359($data['end_registration']),
                'target_participant'    => $data['target_participant'],
                'batch'                 => intval($data['batch']),
                'quota'                 => intval($data['quota']),
                'contact_person'        => $data['contact_person'],
                'source_funds'          => $data['source_funds'],
                'method'                => $data['method'],
                'status_sistem'         => 'create',
            ];

            if (isset($file_schedule)) {
                $rules = [
                    'jadwal' => [
                        'uploaded[jadwal]',
                        'mime_in[jadwal,application/pdf]',
                        'max_size[jadwal,5096]',
                    ],
                ];
                $message = [
                    'jadwal' => [
                        'uploaded' => 'File gagal terupload, silahkan coba lagi!',
                        'mime_in' => 'Jenis berkas yang Anda upload tidak sesuai!',
                        'max_size' => 'Upload dokumen gagal! Size dokumen melebihi 5MB!'
                    ]
                ];
                if ($this->validate($rules, $message)) {
                    if ($file_schedule->isValid() && !($file_schedule->hasMoved())) {

                        $newName = $file_schedule->getRandomName();
                        $path = 'uploads/dokumen';

                        $file_schedule->move(FCPATH . $path, $newName);

                        $dataLokal['schedule_file_name']     = $file_schedule->getClientName();
                        $dataLokal['schedule_file_location'] = $path . '/' . $newName;
                    }
                } else {
                    if (isset($result['data']['courseid'])) {
                        $MoodyDelete = $this->MoodyBest->deleteCourse($result['data']['courseid']);
                        if (!empty($MoodyDelete['error'])) {
                            return redirect()->to(base_url('pelatihan'))->withInput()->with('error', 'Terjadi Kesalahan Sistem, silahkan coba lagi!');
                        }
                    }
                    return redirect()->to(base_url('pelatihan/insert'))->withInput()->with('error', $this->validator->getError('jadwal'));
                }
            }
            $status = model(CourseModel::class)->insert($dataLokal);
            // dd($status);
            return redirect()->to(base_url('pelatihan/insert/syarat/' . $result['data']['courseid']))->withInput();
        } else {
            return redirect()->to(base_url('pelatihan/insert/'))->withInput()->with('error', $result['error']['message']);
        }
        return redirect()->back();
    }


    public function pelatihanInsertRule($id_pelatihan)
    {
        $data['list_course_donwload_document'] = $this->listCourseDonwloadDocument($id_pelatihan);
        $data['list_course_upload_document'] = $this->listCourseUploadDocument($id_pelatihan);

        $dataDownloadDocument = model(DownloadDocumentModel::class)->findAll();
        $dataUploadDocument = model(UploadDocumentModel::class)->findAll();

        $tempDD = [];
        if (!empty($data['list_course_donwload_document'])) {
            foreach ($dataDownloadDocument as $keyDD => $valueDD) {
                foreach ($data['list_course_donwload_document'] as $keyCDD => $valueCDD) {
                    if ($valueDD['id'] == $valueCDD['id']) {
                        $valueDD['check'] = true;
                    }
                }
                array_push($tempDD, $valueDD);
            }
        }
        $tempUD = [];
        if (!empty($data['list_course_donwload_document'])) {
            foreach ($dataUploadDocument as $keyUD => $valueUD) {
                foreach ($data['list_course_upload_document'] as $keyCUD => $valueCUD) {
                    if ($valueUD['id'] == $valueCUD['id']) {
                        $valueUD['check'] = true;
                    }
                }
                array_push($tempUD, $valueUD);
            }
        }

        $data['list_donwload_document'] = (!empty($tempDD)) ? $tempDD : $dataDownloadDocument;
        $data['list_upload_document'] = (!empty($tempUD)) ? $tempUD : $dataUploadDocument;
        $data['id_pelatihan'] = $id_pelatihan;

        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('admin/pelatihan/insert_syarat')
            . view('layout/footer');
    }


    public function pelatihanInsertPublish($id_pelatihan)
    {
        $data['id_pelatihan'] = $id_pelatihan;

        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('admin/pelatihan/insert_publikasi')
            . view('layout/footer');
    }
    public function pelatihanInsertPublishProses($id_pelatihan)
    {

        $publis = $this->request->getPost('publish');
        if (null != model(CourseModel::class)->find($id_pelatihan)) {
            model(CourseModel::class)->update($id_pelatihan, ['status_sistem' => $publis == 'true' ? 'publish' : 'draft']);
        } else {
            return redirect()->to(base_url('pelatihan'))->with('error', 'Terjadi kesalahan saat membuat pelatihan');
            dd('Terjadi Error');
        }

        return redirect()->to(base_url('pelatihan'))->with('message', 'Pelatihan baru berhasil ditambahkan');
    }


    // Menu User
    public function pelatihanUser($id_pelatihan)
    {
        $data = model(UserCourseModel::class)->where('id_course', $id_pelatihan)->findAll();
        $data_final = [];
        foreach ($data as $key => $value) {
            $data_user = model(UserModel::class)->find($value['id_user']);
            $data_final['user'][$key] = $data_user->toArray();
            $data_final['user'][$key]['status_pelatihan'] = $value['status'];
            $data_final['user'][$key]['id_user_course'] = $value['id'];
            $data_final['user'][$key]['certificate_number'] = $value['certificate_number'];
            $data_final['user'][$key]['certificate_file_location'] = $value['certificate_file_location'];
            $data_final['user'][$key]['certificate_is_uploaded'] = !empty($value['certificate_file_location']) ? true : false;
        }
        // dd($data_final);
        // dd($data_final);
        $data_final['id_pelatihan'] = $id_pelatihan;
        // dd($data_final, $data);
        return view('layout/header', $data_final)
            . view('layout/sidebar')
            . view('admin/pelatihan/user')
            . view('layout/footer');
    }
    public function pelatihanUserDelete($id_user_course)
    {
        $data_user_course = model(UserCourseModel::class)->find($id_user_course);
        if (isset($data_user_course)) {
            $user = model(UserModel::class)->find($data_user_course['id_user'])->toArray();
            $id_pelatihan = $data_user_course['id_course'];

            if (isset($user)) {
                // $MoodyUser = $this->MoodyBest->getUserByEmail($user['email']); // Check user in moodle
                $MoodyUser = $this->UserLibrary->getUserIdByEmail($user['email']);
                if (!empty($MoodyUser['error'])) {
                    return redirect()->to(base_url('pelatihan/detail/user/' . $id_pelatihan))->withInput()->with('error', 'User Moodle ' . $MoodyUser['error']['message']);
                }
                $MoodyEnroll = $this->MoodyBest->unEnrolUserFromCourse($id_pelatihan, $MoodyUser['data']['userid']);
                model(UserCourseModel::class)->delete($id_user_course);
                return redirect()->to(base_url('pelatihan/detail/user/' . $id_pelatihan))->with('message', 'Pengguna ' . $user['fullname'] . ' telah dihapus dari pelatihan!');
            } else {
                return redirect()->to(base_url('pelatihan/detail/user/' . $id_pelatihan))->with('error', 'Data pengguna tidak ditemukan!');
            }
        } else {
            return redirect()->back()->with('error', 'Data pengguna tidak ditemukan!');
        }
    }
    public function pelatihanUserRegis($id_pelatihan, $id_user, $status)
    {
        $id_user_coruse = model(UserCourseModel::class)->where('id_course', $id_pelatihan)->where('id_user', $id_user)->findColumn('id');
        $user = model(UserModel::class)->find($id_user)->toArray();

        // $MoodyUser = $this->MoodyBest->getUserByEmail($user['email']); // Check user in moodle
        $MoodyUser = $this->UserLibrary->getUserIdByEmail($user['email']); // Check user in moodle
        // $MoodyUser = $this->MoodyBest->getUserByEmail('admsipandu@gmail.com');
        // dd($MoodyUser, $user['email'], empty($MoodyUser['error']), $MoodyUser['data']['userid']);

        $dataUpdate = [];
        if (empty($MoodyUser['error'])) {
            switch ($status) {
                case 1:
                    $statusUpdate = 'accept';
                    // Enroll user to course in moodle
                    $MoodyEnroll = $this->MoodyBest->enrolUserToCourse($id_pelatihan, $MoodyUser['data']['userid'], Contract::ROLE_ID_STUDENT);
                    if ($MoodyEnroll['data']['code'] != 200) {

                        dd('Error Enrol');
                    }
                    break;
                case 2:
                    $statusUpdate = 'reject';
                    break;
                case 3:
                    $statusUpdate = 'revisi';
                    $comment = $this->request->getPost('comment');
                    if (isset($comment)) {
                        $dataUpdate['comment'] = $comment;
                    }
                    break;

                default:
                    $statusUpdate = 'register';
                    break;
            }
        } else {
            return redirect()->back()->to(base_url('pelatihan/detail/user/' . $id_pelatihan))->withInput()->with('error', 'User Moodle ' . $MoodyUser['error']['message']);

            dd('Error Moodle User');
        }

        $dataUpdate['status'] = $statusUpdate;
        // Update status User Course
        $proses = model(UserCourseModel::class)->update($id_user_coruse[0], $dataUpdate);
        if ($proses) {
            return redirect()->back()->to(base_url('pelatihan/detail/user/' . $id_pelatihan))->withInput()->with('message', 'Setatus User Diperbaharui');
        } else {
            dd('Terjadi Kesalahan');
        }
    }


    public function singkronSimpeg()
    {
        return redirect()->back()->withInput()->with('error', 'Tidak ada data yang tersingkron!');
    }

    public function pelatihanUserDetail($id_pelatihan, $id_user)
    {
        $dataUserCourse = model(UserCourseModel::class)->where('id_course', $id_pelatihan)->where('id_user', $id_user)->findColumn('id');
        $dataCourseUploadDocument = $this->listCourseUploadDocument($id_pelatihan);
        $dataFinal = [];
        foreach ($dataCourseUploadDocument as $key => $value) {
            $UserUploadDocument = model(UserUploadDocumentModel::class)->where('id_user_course', $dataUserCourse[0])->where('id_upload_document', $value['id'])->findAll();
            if (isset($UserUploadDocument[0])) {
                $dataFinal['document'][$key] = $UserUploadDocument[0];
                $dataFinal['document'][$key]['name_upload_document'] = $value['name'];
            }
        }
        $dataFinal['id_pelatihan'] = $id_pelatihan;
        $dataFinal['data'] = model(UserModel::class)->find($id_user)->toArray();
        // dd($dataFinal);
        return view('layout/header', $dataFinal)
            . view('layout/sidebar')
            . view('admin/pelatihan/user_detail')
            . view('layout/footer');
    }

    // Detail Pelatihan
    public function pelatihanDetail($id_pelatihan)
    {
        // Data Pelatihan API
        $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field&field=id&value=' . $id_pelatihan . ''));
        if (empty($dataPelatihan->courses)) {
            return redirect()->to(base_url('pelatihan'))->with('error', 'Pelatihan Best tidak ditemukan, pelatihan munngkin sudah dihapus!');
        }
        // dd($dataPelatihan, empty($dataPelatihan->courses));
        $dataPelatihan->courses[0]->startdatetime           = isset($dataPelatihan->courses[0]->startdate) ? $this->toLocalTime($dataPelatihan->courses[0]->startdate) : '';
        $dataPelatihan->courses[0]->enddatetime             = isset($dataPelatihan->courses[0]->enddate) ? $this->toLocalTime($dataPelatihan->courses[0]->enddate) : '';
        // $dataPelatihan->courses[0]->startdatetime           = $dataPelatihan->courses[0]->startdate ?? '';
        // $dataPelatihan->courses[0]->enddatetime             = $dataPelatihan->courses[0]->enddate ?? '';

        $courseLocal = model(CourseModel::class)->find($id_pelatihan);

        $dataPelatihan->courses[0]->condition               = $courseLocal['condition'] ?? '';
        $dataPelatihan->courses[0]->start_registration      = isset($courseLocal['start_registration']) ? $this->dateToLocalTime($courseLocal['start_registration']) : '';
        $dataPelatihan->courses[0]->end_registration        = isset($courseLocal['end_registration']) ? $this->dateToLocalTime($courseLocal['end_registration']) :  '';
        $dataPelatihan->courses[0]->year                    = isset($courseLocal['end_registration']) ? Time::parse($courseLocal['end_registration'], 'Asia/Jakarta')->getYear() : '';
        $dataPelatihan->courses[0]->target_participant      = $courseLocal['target_participant'] ?? '';
        $dataPelatihan->courses[0]->batch                   = $courseLocal['batch'] ?? '';
        $dataPelatihan->courses[0]->quota                   = $courseLocal['quota'] ?? '';
        $dataPelatihan->courses[0]->source_funds            = $courseLocal['source_funds'] ?? '';
        $dataPelatihan->courses[0]->method                  = $courseLocal['method'] ?? '';
        $dataPelatihan->courses[0]->place                   = $courseLocal['place'] ?? '';
        $dataPelatihan->courses[0]->contact_person          = $courseLocal['contact_person'] ?? '';
        $dataPelatihan->courses[0]->schedule_file_name      = $courseLocal['schedule_file_name'] ?? '';
        $dataPelatihan->courses[0]->schedule_file_location  = $courseLocal['schedule_file_location'] ?? '';

        $dataPelatihan->courses[0]->status_sistem  = $courseLocal['status_sistem'] ?? '';

        $pelatihan['courses'] = $dataPelatihan->courses[0];
        $data['pelatihan'] = json_encode($pelatihan);

        $data['list_course_donwload_document'] = $this->listCourseDonwloadDocument($id_pelatihan);
        $data['list_course_upload_document'] = $this->listCourseUploadDocument($id_pelatihan);
        // dd($data);
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('admin/pelatihan/detail')
            . view('layout/footer');
    }
    public function pelatihanDetailEdit($id_pelatihan)
    {
        // Data Pelatihan API
        $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field&field=id&value=' . $id_pelatihan . ''));
        $categoryPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_categories'));
        // $dataPelatihan->courses[0]->startdatetime           = isset($dataPelatihan->courses[0]->startdate) ? $this->toDMY($dataPelatihan->courses[0]->startdate) : '';
        // $dataPelatihan->courses[0]->enddatetime             = isset($dataPelatihan->courses[0]->enddate) ? $this->toDMY($dataPelatihan->courses[0]->enddate) : '';

        $courseLocal = model(CourseModel::class)->find($id_pelatihan);
        // dd($dataPelatihan);
        $dataPelatihan->courses[0]->batch                   = $courseLocal['condition'] ?? '';
        $dataPelatihan->courses[0]->start_registration      = $courseLocal['start_registration'] ? Time::parse($courseLocal['start_registration'], 'Asia/Jakarta')->toDateString('Y-m-d') : '';
        $dataPelatihan->courses[0]->end_registration        = $courseLocal['end_registration'] ? Time::parse($courseLocal['end_registration'], 'Asia/Jakarta')->toDateString('Y-m-d') : '';
        $dataPelatihan->courses[0]->target_participant      = $courseLocal['target_participant'] ?? '';
        $dataPelatihan->courses[0]->batch                   = $courseLocal['batch'] ?? '';
        $dataPelatihan->courses[0]->quota                   = $courseLocal['quota'] ?? '';
        $dataPelatihan->courses[0]->source_funds            = $courseLocal['source_funds'] ?? '';
        $dataPelatihan->courses[0]->method                  = $courseLocal['method'] ?? '';
        $dataPelatihan->courses[0]->place                   = $courseLocal['place'] ?? '';
        $dataPelatihan->courses[0]->contact_person          = $courseLocal['contact_person'] ?? '';
        $dataPelatihan->courses[0]->schedule_file_name      = $courseLocal['schedule_file_name'] ?? '';
        $dataPelatihan->courses[0]->schedule_file_location  = $courseLocal['schedule_file_location'] ?? '';
        $dataPelatihan->courses[0]->startdatetime           = $this->toDMY($dataPelatihan->courses[0]->startdate);
        $dataPelatihan->courses[0]->enddatetime             = $this->toDMY($dataPelatihan->courses[0]->enddate);

        $pelatihan['courses']   = $dataPelatihan->courses[0];
        // dd($pelatihan);
        $data['pelatihan']      = json_encode($pelatihan);
        $data['kategori_pelatihan']      = $categoryPelatihan;

        $data['list_course_donwload_document'] = $this->listCourseDonwloadDocument($id_pelatihan);
        $data['list_course_upload_document'] = $this->listCourseUploadDocument($id_pelatihan);

        $dataDownloadDocument = model(DownloadDocumentModel::class)->findAll();
        $dataUploadDocument = model(UploadDocumentModel::class)->findAll();

        $tempDD = [];
        if (!empty($data['list_course_donwload_document'])) {
            foreach ($dataDownloadDocument as $keyDD => $valueDD) {
                foreach ($data['list_course_donwload_document'] as $keyCDD => $valueCDD) {
                    if ($valueDD['id'] == $valueCDD['id']) {
                        $valueDD['check'] = true;
                    }
                }
                array_push($tempDD, $valueDD);
            }
        }
        $tempUD = [];
        if (!empty($data['list_course_donwload_document'])) {
            foreach ($dataUploadDocument as $keyUD => $valueUD) {
                foreach ($data['list_course_upload_document'] as $keyCUD => $valueCUD) {
                    if ($valueUD['id'] == $valueCUD['id']) {
                        $valueUD['check'] = true;
                    }
                }
                array_push($tempUD, $valueUD);
            }
        }

        $data['list_donwload_document'] = (!empty($tempDD)) ? $tempDD : $dataDownloadDocument;
        $data['list_upload_document'] = (!empty($tempUD)) ? $tempUD : $dataUploadDocument;
        // dd($temp);

        // }
        // dd($data, $dataDownloadDocument, $temp);
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('admin/pelatihan/edit')
            . view('layout/footer');
    }

    public function pelatihanDetailEditProses($id_pelatihan)
    {
        $data =  $this->request->getPost();
        $file_schedule =  $this->request->getFile('jadwal');


        // // Convert end_registration to a DateTime object
        // $endRegistrationDateTime = new \DateTime($data['end_registration'], new \DateTimeZone('Asia/Jakarta'));

        // // Set the time to 23:59:59
        // $endRegistrationDateTime->setTime(23, 59, 59);
        // dd($endRegistrationDateTime);
        $dataLokal = [
            'shortname'             => $data['shortname'],
            'fullname'             => $data['fullname'],
            'category'             => $this->getCategoryById($data['categoryid']),
            'categoryid'             => $data['categoryid'],
            'summary'             => $data['summary'],


            'startdate'             => $data['startdate'],
            'enddate'               => $this->adjustTimeTo2359($data['enddate']),
            'id'                    => $id_pelatihan,
            'place'                 => $data['place'],
            'start_registration'    => $data['start_registration'],
            'end_registration'      => $this->adjustTimeTo2359($data['end_registration']),
            'target_participant'    => $data['target_participant'],
            'batch'                 => intval($data['batch']),
            'quota'                 => intval($data['quota']),
            'contact_person'        => $data['contact_person'],
            'source_funds'          => $data['source_funds'],
            'method'                => $data['method'],
            // 'status_sistem'         => $data['publish'] == 'true' ? 'publish' : 'draft',
        ];

        if ($data['publish'] == 'true') {
            $dataLokal['status_sistem'] = 'publish';
        }

        $MoodyEdit = $this->MoodyBest->updateCourse(
            $id_pelatihan,
            $data['shortname'],
            $data['fullname'],
            $data['categoryid'],
            $data['summary'],
            new \DateTime($data['startdate']),
            new \DateTime($this->adjustTimeTo2359($data['enddate']))
        );
        if (!empty($MoodyEdit['error'])) {
            return redirect()->to(base_url('pelatihan/detail/edit/' . $id_pelatihan))->withInput()->with('error', 'Pelatihan Moodle ' . $MoodyEdit['error']['message']);
        }

        if (isset($file_schedule)) {
            $rules = [
                'jadwal' => [
                    // 'uploaded[jadwal]',
                    'mime_in[jadwal,application/pdf]',
                    'max_size[jadwal,5096]',
                ],
            ];
            $message = [
                'jadwal' => [
                    // 'uploaded' => 'File gagal terupload, silahkan coba lagi!',
                    'mime_in' => 'Jenis berkas yang Anda upload tidak sesuai!',
                    'max_size' => 'Upload dokumen gagal! Size dokumen melebihi 5MB!'
                ]
            ];
            if ($this->validate($rules, $message)) {
                if ($file_schedule->isValid() && !($file_schedule->hasMoved())) {

                    $this->deleteFileExists(model(CourseModel::class)->find($id_pelatihan)['schedule_file_location']);

                    $newName = $file_schedule->getRandomName();
                    $path = 'uploads/dokumen';
                    // dd(base_url() . $path, FCPATH, WRITEPATH);
                    $file_schedule->move(FCPATH . $path, $newName);

                    $dataLokal['schedule_file_name']     = $file_schedule->getClientName();
                    $dataLokal['schedule_file_location'] = $path . '/' . $newName;
                }
            } else {
                return redirect()->to(base_url('pelatihan/detail/edit/' . $id_pelatihan))->withInput()->with('error', $this->validator->getError('jadwal'));
            }
        }

        if (null != model(CourseModel::class)->find($id_pelatihan)) {
            // dd();

            model(CourseModel::class)->update($id_pelatihan, $dataLokal);
        } else {
            model(CourseModel::class)->insert($dataLokal, false);
        }

        return redirect()->to(base_url('pelatihan'))->with('message', 'Data pelatihan berhasil diperbarui');
    }

    public function convertStatusPelatihan($status)
    {
        $temp =  '';
        switch ($status) {
            case 1:
                $temp = 'create';
                break;
            case 2:
                $temp = 'draft';
                break;
            case 3:
                $temp = 'publish';
                break;

            default:
                $temp = '';
                break;
        }

        return $temp;
    }
    public function pelatihanEditStatus($id_pelatihan, $status)
    {

        if (null != model(CourseModel::class)->find($id_pelatihan)) {
            model(CourseModel::class)->update($id_pelatihan, ['status_sistem' => $this->convertStatusPelatihan($status)]);
        } else {
            dd('Terjadi Error');
        }

        return redirect()->to(base_url('pelatihan'))->with('message', 'Status pelatihan berhasil diperbarui');
    }


    public function listCourseDonwloadDocument($id_pelatihan)
    {
        $temp = [];
        $dataCourseDownloadDocument = model(CourseDownloadDocumentModel::class)->where('id_course', $id_pelatihan)->findAll();
        foreach ($dataCourseDownloadDocument as $key => $value) {
            $result = model(DownloadDocumentModel::class)->find($value['id_download_document']);
            if (!empty($result)) {
                array_push($temp, $result);
            }
            // if (!empty($result[0])) {
            //     array_push($temp, $result[0]);
            // }
        }
        return $temp;
    }
    public function listCourseUploadDocument($id_pelatihan)
    {
        $temp = [];
        $dataCourseUploadDocument = model(CourseUploadDocumentModel::class)->where('id_course', $id_pelatihan)->findAll();
        foreach ($dataCourseUploadDocument as $key => $value) {
            $result = model(UploadDocumentModel::class)->find($value['id_upload_document']);
            if (!empty($result)) {
                array_push($temp, $result);
            }
            // dd($result);
            // if (!empty($result[0])) {
            //     array_push($temp, $result[0]);
            // }
        }
        return $temp;
    }
    public function toDateFormat($tgl)
    {
        return Time::parse($tgl, 'Asia/Jakarta');
    }

    public function insertCertificate($id_user_course)
    {
        $certificate_number =  $this->request->getPost('certificate_number');
        $certificate        =  $this->request->getFile('certificate');

        if (isset($certificate)) {
            $rules = [
                'certificate' => [
                    'uploaded[certificate]',
                    'mime_in[certificate,application/pdf]',
                    'max_size[certificate,5096]',
                ],
            ];
            $message = [
                'certificate' => [
                    'uploaded' => 'File gagal terupload, silahkan coba lagi!',
                    'mime_in' => 'Jenis berkas yang Anda upload tidak sesuai!',
                    'max_size' => 'Upload dokumen gagal! Size dokumen melebihi 5MB!'
                ]
            ];
            if ($this->validate($rules, $message)) {
                if ($certificate->isValid() && !($certificate->hasMoved())) {

                    $newName = $certificate->getRandomName();
                    $path = 'uploads/dokumen';

                    $certificate->move(FCPATH . $path, $newName);
                    $data = [
                        'certificate_number'        => $certificate_number,
                        'certificate_file_location' => $path . '/' . $newName,
                        'certificate_file_name'     => $certificate->getClientName(),

                    ];
                    model(UserCourseModel::class)->update($id_user_course, $data);
                    $succes = true;
                }
            } else {
                $data_user_course = model(UserCourseModel::class)->find($id_user_course);
                return redirect()->to(base_url('pelatihan/detail/user/' . $data_user_course['id_course']))->withInput()->with('error', $this->validator->getError('certificate'));
            }
        }
        $data_user_course = model(UserCourseModel::class)->find($id_user_course);
        return redirect()->to(base_url('pelatihan/detail/user/' . $data_user_course['id_course']));
    }


    public function insertDownloadDocument()
    {
        $name =  $this->request->getPost('name');
        $file_download =  $this->request->getFile('file_download_document');

        if (isset($file_download)) {
            $rules = [
                'file_download_document' => [
                    'uploaded[file_download_document]',
                    'mime_in[file_download_document,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
                    'max_size[file_download_document,5096]',
                ],
            ];
            $message = [
                'file_download_document' => [
                    'uploaded' => 'File gagal terupload, silahkan coba lagi!',
                    'mime_in' => 'Jenis berkas yang Anda upload tidak sesuai!',
                    'max_size' => 'Upload dokumen gagal! Size dokumen melebihi 5MB!'
                ]
            ];
            if ($this->validate($rules, $message)) {
                if ($file_download->isValid() && !($file_download->hasMoved())) {

                    $newName = $file_download->getRandomName();
                    $path = 'uploads/dokumen';
                    // dd(base_url() . $path, FCPATH, WRITEPATH);
                    $file_download->move(FCPATH . $path, $newName);
                    $data = [
                        'name'          => $name,
                        'link'          => $path . '/' . $newName,

                    ];
                    model(DownloadDocumentModel::class)->save($data);
                    $succes = true;
                }
            } else {
                return redirect()->back()->withInput()->with('error', $this->validator->getError('file_download_document'));
            }
        }
        // return redirect()->to(base_url('pelatihan/detail/edit/' . $id_pelatihan));
        return redirect()->back();
    }
    public function editDownloadDocument($id_download_document)
    {
        $name =  $this->request->getPost('name');
        $file_download =  $this->request->getFile('file_download_document');
        // dd($file_download, empty($file_download));
        // $data = [];
        $rules = [
            'file_download_document' => [
                'uploaded[file_download_document]',
                'mime_in[file_download_document,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
                'max_size[file_download_document,5096]',
            ],
        ];
        $message = [
            'file_download_document' => [
                'uploaded' => 'File gagal terupload, silahkan coba lagi!',
                'mime_in' => 'Jenis berkas yang Anda upload tidak sesuai!',
                'max_size' => 'Upload dokumen gagal! Size dokumen melebihi 5MB!'
            ]
        ];
        if (isset($file_download)) {
            if ($this->validate($rules, $message)) {
                if ($file_download->isValid() && !($file_download->hasMoved())) {

                    $this->deleteFileExists(model(DownloadDocumentModel::class)->find($id_download_document)['link']);

                    $newName = $file_download->getRandomName();
                    $path = 'uploads/dokumen';

                    $file_download->move(FCPATH . $path, $newName);
                    $data = [
                        'name'          => $name,
                        'link'          => $path . '/' . $newName,

                    ];
                    // model(DownloadDocumentModel::class)->save($data);
                    $succes = true;
                }
            } else {
                return redirect()->back()->withInput()->with('error', $this->validator->getError('file_download_document'));
            }
        } else {
            $data['name'] = $name;
        }
        model(DownloadDocumentModel::class)->update($id_download_document, $data);

        // return redirect()->to(base_url('pelatihan/detail/edit/' . $id_pelatihan));
        return redirect()->back();
    }
    public function deleteDownloadDocument($id_download_document)
    {
        model(DownloadDocumentModel::class)->delete($id_download_document);

        // return redirect()->to(base_url('pelatihan/detail/edit/' . $id_pelatihan));
        return redirect()->back();
    }
    public function updateCourseDownloadDocument($id_pelatihan)
    {
        $document =  $this->request->getPost();
        $countCourseDocument = model(CourseDownloadDocumentModel::class)->where('id_course', $id_pelatihan)->countAllResults();
        $idDocumentAll = model(DownloadDocumentModel::class)->findColumn('id');
        foreach ($idDocumentAll as $key => $value) {
            $idLastDocument = $value;
        }
        // count($document);
        if ($countCourseDocument == 0) {
            for ($i = 1; $i <= $idLastDocument; $i++) {
                if (isset($document[$i])) {
                    // dd($document[$i], $i, $idLastDocument);
                    $data = ['id_course' => $id_pelatihan, 'id_download_document' => $i];
                    model(CourseDownloadDocumentModel::class)->insert($data);
                }
            }
        } else {
            model(CourseDownloadDocumentModel::class)->where('id_course', $id_pelatihan)->delete();
            for ($i = 1; $i <= $idLastDocument; $i++) {
                if (isset($document[$i])) {

                    $data = ['id_course' => $id_pelatihan, 'id_download_document' => $i];
                    model(CourseDownloadDocumentModel::class)->insert($data);
                }
            }
        }

        // return redirect()->to(base_url('pelatihan/detail/edit/' . $id_pelatihan));
        return redirect()->back();
    }
    public function listDownloadDocument()
    {
        $id_pelatihan =  $this->request->getPost('id_course');
        $data = model(DownloadDocumentModel::class)->findAll();
        return json_encode($data);
    }
    public function insertUploadDocument()
    {
        $name =  $this->request->getPost('name_uplaod_document');
        model(UploadDocumentModel::class)->save(['name' => $name]);

        // return redirect()->to(base_url('pelatihan/detail/edit/' . $id_pelatihan));
        return redirect()->back();
    }
    public function editUploadDocument($id_upload_document)
    {
        $name =  $this->request->getPost('name_uplaod_document');
        model(UploadDocumentModel::class)->update($id_upload_document, ['name' => $name]);

        // return redirect()->to(base_url('pelatihan/detail/edit/' . $id_pelatihan));
        return redirect()->back();
    }
    public function deleteUploadDocument($id_upload_document)
    {
        model(UploadDocumentModel::class)->delete($id_upload_document);

        // return redirect()->to(base_url('pelatihan/detail/edit/' . $id_pelatihan));
        return redirect()->back();
    }
    public function updateCourseUploadDocument($id_pelatihan)
    {
        $document =  $this->request->getPost();
        // dd($document);
        $countCourseDocument = model(CourseUploadDocumentModel::class)->where('id_course', $id_pelatihan)->countAllResults();
        $idDocumentAll = model(UploadDocumentModel::class)->findColumn('id');
        foreach ($idDocumentAll as $key => $value) {
            $idLastDocument = $value;
        }
        // count($document);
        if ($countCourseDocument == 0) {
            for ($i = 1; $i <= $idLastDocument; $i++) {
                if (isset($document[$i])) {
                    // dd($document[$i], $i, $idLastDocument);
                    $data = ['id_course' => $id_pelatihan, 'id_upload_document' => $i];
                    model(CourseUploadDocumentModel::class)->insert($data);
                }
            }
        } else {
            model(CourseUploadDocumentModel::class)->where('id_course', $id_pelatihan)->delete();
            for ($i = 1; $i <= $idLastDocument; $i++) {
                if (isset($document[$i])) {

                    $data = ['id_course' => $id_pelatihan, 'id_upload_document' => $i];
                    model(CourseUploadDocumentModel::class)->insert($data);
                }
            }
        }

        // return redirect()->to(base_url('pelatihan/detail/edit/' . $id_pelatihan));
        return redirect()->back();
    }
    public function listUploadDocument()
    {
        $id_pelatihan =  $this->request->getPost('id_course');
        $data = model(DownloadDocumentModel::class)->findAll();
        return json_encode($data);
    }
    public function listUserCourse()
    {
        $id_pelatihan =  $this->request->getPost('id_course');
        $data = model(UserCourseModel::class)->where('id_course', $id_pelatihan)->findAll();
        $data_final = [];
        foreach ($data as $key => $value) {
            $data_user = model(UserModel::class)->find($value['id_user']);
            $data_final['user'][$key] = $data_user;
        }
        // Read new token and assign in $data['token']
        $security = \Config\Services::security();
        $security->generateHash();

        $data_final['hash'] = $security->getHash();
        $data_final['token'] = $security->getTokenName();
        return json_encode($data_final);
    }
    public function listUserUploadDocument()
    {
        $id_pelatihan =  $this->request->getPost('id_course');
        $id_user =  $this->request->getPost('id_user');
        $data = model(UserCourseModel::class)->where('id_course', $id_pelatihan)->findAll();
        $data_final = [];
        foreach ($data as $key => $value) {
            $data_user = model(UserModel::class)->find($value['id_user']);
            $data_final[$key] = $data_user;
        }
        return json_encode($data_final);
    }
    public function kelolaPengguna()
    {
        return view('layout/header',)
            . view('layout/sidebar')
            . view('admin/pengguna/index')
            . view('layout/footer');
    }
}
