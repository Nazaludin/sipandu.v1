<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\Request;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\UserAgent;
use Config\App;

class AutoEscape implements FilterInterface
{
    /**
     * Verifies that a user is logged in, or redirects to login.
     *
     * @param array|null $arguments
     *
     * @return RedirectResponse|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Mengambil data POST dari form
        $postData = $request->getPost();

        // Melakukan auto-escape pada semua data input POST
        foreach ($postData as $key => &$value) {
            $postData[$key] = $this->customEsc($value);
        }

        // Menimpa data POST global dengan data yang telah diubah
        $_POST = $postData;

        $config = new App();
        $agent = new UserAgent();
        // $config, ?URI $uri = null, $body = 'php://input', ?UserAgent $userAgent = null
        $request = new IncomingRequest($config, $request->getURI(), $postData,  $agent);
        return $request;
    }

    /**
     * @param array|null $arguments
     *
     * @return void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // dd($response);
        return $response;
    }

    function customEsc($value)
    {
        // Melakukan escape pada karakter lainnya
        $value = esc($value);
        $value = str_replace("&#039;", "'", $value);

        return $value;
    }
}
