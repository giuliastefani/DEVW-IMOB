<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    public function index()
    {
        $data['msg'] = session()->getFlashdata('msg') ?? '';
        if($this->request->is('post')) {
            $usuarioModel = model('UsuarioModel');
            $usuarioData = $this->request->getPost();
            //verifica as credenciais do usuário
            $checkUsuario = $usuarioModel->check(
                $usuarioData['usuario'], $usuarioData['senha']
            );

            if(! $checkUsuario) {
                $data['msg'] = "Usuário e/ou senha incorretos";
            }
            else {
                //salvar as informacoes do usuario na sessao
                session()->set('nome', $checkUsuario->nome);
                session()->set('perfil', $checkUsuario->perfil);
                session()->set('usuario_id', $checkUsuario->id);
                //redireciona baseado no perfil
                if (isset($checkUsuario->perfil) && $checkUsuario->perfil === 'admin') {
                    return redirect()->to('admin');
                }

                return redirect()->to(base_url());
            }
        }
        return view('login', $data);
    }
}
