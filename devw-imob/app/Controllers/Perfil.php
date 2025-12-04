<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Perfil extends BaseController
{
    private $clienteModel;

    public function __construct()
    {
        helper(['url','form']);
        $this->clienteModel = model('ClienteModel');
    }

    public function index()
    {
        $session = service('session');
        $usuarioId = $session->get('usuario_id') ?? null;

        $dados['msg'] = session()->getFlashdata('msg') ?? '';

        //tenta encontrar o cliente vinculado ao usuário logado
        $cliente = null;
        if ($usuarioId) {
            $cliente = $this->clienteModel->where('usuario_id', $usuarioId)->first();
        }

        $dados['cliente'] = $cliente;
        $dados['titulo'] = 'Meu Perfil';
        return view('cliente_form', $dados);
    }

    public function editar()
    {
        $session = service('session');
        $usuarioId = $session->get('usuario_id') ?? null;
        
        //valida se o método é PUT
        $method = $this->request->getPost('_method') ?? $this->request->getMethod();
        if ($method !== 'put' && $method !== 'PUT') {
            return $this->response->setJSON(['error' => 'Método não permitido'])->setStatusCode(405);
        }
        
        $post = $this->request->getPost();
        unset($post['_method']);

        //coloca o usuario_id no post
        $post['usuario_id'] = $usuarioId;
        
        if (! array_key_exists('id', $post)) {
            $post['id'] = '';
        }

        //valida se o id pertence ao usuário logado
        if (! empty($post['id'])) {
            $ex = $this->clienteModel->find($post['id']);
            if ($ex && $ex->usuario_id != $usuarioId) {
                return $this->response->setJSON(['error' => 'Você não pode editar este perfil.'])->setStatusCode(403);
            }
        }

        if ($this->clienteModel->save($post)) {
            session()->setFlashdata('msg', 'Perfil salvo com sucesso');
            return redirect()->to(base_url('perfil'));
        }

        $dados['msg'] = 'Erro ao salvar perfil';
        $dados['erros'] = $this->clienteModel->errors();
        $dados['cliente'] = (object)$post;
        $dados['titulo'] = 'Meu Perfil';
        return view('cliente_form', $dados);
    }
}
