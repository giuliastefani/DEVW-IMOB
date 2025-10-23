<?php

namespace App\Models;

use CodeIgniter\Model;

class ImovelModel extends Model
{
    protected $table = 'imovel';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'cidade',
        'bairro',
        'rua',
        'numero',
        'tipo_imovel',
        'quantidade_quartos',
        'quantidade_banheiros',
        'metros_quadrados',
        'tipo_transacao'
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'cidade' => 'required',
        'bairro' => 'required',
        'rua' => 'required',
        'numero' => 'required',
        'tipo_imovel' => 'required',
        'quantidade_quartos' => 'required|integer',
        'quantidade_banheiros' => 'required|integer',
        'metros_quadrados' => 'required|integer',
        'tipo_transacao' => 'required'
    ];
    protected $validationMessages = [
        'cidade' => ['required' => 'O campo Cidade é obrigatório.'],
        'bairro' => ['required' => 'O campo Bairro é obrigatório.'],
        'rua' => ['required' => 'O campo Rua é obrigatório.'],
        'tipo_imovel' => ['required' => 'O Tipo do Imóvel é obrigatório.'],
    ];
    protected $skipValidation = false;

    public function getTituloFormatado($imovel)
    {
        if (!is_object($imovel)) {
            return "";
        }

        $quartos = $imovel->quantidade_quartos;
        $strQuartos = ($quartos > 1) ? $quartos . ' quartos' : $quartos . ' quarto';

        return $imovel->tipo_imovel . ' com ' . $strQuartos;
    }
}