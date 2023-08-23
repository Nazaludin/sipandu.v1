<?php

namespace App\Controllers;

use App\Models\ClassRankModel;
use App\Models\KindNursesModel;

class APIControl extends BaseController
{

    protected $apiKey = 'TczH6QUUVuXOoZKT2qoJ6JHfctAkD8';
    protected $apiURL = 'https://api.goapi.id/v1/regional/';

    public function __construct()
    {
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
    public function dataPangkatGolongan()
    {
        $data = model(ClassRankModel::class)->findAll();
        return json_encode($data);
    }
    public function dataJenisNakes()
    {
        $data = model(KindNursesModel::class)->findAll();
        return json_encode($data);
    }
    public function test()
    {
        return view('test');
    }
    public function testKoneksi()
    {
        $data = $this->request->getPost();
        dd($data);
        $file_download = $this->request->getFile('croppedImage');
        $newName = $file_download->getRandomName();
        $path = 'uploads/dokumen';
        // dd(base_url() . $path, FCPATH, WRITEPATH);
        $file_download->move(FCPATH . $path, $newName);
        // dd($data);
        return json_encode($file_download);
    }
}
