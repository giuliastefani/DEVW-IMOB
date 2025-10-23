<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClienteModel;
use App\Models\ImovelModel;
use App\Models\VisitaModel;

class Visitas extends BaseController
{
    private $visitaModel;
    private $clienteModel;
    private $imovelModel;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->visitaModel = model('VisitaModel');
        $this->clienteModel = model('ClienteModel');
        $this->imovelModel = model('ImovelModel');
    }

    public function index()
    {
        $dados['msg'] = session()->getFlashData('msg');
        $dados['visitas'] = $this->visitaModel->getVisitasComDetalhes();

        return view('visitas_list', $dados);
    }

    private function _prepararFormulario($dados)
    {
        $clientes = $this->clienteModel->findAll();
        $listaClientes = ['' => 'Selecione um cliente...'];
        foreach ($clientes as $cliente) {
            $listaClientes[$cliente->id] = $cliente->nome . ' (CPF: ' . $cliente->cpf . ')';
        }

        $imoveis = $this->imovelModel->findAll();
        $listaImoveis = ['' => 'Selecione um imóvel...'];
        foreach ($imoveis as $imovel) {
            $listaImoveis[$imovel->id] = $this->imovelModel->getTituloFormatado($imovel) .
                ' (' . $imovel->bairro . ', ' . $imovel->cidade . ')';
        }

        $clienteSel = isset($dados['visita']) ? $dados['visita']->id_cliente : '';
        $imovelSel = isset($dados['visita']) ? $dados['visita']->id_imovel : '';

        $dados['comboClientes'] = form_dropdown(
            'id_cliente',
            $listaClientes,
            $clienteSel,
            'class="form-select" required'
        );
        $dados['comboImoveis'] = form_dropdown(
            'id_imovel',
            $listaImoveis,
            $imovelSel,
            'class="form-select" required'
        );

        return $dados;
    }

    public function formulario($id = null)
    {
        $dados['msg'] = "";
        $dados['erros'] = [];

        if ($id) {
            $dados['titulo'] = "Editar Agendamento de Visita";
            $dados['visita'] = $this->visitaModel->find($id);
        } else {
            $dados['titulo'] = "Agendar Nova Visita";
        }

        if ($this->request->is('post')) {
            $postData = $this->request->getPost();

            if ($this->visitaModel->save($postData)) {
                $msg = $id ? 'Visita atualizada com sucesso!' : 'Visita agendada com sucesso!';
                session()->setFlashData('msg', $msg);
                return redirect()->to(base_url('visitas'));
            } else {
                $dados['msg'] = "Erro ao salvar agendamento.";
                $dados['erros'] = $this->visitaModel->errors();
                $dados['visita'] = (object) $postData;
            }
        }

        $dados = $this->_prepararFormulario($dados);
        return view('visita_form', $dados);
    }

    public function excluir($id)
    {
        if ($this->visitaModel->delete($id)) {
            session()->setFlashData('msg', 'Agendamento de visita excluído com sucesso');
        } else {
            session()->setFlashData('msg', 'Erro ao excluir agendamento');
        }
        return redirect()->to(base_url('visitas'));
    }
}