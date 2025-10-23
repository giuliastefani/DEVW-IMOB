<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Clientes extends BaseController
{
    private $clienteModel;

    public function __construct()
    {
        helper('url');
        $this->clienteModel = model('ClienteModel');
    }

    public function index()
    {
        $dados['msg'] = session()->getFlashData('msg');
        $dados['clientes'] = $this->clienteModel->findAll();
        return view('clientes_list', $dados);
    }

    public function adicionar()
    {
        $dados['msg'] = "";
        $dados['erros'] = [];

        if ($this->request->is('post')) {
            $novoCliente['nome'] = $this->request->getPost('nome');
            $novoCliente['cpf'] = $this->request->getPost('cpf');
            $novoCliente['data_nascimento'] = $this->request->getPost('data_nascimento');

            if ($this->clienteModel->insert($novoCliente)) {
                $dados['msg'] = "Cliente cadastrado com sucesso";
            } else {
                $dados['msg'] = "Erro ao cadastrar cliente";
                $dados['erros'] = $this->clienteModel->errors();
            }
        }

        $dados['titulo'] = "Adicionar Novo Cliente";
        return view('cliente_form', $dados);
    }

    public function editar($id)
    {
        $dados['msg'] = "";
        $dados['erros'] = [];

        if ($this->request->is('post')) {
            $editarId = $this->request->getPost('id');
            $editarCliente['nome'] = $this->request->getPost('nome');
            $editarCliente['cpf'] = $this->request->getPost('cpf');
            $editarCliente['data_nascimento'] = $this->request->getPost('data_nascimento');

            if ($this->clienteModel->update($editarId, $editarCliente)) {
                session()->setFlashData('msg', 'Cliente editado com sucesso');
                return redirect()->to(base_url('clientes'));
            } else {
                $dados['msg'] = "Erro ao editar cliente";
                $dados['erros'] = $this->clienteModel->errors();
            }
        }

        $dados['cliente'] = $this->clienteModel->find($id);
        $dados['titulo'] = "Editar Cliente";
        return view('cliente_form', $dados);
    }

    public function excluir($id)
    {
        if ($this->clienteModel->delete($id)) {
            session()->setFlashData('msg', 'Cliente excluído com sucesso');
        } else {
            session()->setFlashData('msg', 'Erro ao excluir cliente');
        }

        return redirect()->to(base_url('clientes'));
    }
}