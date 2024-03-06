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

        foreach ($data['data'] as $key => &$value) {
            $value =  esc($value);
        }

        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('basic/profil/index')
            . view('layout/footer');
    }
    public function photoEdit()
    {
        $data['data'] = model(UsersModel::class)->where('id', user_id())->get()->getRow();
        $dump = explode(" ", $data['data']->tanggal_lahir);
        (!empty($dump[0])) ? $data['data']->tanggal_lahir = $dump[0] : '';

        foreach ($data['data'] as $key => &$value) {
            $value =  esc($value);
        }
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('basic/profil/edit_photo')
            . view('layout/footer');
    }

    public function deleteTempFiles()
    {
        $directory = WRITEPATH . 'uploads/temp'; // Path folder tempat berkas dihapus

        // Pastikan folder tersebut ada dan bisa diakses
        if (is_dir($directory)) {
            $files = glob($directory . '/*'); // Mendapatkan daftar file di dalam folder

            // Hapus setiap file di dalam folder
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file); // Hapus file
                }
            }
        }

        // Redirect atau berikan respons sesuai kebutuhan aplikasi Anda
        return true;
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

    public function photoEditProses()
    {
        $foto = $this->request->getFile('foto');
        $crop = $this->request->getPost('crop_dir');
        $crop_name = $this->request->getPost('crop_name');
        $crop_status = $this->request->getPost('isCropped');

        if ($crop_status == 'false') {
            return redirect()->back()->withInput()->with('errors.complete.profil', ['isCropped' => 'Mohon klik "Crop" terlebih dahulu sebelum submit!']);
        }

        // Mengapus semua file di folder temp
        $this->deleteTempFiles();

        // dd($this->request->getPost());
        if (isset($crop)) {
            if (strstr($crop, 'uploads/profil') !== false) {
                $data['nama_foto']      = $crop_name;
                $data['lokasi_foto']    = $crop;

                //  Hapus foto profil sebelumnya
                $user = model(UserModel::class)->find(user_id())->toArray();
                if (!empty($user['lokasi_foto'])) {
                    $this->deleteFileExists($user['lokasi_foto']);
                }

                $updateUser = model(UserModel::class)->update(user_id(), $data);
                if ($updateUser) {
                    return redirect()->to(base_url('profil'))->withInput()->with('message', 'Foto berhasil diperbarui!');
                } else {
                    return redirect()->to(base_url('profil'))->withInput()->with('error', 'Maaf, terjadi kesalahan sistem saat mengganti foto profil Anda!');
                }
            } else {

                return redirect()->back()->withInput()->with('errors.complete.profil', ['isCropped' => 'Maaf terjadi kesalahan upload foto, silahkan coba untuk hubungi Admin!']);
            }
        }
        return redirect()->to(base_url('profil'))->withInput()->with('error', 'Gagal mengganti photo profil Anda!');

        // if (isset($foto)) {

        //     if ($foto->isValid() && !($foto->hasMoved())) {

        //         // $newName = $foto->getRandomName();
        //         $path = 'uploads/profil';

        //         $sourcePath = WRITEPATH . $crop;
        //         $newName = str_replace('uploads/temp/', '', $crop);


        //         // Memindahkan file ke direktori tujuan
        //         $file = new File($sourcePath);
        //         $file->move(FCPATH . $path, $newName);

        //         $data['nama_foto']      = $foto->getClientName();
        //         $data['lokasi_foto']    = $path . '/' . $newName;
        //         // dd($data);
        //         $updateUser = model(UserModel::class)->update(user_id(), $data);
        //         if ($updateUser) {
        //             return redirect()->to(base_url('profil'))->withInput()->with('message', 'Foto berhasil diperbarui!');
        //         } else {
        //             return redirect()->to(base_url('profil'))->withInput()->with('error', 'Maaf, terjadi kesalahan sistem saat mengganti foto profil Anda!');
        //         }
        //     } else {
        //         return redirect()->to(base_url('profil'))->withInput()->with('error', 'Maaf, foto tidak valid, silahkan unggah foto Anda kembali!');
        //     }
        // } else {
        //     return redirect()->to(base_url('profil'))->withInput()->with('error', 'Gagal mengganti photo profil Anda!');
        // }
    }
    public function profilEdit()
    {
        $data['data'] = model(UsersModel::class)->where('id', user_id())->get()->getRow();
        $dump = explode(" ", $data['data']->tanggal_lahir);
        (!empty($dump[0])) ? $data['data']->tanggal_lahir = $dump[0] : '';

        foreach ($data['data'] as $key => &$value) {
            $value =  esc($value);
        }

        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('basic/profil/edit')
            . view('layout/footer');
    }
    public function profilEditProses()
    {

        $data = $this->request->getPost();
        // dd($data, $this->request);
        $validation = \Config\Services::validation();
        $rules = [
            'fullname'              => 'required|regex_match[/^[a-zA-Z \']+$/]',
            'nik'                   => 'required|numeric',
            'pendidikan_terakhir'   => 'required|alpha',
            'jurusan'               => 'required|regex_match[/^[a-zA-Z \']+$/]',
            'tempat_lahir'          => 'required|regex_match[/^[a-zA-Z \']+$/]',
            'tanggal_lahir'         => 'required|regex_match[/^[0-9 -]+$/]',
            'agama'                 => 'required|alpha_space',
            'jenis_kelamin'         => 'required|alpha',
            'nama_jalan_domisili'   => 'required|regex_match[/^[a-zA-Z0-9 ,.\/\']+$/]',
            'desa_domisili'         => 'required|regex_match[/^[a-zA-Z \']+$/]',
            'kecamatan_domisili'    => 'required|regex_match[/^[a-zA-Z \']+$/]',
            'kabupaten_domisili'    => 'required|regex_match[/^[a-zA-Z \']+$/]',
            'provinsi_domisili'     => 'required|regex_match[/^[a-zA-Z \']+$/]',
            'tipe_pegawai'          => 'required|alpha_space',
            'jabatan'               => 'required|alpha_space',
            'pangkat_golongan'      => 'required|regex_match[/^[a-zA-Z \/-]+$/]',
            'jenis_nakes'           => 'required|regex_match[/^[a-zA-Z -]+$/]',
            'nama_instansi'         => 'required|regex_match[/^[a-zA-Z -\']+$/]',
            'nama_jalan_instansi'   => 'required|regex_match[/^[a-zA-Z0-9 ,.\/\']+$/]',
            'desa_instansi'         => 'required|regex_match[/^[a-zA-Z -\']+$/]',
            'kecamatan_instansi'    => 'required|regex_match[/^[a-zA-Z \']+$/]',
            'kabupaten_instansi'    => 'required|regex_match[/^[a-zA-Z -\']+$/]',
            'provinsi_instansi'     => 'required|regex_match[/^[a-zA-Z -\']+$/]',
            'nip'                   => 'required|numeric',
            'nrp'                   => 'required|numeric',
            'nomor_str'             => 'required|numeric',
            'gelar_depan'           => 'regex_match[/(?:[a-zA-Z ,.]+|^$)/]',
            'gelar_belakang'        => 'regex_match[/(?:[a-zA-Z ,.]+|^$)/]',
        ];
        $message =  [
            'fullname' => [
                'required'      => 'Mohon isikan nama lengkap Anda!',
                'regex_match'   => 'Nama lengkap hanya boleh diisi dengan huruf alfabet!',
            ],
            'nik' => [
                'required'      => 'Mohon isikan nomor KTP Anda!',
                'numeric'       => 'Nomor KTP hanya boleh diisi dengan nomor!',
            ],
            'pendidikan_terakhir' => [
                'required'      => 'Mohon isikan pendidikan terakhir Anda!',
                'alpha'         => 'Pendidikan terakhir hanya boleh diisi dengan huruf alfabet!',
            ],
            'jurusan' => [
                'required'      => 'Mohon isikan jurusan Anda!',
                'regex_match'   => 'Jurusan hanya boleh diisi dengan huruf alfabet!',
            ],
            'tempat_lahir' => [
                'required'      => 'Mohon isikan tempat lahir Anda!',
                'regex_match'   => 'Tempat lahir hanya boleh diisi dengan huruf alfabet!',
            ],
            'tanggal_lahir' => [
                'required'      => 'Mohon isikan tanggal lahir Anda!',
                'regex_match'   => 'HEY!? What are you doing?',
            ],
            'agama' => [
                'required'      => 'Mohon pilih agama Anda!',
                'alpha_space'   => 'HEY!? What are you doing?',
            ],
            'jenis_kelamin' => [
                'required'      => 'Mohon pilih jenis kelamin Anda!',
                'alpha'         => 'HEY!? What are you doing?',
            ],
            'nama_jalan_domisili' => [
                'required'      => 'Mohon isikan jalan domisili Anda!',
                'regex_match'   => 'Nama jalan domisili hanya boleh diisi dengan huruf alfabet dan nomor!',
            ],
            'desa_domisili' => [
                'required'      => 'Mohon isikan desa domisili Anda!',
                'regex_match'   => 'Desa domisili hanya boleh diisi dengan huruf alfabet!',
            ],
            'kecamatan_domisili' => [
                'required'      => 'Mohon pilih kecamatan domisili Anda!',
                'regex_match'   => 'HEY!? What are you doing?',
            ],
            'kabupaten_domisili' => [
                'required'      => 'Mohon pilih kabupaten domisili Anda!',
                'regex_match'   => 'HEY!? What are you doing?',
            ],
            'provinsi_domisili' => [
                'required'      => 'Mohon pilih provinsi domisili Anda!',
                'regex_match'   => 'HEY!? What are you doing?',
            ],
            'tipe_pegawai' => [
                'required'      => 'Mohon pilih tipe pegawai Anda!',
                'alpha_space'   => 'Tipe pegawai hanya boleh diisi dengan huruf alfabet!',
            ],
            'jabatan' => [
                'required'      => 'Mohon isikan jabatan Anda!',
                'alpha_space'   => 'Tipe pegawai hanya boleh diisi dengan huruf alfabet!',
            ],
            'pangkat_golongan' => [
                'required'      => 'Mohon isikan pangkat golongan Anda!',
                'regex_match'   => 'HEY!? What are you doing?',
            ],
            'jenis_nakes' => [
                'required'      => 'Mohon pilih  jenis nakes Anda!',
                'regex_match'   => 'HEY!? What are you doing?',
            ],
            'nama_instansi' => [
                'required'      => 'Mohon isikan nama instansi Anda!',
                'regex_match'   => 'Nama Instansi hanya boleh diisi dengan huruf alfabet!',
            ],
            'desa_instansi' => [
                'required' => 'Mohon oso nama desa instansi Anda!',
                'regex_match'   => 'Nama Desa hanya boleh diisi dengan huruf alfabet!',
            ],
            'nama_jalan_instansi' => [
                'required' => 'Mohon pilih nama jalan instansi Anda!',
                'regex_match'   => 'Nama jalan instansi hanya boleh diisi dengan huruf alfabet dan nomor!',
            ],
            'kecamatan_instansi' => [
                'required' => 'Mohon pilih nama kecamatan instansi Anda!',
                'regex_match'   => 'HEY!? What are you doing?',
            ],
            'kabupaten_instansi' => [
                'required' => 'Mohon pilih nama kabupaten instansi Anda!',
                'regex_match'   => 'HEY!? What are you doing?',
            ],
            'provinsi_instansi' => [
                'required' => 'Mohon pilih nama provinsi instansi Anda!',
                'regex_match'   => 'HEY!? What are you doing?',
            ],
            'nip' => [
                'required' => 'Mohon isikan NIP Anda!',
                'numeric'       => 'NIP hanya boleh diisi dengan nomor!',
            ],
            'nrp' => [
                'required' => 'Mohon isikan NRP Anda!',
                'numeric'       => 'NRP hanya boleh diisi dengan nomor!',
            ],
            'nomor_str' => [
                'required' => 'Mohon isikan Nomor STR Anda!',
                'numeric'       => 'Nomor STR hanya boleh diisi dengan nomor!',
            ],
            'gelar_depan' => [
                'regex_match'   => 'Gelar depan hanya boleh diisi dengan huruf alfabet, titik(.), dan koma (,)!',
            ],
            'gelar_belakang' => [
                'regex_match'   => 'Gelar belakang hanya boleh diisi dengan huruf alfabet, titik(.), dan koma (,)!',
            ],

        ];

        // if ($data['tipe_pegawai'] == 'ASN Kemenkes') {
        //     $rules['nip'] = 'required';
        //     $rules['nrp'] = 'required';
        //     $rules['nomor_str'] = 'required';
        // } else if ($data['tipe_pegawai'] == 'ASN Non Kemenkes') {
        //     $rules['nip'] = 'required';
        //     $rules['nrp'] = 'required';
        // }

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
        $crop_name = $this->request->getPost('crop_name');
        $crop_status = $this->request->getPost('isCropped');

        if ($crop_status == 'false') {
            return redirect()->back()->withInput()->with('errors.complete.profil', ['isCropped' => 'Mohon klik "Crop" terlebih dahulu sebelum submit!']);
        }
        $rules = [
            'fullname'              => 'required|regex_match[/^[a-zA-Z \']+$/]',
            'nik'                   => 'required|numeric',
            'pendidikan_terakhir'   => 'required|alpha',
            'jurusan'               => 'required|regex_match[/^[a-zA-Z \']+$/]',
            'tempat_lahir'          => 'required|regex_match[/^[a-zA-Z \']+$/]',
            'tanggal_lahir'         => 'required|regex_match[/^[0-9 -]+$/]',
            'agama'                 => 'required|alpha_space',
            'jenis_kelamin'         => 'required|alpha',
            'nama_jalan_domisili'   => 'required|regex_match[/^[a-zA-Z0-9 ,.\/\']+$/]',
            'desa_domisili'         => 'required|regex_match[/^[a-zA-Z \']+$/]',
            'kecamatan_domisili'    => 'required|regex_match[/^[a-zA-Z \']+$/]',
            'kabupaten_domisili'    => 'required|regex_match[/^[a-zA-Z \']+$/]',
            'provinsi_domisili'     => 'required|regex_match[/^[a-zA-Z \']+$/]',
            'tipe_pegawai'          => 'required|alpha_space',
            'jabatan'               => 'required|alpha_space',
            'pangkat_golongan'      => 'required|regex_match[/^[a-zA-Z \/-]+$/]',
            'jenis_nakes'           => 'required|regex_match[/^[a-zA-Z -]+$/]',
            'nama_instansi'         => 'required|regex_match[/^[a-zA-Z -\']+$/]',
            'nama_jalan_instansi'   => 'required|regex_match[/^[a-zA-Z0-9 ,.\/\']+$/]',
            'desa_instansi'         => 'required|regex_match[/^[a-zA-Z -\']+$/]',
            'kecamatan_instansi'    => 'required|regex_match[/^[a-zA-Z \']+$/]',
            'kabupaten_instansi'    => 'required|regex_match[/^[a-zA-Z -\']+$/]',
            'provinsi_instansi'     => 'required|regex_match[/^[a-zA-Z -\']+$/]',
            'nip'                   => 'required|numeric',
            'nrp'                   => 'required|numeric',
            'nomor_str'             => 'required|numeric',
            'gelar_depan'           => 'regex_match[/(?:[a-zA-Z ,.]+|^$)/]',
            'gelar_belakang'        => 'regex_match[/(?:[a-zA-Z ,.]+|^$)/]',
            'foto' => 'uploaded[foto]|max_size[foto,512]|mime_in[foto,image/jpg,image/jpeg]',
        ];
        $message =  [
            'fullname' => [
                'required'      => 'Mohon isikan nama lengkap Anda!',
                'regex_match'   => 'Nama lengkap hanya boleh diisi dengan huruf alfabet!',
            ],
            'nik' => [
                'required'      => 'Mohon isikan nomor KTP Anda!',
                'numeric'       => 'Nomor KTP hanya boleh diisi dengan nomor!',
            ],
            'pendidikan_terakhir' => [
                'required'      => 'Mohon isikan pendidikan terakhir Anda!',
                'alpha'         => 'Pendidikan terakhir hanya boleh diisi dengan huruf alfabet!',
            ],
            'jurusan' => [
                'required'      => 'Mohon isikan jurusan Anda!',
                'regex_match'   => 'Jurusan hanya boleh diisi dengan huruf alfabet!',
            ],
            'tempat_lahir' => [
                'required'      => 'Mohon isikan tempat lahir Anda!',
                'regex_match'   => 'Tempat lahir hanya boleh diisi dengan huruf alfabet!',
            ],
            'tanggal_lahir' => [
                'required'      => 'Mohon isikan tanggal lahir Anda!',
                'regex_match'   => 'HEY!? What are you doing?',
            ],
            'agama' => [
                'required'      => 'Mohon pilih agama Anda!',
                'alpha_space'   => 'HEY!? What are you doing?',
            ],
            'jenis_kelamin' => [
                'required'      => 'Mohon pilih jenis kelamin Anda!',
                'alpha'         => 'HEY!? What are you doing?',
            ],
            'nama_jalan_domisili' => [
                'required'      => 'Mohon isikan jalan domisili Anda!',
                'regex_match'   => 'Nama jalan domisili hanya boleh diisi dengan huruf alfabet dan nomor!',
            ],
            'desa_domisili' => [
                'required'      => 'Mohon isikan desa domisili Anda!',
                'regex_match'   => 'Desa domisili hanya boleh diisi dengan huruf alfabet!',
            ],
            'kecamatan_domisili' => [
                'required'      => 'Mohon pilih kecamatan domisili Anda!',
                'regex_match'   => 'HEY!? What are you doing?',
            ],
            'kabupaten_domisili' => [
                'required'      => 'Mohon pilih kabupaten domisili Anda!',
                'regex_match'   => 'HEY!? What are you doing?',
            ],
            'provinsi_domisili' => [
                'required'      => 'Mohon pilih provinsi domisili Anda!',
                'regex_match'   => 'HEY!? What are you doing?',
            ],
            'tipe_pegawai' => [
                'required'      => 'Mohon pilih tipe pegawai Anda!',
                'alpha_space'   => 'Tipe pegawai hanya boleh diisi dengan huruf alfabet!',
            ],
            'jabatan' => [
                'required'      => 'Mohon isikan jabatan Anda!',
                'alpha_space'   => 'Tipe pegawai hanya boleh diisi dengan huruf alfabet!',
            ],
            'pangkat_golongan' => [
                'required'      => 'Mohon isikan pangkat golongan Anda!',
                'regex_match'   => 'HEY!? What are you doing?',
            ],
            'jenis_nakes' => [
                'required'      => 'Mohon pilih  jenis nakes Anda!',
                'regex_match'   => 'HEY!? What are you doing?',
            ],
            'nama_instansi' => [
                'required'      => 'Mohon isikan nama instansi Anda!',
                'regex_match'   => 'Nama Instansi hanya boleh diisi dengan huruf alfabet!',
            ],
            'desa_instansi' => [
                'required' => 'Mohon oso nama desa instansi Anda!',
                'regex_match'   => 'Nama Desa hanya boleh diisi dengan huruf alfabet!',
            ],
            'nama_jalan_instansi' => [
                'required' => 'Mohon pilih nama jalan instansi Anda!',
                'regex_match'   => 'Nama jalan instansi hanya boleh diisi dengan huruf alfabet dan nomor!',
            ],
            'kecamatan_instansi' => [
                'required' => 'Mohon pilih nama kecamatan instansi Anda!',
                'regex_match'   => 'HEY!? What are you doing?',
            ],
            'kabupaten_instansi' => [
                'required' => 'Mohon pilih nama kabupaten instansi Anda!',
                'regex_match'   => 'HEY!? What are you doing?',
            ],
            'provinsi_instansi' => [
                'required' => 'Mohon pilih nama provinsi instansi Anda!',
                'regex_match'   => 'HEY!? What are you doing?',
            ],
            'nip' => [
                'required' => 'Mohon isikan NIP Anda!',
                'numeric'       => 'NIP hanya boleh diisi dengan nomor!',
            ],
            'nrp' => [
                'required' => 'Mohon isikan NRP Anda!',
                'numeric'       => 'NRP hanya boleh diisi dengan nomor!',
            ],
            'nomor_str' => [
                'required' => 'Mohon isikan Nomor STR Anda!',
                'numeric'       => 'Nomor STR hanya boleh diisi dengan nomor!',
            ],
            'gelar_depan' => [
                'regex_match'   => 'Gelar depan hanya boleh diisi dengan huruf alfabet, titik(.), dan koma (,)!',
            ],
            'gelar_belakang' => [
                'regex_match'   => 'Gelar belakang hanya boleh diisi dengan huruf alfabet, titik(.), dan koma (,)!',
            ],
            'foto' => [
                'uploaded'      => 'Mohon unggah foto diri Anda!',
                'max_size'      => 'Ukuran foto Anda melebihi 500kb, mohon unggah ulang foto Anda!',
                'mime_in'       => 'Format foto Anda tidak sesuai, mohon unggah foto dengan format jpg atau jpeg!',
            ],
        ];

        // if ($data['tipe_pegawai'] == 'ASN Kemenkes') {
        //     $rules['nip'] = 'required';
        //     $rules['nrp'] = 'required';
        //     $rules['nomor_str'] = 'required';
        // } else if ($data['tipe_pegawai'] == 'ASN Non Kemenkes') {
        //     $rules['nip'] = 'required';
        //     $rules['nrp'] = 'required';
        // }

        if (!$this->validate($rules, $message)) {
            return redirect()->back()->withInput()->with('errors.complete.profil', $this->validator->getErrors());
        }

        // Mengapus semua file di folder temp
        $this->deleteTempFiles();

        // dd($this->request->getPost());
        if (isset($crop)) {
            if (strstr($crop, 'uploads/profil') !== false) {
                $data['nama_foto']      = $crop_name;
                $data['lokasi_foto']    = $crop;
            } else {
                return redirect()->back()->withInput()->with('errors.complete.profil', ['isCropped' => 'Maaf terjadi kesalahan upload foto, silahkan coba untuk hubungi Admin!']);
            }
        }
        // if (isset($foto)) {

        //     if ($foto->isValid() && !($foto->hasMoved())) {

        //         $newName = $foto->getRandomName();
        //         $path = 'uploads/profil';

        //         $sourcePath = WRITEPATH . $crop;

        //         // Memindahkan file ke direktori tujuan
        //         $file = new File($sourcePath);
        //         $file->move(FCPATH . $path, $newName);

        //         $data['nama_foto']      = $foto->getClientName();
        //         $data['lokasi_foto']    = $path . '/' . $newName;
        //     }
        // }
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
