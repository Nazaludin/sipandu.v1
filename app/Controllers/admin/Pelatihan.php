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

class Pelatihan extends BaseController
{
    protected $MoodyBest;

    public function __construct()
    {
        $configBest = new Config("http://best-bapelkes.jogjaprov.go.id/webservice/rest/server.php", "8d52a95d541a42e81f955536e8927e9a");
        $this->MoodyBest = AppFactory::create($configBest);
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
        $url = 'http://best-bapelkes.jogjaprov.go.id/webservice/rest/server.php?wstoken=26a8df1bbd691fcdc570159cac7f00e7' . $function . '&moodlewsrestformat=json';
        return $url;
    }



    // CODE PELATIHAN
    public function rekap($tipe)
    {
        require_once "../vendor/autoload.php";
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
        require_once "../vendor/autoload.php";
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
        $pelatihan = model(CourseModel::class)->find($id_pelatihan);
        $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field&field=id&value=' . $id_pelatihan . ''));
        // dd($pelatihan, $dataPelatihan);
        //judul
        $title = 'Rekap Pendaftar ' .   ucwords((string)$dataPelatihan->courses[0]->fullname);
        $activeSheet->setCellValue('A2', $title); // Set kolom A1 dengan tulisan "DATA SISWA"
        $activeSheet->mergeCells('A2:L2'); // Set Merge Cell pada kolom A1 sampai F1
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
        }

        // DATA
        if ($tipe == 1) {
            $data = model(UserCourseModel::class)->where('id_course', $id_pelatihan)->where('status', 'accept')->findAll();
            $data_final = [];
            foreach ($data as $key => $value) {
                $data_user = model(UserModel::class)->find($value['id_user']);
                $data_final[$key] = $data_user->toArray();
                $data_final[$key]['status_pelatihan'] = $value['status'];
            }
        } else {
            $data = model(UserCourseModel::class)->where('id_course', $id_pelatihan)->findAll();
            $data_final = [];
            foreach ($data as $key => $value) {
                $data_user = model(UserModel::class)->find($value['id_user']);
                $data_final[$key] = $data_user->toArray();
                $data_final[$key]['status_pelatihan'] = $value['status'];
            }
        }
        $index = 6;
        // dd($data_final);
        // foreach ($data_final as $dt => $value) {
        //     $activeSheet->setCellValue('A' . $index, $index - 5);
        //     $activeSheet->setCellValue('B' . $index, $dataBest->courses[0]->fullname);
        //     $activeSheet->setCellValue('C' . $index, $dataBest->courses[0]->categoryname);
        //     $activeSheet->setCellValue('D' . $index, date('Y-m-d', strtotime($value['start_registration'])));
        //     $activeSheet->setCellValue('E' . $index, date('Y-m-d', strtotime($value['end_registration'])));
        //     $activeSheet->setCellValue('F' . $index, $this->toDMY($dataBest->courses[0]->startdate));
        //     $activeSheet->setCellValue('G' . $index, $this->toDMY($dataBest->courses[0]->enddate));
        //     $activeSheet->setCellValue('H' . $index, $value['batch']);
        //     $activeSheet->setCellValue('I' . $index, $value['target_participant']);
        //     $activeSheet->setCellValue('J' . $index, $value['place']);
        //     $activeSheet->setCellValue('K' . $index, $value['contact_person']);
        //     $activeSheet->setCellValue('L' . $index, $value['quota']);

        //     $activeSheet->getStyle('A' . $index)->applyFromArray($style_row_center);
        //     $activeSheet->getStyle('B' . $index)->applyFromArray($style_row_left);
        //     $activeSheet->getStyle('C' . $index)->applyFromArray($style_row_left);
        //     $activeSheet->getStyle('D' . $index)->applyFromArray($style_row_center);
        //     $activeSheet->getStyle('E' . $index)->applyFromArray($style_row_center);
        //     $activeSheet->getStyle('F' . $index)->applyFromArray($style_row_center);
        //     $activeSheet->getStyle('G' . $index)->applyFromArray($style_row_center);
        //     $activeSheet->getStyle('H' . $index)->applyFromArray($style_row_center);
        //     $activeSheet->getStyle('I' . $index)->applyFromArray($style_row_center);
        //     $activeSheet->getStyle('J' . $index)->applyFromArray($style_row_left);
        //     $activeSheet->getStyle('K' . $index)->applyFromArray($style_row_left);
        //     $activeSheet->getStyle('L' . $index)->applyFromArray($style_row_center);
        //     $index++;
        // }

        // //mengatur warptext disetiap kolom
        // foreach (range('A', $activeSheet->getHighestDataColumn()) as $col) {
        //     $activeSheet->getStyle($col)->getAlignment()->setWrapText(true);
        // }

        // //mengatur weight pada cell
        // $activeSheet->getColumnDimension('B')->setWidth(25);
        // $activeSheet->getColumnDimension('C')->setWidth(25);
        // $activeSheet->getColumnDimension('D')->setWidth(25);
        // $activeSheet->getColumnDimension('E')->setWidth(25);
        // $activeSheet->getColumnDimension('F')->setWidth(25);
        // $activeSheet->getColumnDimension('G')->setWidth(25);
        // $activeSheet->getColumnDimension('I')->setWidth(20);
        // $activeSheet->getColumnDimension('J')->setWidth(25);
        // $activeSheet->getColumnDimension('K')->setWidth(25);
        // $activeSheet->getColumnDimension('L')->setWidth(15);

        $filename = $title . '.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        die;
    }
    public function pelatihan()
    {
        // dd();
        // $result = $this->MoodyBest->getUserByEmail("admsipandu@gmail.com");
        // var_dump($result);
        // $result = model(CourseModel::class)->getDataCourseYear();
        // dd($result);
        // $result = $this->MoodyBest->enrolUserToCourse("203", "2821", Contract::ROLE_ID_STUDENT);
        // $result = $this->MoodyBest->getEnroledUsersByCourseId("203");
        // var_dump($result);

        // Data Pelatihan API
        $pelatihan = model(CourseModel::class)->findAll();

        if (!empty($pelatihan)) {
            $now = new Time('now', 'Asia/Jakarta');
            // $now = Time::createFromFormat('j-M-Y', '1-Jul-2023', 'Asia/Jakarta');
            // $year = Time::createFromFormat('j-M-Y', '1-Jan-' . $now->getYear(), 'Asia/Jakarta');
            foreach ($pelatihan as $key => $value) {
                // Data Pelatihan API
                $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field&field=id&value=' . $value['id'] . ''));

                $dataPelatihan->courses[0]->condition               = isset($value['condition']) ? $this->convertCondition(
                    $value['condition'],
                    $value['id'],
                    isset($value['start_registration']) ? strtotime($value['start_registration']) : null,
                    isset($value['end_registration']) ? strtotime($value['end_registration']) : null,
                    isset($dataPelatihan->courses[0]->startdate) ? $dataPelatihan->courses[0]->startdate : null,
                    isset($dataPelatihan->courses[0]->enddate) ? $dataPelatihan->courses[0]->enddate : null,
                ) : '';
                $dataPelatihan->courses[0]->start_registration      = isset($value['start_registration']) ? $this->dateToLocalTime($value['start_registration']) : '';
                $dataPelatihan->courses[0]->end_registration        = isset($value['end_registration']) ? $this->dateToLocalTime($value['end_registration']) :  '';
                $dataPelatihan->courses[0]->target_participant      = $value['target_participant'] ?? '';
                $dataPelatihan->courses[0]->batch                   = $value['batch'] ?? '';
                $dataPelatihan->courses[0]->quota                   = $value['quota'] ?? '';
                $dataPelatihan->courses[0]->place                   = $value['place'] ?? '';
                $dataPelatihan->courses[0]->contact_person          = $value['contact_person'] ?? '';
                $dataPelatihan->courses[0]->schedule_file           = $value['schedule_file'] ?? '';
                $dataPelatihan->courses[0]->startdatetime           = isset($dataPelatihan->courses[0]->startdate) ? $this->toLocalTime($dataPelatihan->courses[0]->startdate) : '';
                $dataPelatihan->courses[0]->enddatetime             = isset($dataPelatihan->courses[0]->enddate) ? $this->toLocalTime($dataPelatihan->courses[0]->enddate) : '';
                $dataPelatihan->courses[0]->registrar               = model(UserCourseModel::class)->where('id_course', $value['id'])->where('status', 'register')->countAllResults();
                $dataPelatihan->courses[0]->accepted_participant    = model(UserCourseModel::class)->where('id_course', $value['id'])->where('status', 'accept')->countAllResults();
                $dataPelatihan->courses[0]->participant             = model(UserCourseModel::class)->where('id_course', $value['id'])->countAllResults();
                $pelatihan['courses'][$key]   = $dataPelatihan->courses[0];
            }
        }

        $data['pelatihan'] = isset($pelatihan) ? json_encode($pelatihan) : json_encode([]);
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


    public function pelatihanInsertProses()
    {
        $data =  $this->request->getPost();
        $file_schedule =  $this->request->getFile('jadwal');

        // Insert Course Moodle Best
        $result = $this->MoodyBest->createCourse(
            $data['shortname'],
            $data['fullname'],
            $data['categoryid'],
            $data['summary'],
            new \DateTime($data['startdate']),
            new \DateTime($data['enddate'])
        );

        // Insert Course to Lokal Databases
        if (!empty($result['data'])) {
            $dataLokal = [
                // 'id'                    => 202,
                'id'                    => $result['data']['courseid'],
                'condition'             => 'coming',
                'place'                 => $data['place'],
                'start_registration'    => $data['start_registration'],
                'end_registration'      => $data['end_registration'],
                'startdate'             => $data['startdate'],
                'enddate'               => $data['enddate'],
                'target_participant'    => $data['target_participant'],
                'batch'                 => intval($data['batch']),
                'quota'                 => intval($data['quota']),
                'contact_person'        => $data['contact_person'],
                'source_funds'          => $data['source_funds'],
                'method'                => $data['method'],
                'status_sistem'         => 'create',
            ];

            if (isset($file_schedule)) {
                if ($file_schedule->isValid() && !($file_schedule->hasMoved())) {

                    $newName = $file_schedule->getRandomName();
                    $path = 'uploads/dokumen';

                    $file_schedule->move(FCPATH . $path, $newName);

                    $dataLokal['schedule_file_name']     = $file_schedule->getClientName();
                    $dataLokal['schedule_file_location'] = $path . '/' . $newName;
                }
            }
            $status = model(CourseModel::class)->insert($dataLokal);
            // dd($status);
            return redirect()->to(base_url('pelatihan/insert/syarat/' . $result['data']['courseid']))->withInput();
        } else {
            return redirect()->to(base_url('pelatihan/insert/syarat/' . $result['data']['courseid']))->withInput()->with('error', $result['error']['message']);;
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
        $data['pelatihan_id'] = $id_pelatihan;

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
            model(CourseModel::class)->update($id_pelatihan, ['status_sistem' => $publis ? 'publish' : 'draft']);
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
        }

        $data_final['id_pelatihan'] = $id_pelatihan;
        // dd($data_final, $data);
        return view('layout/header', $data_final)
            . view('layout/sidebar')
            . view('admin/pelatihan/user')
            . view('layout/footer');
    }
    public function pelatihanUserRegis($id_pelatihan, $id_user, $status)
    {
        $id_user_coruse = model(UserCourseModel::class)->where('id_course', $id_pelatihan)->where('id_user', $id_user)->findColumn('id');
        $user = model(UserModel::class)->find($id_user)->toArray();

        $MoodyUser = $this->MoodyBest->getUserByEmail($user['email']); // Check user in moodle
        // $MoodyUser = $this->MoodyBest->getUserByEmail('admsipandu@gmail.com');
        // dd($MoodyUser, $user['email'], empty($MoodyUser['error']), $MoodyUser['data']['userid']);

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
                    break;

                default:
                    $statusUpdate = 'register';
                    break;
            }
        } else {
            return redirect()->back()->to(base_url('pelatihan/detail/user/' . $id_pelatihan))->withInput()->with('error', 'User Moodle ' . $MoodyUser['error']['message']);

            dd('Error Moodle User');
        }

        // Update status User Course
        $proses = model(UserCourseModel::class)->update($id_user_coruse[0], ['status' => $statusUpdate]);
        if ($proses) {
            return redirect()->back()->to(base_url('pelatihan/detail/user/' . $id_pelatihan))->withInput()->with('message', 'Setatus User Diperbaharui');
        } else {
            dd('Terjadi Kesalahan');
        }
    }


    public function pelatihanUserDetail($id_pelatihan, $id_user)
    {
        $dataUserCourse = model(UserCourseModel::class)->where('id_course', $id_pelatihan)->where('id_user', $id_user)->findColumn('id');
        $dataCourseUploadDocument = $this->listCourseUploadDocument($id_pelatihan);
        $dataFinal = [];
        foreach ($dataCourseUploadDocument as $key => $value) {
            $UserUploadDocument = model(UserUploadDocumentModel::class)->where('id_user_course', $dataUserCourse[0])->where('id_upload_document', $value['id'])->findAll();
            $dataFinal['document'][$key] = $UserUploadDocument[0];
            $dataFinal['document'][$key]['name_upload_document'] = $value['name'];
        }
        $dataFinal['id_pelatihan'] = $id_pelatihan;
        $dataFinal['user'] = model(UserModel::class)->find($id_user)->toArray();
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
        $dataPelatihan->courses[0]->schedule_file           = $courseLocal['schedule_file'] ?? '';

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

        $dataLokal = [
            'id'                    => $id_pelatihan,
            'condition'             => 'coming',
            'start_registration'    => $data['start_registration'],
            'end_registration'      => $data['end_registration'],
            'target_participant'    => $data['target_participant'],
            'batch'                 => intval($data['batch']),
            'quota'                 => intval($data['quota']),
            'place'                 => $data['place'],
            'contact_person'        => $data['contact_person'],
            'status_sistem'         => $data['publish'] == 'true' ? 'publish' : 'draft',
        ];

        if (isset($file_schedule)) {
            if ($file_schedule->isValid() && !($file_schedule->hasMoved())) {

                $newName = $file_schedule->getRandomName();
                $path = 'uploads/dokumen';
                // dd(base_url() . $path, FCPATH, WRITEPATH);
                $file_schedule->move(FCPATH . $path, $newName);

                $dataLokal['schedule_file_name']     = $file_schedule->getClientName();
                $dataLokal['schedule_file_location'] = $path . '/' . $newName;
            }
        }

        if (null != model(CourseModel::class)->find($id_pelatihan)) {
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
            $result = model(DownloadDocumentModel::class)->where('id', $value['id_download_document'])->find();
            array_push($temp, $result[0]);
        }
        return $temp;
    }
    public function listCourseUploadDocument($id_pelatihan)
    {
        $temp = [];
        $dataCourseUploadDocument = model(CourseUploadDocumentModel::class)->where('id_course', $id_pelatihan)->findAll();
        foreach ($dataCourseUploadDocument as $key => $value) {
            $result = model(UploadDocumentModel::class)->where('id', $value['id_upload_document'])->find();
            array_push($temp, $result[0]);
        }
        return $temp;
    }
    public function toDateFormat($tgl)
    {
        return Time::parse($tgl, 'Asia/Jakarta');
    }



    public function insertDownloadDocument($id_pelatihan)
    {
        $name =  $this->request->getPost('name');
        $file_download =  $this->request->getFile('file_download_document');

        if (isset($file_download)) {
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
        }

        return redirect()->to(base_url('pelatihan/detail/edit/' . $id_pelatihan));
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

        return redirect()->to(base_url('pelatihan/detail/edit/' . $id_pelatihan));
    }
    public function listDownloadDocument()
    {
        $id_pelatihan =  $this->request->getPost('id_course');
        $data = model(DownloadDocumentModel::class)->findAll();
        return json_encode($data);
    }
    public function insertUploadDocument($id_pelatihan)
    {
        $name =  $this->request->getPost('name_uplaod_document');
        model(UploadDocumentModel::class)->save(['name' => $name]);

        return redirect()->to(base_url('pelatihan/detail/edit/' . $id_pelatihan));
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

        return redirect()->to(base_url('pelatihan/detail/edit/' . $id_pelatihan));
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
}
