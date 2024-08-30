<?php

namespace App\Controllers\Aset;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('aset/dashboard');
    }
}
