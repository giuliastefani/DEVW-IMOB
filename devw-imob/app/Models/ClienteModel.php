<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table = 'cliente';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['nome', 'cpf', 'data_nascimento', 'usuario_id'];

    protected $useTimestamps = false;

    protected $validationRules = [
        'id' => 'permit_empty',
        'nome' => 'required|min_length[3]',
        'cpf' => 'required|exact_length[11]|is_unique[cliente.cpf,id,{id}]',
        'data_nascimento' => 'required|valid_date'
    ];
    protected $validationMessages = [
        'nome' => [
            'required' => 'O campo Nome é obrigatório.',
            'min_length' => 'O Nome deve ter pelo menos 3 caracteres.'
        ],
        'cpf' => [
            'required' => 'O campo CPF é obrigatório.',
            'exact_length' => 'O CPF deve ter exatamente 11 dígitos.',
            'is_unique' => 'Este CPF já está cadastrado.'
        ],
        'data_nascimento' => [
            'required' => 'A Data de Nascimento é obrigatória.'
        ]
    ];
    protected $skipValidation = false;
}