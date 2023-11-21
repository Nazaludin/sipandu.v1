<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;
use \App\Models\InstrumentModel;
use App\Models\OptionModel;
use App\Models\QuestionModel;

class Evaluasi extends BaseController
{

    public function __construct()
    {
    }

    // FUNNCITON UMUM
    public function index()
    {
        return view('layout/header')
            . view('layout/sidebar')
            . view('admin/evaluasi/index')
            . view('layout/footer');
    }

    public function postEPP()
    {
        $data = $this->request->getPost();
        // dd($data, json_encode($data));
        // Data yang akan di-insert ke tabel 'instrumen_soal'
        $dataInstrumenSoal = array(
            'name' => $data['name'],
            'id_course' => $data['id_course'],
            'start_fill' => $data['start_fill'],
            'end_fill' => $data['end_fill'],
            'description' => $data['description']
        );
        model(InstrumentModel::class)->insert($dataInstrumenSoal);
        $instrument_id =  model(InstrumentModel::class)->getInsertID();
        // Data soal yang akan di-insert ke tabel 'soal'
        // dd($instrument_id, $dataInstrumenSoal);
        $dataSoal = array();
        // Data opsi jawaban yang akan di-insert ke tabel 'opsi_jawaban'
        $dataOpsi = array();

        // Mencari dan menyiapkan data soal dan opsi jawaban dari input yang dinamis
        foreach ($data as $key => $value) {
            // Jika kunci input merupakan bagian dari data soal (misalnya 'card1_input_pertanyaan')
            if (strpos($key, 'card') !== false && strpos($key, '_input_pertanyaan') !== false) {
                $index = substr($key, 4, 1); // Mengambil nomor kartu dari kunci
                $dataSoal['id_instrument'] = $instrument_id;
                $dataSoal['number'] = $index;
                $dataSoal['type'] = $data['card' . $index . '_input_tipe_soal'];
                $dataSoal['question'] = $value;

                model(QuestionModel::class)->insert($dataSoal);
                $soal_id =  model(QuestionModel::class)->getInsertID();
                // dd($soal_id);

                // $dataSoal[$index]['pertanyaan'] = $value;
                // Mengambil data opsi jawaban sesuai nomor kartu yang sama
                // $dataSoal[$index]['type'] = $data['card' . $index . '_input_tipe_soal'];
                if ($data['card' . $index . '_input_tipe_soal'] == 1) {
                    $dataOpsi['id_question'] = $soal_id;
                    $dataOpsi['option_a'] = $data['card' . $index . '_input_opsiA'];
                    $dataOpsi['option_b'] = $data['card' . $index . '_input_opsiB'];
                    $dataOpsi['option_c'] = $data['card' . $index . '_input_opsiC'];
                    $dataOpsi['option_d'] = $data['card' . $index . '_input_opsiD'];
                    model(OptionModel::class)->insert($dataOpsi);
                    $option_id =  model(OptionModel::class)->getInsertID();
                    // dd($option_id);

                    // $dataOpsiJawaban[$index]['opsiA'] = $data['card' . $index . '_input_opsiA'];
                    // $dataOpsiJawaban[$index]['opsiB'] = $data['card' . $index . '_input_opsiB'];
                    // $dataOpsiJawaban[$index]['opsiC'] = $data['card' . $index . '_input_opsiC'];
                    // $dataOpsiJawaban[$index]['opsiD'] = $data['card' . $index . '_input_opsiD'];
                }
                // $dataOpsiJawaban[$index]['isianSingkat'] = $data['card' . $index . '_input_isianSingkat'];
                // $dataOpsiJawaban[$index]['isianPanjang'] = $data['card' . $index . '_input_isianPanjang'];
            }
        }
        dd($dataInstrumenSoal, $dataSoal, $dataOpsi);
        dd($data, json_encode($data));
    }
}
