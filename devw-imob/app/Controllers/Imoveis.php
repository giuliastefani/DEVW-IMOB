<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Imoveis extends BaseController
{
    private $imovelModel;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->imovelModel = model('ImovelModel');
    }

    public function index()
    {
        $dados['msg'] = session()->getFlashData('msg');
        $dados['imoveis'] = $this->imovelModel->findAll();
        $dados['imovelModel'] = $this->imovelModel;
        return view('imoveis_list', $dados);
    }

    private function _prepararFormulario($dados)
    {
        $listaTipoImovel = [
            '' => 'Selecione...',
            'Apartamento' => 'Apartamento',
            'Casa' => 'Casa',
            'Terreno' => 'Terreno',
            'Comercial' => 'Comercial'
        ];
        $listaTransacao = [
            '' => 'Selecione...',
            'Venda' => 'Venda',
            'Aluguel' => 'Aluguel'
        ];

        $tipoSel = isset($dados['imovel']) ? $dados['imovel']->tipo_imovel : '';
        $transSel = isset($dados['imovel']) ? $dados['imovel']->tipo_transacao : '';

        $dados['comboTipoImovel'] = form_dropdown(
            'tipo_imovel',
            $listaTipoImovel,
            $tipoSel,
            'class="form-select" required'
        );
        $dados['comboTransacao'] = form_dropdown(
            'tipo_transacao',
            $listaTransacao,
            $transSel,
            'class="form-select" required'
        );

        return $dados;
    }

    public function adicionar()
    {
        $dados['msg'] = "";
        $dados['erros'] = [];

        if ($this->request->is('post')) {
            $novoImovel = $this->request->getPost();

            if ($this->imovelModel->insert($novoImovel)) {
                $dados['msg'] = "Imóvel cadastrado com sucesso";
            } else {
                $dados['msg'] = "Erro ao cadastrar imóvel";
                $dados['erros'] = $this->imovelModel->errors();
            }
        }

        $dados['titulo'] = "Adicionar Novo Imóvel";
        $dados = $this->_prepararFormulario($dados);
        return view('imovel_form', $dados);
    }

    public function editar($id)
    {
        $dados['msg'] = "";
        $dados['erros'] = [];

        if ($this->request->is('post')) {
            $editarId = $this->request->getPost('id');
            $editarImovel = $this->request->getPost();

            if ($this->imovelModel->update($editarId, $editarImovel)) {
                session()->setFlashData('msg', 'Imóvel editado com sucesso');
                return redirect()->to(base_url('imoveis'));
            } else {
                $dados['msg'] = "Erro ao editar imóvel";
                $dados['erros'] = $this->imovelModel->errors();
            }
        }

        $dados['imovel'] = $this->imovelModel->find($id);
        $dados['titulo'] = "Editar Imóvel";
        $dados = $this->_prepararFormulario($dados);
        return view('imovel_form', $dados);
    }

    public function excluir($id)
    {
        if ($this->imovelModel->delete($id)) {
            session()->setFlashData('msg', 'Imóvel excluído com sucesso');
        } else {
            session()->setFlashData('msg', 'Erro ao excluir imóvel');
        }
        return redirect()->to(base_url('imoveis'));
    }
}