<?php

namespace App\Controllers\General;

use App\Controllers\BaseController;
use App\Models\AnswerModel;
use CodeIgniter\I18n\Time;
use \App\Models\InstrumentModel;
use App\Models\OptionModel;
use App\Models\QuestionModel;
use App\Models\SectionModel;
use App\Models\TemplateModel;
use PhpParser\Node\Expr\Empty_;

class Evaluasi extends BaseController
{

    public function __construct()
    {
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
        $tgl = $time->toDateString('Y-m-d');
        return $tgl;
    }

    // public function convertCondition($condition)
    // {
    //     $result = '';
    //     switch (true) {
    //         case $condition == 'coming':
    //             $result = 'Pendaftaran Belum Aktif';
    //             break;
    //         case $condition == 'going':
    //             $result = 'Pendaftaran Aktif';
    //             break;
    //         case $condition == 'passed':
    //             $result = 'Pendaftaran Telah Berakhir';
    //             break;

    //         default:
    //             $result = '';
    //             break;
    //     }
    //     return $result;
    // }
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
        $apiKeyMoodle =  getenv('API_KEY_MOODLE');
        $url = 'http://best-bapelkes.jogjaprov.go.id/webservice/rest/server.php?wstoken=' . $apiKeyMoodle . $function . '&moodlewsrestformat=json';
        return $url;
    }

    // CODE START
    public function fillInstrument($id_pelatihan)
    {
        $data['id_course'] = $id_pelatihan;
        // $data['id_user'] = user_id();
        $data['data'] = model(InstrumentModel::class)->getInstrument($id_pelatihan);
        // dd($data);
        if (empty($data['data'])) {
            return redirect()->back()->to(base_url('epp-fill'))->withInput()->with('error', 'Terjadi kesalahan, Silahkan coba untuk menghubungi Admin!');
        } else {
            // dd($data);
            foreach ($data['data'] as $key => $value) {
                $data['data'][$key]['start_fill'] = !empty($value['start_fill']) ? Time::parse($value['start_fill'], 'Asia/Jakarta')->toDateString('Y-m-d') : '';
                $data['data'][$key]['end_fill'] = !empty($value['end_fill']) ? Time::parse($value['end_fill'], 'Asia/Jakarta')->toDateString('Y-m-d') : '';
            }
            // d($value['start_fill']);
        }
        // dd($data);
        return view('layout/header', $data)
            . view('layout/sidebar')
            . view('basic/evaluasi/fill_instrument')
            . view('layout/footer');
    }
    public function answerInstrument()
    {
        $postData = $this->request->getPost();
        // dd($postData);
        $userId = user_id();

        foreach ($postData as $key => $value) {
            if (strpos($key, 'question') !== false) {
                preg_match('/question(\d+)/', $key, $questionIdMatches);
                preg_match('/type(\d+)/', $key, $typeMatches);

                if (isset($questionIdMatches[1]) && isset($typeMatches[1])) {
                    $data = [
                        'id_user' => $userId,
                        'id_instrument' => $postData['id_instrument'],
                        'id_question' => $questionIdMatches[1],
                        'type' => $typeMatches[1],
                    ];

                    if ($typeMatches[1] == 1) {
                        $skorKey = 'question' . $questionIdMatches[1] . '_type' . $typeMatches[1] . '_skor';
                        if (isset($postData[$skorKey])) {
                            $data['skor'] = $postData[$skorKey];
                        }
                    } else {
                        $answerKey = 'question' . $questionIdMatches[1] . '_type' . $typeMatches[1] . '_answer';
                        if (isset($postData[$answerKey])) {
                            $data['answer'] = $postData[$answerKey];
                        }
                    }

                    $existingAnswer = model(AnswerModel::class)
                        ->where('id_user', $userId)
                        ->where('id_question', $data['id_question'])
                        ->first();

                    if (!$existingAnswer) {
                        model(AnswerModel::class)->insert($data);
                    } else {
                        model(AnswerModel::class)->update($existingAnswer['id'], $data);
                    }
                }
            }
        }

        return redirect()->back()->to(base_url('epp-fill'))->withInput()->with('message', 'Jawaban Berhasil Direkam');
    }
}
