<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['nome', 'usuario', 'senha', 'perfil'];

    protected $useTimestamps = false;

    protected $validationRules = [
        'id' => 'permit_empty',
        'nome' => 'required|min_length[3]',
        'usuario' => 'required|min_length[3]|is_unique[usuario.usuario,id,{id}]',
        'senha' => 'required|min_length[6]'
    ];

    protected $validationMessages = [
        'usuario' => [
            'is_unique' => 'Este nome de usuário já está em uso.'
        ],
        'senha' => [
            'min_length' => 'A senha deve ter pelo menos 6 caracteres.'
        ]
    ];

    protected $skipValidation = false;

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    //método para criptografar a senha
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['senha'])) {
            $data['data']['senha'] = password_hash($data['data']['senha'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    //método para validar usuário/senha (form de Login)
    public function check(string $usuario, string $senha)
    {
        //busca o usuário
        $user = $this->where('usuario', $usuario)->first();
        if (! $user) {
            return false;
        }

        //validar a senha
        if (password_verify($senha, $user->senha)) {
            return $user;
        }

        return false;
    }
}
