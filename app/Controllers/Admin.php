<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use Myth\Auth\Models\UserModel;
use \App\Models\CourseModel;
use \App\Models\UploadDocumentModel;
use \App\Models\DownloadDocumentModel;
use stdClass;

class Admin extends BaseController
{
    protected $UsersModel;
    protected $CourseModel;
    protected $UploadDocumentModel;
    protected $DownloadDocumentModel;
    protected $apiKey = 'TczH6QUUVuXOoZKT2qoJ6JHfctAkD8';
    protected $apiURL = 'https://api.goapi.id/v1/regional/';

    public function __construct()
    {
        $this->UsersModel  = new UserModel();
        $this->CourseModel  = new CourseModel();
        $this->UploadDocumentModel  = new UploadDocumentModel();
        $this->DownloadDocumentModel  = new DownloadDocumentModel();
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
        // $dataPelatihan->courses[0]->startdatetime           = isset($dataPelatihan->courses[0]->startdate) ? $this->toDMY($dataPelatihan->courses[0]->startdate) : '';
        // $dataPelatihan->courses[0]->enddatetime             = isset($dataPelatihan->courses[0]->enddate) ? $this->toDMY($dataPelatihan->courses[0]->enddate) : '';

        $courseLocal =  $this->CourseModel->find($id_pelatihan);

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
        // dd($data);
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('admin/pelatihan/edit')
            . view('layout/footer');
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
            'name_uplaod_document'         => $data['name_uplaod_document'],
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
}
