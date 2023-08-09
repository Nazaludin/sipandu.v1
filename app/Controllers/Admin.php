<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use Myth\Auth\Models\UserModel;
use \App\Models\CourseModel;
use \App\Models\UploadDocumentModel;
use \App\Models\DownloadDocumentModel;
use \App\Models\CourseUploadDocumentModel;
use \App\Models\CourseDownloadDocumentModel;
use \App\Models\UserCourseModel;
use \App\Models\UserUploadDocumentModel;
use stdClass;

class Admin extends BaseController
{
    protected $UsersModel;
    protected $CourseModel;
    protected $UploadDocumentModel;
    protected $DownloadDocumentModel;
    protected $CourseUploadDocumentModel;
    protected $CourseDownloadDocumentModel;
    protected $UserCourseModel;
    protected $UserUploadDocumentModel;
    protected $apiKey = 'TczH6QUUVuXOoZKT2qoJ6JHfctAkD8';
    protected $apiURL = 'https://api.goapi.id/v1/regional/';

    public function __construct()
    {
        $this->UsersModel  = new UserModel();
        $this->CourseModel  = new CourseModel();
        $this->UploadDocumentModel  = new UploadDocumentModel();
        $this->DownloadDocumentModel  = new DownloadDocumentModel();
        $this->CourseUploadDocumentModel  = new CourseUploadDocumentModel();
        $this->CourseDownloadDocumentModel  = new CourseDownloadDocumentModel();
        $this->UserCourseModel  = new UserCourseModel();
        $this->UserUploadDocumentModel  = new UserUploadDocumentModel();
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


    public function pelatihanKelola()
    {
        // Data Pelatihan API
        $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field'));

        $pelatihan = [];
        $i = 0;

        // $now = new Time('now', 'Asia/Jakarta');
        $now = Time::createFromFormat('j-M-Y', '1-Jul-2023', 'Asia/Jakarta');
        foreach ($dataPelatihan->courses as $key => $value) {
            if ($now->getTimestamp() < $value->startdate) {
                $value->startdatetime   = $this->toLocalTime($value->startdate);
                $value->enddatetime     = $this->toLocalTime($value->enddate);

                $courseLocal =  $this->CourseModel->find($value->id);
                $value->condition           = isset($courseLocal['condition']) ? $this->convertCondition($courseLocal['condition']) : '';
                $value->start_registration  = isset($courseLocal['start_registration']) ? $this->dateToLocalTime($courseLocal['start_registration']) : '';
                $value->end_registration    = isset($courseLocal['end_registration']) ? $this->dateToLocalTime($courseLocal['end_registration']) : '';
                $value->batch               = $courseLocal['batch'] ?? '';
                $value->quota               = $courseLocal['quota'] ?? '';

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
    public function pelatihanUser($id_pelatihan)
    {
        // Data Pelatihan API
        $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field&field=id&value=' . $id_pelatihan . ''));

        $dataPelatihan->courses[0]->startdatetime           = isset($dataPelatihan->courses[0]->startdate) ? $this->toLocalTime($dataPelatihan->courses[0]->startdate) : '';
        $dataPelatihan->courses[0]->enddatetime             = isset($dataPelatihan->courses[0]->enddate) ? $this->toLocalTime($dataPelatihan->courses[0]->enddate) : '';
        // $dataPelatihan->courses[0]->startdatetime           = $dataPelatihan->courses[0]->startdate ?? '';
        // $dataPelatihan->courses[0]->enddatetime             = $dataPelatihan->courses[0]->enddate ?? '';

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

        $data['list_course_donwload_document'] = $this->listCourseDonwloadDocument($id_pelatihan);
        $data['list_course_upload_document'] = $this->listCourseUploadDocument($id_pelatihan);
        // dd($data);
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('admin/pelatihan/user')
            . view('layout/footer');
    }
    public function detailKelola($id_pelatihan)
    {
        // Data Pelatihan API
        $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field&field=id&value=' . $id_pelatihan . ''));

        $dataPelatihan->courses[0]->startdatetime           = isset($dataPelatihan->courses[0]->startdate) ? $this->toLocalTime($dataPelatihan->courses[0]->startdate) : '';
        $dataPelatihan->courses[0]->enddatetime             = isset($dataPelatihan->courses[0]->enddate) ? $this->toLocalTime($dataPelatihan->courses[0]->enddate) : '';
        // $dataPelatihan->courses[0]->startdatetime           = $dataPelatihan->courses[0]->startdate ?? '';
        // $dataPelatihan->courses[0]->enddatetime             = $dataPelatihan->courses[0]->enddate ?? '';

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

        $data['list_course_donwload_document'] = $this->listCourseDonwloadDocument($id_pelatihan);
        $data['list_course_upload_document'] = $this->listCourseUploadDocument($id_pelatihan);
        // dd($data);
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('admin/pelatihan/detail')
            . view('layout/footer');
    }
    public function detailKelolaEdit($id_pelatihan)
    {
        // Data Pelatihan API
        $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field&field=id&value=' . $id_pelatihan . ''));
        $categoryPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_categories'));
        // $dataPelatihan->courses[0]->startdatetime           = isset($dataPelatihan->courses[0]->startdate) ? $this->toDMY($dataPelatihan->courses[0]->startdate) : '';
        // $dataPelatihan->courses[0]->enddatetime             = isset($dataPelatihan->courses[0]->enddate) ? $this->toDMY($dataPelatihan->courses[0]->enddate) : '';

        $courseLocal =  $this->CourseModel->find($id_pelatihan);
        // dd($dataPelatihan);
        $dataPelatihan->courses[0]->batch                   = $courseLocal['condition'] ?? '';
        $dataPelatihan->courses[0]->start_registration      = $courseLocal['start_registration'] ?? '';
        $dataPelatihan->courses[0]->end_registration        = $courseLocal['end_registration'] ?? '';
        $dataPelatihan->courses[0]->target_participant      = $courseLocal['target_participant'] ?? '';
        $dataPelatihan->courses[0]->batch                   = $courseLocal['batch'] ?? '';
        $dataPelatihan->courses[0]->quota                   = $courseLocal['quota'] ?? '';
        $dataPelatihan->courses[0]->place                   = $courseLocal['place'] ?? '';
        $dataPelatihan->courses[0]->contact_person          = $courseLocal['contact_person'] ?? '';
        $dataPelatihan->courses[0]->schedule_file           = $courseLocal['schedule_file'] ?? '';
        $dataPelatihan->courses[0]->startdatetime           = $this->toDMY($dataPelatihan->courses[0]->startdate);
        $dataPelatihan->courses[0]->enddatetime             = $this->toDMY($dataPelatihan->courses[0]->enddate);

        $pelatihan['courses']   = $dataPelatihan->courses[0];
        $data['pelatihan']      = json_encode($pelatihan);
        $data['kategori_pelatihan']      = $categoryPelatihan;

        $data['list_course_donwload_document'] = $this->listCourseDonwloadDocument($id_pelatihan);
        $data['list_course_upload_document'] = $this->listCourseUploadDocument($id_pelatihan);

        $dataDownloadDocument = $this->DownloadDocumentModel->findAll();
        $dataUploadDocument = $this->UploadDocumentModel->findAll();

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
    public function listCourseDonwloadDocument($id_pelatihan)
    {
        $temp = [];
        $dataCourseDownloadDocument = $this->CourseDownloadDocumentModel->where('id_course', $id_pelatihan)->findAll();
        foreach ($dataCourseDownloadDocument as $key => $value) {
            $result = $this->DownloadDocumentModel->where('id', $value['id_download_document'])->find();
            array_push($temp, $result[0]);
        }
        return $temp;
    }
    public function listCourseUploadDocument($id_pelatihan)
    {
        $temp = [];
        $dataCourseUploadDocument = $this->CourseUploadDocumentModel->where('id_course', $id_pelatihan)->findAll();
        foreach ($dataCourseUploadDocument as $key => $value) {
            $result = $this->UploadDocumentModel->where('id', $value['id_upload_document'])->find();
            array_push($temp, $result[0]);
        }
        return $temp;
    }
    public function toDateFormat($tgl)
    {
        return Time::parse($tgl, 'Asia/Jakarta');
    }
    public function detailKelolaEditProses($id_pelatihan)
    {

        $data =  $this->request->getPost();
        $file_schedule =  $this->request->getFile('jadwal');
        $file_download =  $this->request->getFile('downlaod_document');
        // $file_upload =  $this->request->getFile('uplaod_document');

        // dd($file_schedule, $file_upload, $file_download);
        $tgl = $this->request->getPost('startdate');
        $now = Time::parse($data['startdate'], 'Asia/Jakarta');
        $dataLokal = [
            'id'                    => $id_pelatihan,
            'condition'             => 'coming',
            'start_registration'    => $data['start_registration'],
            'end_registration'      => $data['end_registration'],
            'target_participant'    => $data['target_participant'],
            'batch'                 => intval($data['batch']),
            'quota'                 => intval($data['quota']),
            'contact_person'        => $data['contact_person'],
            // 'schedule_file'         => $data['schedule_file'],
            // 'name_uplaod_dokument'         => $data['name_uplaod_dokument'],
        ];

        $isSet = $this->CourseModel->find($id_pelatihan);
        $dataDownDucument = [
            'id_course' => $id_pelatihan,
            'name'      => 'tEST',
            'lokasi'    => '-',
        ];

        // $isSetDownDocument = ($this->DownloadDocumentModel->where('id_course', $id_pelatihan)->countAllResults() > 0) ? true : false;
        // if ($isSetDownDocument) {
        //     $this->CourseModel->update($id_pelatihan, $dataLokal);
        // } else {
        //     // $dataLokal['id'] = $id_pelatihan;
        //     $this->CourseModel->insert($dataLokal, false);
        // }
        // dd($isSetDownDocument);
        // $this->DownloadDocumentModel->insert($dataDownDucument);
        // $isSetUpDocument = $this->UploadDocumentModel->where('id_course', $id_pelatihan)->asArray()->findAll();
        // $isSetDownDocument = $this->DownloadDocumentModel->where('id_course', $id_pelatihan)->asArray()->findAll();
        // dd($isSetDownDocument);
        // dd($isSet, isset($isSet), $id_pelatihan);
        if (isset($isSet)) {
            $this->CourseModel->update($id_pelatihan, $dataLokal);
        } else {
            // $dataLokal['id'] = $id_pelatihan;
            $this->CourseModel->insert($dataLokal, false);
        }
        // if (isset($isSet)) {
        //     $this->CourseModel->update($id_pelatihan, $dataLokal);
        // } else {
        //     // $dataLokal['id'] = $id_pelatihan;
        //     $this->CourseModel->insert($dataLokal, false);
        // }
        return redirect()->to(base_url('admin/pelatihan/detail/' . $id_pelatihan));
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
                $this->DownloadDocumentModel->save($data);
                $succes = true;
            }
        }

        return redirect()->to(base_url('pelatihan/detail/edit/' . $id_pelatihan));
    }
    public function updateCourseDownloadDocument($id_pelatihan)
    {
        $document =  $this->request->getPost();
        $countCourseDocument = $this->CourseDownloadDocumentModel->where('id_course', $id_pelatihan)->countAllResults();
        $idDocumentAll = $this->DownloadDocumentModel->findColumn('id');
        foreach ($idDocumentAll as $key => $value) {
            $idLastDocument = $value;
        }
        // count($document);
        if ($countCourseDocument == 0) {
            for ($i = 1; $i <= $idLastDocument; $i++) {
                if (isset($document[$i])) {
                    // dd($document[$i], $i, $idLastDocument);
                    $data = ['id_course' => $id_pelatihan, 'id_download_document' => $i];
                    $this->CourseDownloadDocumentModel->insert($data);
                }
            }
        } else {
            $this->CourseDownloadDocumentModel->where('id_course', $id_pelatihan)->delete();
            for ($i = 1; $i <= $idLastDocument; $i++) {
                if (isset($document[$i])) {

                    $data = ['id_course' => $id_pelatihan, 'id_download_document' => $i];
                    $this->CourseDownloadDocumentModel->insert($data);
                }
            }
        }

        return redirect()->to(base_url('pelatihan/detail/edit/' . $id_pelatihan));
    }
    public function listDownloadDocument()
    {
        $id_pelatihan =  $this->request->getPost('id_course');
        $data = $this->DownloadDocumentModel->findAll();
        return json_encode($data);
    }
    public function insertUploadDocument($id_pelatihan)
    {
        $name =  $this->request->getPost('name_uplaod_document');
        $this->UploadDocumentModel->save(['name' => $name]);

        return redirect()->to(base_url('pelatihan/detail/edit/' . $id_pelatihan));
    }
    public function updateCourseUploadDocument($id_pelatihan)
    {
        $document =  $this->request->getPost();
        // dd($document);
        $countCourseDocument = $this->CourseUploadDocumentModel->where('id_course', $id_pelatihan)->countAllResults();
        $idDocumentAll = $this->UploadDocumentModel->findColumn('id');
        foreach ($idDocumentAll as $key => $value) {
            $idLastDocument = $value;
        }
        // count($document);
        if ($countCourseDocument == 0) {
            for ($i = 1; $i <= $idLastDocument; $i++) {
                if (isset($document[$i])) {
                    // dd($document[$i], $i, $idLastDocument);
                    $data = ['id_course' => $id_pelatihan, 'id_upload_document' => $i];
                    $this->CourseUploadDocumentModel->insert($data);
                }
            }
        } else {
            $this->CourseUploadDocumentModel->where('id_course', $id_pelatihan)->delete();
            for ($i = 1; $i <= $idLastDocument; $i++) {
                if (isset($document[$i])) {

                    $data = ['id_course' => $id_pelatihan, 'id_upload_document' => $i];
                    $this->CourseUploadDocumentModel->insert($data);
                }
            }
        }

        return redirect()->to(base_url('pelatihan/detail/edit/' . $id_pelatihan));
    }
    public function listUploadDocument()
    {
        $id_pelatihan =  $this->request->getPost('id_course');
        $data = $this->DownloadDocumentModel->findAll();
        return json_encode($data);
    }
    public function listUserCourse()
    {
        $id_pelatihan =  $this->request->getPost('id_course');
        $data = $this->UserCourseModel->where('id_course', $id_pelatihan)->findAll();
        $data_final = [];
        foreach ($data as $key => $value) {
            $data_user = $this->UsersModel->find($value['id_user']);
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
        $data = $this->UserCourseModel->where('id_course', $id_pelatihan)->findAll();
        $data_final = [];
        foreach ($data as $key => $value) {
            $data_user = $this->UsersModel->find($value['id_user']);
            $data_final[$key] = $data_user;
        }
        return json_encode($data_final);
    }
}
