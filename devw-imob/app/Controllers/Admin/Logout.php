<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Logout extends BaseController
{
    public function index()
    {
        //exclui os dados da sessão
        session()->destroy();
        return redirect()->to('login');
    }
}
