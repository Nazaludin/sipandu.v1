<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use Myth\Auth\Models\UserModel;
use \App\Models\CourseModel;
use \App\Models\UploadDocumentModel;
use \App\Models\DownloadDocumentModel;
use stdClass;

class Pages extends BaseController
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

    public function index()
    {
        $pengguna = session()->get('logged_in');
        $data['data'] = $this->UsersModel->where('id', $pengguna)->get()->getRow();
        $dump = explode(" ", $data['data']->tanggal_lahir);
        (!empty($dump[0])) ? $data['data']->tanggal_lahir = $dump[0] : '';
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('basic/profil/index')
            . view('layout/footer');
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
    public function pelatihanBerlangsung()
    {
        $pengguna = session()->get('logged_in');
        $data['data'] = $this->UsersModel->where('id', $pengguna)->get()->getRow();
        $dump = explode(" ", $data['data']->tanggal_lahir);
        (!empty($dump[0])) ? $data['data']->tanggal_lahir = $dump[0] : '';

        // Data Pelatihan API
        $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field'));
        $data['pelatihan'] = json_encode($dataPelatihan);

        return view('layout/header', $data)

            . view('layout/sidebar')
            . view('basic/pelatihan/berlangsung/index')
            . view('layout/footer');
    }

    public function toDateFormat($tgl)
    {
        return Time::parse($tgl, 'Asia/Jakarta');
    }


    public function pelatihanAgenda()
    {
        $pengguna = session()->get('logged_in');
        $data['data'] = $this->UsersModel->where('id', $pengguna)->get()->getRow();
        $dump = explode(" ", $data['data']->tanggal_lahir);
        (!empty($dump[0])) ? $data['data']->tanggal_lahir = $dump[0] : '';

        // Data Pelatihan API
        $dataPelatihan = $this->controlAPI($this->moodleUrlAPI('&wsfunction=core_course_get_courses_by_field'));

        $pelatihan = [];
        $i = 0;

        // $now = new Time('now', 'Asia/Jakarta');
        $now = Time::createFromFormat('j-M-Y', '1-Jul-2023', 'Asia/Jakarta');
        // $year = Time::createFromFormat('j-M-Y', '1-Jan-' . $now->getYear(), 'Asia/Jakarta');
        foreach ($dataPelatihan->courses as $key => $value) {
            $courseLocal = $this->CourseModel->find($value->id);
            // if (isset($courseLocal)) {
            $value->batch = $courseLocal['condition'] ?? '';
            $value->start_registration = $courseLocal['start_registration'] ?? '';
            $value->batend_registrationch = $courseLocal['end_registration'] ?? '';
            $value->target_participant = $courseLocal['target_participant'] ?? '';
            $value->batch = $courseLocal['batch'] ?? '';
            $value->quota = $courseLocal['quota'] ?? '';
            $value->place = $courseLocal['place'] ?? '';
            $value->contact_person = $courseLocal['contact_person'] ?? '';
            $value->schedule_file = $courseLocal['schedule_file'] ?? '';
            // }
            if ($now->getTimestamp() < $value->startdate) {
                $value->startdatetime = $this->toLocalTime($value->startdate);
                $value->enddatetime = $this->toLocalTime($value->enddate);

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
        // dd($pelatihan);
        $data['pelatihan'] = json_encode($pelatihan);

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

        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('basic/pelatihan/agenda/detail')
            . view('layout/footer');
    }

    public function login()
    {
        return view('login');
    }
    public function registrasi()
    {
        return view('register');
    }
    public function dataProvinsi()
    {
        $client = \Config\Services::curlrequest();

        $response = $client->request('GET', $this->apiURL . 'provinsi?api_key=' . $this->apiKey);
        if (strpos($response->header('content-type'), 'application/json') !== false) {
            $body = json_decode($response->getBody())->data;
        }
        return $this->response = json_encode($body);
    }
    public function dataKabupaten($provinsi_id)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->request('GET', $this->apiURL . 'kota?provinsi_id=' . strval($provinsi_id) . '&api_key=' . $this->apiKey);
        if (strpos($response->header('content-type'), 'application/json') !== false) {
            $body = json_decode($response->getBody())->data;
        }
        return $this->response = json_encode($body);
    }
    public function dataKecamatan($kota_id)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->request('GET', $this->apiURL . 'kecamatan?kota_id=' . strval($kota_id) . '&api_key=' . $this->apiKey);
        if (strpos($response->header('content-type'), 'application/json') !== false) {
            $body = json_decode($response->getBody())->data;
        }
        return $this->response = json_encode($body);
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
    public function registrasiProses()
    {
        $data = $this->request->getPost();
        // dd($data);
        // dd($data);
        $this->UsersModel->save($data);
        $user_id = $this->UsersModel->getInsertID();
        $data_pengguna          = new stdClass;
        $data_pengguna->id      = $user_id;
        $data_pengguna->nama    = $data['nama'];

        $data_sess = [
            'pengguna'  => $data_pengguna,
            // 'sistem'    => $data_sistem,
        ];
        session()->set($data_sess);
        return redirect()->to(base_url('profil'))->withInput();
    }
    public function loginProses()
    {
        $email       = $this->request->getPost('email');
        $password   = $this->request->getPost('password');
        // dd($email, $password);
        $input = $this->validate([
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required'    => 'Nama harus diisi!'
                ]
            ],
            'password' => [
                'rules' => 'min_length[6]|required',
                'errors' => [
                    'required'      => 'Kode akses harus diisi!',
                    'min_length'    => 'Password terlalu pendek!'
                ]
            ]
        ]);

        if (!$input) {
            session()->setFlashdata('error', 'Isian yang Anda masukkan tidak sesuai!');
            return redirect()->back()->withInput();
        }

        $pengguna = $this->UsersModel->where('email', $email)->get()->getRow();

        if (is_null($pengguna)) {
            session()->setFlashdata('error', 'Akun Anda tidak terdaftar!');
            return redirect()->back()->withInput();
        }

        if ($password == $pengguna->password) {

            $data_pengguna          = new stdClass;
            $data_pengguna->id      = $pengguna;
            $data_pengguna->nama    = $pengguna->nama;

            $data_sistem            = new stdClass;
            $data_sistem->logged_in = true;

            $data = [
                'pengguna'  => $data_pengguna,
                'sistem'    => $data_sistem,
            ];
            session()->set($data);
            return redirect()->to(base_url('profil'))->withInput();
        }
        session()->setFlashdata('error', 'Nama atau Kode Akses salah!');
        return redirect()->back()->withInput();
    }
    public function logout()
    {
        session()->remove('pengguna');
        session()->remove('sistem');
        session()->destroy();
        return redirect()->to(base_url());
    }
}
