<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Ajax extends BaseController
{
  public function index()
  {
    // code...
  }

  public function getPegawai($nip)
  {
    $request = \Config\Services::request();
    $client = \Config\Services::curlrequest();

    $apiurl = 'https://api.kemenag.go.id/epa/pegawai/'.$nip;

    $response = $client->request('GET', $apiurl, [
      'headers' => [
          'Accept'        => 'application/json'
      ],
      'verify' => false
    ]);

    $data = json_decode($response->getBody());
    return $this->response->setJSON($data);
  }

}
