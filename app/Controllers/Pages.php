<?php

namespace App\Controllers;

// use App\Models\UsersModel;
use CodeIgniter\I18n\Time;
use Myth\Auth\Models\UserModel;
use stdClass;

class Pages extends BaseController
{
    protected $UsersModel;
    protected $apiKey = 'TczH6QUUVuXOoZKT2qoJ6JHfctAkD8';
    protected $apiURL = 'https://api.goapi.id/v1/regional/';

    public function __construct()
    {
        $this->UsersModel  = new UserModel();
    }

    public function index()
    {
        d($_SESSION);
        $pengguna = session()->get('logged_in');
        $data['data'] = $this->UsersModel->where('id', $pengguna)->get()->getRow();
        $dump = explode(" ", $data['data']->tanggal_lahir);
        (!empty($dump[0])) ? $data['data']->tanggal_lahir = $dump[0] : '';
        d($data);
        return view('layout/header', $data)
            . view('layout/navbar')
            . view('layout/sidebar')
            . view('profil/index')
            . view('layout/footer');
    }
    public function pelatihanRiwayat()
    {
        $pengguna = session()->get('logged_in');
        $data['data'] = $this->UsersModel->where('id', $pengguna)->get()->getRow();
        $dump = explode(" ", $data['data']->tanggal_lahir);
        (!empty($dump[0])) ? $data['data']->tanggal_lahir = $dump[0] : '';

        $client = \Config\Services::curlrequest();
        $response = $client->request('GET', 'http://best-bapelkes.jogjaprov.go.id/webservice/rest/server.php?wstoken=26a8df1bbd691fcdc570159cac7f00e7&wsfunction=core_course_get_courses_by_field&moodlewsrestformat=json');
        if (strpos($response->header('content-type'), 'application/json') !== false) {
            $body = json_decode($response->getBody());
        }
        $data['pelatihan'] = json_encode($body);
        // dd($data);
        return view('layout/header', $data)
            . view('layout/navbar')
            . view('layout/sidebar')
            . view('pelatihan/riwayat/index')
            . view('layout/footer');
    }
    public function pelatihanBerlangsung()
    {
        $pengguna = session()->get('logged_in');
        $data['data'] = $this->UsersModel->where('id', $pengguna)->get()->getRow();
        $dump = explode(" ", $data['data']->tanggal_lahir);
        (!empty($dump[0])) ? $data['data']->tanggal_lahir = $dump[0] : '';

        $client = \Config\Services::curlrequest();
        $response = $client->request('GET', 'http://best-bapelkes.jogjaprov.go.id/webservice/rest/server.php?wstoken=26a8df1bbd691fcdc570159cac7f00e7&wsfunction=core_course_get_courses_by_field&moodlewsrestformat=json');
        if (strpos($response->header('content-type'), 'application/json') !== false) {
            $body = json_decode($response->getBody());
        }
        $data['pelatihan'] = json_encode($body);
        // dd($data);
        return view('layout/header', $data)
            . view('layout/navbar')
            . view('layout/sidebar')
            . view('pelatihan/berlangsung/index')
            . view('layout/footer');
    }
    public function pelatihanAgenda()
    {
        $pengguna = session()->get('logged_in');
        $data['data'] = $this->UsersModel->where('id', $pengguna)->get()->getRow();
        $dump = explode(" ", $data['data']->tanggal_lahir);
        (!empty($dump[0])) ? $data['data']->tanggal_lahir = $dump[0] : '';

        $client = \Config\Services::curlrequest();
        $response = $client->request('GET', 'http://best-bapelkes.jogjaprov.go.id/webservice/rest/server.php?wstoken=26a8df1bbd691fcdc570159cac7f00e7&wsfunction=core_course_get_courses_by_field&moodlewsrestformat=json');
        if (strpos($response->header('content-type'), 'application/json') !== false) {
            $body = json_decode($response->getBody());
        }
        $pelatihan = [];
        $i = 0;

        $now = new Time('now', 'Asia/Jakarta');
        $year = Time::createFromFormat('j-M-Y', '15-Feb-' . $now->getYear(), 'Asia/Jakarta');
        foreach ($body->courses as $key => $value) {
            if ($year->getTimestamp() <= $value->enddate) {
                $value->startdatetime = date('d-m-Y', $value->startdate);
                $value->enddatetime = date('d-m-Y', $value->enddate);
                $pelatihan['courses'][$i] = $value;
                $i++;
            }
            // d($pelatihan[$i]);
        }
        // dd($pelatihan);
        $data['pelatihan'] = json_encode($pelatihan);

        // dd($data);
        return view('layout/header', $data)
            . view('layout/navbar')
            . view('layout/sidebar')
            . view('pelatihan/agenda/index')
            . view('layout/footer');
    }
    public function detailAgendaProses()
    {
        $pengguna = session()->get('logged_in');
        $data['data'] = $this->UsersModel->where('id', $pengguna)->get()->getRow();
        $dump = explode(" ", $data['data']->tanggal_lahir);
        (!empty($dump[0])) ? $data['data']->tanggal_lahir = $dump[0] : '';

        $client = \Config\Services::curlrequest();

        $id_pelatihan = $this->request->getPost('id_pelatihan');
        $response = $client->request('GET', 'http://best-bapelkes.jogjaprov.go.id/webservice/rest/server.php?wstoken=26a8df1bbd691fcdc570159cac7f00e7&wsfunction=core_course_get_courses_by_field&field=id&value=' . $id_pelatihan . '&moodlewsrestformat=json');
        if (strpos($response->header('content-type'), 'application/json') !== false) {
            $body = json_decode($response->getBody());
        }

        $now = new Time('now', 'Asia/Jakarta');
        $year = Time::createFromFormat('j-M-Y', '15-Feb-' . $now->getYear(), 'Asia/Jakarta');
        $body->courses[0]->startdatetime = date('d-m-Y', $body->courses[0]->startdate);
        $body->courses[0]->enddatetime = date('d-m-Y', $body->courses[0]->enddate);


        $pelatihan['courses'] = $body->courses[0];

        $data['pelatihan'] = json_encode($pelatihan);

        // dd($data);
        return view('layout/header', $data)
            . view('layout/navbar')
            . view('layout/sidebar')
            . view('pelatihan/agenda/detail')
            . view('layout/footer');
        // return redirect()->to(base_url('pelatihan/agenda/detail'))->with('data', $data);
    }
    public function detailAgenda($data)
    {

        return view('layout/header', $data)
            . view('layout/navbar')
            . view('layout/sidebar')
            . view('pelatihan/agenda/detail')
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
