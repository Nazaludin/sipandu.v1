<?php

namespace App\Controllers\General;

use App\Controllers\BaseController;
use CodeIgniter\Files\File;
use Config\App;

class Profil extends BaseController
{
    public function index()
    {
        $data['data'] = model(UsersModel::class)->where('id', user_id())->get()->getRow();
        $dump = explode(" ", $data['data']->tanggal_lahir);
        (!empty($dump[0])) ? $data['data']->tanggal_lahir = $dump[0] : '';

        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('basic/profil/index')
            . view('layout/footer');
    }
    public function profilEdit()
    {
        $data['data'] = model(UsersModel::class)->where('id', user_id())->get()->getRow();
        $dump = explode(" ", $data['data']->tanggal_lahir);
        (!empty($dump[0])) ? $data['data']->tanggal_lahir = $dump[0] : '';

        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('basic/profil/edit')
            . view('layout/footer');
    }
    public function profilEditProses()
    {

        $data = $this->request->getPost();

        $validation = \Config\Services::validation();
        $rules = [
            'fullname' => 'required',
            'nik' => 'required',
            'pendidikan_terakhir' => 'required',
            'jurusan' => 'required',
            'tempat_lahir' => 'required',
            'agama' => 'required',
            'jenis_kelamin' => 'required',
            'nama_jalan_domisili' => 'required',
            'desa_domisili' => 'required',
            'kecamatan_domisili' => 'required',
            'kabupaten_domisili' => 'required',
            'provinsi_domisili' => 'required',
            'tipe_pegawai' => 'required',
            'jabatan' => 'required',
            'pangkat_golongan' => 'required',
            'jenis_nakes' => 'required',
            'nama_instansi' => 'required',
            'nama_jalan_instansi' => 'required',
            'desa_instansi' => 'required',
            'kabupaten_instansi' => 'required',
            'provinsi_instansi' => 'required',
        ];
        $message =  [
            'fullname' => [
                'required' => 'Mohon isikan nama lengkap Anda!',
            ],
            'nik' => [
                'required' => 'Mohon isikan nomor KTP Anda!',
            ],
            'pendidikan_terakhir' => [
                'required' => 'Mohon isikan pendidikan terakhir Anda!',
            ],
            'jurusan' => [
                'required' => 'Mohon isikan jurusan Anda!',
            ],
            'tempat_lahir' => [
                'required' => 'Mohon isikan tempat lahir Anda!',
            ],
            'agama' => [
                'required' => 'Mohon pilih agama Anda!',
            ],
            'jenis_kelamin' => [
                'required' => 'Mohon pilih jenis kelamin Anda!',
            ],
            'nama_jalan_domisili' => [
                'required' => 'Mohon isikan jalan domisili Anda!',
            ],
            'nama_jalan_domisili' => [
                'required' => 'Mohon isikan jalan domisili Anda!',
            ],
            'desa_domisili' => [
                'required' => 'Mohon isikan desa domisili Anda!',
            ],
            'kecamatan_domisili' => [
                'required' => 'Mohon pilih kecamatan domisili Anda!',
            ],
            'kabupaten_domisili' => [
                'required' => 'Mohon pilih kabupaten domisili Anda!',
            ],
            'provinsi_domisili' => [
                'required' => 'Mohon pilih provinsi domisili Anda!',
            ],
            'tipe_pegawai' => [
                'required' => 'Mohon pilih tipe pegawai Anda!',
            ],
            'jabatan' => [
                'required' => 'Mohon isikan jabatan Anda!',
            ],
            'pangkat_golongan' => [
                'required' => 'Mohon isikan pangkat golongan Anda!',
            ],
            'jenis_nakes' => [
                'required' => 'Mohon pilih  jenis nakes Anda!',
            ],
            'nama_instansi' => [
                'required' => 'Mohon isikan nama instansi Anda!',
            ],
            'nama_desa' => [
                'required' => 'Mohon oso nama desa instansi Anda!',
            ],
            'nama_jalan_instansi' => [
                'required' => 'Mohon pilih nama jalan instansi Anda!',
            ],
            'kabupaten_instansi' => [
                'required' => 'Mohon pilih nama kabupaten instansi Anda!',
            ],
            'provinsi_instansi' => [
                'required' => 'Mohon pilih nama provinsi instansi Anda!',
            ],
            'nip' => [
                'required' => 'Mohon isikan NIP Anda!',
            ],
            'nrp' => [
                'required' => 'Mohon isikan NRP Anda!',
            ],
            'nomor_str' => [
                'required' => 'Mohon isikan Nomor STR Anda!',
            ],

        ];

        if ($data['tipe_pegawai'] == 'ASN Kemenkes') {
            $rules['nip'] = 'required';
            $rules['nrp'] = 'required';
            $rules['nomor_str'] = 'required';
        } else if ($data['tipe_pegawai'] == 'ASN Non Kemenkes') {
            $rules['nip'] = 'required';
            $rules['nrp'] = 'required';
        }

        $validation->setRules($rules, $message);
        if (!$this->validate($rules, $message)) {
            return redirect()->back()->withInput()->with('errors.edit.profil', $this->validator->getErrors());
        }

        $updateUser = model(UserModel::class)->update(user_id(), $data);
        if ($updateUser) {
            return redirect()->to(base_url('profil'))->withInput()->with('message', 'Data berhasil diperbarui!');
        } else {
            return redirect()->to(base_url('profil/edit'))->withInput()->with('error', 'Terjadi Kesalahan saat mengubah data!');
        }
    }
    public function completeProfil()
    {
        $data = $this->request->getPost();
        $foto = $this->request->getFile('foto');
        $crop = $this->request->getPost('crop_dir');
        $crop_status = $this->request->getPost('isCropped');

        if ($crop_status == 'false') {
            return redirect()->back()->withInput()->with('errors.complete.profil', ['isCropped' => 'Mohon klik "Crop" terlebih dahulu sebelum submit!']);
        }

        $rules = [
            'fullname' => 'required',
            'nik' => 'required',
            'pendidikan_terakhir' => 'required',
            'jurusan' => 'required',
            'tempat_lahir' => 'required',
            'agama' => 'required',
            'jenis_kelamin' => 'required',
            'nama_jalan_domisili' => 'required',
            'desa_domisili' => 'required',
            'kecamatan_domisili' => 'required',
            'kabupaten_domisili' => 'required',
            'provinsi_domisili' => 'required',
            'tipe_pegawai' => 'required',
            'jabatan' => 'required',
            'pangkat_golongan' => 'required',
            'jenis_nakes' => 'required',
            'nama_instansi' => 'required',
            'nama_jalan_instansi' => 'required',
            'desa_instansi' => 'required',
            'kabupaten_instansi' => 'required',
            'provinsi_instansi' => 'required',
            'foto' => 'uploaded[foto]|max_size[foto,512]|mime_in[foto,image/jpg,image/jpeg]',
        ];
        $message =  [
            'fullname' => [
                'required' => 'Mohon isikan nama lengkap Anda!',
            ],
            'nik' => [
                'required' => 'Mohon isikan nomor KTP Anda!',
            ],
            'pendidikan_terakhir' => [
                'required' => 'Mohon isikan pendidikan terakhir Anda!',
            ],
            'jurusan' => [
                'required' => 'Mohon isikan jurusan Anda!',
            ],
            'tempat_lahir' => [
                'required' => 'Mohon isikan tempat lahir Anda!',
            ],
            'agama' => [
                'required' => 'Mohon pilih agama Anda!',
            ],
            'jenis_kelamin' => [
                'required' => 'Mohon pilih jenis kelamin Anda!',
            ],
            'nama_jalan_domisili' => [
                'required' => 'Mohon isikan jalan domisili Anda!',
            ],
            'nama_jalan_domisili' => [
                'required' => 'Mohon isikan jalan domisili Anda!',
            ],
            'desa_domisili' => [
                'required' => 'Mohon isikan desa domisili Anda!',
            ],
            'kecamatan_domisili' => [
                'required' => 'Mohon pilih kecamatan domisili Anda!',
            ],
            'kabupaten_domisili' => [
                'required' => 'Mohon pilih kabupaten domisili Anda!',
            ],
            'provinsi_domisili' => [
                'required' => 'Mohon pilih provinsi domisili Anda!',
            ],
            'tipe_pegawai' => [
                'required' => 'Mohon pilih tipe pegawai Anda!',
            ],
            'jabatan' => [
                'required' => 'Mohon isikan jabatan Anda!',
            ],
            'pangkat_golongan' => [
                'required' => 'Mohon isikan pangkat golongan Anda!',
            ],
            'jenis_nakes' => [
                'required' => 'Mohon pilih  jenis nakes Anda!',
            ],
            'nama_instansi' => [
                'required' => 'Mohon isikan nama instansi Anda!',
            ],
            'nama_desa' => [
                'required' => 'Mohon oso nama desa instansi Anda!',
            ],
            'nama_jalan_instansi' => [
                'required' => 'Mohon pilih nama jalan instansi Anda!',
            ],
            'kabupaten_instansi' => [
                'required' => 'Mohon pilih nama kabupaten instansi Anda!',
            ],
            'provinsi_instansi' => [
                'required' => 'Mohon pilih nama provinsi instansi Anda!',
            ],
            'nip' => [
                'required' => 'Mohon isikan NIP Anda!',
            ],
            'nrp' => [
                'required' => 'Mohon isikan NRP Anda!',
            ],
            'nomor_str' => [
                'required' => 'Mohon isikan Nomor STR Anda!',
            ],
            'foto' => [
                'uploaded' => 'Mohon unggah foto diri Anda!',
                'max_size' => 'Ukuran foto Anda melebihi 500kb, mohon unggah ulang foto Anda!',
                'mime_in' => 'Format foto Anda tidak sesuai, mohon unggah foto dengan format jpg atau jpeg!',
            ],

        ];

        if ($data['tipe_pegawai'] == 'ASN Kemenkes') {
            $rules['nip'] = 'required';
            $rules['nrp'] = 'required';
            $rules['nomor_str'] = 'required';
        } else if ($data['tipe_pegawai'] == 'ASN Non Kemenkes') {
            $rules['nip'] = 'required';
            $rules['nrp'] = 'required';
        }

        if (!$this->validate($rules, $message)) {
            return redirect()->back()->withInput()->with('errors.complete.profil', $this->validator->getErrors());
        }

        if (isset($foto)) {

            if ($foto->isValid() && !($foto->hasMoved())) {

                $newName = $foto->getRandomName();
                $path = 'uploads/profil';

                $sourcePath = WRITEPATH . $crop;

                // Memindahkan file ke direktori tujuan
                $file = new File($sourcePath);
                $file->move(FCPATH . $path, $newName);

                $data['nama_foto']      = $foto->getClientName();
                $data['lokasi_foto']    = $path . '/' . $newName;
            }
        }
        // dd($pengguna, $data);
        $data['status_sistem'] = 'complete';
        $updateUser = model(UserModel::class)->update(user_id(), $data);
        if ($updateUser) {
            return redirect()->to(base_url('profil'))->withInput()->with('message', 'Data berhasil dilengkapi!');
        } else {
            return redirect()->to(base_url('profil'))->withInput()->with('error', 'Maaf, terjadi kesalahan sistem saat melengkapi data diri Anda!');
        }
    }
}
