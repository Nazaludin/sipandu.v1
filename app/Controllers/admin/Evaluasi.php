<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;
use \App\Models\InstrumentModel;
use App\Models\OptionModel;
use App\Models\QuestionModel;
use App\Models\SectionModel;
use App\Models\TemplateModel;
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
        $url = 'http://best-bapelkes.jogjaprov.go.id/webservice/rest/server.php?wstoken=26a8df1bbd691fcdc570159cac7f00e7' . $function . '&moodlewsrestformat=json';
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
                $dataPelatihan->courses[0]->accepted_participant    = model(UserCourseModel::class)->where('id_course', $value['id'])->whereIn('status', ['accept', 'passed'])->countAllResults();
                $dataPelatihan->courses[0]->participant             = model(UserCourseModel::class)->where('id_course', $value['id'])->countAllResults();
                $pelatihan['courses'][$key]   = $dataPelatihan->courses[0];
            }
        }

        $data['pelatihan'] = isset($pelatihan) ? json_encode($pelatihan) : json_encode([]);
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
            $pelatihan['courses'][$key]   = $dataPelatihan->courses[0];
        }
        // dd("test");
        // return isset($pelatihan) ? json_encode($pelatihan) : json_encode([]);
        $data['pelatihan'] = isset($pelatihan) ? json_encode($pelatihan) : json_encode([]);
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
    public function rekapInstrument()
    {
        return redirect()->back()->to(base_url('epp'))->withInput()->with('error', 'Intrument Belum dibuat');
        // return view('layout/header')
        //     . view('layout/sidebar')
        //     . view('admin/evaluasi/instrument')
        //     . view('layout/footer');
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
                    if (strpos($subKey, 'card') !== false && strpos($subKey, '_section' . $sectionNumber) !== false) {
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
                    if (strpos($subKey, 'card') !== false && strpos($subKey, '_section' . $sectionNumber) !== false) {
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
                    if (strpos($subKey, 'card') !== false && strpos($subKey, '_section' . $sectionNumber) !== false) {
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
                    if (strpos($subKey, 'card') !== false && strpos($subKey, '_section' . $sectionNumber) !== false) {
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

        return redirect()->back()->to(base_url('instrument/template'))->withInput()->with('message', 'Instrument Berhasil dibuat');
    }

    public function deleteTemplateInstrument($template_id)
    {
        // $template_id = $this->request->getPost('id_template');
        $deletedTemplate =  model(TemplateModel::class)->delete($template_id);
        if (!$deletedTemplate) {
            return redirect()->back()->withInput()->with('error', 'Maaf, terjadi kesalahan dalam proses menghapus template.');
        }

        return redirect()->back()->to(base_url('instrument/template'))->withInput()->with('message', 'Instrument Berhasil Dihapus');
    }
}
