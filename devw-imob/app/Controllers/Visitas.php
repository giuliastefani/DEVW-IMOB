<?php

namespace App\Controllers;

use App\Controllers\BaseController;

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

        $session = service('session');
        $perfil = $session->get('perfil');

        if ($perfil === 'admin') {
            $dados['visitas'] = $this->visitaModel->getVisitasComDetalhes();
        } elseif ($perfil === 'usuario') {
            $usuarioId = $session->get('usuario_id');
            $cliente = $this->clienteModel->where('usuario_id', $usuarioId)->first();
            if ($cliente) {
                $dados['visitas'] = $this->visitaModel->getVisitasComDetalhesPorCliente($cliente->id);
            } else {
                $dados['visitas'] = [];
            }
        } else {
            $dados['visitas'] = [];
        }

        return view('visitas_list', $dados);
    }

    private function _prepararFormulario($dados)
    {
        $session = service('session');
        $usuarioId = $session->get('usuario_id');

        $listaClientes = ['' => 'Selecione um cliente...'];

        if ($usuarioId) {
            // se usuário logado, procurar cliente vinculado
            $cliente = $this->clienteModel->where('usuario_id', $usuarioId)->first();
            if ($cliente) {
                $listaClientes = [$cliente->id => $cliente->nome . ' (CPF: ' . $cliente->cpf . ')'];
            } else {
                // fallback para todos
                $clientes = $this->clienteModel->findAll();
                foreach ($clientes as $clienteItem) {
                    $listaClientes[$clienteItem->id] = $clienteItem->nome . ' (CPF: ' . $clienteItem->cpf . ')';
                }
            }
        } else {
            $clientes = $this->clienteModel->findAll();
            foreach ($clientes as $clienteItem) {
                $listaClientes[$clienteItem->id] = $clienteItem->nome . ' (CPF: ' . $clienteItem->cpf . ')';
            }
        }

        $imoveis = $this->imovelModel->findAll();
        $listaImoveis = ['' => 'Selecione um imóvel...'];
        foreach ($imoveis as $imovel) {
            $listaImoveis[$imovel->id] = $this->imovelModel->getTituloFormatado($imovel) .
                ' (' . $imovel->bairro . ', ' . $imovel->cidade . ')';
        }

        $clienteSel = '';
        $imovelSel = '';

        //verifica se existe os dados da visita para preencher o formulário
        $visitaData = [];
        if (isset($dados['visita'])) {
            if (is_object($dados['visita'])) {
                $visitaData = (array) $dados['visita'];
            } elseif (is_array($dados['visita'])) {
                $visitaData = $dados['visita'];
            }
        }

        $clienteSel = isset($visitaData['id_cliente']) ? $visitaData['id_cliente'] : '';
        $imovelSel = isset($visitaData['id_imovel']) ? $visitaData['id_imovel'] : '';

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
            //se usuario for 'usuario', valida se a visita pertence ao cliente logado
            $session = service('session');
            $perfil = $session->get('perfil');
            if ($perfil === 'usuario') {
                $usuarioId = $session->get('usuario_id');
                $cliente = $this->clienteModel->where('usuario_id', $usuarioId)->first();
                //se for visitante nega o acesso
                if (! $cliente || ! isset($dados['visita']->id_cliente) || $dados['visita']->id_cliente != $cliente->id) {
                    session()->setFlashData('msg', 'Acesso negado.');
                    return redirect()->to(base_url());
                }
            }
        } else {
            $dados['titulo'] = "Agendar Nova Visita";
        }

        //se vier imovel_id por GET, preenche no formulário
        $imovelGet = $this->request->getGet('imovel_id');
        if ($imovelGet && empty($dados['visita'])) {
            $dados['visita'] = (object) ['id_imovel' => $imovelGet];
        }

        if ($this->request->is('post')) {
            $postData = $this->request->getPost();
            //se usuario for 'usuario', seta o id_cliente para o cliente logado
            $session = service('session');
            $usuarioId = $session->get('usuario_id');
            if ($usuarioId) {
                $cliente = $this->clienteModel->where('usuario_id', $usuarioId)->first();
                if ($cliente) {
                    $postData['id_cliente'] = $cliente->id;
                } else {
                    $dados['msg'] = 'Você precisa criar seu perfil antes de agendar visitas.';
                    $dados['erros'] = [];
                    $dados = $this->_prepararFormulario($dados);
                    return view('visita_form', $dados);
                }
            }

            //garante que o id está presente no postData
            if (is_array($postData) && ! array_key_exists('id', $postData)) {
                $postData['id'] = '';
            }

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
        $session = service('session');
        $perfil = $session->get('perfil');

        $visita = $this->visitaModel->find($id);
        if (! $visita) {
            session()->setFlashData('msg', 'Agendamento não encontrado');
            return redirect()->to(base_url('visitas'));
        }

        if ($perfil === 'admin') {
            $ok = $this->visitaModel->delete($id);
        } elseif ($perfil === 'usuario') {
            $usuarioId = $session->get('usuario_id');
            $cliente = $this->clienteModel->where('usuario_id', $usuarioId)->first();
            if ($cliente && isset($visita->id_cliente) && $visita->id_cliente == $cliente->id) {
                $ok = $this->visitaModel->delete($id);
            } else {
                $ok = false;
            }
        } else {
            $ok = false;
        }

        if ($ok) {
            session()->setFlashData('msg', 'Agendamento de visita excluído com sucesso');
        } else {
            session()->setFlashData('msg', 'Erro ao excluir agendamento');
        }
        return redirect()->to(base_url('visitas'));
    }

    public function editar($id)
    {
        $session = service('session');
        $perfil  = $session->get('perfil');
        $usuarioId = $session->get('usuario_id');

        $visita = $this->visitaModel->find($id);
        if (! $visita) {
            session()->setFlashdata('msg', 'Visita não encontrada.');
            return redirect()->to(base_url('visitas'));
        }

        if ($perfil !== 'admin') {
            $clienteModel = model('ClienteModel');
            $cliente = $clienteModel->where('usuario_id', $usuarioId)->first();
            if (! $cliente || (! empty($visita->id_cliente) && $visita->id_cliente != $cliente->id)) {
                session()->setFlashdata('msg', 'Você não pode editar esta visita.');
                return redirect()->to(base_url('visitas'));
            }
        }

        return $this->formulario($id);
    }
}