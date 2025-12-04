<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Logout extends BaseController
{
    public function index()
    {
        //exclui os dados da sessão
        service('session')->destroy();
        return redirect()->to(base_url());
    }
}
