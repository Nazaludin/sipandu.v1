<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use CodeIgniter\I18n\Time;

use Loncat\Moody\AppFactory;
use Loncat\Moody\Config;
use Loncat\Moody\Contract;


class ApiPelatihan extends ResourceController
{
    protected $MoodyBest;
    protected $properties = [
        'filter' => ['before' => ['except' => ['*']]],
    ];
    use ResponseTrait;
    public function __construct()
    {
        $configBest = new Config("http://best-bapelkes.jogjaprov.go.id/webservice/rest/server.php", "8d52a95d541a42e81f955536e8927e9a");
        $this->MoodyBest = AppFactory::create($configBest);
    }

    public function getPelatihan()
    {
        $pelatihan = model(CourseModel::class)->findAll();
        if (empty($pelatihan)) {
            return $this->respondNoContent(); // Respons jika data kosong
        }
        return $this->setResponseFormat('json')->respond($pelatihan, 200);
    }
    public function getPelatihanFilter()
    {
        $status_sistem = $this->request->getPost('status_sistem');
        $keyword = $this->request->getPost('keyword');

        // $data = $this->request->getPost();
        // return $this->setResponseFormat('json')->respond($data, 200);
        $courseModel = model(CourseModel::class)->getPelatihanFilter($status_sistem, $keyword)->orderBy('start_registration', 'desc');

        $pelatihan = $courseModel->paginate(10, 'group1'); // 'group1' is a named group
        // $pelatihan = $builder->paginate(10, 'group1');
        $pager = $courseModel->pager;

        if (empty($pelatihan)) {
            return $this->failNotFound(); // Respons jika data kosong
        }

        $formated_pelatihan = $this->formatPelatihan($pelatihan);

        $data = [
            'pelatihan' => $formated_pelatihan,
            'pager' => [
                'current_page' => $pager->getCurrentPage('group1'),
                'page_count'   => $pager->getPageCount('group1'),
                'total_data'   => $pager->getTotal('group1'),
                'page_uri' => $pager->getPageURI(),
            ],
        ];
        return $this->setResponseFormat('json')->respond($data, 200);
        // return $this->setResponseFormat('json')->respond($formated_pelatihan, 200);
    }

    public function formatPelatihan($pelatihan)
    {
        if (!empty($pelatihan)) {
            $now = new Time('now', 'Asia/Jakarta');
            // $now = Time::createFromFormat('j-M-Y', '1-Jul-2023', 'Asia/Jakarta');
            // $year = Time::createFromFormat('j-M-Y', '1-Jan-' . $now->getYear(), 'Asia/Jakarta');
            $dataPelatihan = [];
            foreach ($pelatihan as $key => $value) {
                // Data Pelatihan API
                // d($value['condition']);
                // d($value, $dataPelatihan);
                $value['condition']               = isset($value['condition']) ? $this->convertCondition(
                    $value['condition'],
                    $value['id'],
                    isset($value['start_registration']) ? strtotime($value['start_registration']) : null,
                    isset($value['end_registration']) ? strtotime($value['end_registration']) : null,
                    isset($value['startdate']) ? $value['startdate'] : null,
                    isset($value['enddate']) ? $value['enddate'] : null,
                ) : '';
                $value['start_registration']      = isset($value['start_registration']) ? $this->dateToLocalTime($value['start_registration']) : '';
                $value['end_registration']        = isset($value['end_registration']) ? $this->dateToLocalTime($value['end_registration']) :  '';
                $value['target_participant']      = $value['target_participant'] ?? '';
                $value['batch']                   = $value['batch'] ?? '';
                $value['quota']                   = $value['quota'] ?? '';
                $value['place']                   = $value['place'] ?? '';
                $value['contact_person']          = $value['contact_person'] ?? '';
                $value['schedule_file']           = $value['schedule_file'] ?? '';
                $value['startdatetime']           = isset($value['startdate']) ? $this->toLocalTime(strtotime($value['startdate'])) : '';
                $value['enddatetime']             = isset($value['enddate']) ? $this->toLocalTime(strtotime($value['enddate'])) : '';
                $value['registrar']               = model(UserCourseModel::class)->where('id_course', $value['id'])->where('status', 'register')->countAllResults();
                $value['accepted_participant']    = model(UserCourseModel::class)->where('id_course', $value['id'])->whereIn('status', ['accept', 'passed'])->countAllResults();
                $value['participant']             = model(UserCourseModel::class)->where('id_course', $value['id'])->countAllResults();
                array_push($dataPelatihan, $value);
                // $pelatihan['courses'][$key]   = $dataPelatihan->courses[0];
            }
            return $dataPelatihan;
        }
    }
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
}
