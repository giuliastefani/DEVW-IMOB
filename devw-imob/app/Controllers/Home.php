<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    private $imovelModel;

    public function __construct()
    {
        helper('url');
        $this->imovelModel = model('ImovelModel');
    }

    public function index()
    {
        $dados['imoveis'] = $this->imovelModel->findAll();
        $dados['imovelModel'] = $this->imovelModel;
        return view('imoveis_public_list', $dados);
    }

    public function detalhe($id = null)
    {
        $dados['imovel'] = $this->imovelModel->find($id);

        if (!$dados['imovel']) {
            return redirect()->to(base_url());
        }

        $dados['imovelModel'] = $this->imovelModel;
        return view('imovel_detalhe', $dados);
    }
}