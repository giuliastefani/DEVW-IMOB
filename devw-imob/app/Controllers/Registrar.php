<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Registrar extends BaseController
{
    public function index()
    {
        $data['msg'] = session()->getFlashdata('msg') ?? '';
        if($this->request->is('post')) {
            $usuarioModel = model('UsuarioModel');
            try{
                $usuarioData = $this->request->getPost();
                $usuarioData['perfil'] = 'usuario';
                if($usuarioModel->insert($usuarioData)) {
                    //cria o cliente vinculado ao usuário
                    $usuarioId = $usuarioModel->getInsertID();
                    $clienteModel = model('ClienteModel');
                    $clienteData = [
                        'nome' => $usuarioData['nome'] ?? '',
                        'cpf' => '',
                        'data_nascimento' => null,
                        'usuario_id' => $usuarioId,
                    ];
                    //pula campos obrigatórios com valores padrão
                    $clienteModel->skipValidation(true)->insert($clienteData);
                    $data['msg'] = "Usuário criado com sucesso";
                }
                else {
                    $data['msg'] = "Erro ao criar usuário";
                    $data['errors'] = $usuarioModel->errors();
                }
            }
            catch(\Exception $e) {
                $data['msg'] = "Erro ao criar usuário: " . $e->getMessage();
            }
        }
        return view('registrar', $data);
    }
}
