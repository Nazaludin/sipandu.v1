<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnswerModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use CodeIgniter\I18n\Time;
use \App\Models\InstrumentModel;
use App\Models\OptionModel;
use App\Models\QuestionModel;
use App\Models\SectionModel;
use App\Models\TemplateModel;
use App\Models\UserCourseModel;
use PhpParser\Node\Expr\Empty_;

class Evaluasi extends BaseController
{

    public function __construct()
    {
    }
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
    // FUNNCITON UMUM
    public function index()
    {
        // Data Pelatihan API
        $pelatihan = model(CourseModel::class)->findAll();

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
        }
        // dd($pelatihan);
        // dd($dataPelatihan);
        $data['pelatihan'] = $dataPelatihan;
        return view('layout/header')
            . view('layout/sidebar')
            . view('admin/evaluasi/index', $data)
            . view('layout/footer');
    }
    public function indexBasic()
    {
        $user_course = model(UserCourseModel::class)->dataCourseUserByPage(user_id(), 'riwayat');
        // dd($user_course);
        // $user_course = $this->UserCourseModel->where('id_user', user_id())->where('status', 'register')->findAll();
        // dd($user_course);
        foreach ($user_course as $key => $value) {
            // Data Pelatihan API
            $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field&field=id&value=' . $value['id_course'] . ''));
            $courseLocal =  model(CourseModel::class)->find($dataPelatihan->courses[0]->id);
            // dd($dataPelatihan);

            // d($value);
            $dataPelatihan->courses[0]->status                  = $value['status'];
            $dataPelatihan->courses[0]->condition               = isset($courseLocal['condition']) ? $this->convertCondition(
                $courseLocal['condition'],
                $courseLocal['id'],
                isset($value['start_registration']) ? strtotime($courseLocal['start_registration']) : null,
                isset($value['end_registration']) ? strtotime($courseLocal['end_registration']) : null,
                isset($dataPelatihan->courses[0]->startdate) ? $dataPelatihan->courses[0]->startdate : null,
                isset($dataPelatihan->courses[0]->enddate) ? $dataPelatihan->courses[0]->enddate : null,
            ) : '';

            // if ($page == 'riwayat') {
            $dataPelatihan->courses[0]->certificate_number              = $value['certificate_number'];
            $dataPelatihan->courses[0]->certificate_file_name           = $value['certificate_file_name'];
            $dataPelatihan->courses[0]->certificate_file_location       = $value['certificate_file_location'];
            // }


            $dataPelatihan->courses[0]->start_registration      = isset($courseLocal['start_registration']) ? $this->dateToLocalTime($courseLocal['start_registration']) : '';
            $dataPelatihan->courses[0]->end_registration        = isset($courseLocal['end_registration']) ? $this->dateToLocalTime($courseLocal['end_registration']) :  '';
            $dataPelatihan->courses[0]->target_participant      = $courseLocal['target_participant'] ?? '';
            $dataPelatihan->courses[0]->batch                   = $courseLocal['batch'] ?? '';
            $dataPelatihan->courses[0]->quota                   = $courseLocal['quota'] ?? '';
            $dataPelatihan->courses[0]->place                   = $courseLocal['place'] ?? '';
            $dataPelatihan->courses[0]->contact_person          = $courseLocal['contact_person'] ?? '';
            $dataPelatihan->courses[0]->schedule_file           = $courseLocal['schedule_file'] ?? '';
            $dataPelatihan->courses[0]->startdatetime           = isset($dataPelatihan->courses[0]->startdate) ? $this->toLocalTime($dataPelatihan->courses[0]->startdate) : '';
            $dataPelatihan->courses[0]->enddatetime             = isset($dataPelatihan->courses[0]->enddate) ? $this->toLocalTime($dataPelatihan->courses[0]->enddate) : '';


            $instrument['data'] = model(InstrumentModel::class)->getInstrument($dataPelatihan->courses[0]->id);
            // dd($data);
            if (empty($instrument['data'])) {
                continue;
            } else {
                $now = new Time('now', 'Asia/Jakarta');
                if (isset($instrument['data'][0])) {

                    $startFill = !empty($instrument['data'][0]['start_fill']) ? Time::parse($instrument['data'][0]['start_fill'], 'Asia/Jakarta') : null;
                    $endFill = !empty($instrument['data'][0]['end_fill']) ? Time::parse($instrument['data'][0]['end_fill'], 'Asia/Jakarta') : null;

                    if (isset($startFill) && isset($endFill)) {
                        if ($now > $startFill && $now < $endFill) {

                            $instrument['data'][0]['start_fill'] = $startFill->toDateString('Y-m-d');
                            $instrument['data'][0]['end_fill'] =  $endFill->toDateString('Y-m-d');

                            $pelatihan['courses'][$key]   = $dataPelatihan->courses[0];
                        }
                    }
                }

                // dd('test');
                // d($value['start_fill']);
            }
            // $dataPelatihan->courses[0]->enddatetime             = isset($dataPelatihan->courses[0]->enddate) ? $this->toLocalTime($dataPelatihan->courses[0]->enddate) : '';
        }
        // dd("test");
        // return isset($pelatihan) ? json_encode($pelatihan) : json_encode([]);
        // dd($pelatihan);
        $data['pelatihan'] = isset($pelatihan) ? json_encode($pelatihan) : json_encode([]);
        // $data['id_instrument'] = model(InstrumentModel::class)->getInstrument($pelatihan['courses']);
        return view('layout/header')
            . view('layout/sidebar')
            . view('basic/evaluasi/index', $data)
            . view('layout/footer');
    }
    public function instrument()
    {
        return view('layout/header')
            . view('layout/sidebar')
            . view('admin/evaluasi/instrument')
            . view('layout/footer');
    }
    public function templateInstrument()
    {
        $data['data'] = model(TemplateModel::class)->findAll();
        // dd($data);
        // if (empty($data['data'])) {
        // return redirect()->back()->to(base_url('epp'))->withInput()->with('error', 'Template Masi dibuat');
        // }
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('admin/evaluasi/template_instrument')
            . view('layout/footer');
    }
    public function courseTemplateInstrument($id_course)
    {
        $data['id_course'] = $id_course;
        $data['data'] = model(TemplateModel::class)->findAll();
        // dd($data);
        // if (empty($data['data'])) {
        // return redirect()->back()->to(base_url('epp'))->withInput()->with('error', 'Template Masi dibuat');
        // }
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('admin/evaluasi/course_template_instrument')
            . view('layout/footer');
    }

    // Fungsi untuk mengonversi nomor kolom menjadi huruf kolom
    function getColumnName($columnNumber)
    {
        $columnName = '';

        while ($columnNumber > 0) {
            $remainder = ($columnNumber - 1) % 26;
            $columnName = chr(65 + $remainder) . $columnName;
            $columnNumber = ($columnNumber - $remainder - 1) / 26;
        }

        return $columnName;
    }
    public function rekapInstrument($id_pelatihan)
    {

        $instrument = model(InstrumentModel::class)->getInstrument($id_pelatihan);
        $users = model(UserCourseModel::class)->findPassedUsersByCourse($id_pelatihan);
        if (empty($instrument)) {
            return redirect()->back()->to(base_url('epp'))->withInput()->with('error', 'Intrument Belum dibuat');
        }

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
        $style_row_justify = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'outline' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];
        $style_row_center = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'outline' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];

        $style_row_left = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        //judul
        $title = 'Rekap Evaluasi Pasca Pelatihan ' . $instrument[0]['name'];
        $activeSheet->setCellValue('A2', $title); // Set kolom A1 dengan title
        $activeSheet->getStyle('A2')->applyFromArray($style_title);

        // Tanggal download
        $now = Time::now('Asia/Jakarta', 'en_US');
        $activeSheet->setCellValue('A3', 'Diunduh pada ' . $now->toDateTimeString());


        $activeSheet->setCellValue('A4', 'No');
        $activeSheet->mergeCells('A4:A5');
        $activeSheet->setCellValue('B4', 'Nama Lengkap');
        $activeSheet->mergeCells('B4:B5');
        $activeSheet->setCellValue('C4', 'Nama Instansi');
        $activeSheet->mergeCells('C4:C5');
        $activeSheet->setCellValue('D4', 'Jabatan');
        $activeSheet->mergeCells('D4:D5');
        $activeSheet->setCellValue('E4', 'NIP');
        $activeSheet->mergeCells('E4:E5');
        $activeSheet->setCellValue('F4', 'Jenis Kelamin');
        $activeSheet->mergeCells('F4:F5');

        $row = 4;
        $col = 7;
        $startColMerge = $this->getColumnName($col);
        $oldSection = null;
        $lastCol = null;
        $questionColumn = [];

        // Data Instrument untuk Header dari tabel
        foreach ($instrument as $cellData) {
            $columnName = $this->getColumnName($col);

            if ($oldSection === null) {
                $activeSheet->setCellValue($columnName . $row, $cellData['section']);
                $startColMerge = $columnName;
            } elseif ($cellData['id_section'] != $oldSection) {
                $activeSheet->setCellValue($columnName . $row, $cellData['section']);
                if ($startColMerge !== $lastCol) {
                    $activeSheet->mergeCells($startColMerge . $row . ':' . $lastCol . $row);
                }
                $startColMerge = $columnName;
            }

            $questionColumn[$cellData['id_question']] = $columnName;
            $activeSheet->setCellValue($columnName . ($row + 1), $cellData['number']);

            $oldSection = $cellData['id_section'];
            $lastCol = $columnName;
            $lastColInt = $col;
            $col++;
        }
        // dd($questionColumn, $instrument);

        if ($startColMerge !== $lastCol) {
            $activeSheet->mergeCells($startColMerge . $row . ':' . $lastCol . $row);
        }

        $row += 2;
        $col = 1;
        // Load data User untuk jawaban tiap user
        foreach ($users as $us => $valueUS) {
            $answer = model(AnswerModel::class)->getAnswerByUserAndInstrument($valueUS['id_user'], $instrument[0]['id_instrument']);

            // Data Peserta
            $activeSheet->setCellValue('A' . $row, $us + 1);
            $activeSheet->setCellValue('B' . $row, $valueUS['fullname']);
            $activeSheet->setCellValue('C' . $row, $valueUS['nama_instansi']);
            $activeSheet->setCellValue('D' . $row, $valueUS['jabatan']);
            $activeSheet->setCellValue('E' . $row, $valueUS['nip']);
            $activeSheet->setCellValue('F' . $row, $valueUS['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan');

            if (!empty($answer)) {
                // Data Jawaban
                foreach ($answer as $ans => $valueANS) {
                    if (isset($questionColumn[$valueANS['id_question']])) {
                        $columnName = $questionColumn[$valueANS['id_question']];
                        if ($valueANS['type'] == 1) {
                            $activeSheet->setCellValue($columnName . $row, $valueANS['skor']);
                            $activeSheet->getStyle($columnName . $row)->applyFromArray($style_row_center);
                        } else {
                            $activeSheet->setCellValue($columnName . $row, $valueANS['answer']);
                            $activeSheet->getStyle($columnName . $row)->applyFromArray($style_row_justify);
                            $activeSheet->getColumnDimension($columnName)->setWidth(40);
                        }
                    }
                }
            } else {
                $activeSheet->setCellValue($columnName . $row, 'Belum Mengisi');
            }

            // Styling kolom
            $activeSheet->getStyle('A' . $row)->applyFromArray($style_row_center);
            $activeSheet->getStyle('B' . $row)->applyFromArray($style_row_left);
            $activeSheet->getStyle('C' . $row)->applyFromArray($style_row_left);
            $activeSheet->getStyle('D' . $row)->applyFromArray($style_row_left);
            $activeSheet->getStyle('E' . $row)->applyFromArray($style_row_left);
            $activeSheet->getStyle('F' . $row)->applyFromArray($style_row_left);
            $row++;
        }
        // CLose Marge
        if ($startColMerge !== $lastCol) {
            $activeSheet->mergeCells($startColMerge . $row . ':' . $lastCol . $row);
        }
        $activeSheet->mergeCells('A2:' . $lastCol . '2');
        $activeSheet->mergeCells('A3:' . $lastCol . '3');


        // Menerapkan Style Kolom
        for ($i = 4; $i <= 5; $i++) {
            for ($j = 1; $j <= $lastColInt; $j++) {
                $activeSheet->getStyle($this->getColumnName($j) . $i)->applyFromArray($style_col);
            }
        }

        //mengatur warptext disetiap kolom
        foreach (range('A', $activeSheet->getHighestDataColumn()) as $col) {
            $activeSheet->getStyle($col)->getAlignment()->setWrapText(true);
        }

        //mengatur weight pada cell
        $activeSheet->getColumnDimension('B')->setWidth(30);
        $activeSheet->getColumnDimension('C')->setWidth(25);
        $activeSheet->getColumnDimension('D')->setWidth(25);
        $activeSheet->getColumnDimension('E')->setWidth(25);
        $activeSheet->getColumnDimension('F')->setWidth(20);


        $filename = $title . '.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        die;
    }

    public function insertInstrument($id_pelatihan)
    {
        $data['id_course'] = $id_pelatihan;
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('admin/evaluasi/insert_instrument')
            . view('layout/footer');
    }
    public function insertTemplateInstrument()
    {
        // $data['id_course'] = $id_pelatihan;
        return view('layout/header')
            . view('layout/sidebar')
            . view('admin/evaluasi/insert_template_instrument')
            . view('layout/footer');
    }
    public function editTemplateInstrument($id_template)
    {
        // $data['id_template'] = $id_template;
        $data['data'] = model(TemplateModel::class)->getInstrument($id_template);
        // dd($data);
        if (empty($data['data'])) {
            return redirect()->back()->to(base_url('epp'))->withInput()->with('error', 'Intrument Belum dibuat');
        } else {
            $data['data'][0]['start_fill'] = $data['data'][0]['start_fill'] ? Time::parse($data['data'][0]['start_fill'], 'Asia/Jakarta')->toDateString('Y-m-d') : '';
            $data['data'][0]['end_fill'] = $data['data'][0]['end_fill'] ? Time::parse($data['data'][0]['end_fill'], 'Asia/Jakarta')->toDateString('Y-m-d') : '';
        }
        // dd($data);
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('admin/evaluasi/edit_template_instrument')
            . view('layout/footer');
    }
    public function previewTemplateInstrument($id_template)
    {
        // $data['id_template'] = $id_template;
        $data['data'] = model(TemplateModel::class)->getInstrument($id_template);
        // dd($data);
        if (empty($data['data'])) {
            return redirect()->back()->to(base_url('epp'))->withInput()->with('error', 'Intrument Belum dibuat');
        } else {
            $data['data'][0]['start_fill'] = $data['data'][0]['start_fill'] ? Time::parse($data['data'][0]['start_fill'], 'Asia/Jakarta')->toDateString('Y-m-d') : '';
            $data['data'][0]['end_fill'] = $data['data'][0]['end_fill'] ? Time::parse($data['data'][0]['end_fill'], 'Asia/Jakarta')->toDateString('Y-m-d') : '';
        }
        // dd($data);
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('admin/evaluasi/preview_template_instrument')
            . view('layout/footer');
    }
    public function editInstrument($id_pelatihan)
    {
        $data['id_course'] = $id_pelatihan;
        $data['data'] = model(InstrumentModel::class)->getInstrument($id_pelatihan);
        // dd($data);
        if (empty($data['data'])) {
            return redirect()->back()->to(base_url('epp'))->withInput()->with('error', 'Intrument Belum dibuat');
        } else {
            $data['data'][0]['start_fill'] = $data['data'][0]['start_fill'] ? Time::parse($data['data'][0]['start_fill'], 'Asia/Jakarta')->toDateString('Y-m-d') : '';
            $data['data'][0]['end_fill'] = $data['data'][0]['end_fill'] ? Time::parse($data['data'][0]['end_fill'], 'Asia/Jakarta')->toDateString('Y-m-d') : '';
        }
        // dd($data);
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('admin/evaluasi/edit_instrument')
            . view('layout/footer');
    }
    public function useTemplateInstrument($id_pelatihan, $id_template)
    {
        $data['id_course'] = $id_pelatihan;
        $data['data'] = model(TemplateModel::class)->getInstrument($id_template);
        // dd($data);
        if (empty($data['data'])) {
            return redirect()->back()->to(base_url('epp'))->withInput()->with('error', 'Intrument Belum dibuat');
        } else {
            $data['data'][0]['start_fill'] = $data['data'][0]['start_fill'] ? Time::parse($data['data'][0]['start_fill'], 'Asia/Jakarta')->toDateString('Y-m-d') : '';
            $data['data'][0]['end_fill'] = $data['data'][0]['end_fill'] ? Time::parse($data['data'][0]['end_fill'], 'Asia/Jakarta')->toDateString('Y-m-d') : '';
        }
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('admin/evaluasi/use_template_instrument')
            . view('layout/footer');
    }

    public function editInstrumentProses()
    {
        $data = $this->request->getPost();

        // Data yang akan di-insert ke tabel 'instrumen_soal'
        $dataInstrumenSoal = array(
            'name' => $data['name'],
            'id_course' => $data['id_course'],
            'start_fill' => $data['start_fill'],
            'end_fill' => $data['end_fill'],
            'description' => $data['description']
        );

        $deletedInstrument =  model(InstrumentModel::class)->deleteByCourseId($data['id_course']);
        // $result = model(InstrumentModel::class)->delete($data['id_instrument']);
        // $result = model(InstrumentModel::class)->delete(10);
        // $result = model(InstrumentModel::class)->delete(11);

        if (!$deletedInstrument) {
            // Terjadi kesalahan saat penghapusan
            return redirect()->back()->withInput()->with('error', 'Maaf, terjadi kesalahan dalam proses edit instrument.');
        }

        model(InstrumentModel::class)->insert($dataInstrumenSoal);
        $instrument_id =  model(InstrumentModel::class)->getInsertID();

        $dataBagian = array();
        $dataSoal = array();
        $dataOpsi = array();
        $sectionNumber = 0;

        // Mencari dan menyiapkan data soal dan opsi jawaban dari input yang dinamis
        foreach ($data as $key => $value) {
            if (strpos($key, 'section') !== false && strpos($key, '_bagian') !== false) {
                preg_match('/section(\d+)/', $key, $matches);
                if (isset($matches[1])) {
                    $sectionNumber = $matches[1];
                    $dataBagian['id_instrument'] = $instrument_id;
                    $dataBagian['section'] = $data['section' . $sectionNumber . '_bagian'];

                    model(SectionModel::class)->insert($dataBagian);
                    $section_id =  model(SectionModel::class)->getInsertID();
                } else {
                    //     // Penanganan jika tidak ada nilai yang ditemukan
                    continue;
                }

                foreach ($data as $subKey => $subValue) {
                    if (strpos($subKey, 'card') !== false && preg_match('/_section' . $sectionNumber . '(?=$|\D)/', $subKey)) {
                        // Proses soal dan opsi jawaban untuk bagian yang sesuai dengan nomor bagian
                        preg_match('/card(\d+)/', $subKey, $matchesCard);
                        if (isset($matchesCard[1])) {
                            $index = $matchesCard[1];
                        }

                        // Cek apakah pertanyaan sudah pernah di-insert
                        $existingQuestion = model(QuestionModel::class)
                            ->where('number', $index)
                            ->where('id_section', $section_id)
                            ->first();

                        if (!$existingQuestion) {
                            $dataSoal['id_section'] = $section_id;
                            $dataSoal['number'] = $index;
                            $dataSoal['type'] = $data['card' . $index . '_section' . $sectionNumber . '_input_tipe_soal'];
                            $dataSoal['question'] = $subValue;

                            model(QuestionModel::class)->insert($dataSoal);
                            $soal_id =  model(QuestionModel::class)->getInsertID();

                            if ($data['card' . $index . '_section' . $sectionNumber . '_input_tipe_soal'] == 1) {
                                // Proses opsi jawaban hanya jika tipe soal adalah 1
                                $dataOpsi['id_question'] = $soal_id;
                                $dataOpsi['option_a'] = $data['card' . $index . '_section' . $sectionNumber . '_input_opsiA'];
                                $dataOpsi['option_b'] = $data['card' . $index . '_section' . $sectionNumber . '_input_opsiB'];
                                $dataOpsi['option_c'] = $data['card' . $index . '_section' . $sectionNumber . '_input_opsiC'];
                                $dataOpsi['option_d'] = $data['card' . $index . '_section' . $sectionNumber . '_input_opsiD'];
                                $dataOpsi['option_e'] = $data['card' . $index . '_section' . $sectionNumber . '_input_opsiE'];

                                model(OptionModel::class)->insert($dataOpsi);
                            }
                        }

                        unset(
                            $data['card' . $index . '_section' . $sectionNumber . '_input_pertanyaan'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_tipe_soal'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_opsiA'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_opsiB'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_opsiC'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_opsiD'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_opsiE']
                        );
                    }
                }
            }
        }

        return redirect()->back()->to(base_url('epp'))->withInput()->with('message', 'Instrument Berhasil Diubah');
    }
    public function editTemplateInstrumentProses()
    {
        $data = $this->request->getPost();

        $template_id = $data['id_template'];
        $old_instrument_id = $data['id_instrument'];

        $deletedInstrument =  model(InstrumentModel::class)->delete($old_instrument_id);
        if (!$deletedInstrument) {
            // Terjadi kesalahan saat penghapusan
            return redirect()->back()->withInput()->with('error', 'Maaf, terjadi kesalahan dalam proses edit instrument.');
        }

        // Data yang akan di-insert ke tabel 'instrumen_soal'
        $dataInstrumenSoal = array(
            'name' => $data['name'],
        );
        model(InstrumentModel::class)->insert($dataInstrumenSoal);
        $instrument_id =  model(InstrumentModel::class)->getInsertID();

        // edit isian table template
        $dataTemplate = array(
            'name' => $data['name'],
            'id_instrument' =>  $instrument_id,
        );

        $updatedTemplate =  model(TemplateModel::class)->update($template_id, $dataTemplate);
        if (!$updatedTemplate) {
            return redirect()->back()->withInput()->with('error', 'Maaf, terjadi kesalahan dalam proses pengubahan template.');
        }


        $dataBagian = array();
        $dataSoal = array();
        $dataOpsi = array();
        $sectionNumber = 0;

        // Mencari dan menyiapkan data soal dan opsi jawaban dari input yang dinamis
        foreach ($data as $key => $value) {
            if (strpos($key, 'section') !== false && strpos($key, '_bagian') !== false) {
                preg_match('/section(\d+)/', $key, $matches);
                if (isset($matches[1])) {
                    $sectionNumber = $matches[1];
                    $dataBagian['id_instrument'] = $instrument_id;
                    $dataBagian['section'] = $data['section' . $sectionNumber . '_bagian'];

                    model(SectionModel::class)->insert($dataBagian);
                    $section_id =  model(SectionModel::class)->getInsertID();
                } else {
                    //     // Penanganan jika tidak ada nilai yang ditemukan
                    continue;
                }

                foreach ($data as $subKey => $subValue) {
                    if (strpos($subKey, 'card') !== false && preg_match('/_section' . $sectionNumber . '(?=$|\D)/', $subKey)) {
                        // Proses soal dan opsi jawaban untuk bagian yang sesuai dengan nomor bagian
                        preg_match('/card(\d+)/', $subKey, $matchesCard);
                        if (isset($matchesCard[1])) {
                            $index = $matchesCard[1];
                        }

                        // Cek apakah pertanyaan sudah pernah di-insert
                        $existingQuestion = model(QuestionModel::class)
                            ->where('number', $index)
                            ->where('id_section', $section_id)
                            ->first();

                        if (!$existingQuestion) {
                            $dataSoal['id_section'] = $section_id;
                            $dataSoal['number'] = $index;
                            $dataSoal['type'] = $data['card' . $index . '_section' . $sectionNumber . '_input_tipe_soal'];
                            $dataSoal['question'] = $subValue;

                            model(QuestionModel::class)->insert($dataSoal);
                            $soal_id =  model(QuestionModel::class)->getInsertID();

                            if ($data['card' . $index . '_section' . $sectionNumber . '_input_tipe_soal'] == 1) {
                                // Proses opsi jawaban hanya jika tipe soal adalah 1
                                $dataOpsi['id_question'] = $soal_id;
                                $dataOpsi['option_a'] = $data['card' . $index . '_section' . $sectionNumber . '_input_opsiA'];
                                $dataOpsi['option_b'] = $data['card' . $index . '_section' . $sectionNumber . '_input_opsiB'];
                                $dataOpsi['option_c'] = $data['card' . $index . '_section' . $sectionNumber . '_input_opsiC'];
                                $dataOpsi['option_d'] = $data['card' . $index . '_section' . $sectionNumber . '_input_opsiD'];
                                $dataOpsi['option_e'] = $data['card' . $index . '_section' . $sectionNumber . '_input_opsiE'];

                                model(OptionModel::class)->insert($dataOpsi);
                            }
                        }

                        unset(
                            $data['card' . $index . '_section' . $sectionNumber . '_input_pertanyaan'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_tipe_soal'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_opsiA'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_opsiB'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_opsiC'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_opsiD'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_opsiE']
                        );
                    }
                }
            }
        }

        return redirect()->back()->to(base_url('instrument/template'))->withInput()->with('message', 'Template Berhasil Diubah');
    }
    public function fillInstrument($id_pelatihan)
    {
        // push eval
        $data['id_course'] = $id_pelatihan;
        $data['data'] = model(InstrumentModel::class)->getInstrument($id_pelatihan);

        if (empty($data['data'])) {
            return redirect()->back()->to(base_url('epp'))->withInput()->with('error', 'Intrument Belum dibuat');
        }
        // dd($data);
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('admin/evaluasi/fill_instrument')
            . view('layout/footer');
    }
    public function perviewInstrument($id_pelatihan)
    {
        $data['id_course'] = $id_pelatihan;
        $data['data'] = model(InstrumentModel::class)->getInstrument($id_pelatihan);

        if (empty($data['data'])) {
            return redirect()->back()->to(base_url('epp'))->withInput()->with('error', 'Intrument Belum dibuat');
        } else {
            // dd($data);
            foreach ($data['data'] as $key => $value) {
                $data['data'][$key]['start_fill'] = !empty($value['start_fill']) ? Time::parse($value['start_fill'], 'Asia/Jakarta')->toDateString('Y-m-d') : '';
                $data['data'][$key]['end_fill'] = !empty($value['end_fill']) ? Time::parse($value['end_fill'], 'Asia/Jakarta')->toDateString('Y-m-d') : '';
            }
            // d($value['start_fill']);
        }
        // dd($data);
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('admin/evaluasi/perview_instrument')
            . view('layout/footer');
    }
    public function insertInstrumentProses()
    {
        $data = $this->request->getPost();

        // Data yang akan di-insert ke tabel 'instrumen_soal'
        $dataInstrumenSoal = array(
            'name' => $data['name'],
            'id_course' => $data['id_course'],
            'start_fill' => $data['start_fill'],
            'end_fill' => $data['end_fill'],
            'description' => $data['description']
        );

        model(InstrumentModel::class)->insert($dataInstrumenSoal);
        $instrument_id =  model(InstrumentModel::class)->getInsertID();

        $dataBagian = array();
        $dataSoal = array();
        $dataOpsi = array();
        $sectionNumber = 0;

        // Mencari dan menyiapkan data soal dan opsi jawaban dari input yang dinamis
        foreach ($data as $key => $value) {
            if (strpos($key, 'section') !== false && strpos($key, '_bagian') !== false) {
                preg_match('/section(\d+)/', $key, $matches);
                if (isset($matches[1])) {
                    $sectionNumber = $matches[1];
                    $dataBagian['id_instrument'] = $instrument_id;
                    $dataBagian['section'] = $data['section' . $sectionNumber . '_bagian'];

                    model(SectionModel::class)->insert($dataBagian);
                    $section_id =  model(SectionModel::class)->getInsertID();
                } else {
                    //     // Penanganan jika tidak ada nilai yang ditemukan
                    continue;
                }

                foreach ($data as $subKey => $subValue) {
                    if (strpos($subKey, 'card') !== false && preg_match('/_section' . $sectionNumber . '(?=$|\D)/', $subKey)) {
                        // Proses soal dan opsi jawaban untuk bagian yang sesuai dengan nomor bagian
                        preg_match('/card(\d+)/', $subKey, $matchesCard);
                        if (isset($matchesCard[1])) {
                            $index = $matchesCard[1];
                        }

                        // Cek apakah pertanyaan sudah pernah di-insert
                        $existingQuestion = model(QuestionModel::class)
                            ->where('number', $index)
                            ->where('id_section', $section_id)
                            ->first();

                        if (!$existingQuestion) {
                            $dataSoal['id_section'] = $section_id;
                            $dataSoal['number'] = $index;
                            $dataSoal['type'] = $data['card' . $index . '_section' . $sectionNumber . '_input_tipe_soal'];
                            $dataSoal['question'] = $subValue;

                            model(QuestionModel::class)->insert($dataSoal);
                            $soal_id =  model(QuestionModel::class)->getInsertID();

                            if ($data['card' . $index . '_section' . $sectionNumber . '_input_tipe_soal'] == 1) {
                                // Proses opsi jawaban hanya jika tipe soal adalah 1
                                $dataOpsi['id_question'] = $soal_id;
                                $dataOpsi['option_a'] = $data['card' . $index . '_section' . $sectionNumber . '_input_opsiA'];
                                $dataOpsi['option_b'] = $data['card' . $index . '_section' . $sectionNumber . '_input_opsiB'];
                                $dataOpsi['option_c'] = $data['card' . $index . '_section' . $sectionNumber . '_input_opsiC'];
                                $dataOpsi['option_d'] = $data['card' . $index . '_section' . $sectionNumber . '_input_opsiD'];
                                $dataOpsi['option_e'] = $data['card' . $index . '_section' . $sectionNumber . '_input_opsiE'];

                                model(OptionModel::class)->insert($dataOpsi);
                            }
                        }

                        unset(
                            $data['card' . $index . '_section' . $sectionNumber . '_input_pertanyaan'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_tipe_soal'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_opsiA'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_opsiB'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_opsiC'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_opsiD'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_opsiE']
                        );
                    }
                }
            }
        }

        return redirect()->back()->to(base_url('epp'))->withInput()->with('message', 'Instrument Berhasil dibuat');
    }
    public function insertTemplateInstrumentProses()
    {
        $data = $this->request->getPost();

        // Data yang akan di-insert ke tabel 'instrumen_soal'
        $dataInstrumenSoal = array(
            'name' => $data['name'],
            // 'id_course' => $data['id_course'],
            // 'start_fill' => $data['start_fill'],
            // 'end_fill' => $data['end_fill'],
            // 'description' => $data['description']
        );

        model(InstrumentModel::class)->insert($dataInstrumenSoal);
        $instrument_id =  model(InstrumentModel::class)->getInsertID();

        $dataTemplate = array(
            'name' => $data['name'],
            'id_instrument' =>  $instrument_id,
        );

        $createdTemplate =  model(TemplateModel::class)->insert($dataTemplate);
        if (!$createdTemplate) {
            return redirect()->back()->withInput()->with('error', 'Maaf, terjadi kesalahan dalam proses pembuatan template.');
        }

        $dataBagian = array();
        $dataSoal = array();
        $dataOpsi = array();
        $sectionNumber = 0;
        d($data);
        // Mencari dan menyiapkan data soal dan opsi jawaban dari input yang dinamis
        foreach ($data as $key => $value) {
            if (strpos($key, 'section') !== false && strpos($key, '_bagian') !== false) {
                preg_match('/section(\d+)/', $key, $matches);
                if (isset($matches[1])) {
                    $sectionNumber = $matches[1];
                    $dataBagian['id_instrument'] = $instrument_id;
                    $dataBagian['section'] = $data['section' . $sectionNumber . '_bagian'];

                    model(SectionModel::class)->insert($dataBagian);
                    $section_id =  model(SectionModel::class)->getInsertID();
                } else {
                    //     // Penanganan jika tidak ada nilai yang ditemukan
                    continue;
                }
                d($key, $sectionNumber);
                foreach ($data as $subKey => $subValue) {
                    // Memperbarui kondisi untuk memastikan pencocokan nomor bagian yang tepat
                    d($subKey);
                    if (strpos($subKey, 'card') !== false && preg_match('/_section' . $sectionNumber . '(?=$|\D)/', $subKey)) {
                        // Proses soal dan opsi jawaban untuk bagian yang sesuai dengan nomor bagian
                        preg_match('/card(\d+)/', $subKey, $matchesCard);
                        if (isset($matchesCard[1])) {
                            $index = $matchesCard[1];
                        }
                        //  else {
                        //     //     // Penanganan jika tidak ada nilai yang ditemukan
                        //     continue;
                        // }

                        // d($subValue);
                        // Cek apakah pertanyaan sudah pernah di-insert
                        $existingQuestion = model(QuestionModel::class)
                            ->where('number', $index)
                            ->where('id_section', $section_id)
                            ->first();

                        if (!$existingQuestion) {
                            $dataSoal['id_section'] = $section_id;
                            $dataSoal['number'] = $index;
                            $dataSoal['type'] = $data['card' . $index . '_section' . $sectionNumber . '_input_tipe_soal'];
                            $dataSoal['question'] = $subValue;

                            model(QuestionModel::class)->insert($dataSoal);
                            $soal_id =  model(QuestionModel::class)->getInsertID();

                            if ($data['card' . $index . '_section' . $sectionNumber . '_input_tipe_soal'] == 1) {
                                // Proses opsi jawaban hanya jika tipe soal adalah 1
                                $dataOpsi['id_question'] = $soal_id;
                                $dataOpsi['option_a'] = $data['card' . $index . '_section' . $sectionNumber . '_input_opsiA'];
                                $dataOpsi['option_b'] = $data['card' . $index . '_section' . $sectionNumber . '_input_opsiB'];
                                $dataOpsi['option_c'] = $data['card' . $index . '_section' . $sectionNumber . '_input_opsiC'];
                                $dataOpsi['option_d'] = $data['card' . $index . '_section' . $sectionNumber . '_input_opsiD'];
                                $dataOpsi['option_e'] = $data['card' . $index . '_section' . $sectionNumber . '_input_opsiE'];

                                model(OptionModel::class)->insert($dataOpsi);
                            }
                        }

                        unset(
                            $data['card' . $index . '_section' . $sectionNumber . '_input_pertanyaan'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_tipe_soal'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_opsiA'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_opsiB'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_opsiC'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_opsiD'],
                            $data['card' . $index . '_section' . $sectionNumber . '_input_opsiE']
                        );
                    }
                }
            }
        }
        // $dataBagian = array();
        // $dataSoal = array();
        // $dataOpsi = array();
        // $sectionNumber = 0;
        // dd($dataBagian, $dataSoal, $dataOpsi, $sectionNumber);
        return redirect()->back()->to(base_url('instrument/template'))->withInput()->with('message', 'Instrument Berhasil dibuat');
    }

    public function deleteTemplateInstrument($template_id)
    {
        $deletedInstrument = false;
        $deletedTemplate =  false;
        $result = model(TemplateModel::class)->find($template_id);
        // dd($result);
        if ($result) {
            $deletedInstrument = model(InstrumentModel::class)->delete($result['id_instrument']);
            $deletedTemplate =  model(TemplateModel::class)->delete($template_id);
        }


        if (!($deletedTemplate && $deletedInstrument)) {
            return redirect()->back()->withInput()->with('error', 'Maaf, terjadi kesalahan dalam proses menghapus template.');
        }

        return redirect()->back()->to(base_url('instrument/template'))->withInput()->with('message', 'Instrument Berhasil Dihapus');
    }
}
