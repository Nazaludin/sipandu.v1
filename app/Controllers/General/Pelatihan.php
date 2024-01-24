<?php

namespace App\Controllers\General;

use App\Controllers\BaseController;
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
use \App\Controllers\Admin\Pelatihan as AdminController;
use stdClass;

class Pelatihan extends BaseController
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
        $this->AdminControl  = new AdminController();
        $this->UsersModel  = new UserModel();
        $this->CourseModel  = new CourseModel();
        $this->UploadDocumentModel  = new UploadDocumentModel();
        $this->DownloadDocumentModel  = new DownloadDocumentModel();
        $this->UserCourseModel  = new UserCourseModel();
        $this->UserUploadDocumentModel  = new UserUploadDocumentModel();

        $apiKeyMoody =  getenv('API_KEY_MOODY');
        $configBest = new Config("http://best-bapelkes.jogjaprov.go.id/webservice/rest/server.php", $apiKeyMoody);
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
        $now = now('Asia/Jakarta');
        // dd($now);
        // $nowTimestamp = $now->getTimestamp();
        $result = '';

        if (isset($id_pelatihan)) {
            switch (true) {
                case ($enddate <= $now):
                    $condition = 'passed';
                    $result = 'Pelatihan Berakhir';
                    model(UserCourseModel::class)->setStatusPassed($id_pelatihan); //control status accept to passed
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


    public function pelatihanBatal($id_pelatihan)
    {
        $id_user_course = model(UserCourseModel::class)->where('id_course', $id_pelatihan)->where('id_user', user_id())->findColumn('id');
        if (isset($id_user_course)) {
            model(UserCourseModel::class)->delete($id_user_course[0]);
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan dalam pembatalan pelatihan!');
        }

        return redirect()->back()->with('message', 'Berhasil membatalkan pendaftaran.');
    }


    private function dataPelatihan($page)
    {
        $user_course = $this->UserCourseModel->dataCourseUserByPage(user_id(), $page);
        // dd($user_course);
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
                isset($value['start_registration']) ? strtotime($courseLocal['start_registration']) : null,
                isset($value['end_registration']) ? strtotime($courseLocal['end_registration']) : null,
                isset($dataPelatihan->courses[0]->startdate) ? $dataPelatihan->courses[0]->startdate : null,
                isset($dataPelatihan->courses[0]->enddate) ? $dataPelatihan->courses[0]->enddate : null,
            ) : '';

            if ($page == 'riwayat') {
                $dataPelatihan->courses[0]->certificate_number              = $value['certificate_number'];
                $dataPelatihan->courses[0]->certificate_file_name           = $value['certificate_file_name'];
                $dataPelatihan->courses[0]->certificate_file_location       = $value['certificate_file_location'];
            }


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
        $userCourse = model(UserCourseModel::class)->where('id_course', $id_pelatihan)->where('id_user', user_id())->findAll();
        $uploadedDocument = model((UserUploadDocumentModel::class))->getUserUploadDocument($userCourse[0]['id']);

        $dataPelatihan->courses[0]->condition               = $courseLocal['condition'] ?? '';
        $dataPelatihan->courses[0]->start_registration      = isset($courseLocal['start_registration']) ? $this->dateToLocalTime($courseLocal['start_registration']) : '';
        $dataPelatihan->courses[0]->end_registration        = isset($courseLocal['end_registration']) ? $this->dateToLocalTime($courseLocal['end_registration']) :  '';
        $dataPelatihan->courses[0]->year                    = isset($courseLocal['end_registration']) ? Time::parse($courseLocal['end_registration'], 'Asia/Jakarta')->getYear() : '';
        $dataPelatihan->courses[0]->target_participant      = $courseLocal['target_participant'] ?? '';
        $dataPelatihan->courses[0]->batch                   = $courseLocal['batch'] ?? '';
        $dataPelatihan->courses[0]->quota                   = $courseLocal['quota'] ?? '';
        $dataPelatihan->courses[0]->place                   = $courseLocal['place'] ?? '';
        $dataPelatihan->courses[0]->contact_person          = $courseLocal['contact_person'] ?? '';
        $dataPelatihan->courses[0]->schedule_file_location  = $courseLocal['schedule_file_location'] ?? '';
        $dataPelatihan->courses[0]->schedule_file_name      = $courseLocal['schedule_file_name'] ?? '';
        $dataPelatihan->courses[0]->method                  = $courseLocal['method'] ?? '';

        $dataPelatihan->courses[0]->status_pelatihan        = $userCourse[0]['status'] ?? '';

        // $dataPelatihan->courses[0]->uploaded_document       = !empty($uploadedDocument) ? $uploadedDocument : [];

        $pelatihan['courses'] = $dataPelatihan->courses[0];
        $data['pelatihan'] = json_encode($pelatihan);
        $data['uploaded_document'] = !empty($uploadedDocument) ? $uploadedDocument : [];
        // dd($data, $userCourse, $uploadedDocument);

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

    public function pelatihanRiwayat()
    {
        $data['pelatihan'] = $this->dataPelatihan('riwayat');
        // dd($data);
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('basic/pelatihan/riwayat/index')
            . view('layout/footer');
    }
    public function detailRiwayatProses($id_pelatihan)
    {
        $data = $this->dataDetailPelatihan($id_pelatihan);
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('basic/pelatihan/riwayat/detail')
            . view('layout/footer');
    }

    public function toDateFormat($tgl)
    {
        return Time::parse($tgl, 'Asia/Jakarta');
    }


    public function pelatihanAgenda()
    {
        $pelatihanPublish = model(CourseModel::class)
            ->where('status_sistem', 'publish')
            ->whereNotIn('`condition`', ['begin', 'passed'])
            ->findAll();

        $userCourse = model(UserCourseModel::class)->where('id_user', user_id())->findAll();
        d($pelatihanPublish, !empty($pelatihanPublish));
        // dd($userCourse);
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
                // d($now->getTimestamp(), $dataPelatihan->courses[0]->startdate);
                d(isset($dataPelatihan->courses[0]->startdate) ?? null);
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
        $dataPelatihan->courses[0]->schedule_file_location  = $courseLocal['schedule_file_location'] ?? '';
        $dataPelatihan->courses[0]->schedule_file_name      = $courseLocal['schedule_file_name'] ?? '';
        $dataPelatihan->courses[0]->method                  = $courseLocal['method'] ?? '';

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
        $data['id_pelatihan'] = $id_pelatihan;
        $data['upload_document'] = $this->AdminControl->listCourseUploadDocument($id_pelatihan);

        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('basic/pelatihan/agenda/registrasi')
            . view('layout/footer');
    }
    public function pelatihanRevisi($id_pelatihan)
    {
        $userCourse = model(UserCourseModel::class)->where('id_course', $id_pelatihan)->where('id_user', user_id())->findAll();
        $uploadedDocument = model((UserUploadDocumentModel::class))->getUserUploadDocument($userCourse[0]['id']);

        $data['id_pelatihan'] = $id_pelatihan;
        $data['upload_document'] = $this->AdminControl->listCourseUploadDocument($id_pelatihan);
        $data['comment'] = $userCourse[0]['comment'];
        $data['uploaded_document'] = $uploadedDocument;

        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('basic/pelatihan/daftar/revisi')
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
        $id_user = user_id();
        $isInsert = true;

        $userCourse = $this->UserCourseModel->where(['id_course' => $id_pelatihan, 'id_user' => $id_user])->first();
        if ($userCourse) {
            // Jika ditemukan, lakukan update
            $id_user_course =  $userCourse['id'];
            $isInsert = false;
        } else {
            // Jika tidak ditemukan, lakukan insert
            $this->UserCourseModel->insert(['id_course' => $id_pelatihan, 'id_user' => $id_user, 'status' => 'register']);
            $id_user_course = $this->UserCourseModel->getInsertID();
        }

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
                    if (!$isInsert) {
                        $user_uploaded_document = $this->UserUploadDocumentModel->where('id_user_course', $id_user_course)->findAll();
                        foreach ($user_uploaded_document as $user_uploaded_doc => $value_uploaded_doc) {
                            $this->deleteFileExists($value_uploaded_doc['id']);
                            $this->UserUploadDocumentModel->delete($value_uploaded_doc['id']);
                        }
                        $isInsert = true;
                    }
                    $this->UserUploadDocumentModel->insert($dataInsert);
                }
            }
        }
        return redirect()->to(base_url('pelatihan/daftar/detail/' . $id_pelatihan))->with('message', 'Berhasil mendaftar pelatihan!');
    }
    public function pelatihanRevisiProses($id_pelatihan)
    {
        $data =  $this->request->getFiles();

        $userCourse = model(UserCourseModel::class)->where('id_course', $id_pelatihan)->where('id_user', user_id())->findAll();
        $uploadedDocument = model((UserUploadDocumentModel::class))->getUserUploadDocument($userCourse[0]['id']);
        // dd($uploadedDocument);
        foreach ($uploadedDocument as $key => $value) {
            $file_upload = $data[$value['id']];

            if (isset($file_upload)) {
                if ($file_upload->isValid() && !($file_upload->hasMoved())) {
                    $newName = $file_upload->getRandomName();
                    $path = 'uploads/dokumen';

                    unlink(FCPATH . $value['link']);
                    $file_upload->move(FCPATH . $path, $newName);

                    $dataUpdate = [
                        'name'                  => $file_upload->getClientName(),
                        'link'                  => $path . '/' . $newName,
                        'status'                => 'revisi',
                    ];
                    $this->UserUploadDocumentModel->update($value['id_user_upload_document'], $dataUpdate);
                }
            }
        }
        model(UserCourseModel::class)->update($userCourse[0]['id'], ['status' => 'renew']);

        return redirect()->to(base_url('pelatihan/daftar/detail/' . $id_pelatihan));
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
    // public function login()
    // {
    //     return view('login');
    // }
    // public function registrasi()
    // {
    //     return view('register');
    // }


    //fungsi menyimpan dokumen multiple
    // public function uploadFotoProfil()
    // {
    //     $pengguna = session()->get('logged_in');
    //     $file = $this->request->getFile('foto_profil');
    //     // d($file);
    //     if (isset($file)) {

    //         if ($file->isValid() && !($file->hasMoved())) {

    //             $newName = $file->getRandomName();
    //             $path = 'uploads/profil';
    //             // dd(base_url() . $path, FCPATH, WRITEPATH);
    //             $file->move(FCPATH . $path, $newName);
    //             $data = [
    //                 'nama_foto'          => $file->getClientName(),
    //                 'lokasi_foto'      => $path . '/' . $newName,
    //             ];
    //             $this->UsersModel->update($pengguna, $data);
    //             $succes = true;
    //         }
    //     }

    //     return redirect()->to(base_url('profil'))->withInput();
    // }
    //fungsi menyimpan dokumen multiple
    // public function updateUser()
    // {
    //     $pengguna = session()->get('logged_in');
    //     $data = $this->request->getPost();
    //     d($pengguna, $data);
    //     $this->UsersModel->update($pengguna, $data);

    //     return redirect()->to(base_url('profil'))->withInput();
    // }

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
