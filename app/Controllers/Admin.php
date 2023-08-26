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
use \App\Models\CourseUploadDocumentModel;
use \App\Models\CourseDownloadDocumentModel;
use \App\Models\UserCourseModel;
use \App\Models\UserUploadDocumentModel;

class Admin extends BaseController
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

    public function convertCondition($condition)
    {
        $result = '';
        switch (true) {
            case $condition == 'coming':
                $result = 'Pendaftaran Belum Aktif';
                break;
            case $condition == 'going':
                $result = 'Pendaftaran Aktif';
                break;
            case $condition == 'passed':
                $result = 'Pendaftaran Telah Berakhir';
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
    public function pelatihan()
    {
        // dd();
        $result = $this->MoodyBest->getUserByEmail("admsipandu@gmail.com");
        var_dump($result);
        // dd($result);
        // $result = $this->MoodyBest->enrolUserToCourse("203", "2821", Contract::ROLE_ID_STUDENT);
        $result = $this->MoodyBest->getEnroledUsersByCourseId("203");
        var_dump($result);

        // Data Pelatihan API
        $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field'));
        // dd($dataPelatihan);

        $pelatihan = [];
        $i = 0;

        // $now = new Time('now', 'Asia/Jakarta');
        $now = Time::createFromFormat('j-M-Y', '1-Jul-2023', 'Asia/Jakarta');
        foreach ($dataPelatihan->courses as $key => $value) {
            if ($now->getTimestamp() < $value->startdate) {
                $value->startdatetime   = $this->toLocalTime($value->startdate);
                $value->enddatetime     = $this->toLocalTime($value->enddate);

                $courseLocal = model(CourseModel::class)->find($value->id);
                $value->condition           = isset($courseLocal['condition']) ? $this->convertCondition($courseLocal['condition']) : '';
                $value->start_registration  = isset($courseLocal['start_registration']) ? $this->dateToLocalTime($courseLocal['start_registration']) : '';
                $value->end_registration    = isset($courseLocal['end_registration']) ? $this->dateToLocalTime($courseLocal['end_registration']) : '';
                $value->batch               = $courseLocal['batch'] ?? '';
                $value->quota               = $courseLocal['quota'] ?? '';
                $value->registrar           = model(UserCourseModel::class)->where('id_course', $value->id)->where('status', 'register')->countAllResults();
                $value->participant         = model(UserCourseModel::class)->where('id_course', $value->id)->countAllResults();

                $pelatihan['courses'][$i] = $value;
                $i++;
            }
        }

        $data['pelatihan'] = json_encode($pelatihan);
        // dd($data);
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('admin/pelatihan/index')
            . view('layout/footer');
    }

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
            $data['fullname'],
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
                'start_registration'    => $data['start_registration'],
                'end_registration'      => $data['end_registration'],
                'target_participant'    => $data['target_participant'],
                'batch'                 => intval($data['batch']),
                'quota'                 => intval($data['quota']),
                'contact_person'        => $data['contact_person'],
                'status'                => 'create',
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
            return redirect()->to(base_url('pelatihan/insert/syarat/' . $result['data']['courseid']));
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
            dd('Terjadi Error');
        }

        return redirect()->to(base_url('pelatihan'));
    }


    // Menu User
    public function pelatihanUser($id_pelatihan)
    {
        $data = model(UserCourseModel::class)->where('id_course', $id_pelatihan)->findAll();
        $data_final = [];
        foreach ($data as $key => $value) {
            $data_user = model(UserModel::class)->find($value['id_user']);
            $data_final['user'][$key] = $data_user->toArray();
        }

        $data_final['id_pelatihan'] = $id_pelatihan;
        return view('layout/header', $data_final)
            . view('layout/sidebar')
            . view('admin/pelatihan/user')
            . view('layout/footer');
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

        return redirect()->to(base_url('pelatihan/detail/' . $id_pelatihan));
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

        return redirect()->to(base_url('pelatihan'));
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
