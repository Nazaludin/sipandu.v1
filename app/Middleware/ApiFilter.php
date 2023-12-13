<?php

namespace App\Middleware;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ApiFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $uri = service('uri');

        // Lakukan verifikasi API key untuk rute-rute yang memerlukan
        if (strpos($uri->getPath(), 'api') !== false) {
            $apiKey = $request->getHeaderLine('X-API-KEY');
            $validApiKey = getenv('API_KEY'); // Ganti dengan nilai API key yang valid dari .env

            if ($apiKey !== $validApiKey) {
                return service('response')->setStatusCode(401)->setBody('Unauthorized access');
            }
        }

        return $request;
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return $response;
    }
}
