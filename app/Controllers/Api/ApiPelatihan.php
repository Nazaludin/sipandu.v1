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
        $data = $this->request->getPost();
        return $this->setResponseFormat('json')->respond($data, 200);
        // $pelatihan = model(CourseModel::class)->getPelatihanFilter();
        // if (empty($pelatihan)) {
        //     return $this->respondNoContent(); // Respons jika data kosong
        // }
        // return $this->setResponseFormat('json')->respond($pelatihan, 200);
    }
}
