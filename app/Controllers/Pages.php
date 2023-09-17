<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use Myth\Auth\Models\UserModel;
use Loncat\Moody\AppFactory;
use Loncat\Moody\Config;
use Loncat\Moody\Contract;
use \App\Models\CourseModel;
use \App\Models\UploadDocumentModel;
use \App\Models\DownloadDocumentModel;
use \App\Models\UserCourseModel;
use \App\Models\UserUploadDocumentModel;
use \App\Controllers\Admin;
use stdClass;

class Pages extends BaseController
{
    protected $MoodyBest;
    protected $AdminControl;
    protected $UsersModel;
    protected $CourseModel;
    protected $UploadDocumentModel;
    protected $DownloadDocumentModel;
    protected $UserCourseModel;
    protected $UserUploadDocumentModel;
    protected $apiKey = 'TczH6QUUVuXOoZKT2qoJ6JHfctAkD8';
    protected $apiURL = 'https://api.goapi.id/v1/regional/';

    public function __construct()
    {
        $this->AdminControl  = new Admin();
        $this->UsersModel  = new UserModel();
        $this->CourseModel  = new CourseModel();
        $this->UploadDocumentModel  = new UploadDocumentModel();
        $this->DownloadDocumentModel  = new DownloadDocumentModel();
        $this->UserCourseModel  = new UserCourseModel();
        $this->UserUploadDocumentModel  = new UserUploadDocumentModel();

        $configBest = new Config("http://best-bapelkes.jogjaprov.go.id/webservice/rest/server.php", "8d52a95d541a42e81f955536e8927e9a");
        $this->MoodyBest = AppFactory::create($configBest);
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
        // $bulan = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $tgl = $time->toDateString('Y-m-d');
        // $tgl_formatted = str_replace("+++", $bulan[$time->getMonth() - 1], $tgl);
        return $tgl;
    }
    public function convertCondition($condition, $id_pelatihan = null, $startregis = null, $endregis = null, $startdate = null, $enddate = null)
    {
        $now = new Time('now', 'Asia/Jakarta');
        $nowTimestamp = $now->getTimestamp();
        $result = '';
        if (isset($id_pelatihan)) {
            switch (true) {
                case $enddate <= $nowTimestamp:
                    $condition = 'passed';
                    $result = 'Pelatihan Berakhir';
                    break;
                case $startdate <= $nowTimestamp:
                    $condition = 'begin';
                    $result = 'Pelatihan Dimulai';
                    break;
                case $endregis <= $nowTimestamp:
                    $condition = 'end';
                    $result = 'Pendaftaran Berkahir';
                    break;
                case $startregis <= $nowTimestamp:
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
            switch (true) {
                case $condition == 'coming':
                    $result = 'Pendaftaran Belum Aktif';
                    break;
                case $condition == 'going':
                    $result = 'Pendaftaran Aktif';
                    break;
                case $condition == 'end':
                    $result = 'Pendaftaran Berkahir';
                    break;
                case $condition == 'begin':
                    $result = 'Pelatihan Dimulai';
                    break;
                case $condition == 'passed':
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
    public function index()
    {
        // dd(system_status());
        $pengguna = session()->get('logged_in');
        $data['data'] = $this->UsersModel->where('id', $pengguna)->get()->getRow();
        $dump = explode(" ", $data['data']->tanggal_lahir);
        (!empty($dump[0])) ? $data['data']->tanggal_lahir = $dump[0] : '';
        // dd($data);
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('basic/profil/index')
            . view('layout/footer');
    }
    public function pelatihanBatal($id_pelatihan)
    {
        $id_user_course = model(UserCourseModel::class)->where('id_course', $id_pelatihan)->where('id_user', user_id())->findColumn('id');
        if (isset($id_user_course)) {
            model(UserCourseModel::class)->delete($id_user_course[0]);
        } else {
            return redirect()->to(base_url('/pelatihan/berlangsung'))->with('error', 'Terjadi kesalahan dalam pembatalan pelatihan!');
        }

        return redirect()->to(base_url('/pelatihan/berlangsung'))->with('message', 'Berhasil membatalkan pendaftaran.');
    }
    public function pelatihanRiwayat()
    {
        $pengguna = session()->get('logged_in');
        $data['data'] = $this->UsersModel->where('id', $pengguna)->get()->getRow();
        $dump = explode(" ", $data['data']->tanggal_lahir);
        (!empty($dump[0])) ? $data['data']->tanggal_lahir = $dump[0] : '';

        $pelatihan = [];
        $i = 0;

        // Data Pelatihan API
        $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field'));
        foreach ($dataPelatihan->courses as $key => $value) {
            $value->startdatetime = $this->toLocalTime($value->startdate);
            $value->enddatetime = $this->toLocalTime($value->enddate);
            $pelatihan['courses'][$i] = $value;
            $i++;
        }

        $data['pelatihan'] = json_encode($dataPelatihan);

        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('basic/pelatihan/riwayat/index')
            . view('layout/footer');
    }

    private function dataPelatihan($page)
    {
        $user_course = $this->UserCourseModel->dataCourseUserByPage(user_id(), $page);
        // $user_course = $this->UserCourseModel->where('id_user', user_id())->where('status', 'register')->findAll();
        // dd($user_course);
        foreach ($user_course as $key => $value) {
            // Data Pelatihan API
            $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field&field=id&value=' . $value['id_course'] . ''));
            $courseLocal =  $this->CourseModel->find($dataPelatihan->courses[0]->id);
            // dd($dataPelatihan);

            // d($value);
            $dataPelatihan->courses[0]->status                  = $value['status'];
            $dataPelatihan->courses[0]->condition               = isset($courseLocal['condition']) ? $this->convertCondition(
                $courseLocal['condition'],
                $courseLocal['id'],
                isset($value['start_registration']) ? Time::parse($courseLocal['start_registration'], 'Asia/Jakarta')->getTimestamp() : null,
                isset($value['end_registration']) ? Time::parse($courseLocal['end_registration'], 'Asia/Jakarta')->getTimestamp() : null,
                isset($dataPelatihan->courses[0]->startdate) ? $dataPelatihan->courses[0]->startdate : null,
                isset($dataPelatihan->courses[0]->enddate) ? $dataPelatihan->courses[0]->enddate : null,
            ) : '';
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
        return isset($pelatihan) ? json_encode($pelatihan) : json_encode([]);
    }
    private function dataDetailPelatihan($id_pelatihan)
    {
        // Data Pelatihan API
        $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field&field=id&value=' . $id_pelatihan . ''));

        $dataPelatihan->courses[0]->startdatetime = $this->toLocalTime($dataPelatihan->courses[0]->startdate);
        $dataPelatihan->courses[0]->enddatetime = $this->toLocalTime($dataPelatihan->courses[0]->enddate);


        $courseLocal =  $this->CourseModel->find($id_pelatihan);

        $dataPelatihan->courses[0]->condition               = $courseLocal['condition'] ?? '';
        $dataPelatihan->courses[0]->start_registration      = isset($courseLocal['start_registration']) ? $this->dateToLocalTime($courseLocal['start_registration']) : '';
        $dataPelatihan->courses[0]->end_registration        = isset($courseLocal['end_registration']) ? $this->dateToLocalTime($courseLocal['end_registration']) :  '';
        $dataPelatihan->courses[0]->year                    = isset($courseLocal['end_registration']) ? Time::parse($courseLocal['end_registration'], 'Asia/Jakarta')->getYear() : '';
        $dataPelatihan->courses[0]->target_participant      = $courseLocal['target_participant'] ?? '';
        $dataPelatihan->courses[0]->batch                   = $courseLocal['batch'] ?? '';
        $dataPelatihan->courses[0]->quota                   = $courseLocal['quota'] ?? '';
        $dataPelatihan->courses[0]->place                   = $courseLocal['place'] ?? '';
        $dataPelatihan->courses[0]->contact_person          = $courseLocal['contact_person'] ?? '';
        $dataPelatihan->courses[0]->schedule_file           = $courseLocal['schedule_file'] ?? '';

        $pelatihan['courses'] = $dataPelatihan->courses[0];
        $data['pelatihan'] = json_encode($pelatihan);
        // dd('yess');

        $data['list_course_donwload_document'] = $this->listCourseDonwloadDocument($id_pelatihan);
        $data['list_course_upload_document'] = $this->listCourseUploadDocument($id_pelatihan);
        return $data;
    }
    public function pelatihanDaftar()
    {
        $data['pelatihan'] = $this->dataPelatihan('daftar');

        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('basic/pelatihan/daftar/index')
            . view('layout/footer');
    }

    public function detailDaftarProses($id_pelatihan)
    {
        $data = $this->dataDetailPelatihan($id_pelatihan);
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('basic/pelatihan/daftar/detail')
            . view('layout/footer');
    }
    public function pelatihanBerlangsung()
    {
        $data['pelatihan'] = $this->dataPelatihan('berlangsung');

        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('basic/pelatihan/berlangsung/index')
            . view('layout/footer');
    }

    public function detailBerlangsungProses($id_pelatihan)
    {
        $data = $this->dataDetailPelatihan($id_pelatihan);
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('basic/pelatihan/berlangsung/detail')
            . view('layout/footer');
    }

    public function toDateFormat($tgl)
    {
        return Time::parse($tgl, 'Asia/Jakarta');
    }


    public function pelatihanAgenda()
    {
        $pelatihanPublish = model(CourseModel::class)->where('status_sistem', 'publish')->findAll();
        $userCourse = model(UserCourseModel::class)->where('id_user', user_id())->findAll();
        d($pelatihanPublish, !empty($pelatihanPublish));

        if (!empty($pelatihanPublish)) {
            $now = new Time('now', 'Asia/Jakarta');
            // $now = Time::createFromFormat('j-M-Y', '1-Jul-2023', 'Asia/Jakarta');
            // $year = Time::createFromFormat('j-M-Y', '1-Jan-' . $now->getYear(), 'Asia/Jakarta');
            foreach ($pelatihanPublish as $key => $value) {
                $finded = false;
                // Check apakah user sudah terdaftar di pelatihan "publish", skip jika iya
                if (!empty($userCourse)) {
                    // d($userCourse);
                    foreach ($userCourse as $keyUC => $valueUC) {
                        if ($value['id'] == $valueUC['id_course']) {
                            unset($value[$key]);
                            unset($valueUC[$keyUC]);
                            $finded = true;
                            break;
                        }
                    }
                }

                if ($finded) {
                    continue;
                }
                // Data Pelatihan API
                $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field&field=id&value=' . $value['id'] . ''));

                $dataPelatihan->courses[0]->condition               = isset($value['condition']) ? $this->convertCondition(
                    $value['condition'],
                    $value['id'],
                    isset($value['start_registration']) ? Time::parse($value['start_registration'], 'Asia/Jakarta')->getTimestamp() : null,
                    isset($value['end_registration']) ? Time::parse($value['end_registration'], 'Asia/Jakarta')->getTimestamp() : null,
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
                // d($now->getTimestamp(), $dataPelatihan->courses[0]->startdate);
                if ($now->getTimestamp() < $dataPelatihan->courses[0]->startdate) {
                    $pelatihan['courses'][$key]   = $dataPelatihan->courses[0];
                    // d($pelatihan);
                }
                // dd($pelatihan, $value['start_registration'], $now->getTimestamp(), Time::parse($value['start_registration'], 'Asia/Jakarta')->getTimestamp());
            }
        }

        $data['pelatihan'] = isset($pelatihan) ? json_encode($pelatihan) : json_encode([]);
        // dd($data);
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('basic/pelatihan/agenda/index')
            . view('layout/footer');
    }

    public function detailAgendaProses($id_pelatihan)
    {
        // $pengguna = session()->get('logged_in');
        // $data['data'] = $this->UsersModel->where('id', $pengguna)->get()->getRow();
        // $dump = explode(" ", $data['data']->tanggal_lahir);
        // (!empty($dump[0])) ? $data['data']->tanggal_lahir = $dump[0] : '';
        // $id_pelatihan = $this->request->getPost('id_pelatihan');

        // Data Pelatihan API
        $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field&field=id&value=' . $id_pelatihan . ''));

        $dataPelatihan->courses[0]->startdatetime = $this->toLocalTime($dataPelatihan->courses[0]->startdate);
        $dataPelatihan->courses[0]->enddatetime = $this->toLocalTime($dataPelatihan->courses[0]->enddate);


        $courseLocal =  $this->CourseModel->find($id_pelatihan);

        $dataPelatihan->courses[0]->condition               = $courseLocal['condition'] ?? '';
        $dataPelatihan->courses[0]->start_registration      = isset($courseLocal['start_registration']) ? $this->dateToLocalTime($courseLocal['start_registration']) : '';
        $dataPelatihan->courses[0]->end_registration        = isset($courseLocal['end_registration']) ? $this->dateToLocalTime($courseLocal['end_registration']) :  '';
        $dataPelatihan->courses[0]->year                    = isset($courseLocal['end_registration']) ? Time::parse($courseLocal['end_registration'], 'Asia/Jakarta')->getYear() : '';
        $dataPelatihan->courses[0]->target_participant      = $courseLocal['target_participant'] ?? '';
        $dataPelatihan->courses[0]->batch                   = $courseLocal['batch'] ?? '';
        $dataPelatihan->courses[0]->quota                   = $courseLocal['quota'] ?? '';
        $dataPelatihan->courses[0]->place                   = $courseLocal['place'] ?? '';
        $dataPelatihan->courses[0]->contact_person          = $courseLocal['contact_person'] ?? '';
        $dataPelatihan->courses[0]->schedule_file           = $courseLocal['schedule_file'] ?? '';

        $pelatihan['courses'] = $dataPelatihan->courses[0];
        $data['pelatihan'] = json_encode($pelatihan);
        // dd('yess');

        $data['list_course_donwload_document'] = $this->listCourseDonwloadDocument($id_pelatihan);
        $data['list_course_upload_document'] = $this->listCourseUploadDocument($id_pelatihan);
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('basic/pelatihan/agenda/detail')
            . view('layout/footer');
    }

    public function pelatihanRegis($id_pelatihan)
    {
        $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field&field=id&value=' . $id_pelatihan . ''));

        $dataPelatihan->courses[0]->startdatetime = $this->toLocalTime($dataPelatihan->courses[0]->startdate);
        $dataPelatihan->courses[0]->enddatetime = $this->toLocalTime($dataPelatihan->courses[0]->enddate);


        $courseLocal =  $this->CourseModel->find($id_pelatihan);

        $dataPelatihan->courses[0]->condition               = $courseLocal['condition'] ?? '';
        $dataPelatihan->courses[0]->start_registration      = isset($courseLocal['start_registration']) ? $this->dateToLocalTime($courseLocal['start_registration']) : '';
        $dataPelatihan->courses[0]->end_registration        = isset($courseLocal['end_registration']) ? $this->dateToLocalTime($courseLocal['end_registration']) :  '';
        $dataPelatihan->courses[0]->year                    = isset($courseLocal['end_registration']) ? Time::parse($courseLocal['end_registration'], 'Asia/Jakarta')->getYear() : '';
        $dataPelatihan->courses[0]->target_participant      = $courseLocal['target_participant'] ?? '';
        $dataPelatihan->courses[0]->batch                   = $courseLocal['batch'] ?? '';
        $dataPelatihan->courses[0]->quota                   = $courseLocal['quota'] ?? '';
        $dataPelatihan->courses[0]->place                   = $courseLocal['place'] ?? '';
        $dataPelatihan->courses[0]->contact_person          = $courseLocal['contact_person'] ?? '';
        $dataPelatihan->courses[0]->schedule_file           = $courseLocal['schedule_file'] ?? '';

        $pelatihan['courses'] = $dataPelatihan->courses[0];
        $data['pelatihan'] = json_encode($pelatihan);


        $data['upload_document'] = $this->AdminControl->listCourseUploadDocument($id_pelatihan);
        // dd($data['upload_document'], $id_pelatihan);
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('basic/pelatihan/agenda/registrasi')
            . view('layout/footer');
    }
    public function pelatihanRegisProses($id_pelatihan)
    {
        // $test = $this->MoodyBest->getUserById(2821);
        $MoodyUser = $this->MoodyBest->getUserByEmail(user_email());
        if (!empty($MoodyUser['error'])) {
            return redirect()->to(base_url('pelatihan/agenda/detail/' . $id_pelatihan))->withInput()->with('error', 'User Moodle ' . $MoodyUser['error']['message']);
        }
        // dd($MoodyUser);
        // dd($_SESSION, user_email());
        $data =  $this->request->getFiles();

        // dd($data, count($data), $data[1]);
        $this->UserCourseModel->insert(['id_course' => $id_pelatihan, 'id_user' => user_id(), 'status' => 'register']);
        $id_user_course = $this->UserCourseModel->getInsertID();
        $uploadDocument = $this->AdminControl->listCourseUploadDocument($id_pelatihan);

        foreach ($uploadDocument as $key => $value) {
            $file_upload = $data[$value['id']];

            if (isset($file_upload)) {
                if ($file_upload->isValid() && !($file_upload->hasMoved())) {
                    $newName = $file_upload->getRandomName();
                    $path = 'uploads/dokumen';

                    $file_upload->move(FCPATH . $path, $newName);

                    $dataInsert = [
                        'id_user_course'        => $id_user_course,
                        'id_upload_document'    => $value['id'],
                        'name'                  => $file_upload->getClientName(),
                        'link'                  => $path . '/' . $newName,
                        'status'                => 'new',
                    ];
                    $this->UserUploadDocumentModel->insert($dataInsert);
                }
            }
        }
        return redirect()->to(base_url('pelatihan/agenda/detail/' . $id_pelatihan));
    }

    public function login()
    {
        return view('login');
    }
    public function registrasi()
    {
        return view('register');
    }


    //fungsi menyimpan dokumen multiple
    public function uploadFotoProfil()
    {
        $pengguna = session()->get('logged_in');
        $file = $this->request->getFile('foto_profil');
        // d($file);
        if (isset($file)) {

            if ($file->isValid() && !($file->hasMoved())) {

                $newName = $file->getRandomName();
                $path = 'uploads/profil';
                // dd(base_url() . $path, FCPATH, WRITEPATH);
                $file->move(FCPATH . $path, $newName);
                $data = [
                    'nama_foto'          => $file->getClientName(),
                    'lokasi_foto'      => $path . '/' . $newName,
                ];
                $this->UsersModel->update($pengguna, $data);
                $succes = true;
            }
        }

        return redirect()->to(base_url('profil'))->withInput();
    }
    //fungsi menyimpan dokumen multiple
    public function updateUser()
    {
        $pengguna = session()->get('logged_in');
        $data = $this->request->getPost();
        d($pengguna, $data);
        $this->UsersModel->update($pengguna, $data);

        return redirect()->to(base_url('profil'))->withInput();
    }
    public function completeProfil()
    {
        $pengguna = session()->get('logged_in');
        $data = $this->request->getPost();
        $file = $this->request->getFile('croppedImage');
        // dd($data, $file);
        if (isset($file)) {

            if ($file->isValid() && !($file->hasMoved())) {

                $newName = $file->getRandomName();
                $path = 'uploads/profil';
                // dd(base_url() . $path, FCPATH, WRITEPATH);

                $file->move(FCPATH . $path, $newName);
                $data['nama_foto']      = $file->getClientName();
                $data['lokasi_foto']    = $path . '/' . $newName;
            }
        }
        // dd($pengguna, $data);
        $data['status_sistem'] = 'complete';
        $updateUser = model(UserModel::class)->update($pengguna, $data);
        if ($updateUser) {
            return redirect()->to(base_url('profil'))->withInput()->with('message', 'Data berhasil dilengkapi');
        } else {
            return redirect()->to(base_url('profil'))->withInput()->with('error', 'Terjadi Kesalahan');
        }
    }
    // public function registrasiProses()
    // {
    //     $data = $this->request->getPost();
    //     // dd($data);
    //     // dd($data);
    //     $this->UsersModel->save($data);
    //     $user_id = $this->UsersModel->getInsertID();
    //     $data_pengguna          = new stdClass;
    //     $data_pengguna->id      = $user_id;
    //     $data_pengguna->nama    = $data['nama'];

    //     $data_sess = [
    //         'pengguna'  => $data_pengguna,
    //         // 'sistem'    => $data_sistem,
    //     ];
    //     session()->set($data_sess);
    //     return redirect()->to(base_url('profil'))->withInput();
    // }
    // public function loginProses()
    // {
    //     $email       = $this->request->getPost('email');
    //     $password   = $this->request->getPost('password');
    //     // dd($email, $password);
    //     $input = $this->validate([
    //         'email' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required'    => 'Nama harus diisi!'
    //             ]
    //         ],
    //         'password' => [
    //             'rules' => 'min_length[6]|required',
    //             'errors' => [
    //                 'required'      => 'Kode akses harus diisi!',
    //                 'min_length'    => 'Password terlalu pendek!'
    //             ]
    //         ]
    //     ]);

    //     if (!$input) {
    //         session()->setFlashdata('error', 'Isian yang Anda masukkan tidak sesuai!');
    //         return redirect()->back()->withInput();
    //     }

    //     $pengguna = $this->UsersModel->where('email', $email)->get()->getRow();

    //     if (is_null($pengguna)) {
    //         session()->setFlashdata('error', 'Akun Anda tidak terdaftar!');
    //         return redirect()->back()->withInput();
    //     }

    //     if ($password == $pengguna->password) {

    //         $data_pengguna          = new stdClass;
    //         $data_pengguna->id      = $pengguna;
    //         $data_pengguna->nama    = $pengguna->nama;

    //         $data_sistem            = new stdClass;
    //         $data_sistem->logged_in = true;

    //         $data = [
    //             'pengguna'  => $data_pengguna,
    //             'sistem'    => $data_sistem,
    //         ];
    //         session()->set($data);
    //         return redirect()->to(base_url('profil'))->withInput();
    //     }
    //     session()->setFlashdata('error', 'Nama atau Kode Akses salah!');
    //     return redirect()->back()->withInput();
    // }
    // public function logout()
    // {
    //     session()->remove('pengguna');
    //     session()->remove('sistem');
    //     session()->destroy();
    //     return redirect()->to(base_url());
    // }
}
