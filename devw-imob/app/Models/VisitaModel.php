<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitaModel extends Model
{
    protected $table = 'visita';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id_cliente', 'id_imovel', 'data'];

    protected $useTimestamps = false;

    protected $validationRules = [
        'id_cliente' => 'required|integer',
        'id_imovel' => 'required|integer',
        'data' => 'required|valid_date'
    ];
    protected $validationMessages = [
        'id_cliente' => ['required' => 'O campo Cliente é obrigatório.'],
        'id_imovel' => ['required' => 'O campo Imóvel é obrigatório.'],
        'data' => ['required' => 'O campo Data e Hora é obrigatório.']
    ];
    protected $skipValidation = false;

    public function getVisitasComDetalhes()
    {
        $builder = $this->db->table('visita');
        $builder->select('
            visita.*, 
            cliente.nome as nome_cliente, 
            imovel.tipo_imovel, 
            imovel.bairro
        ');
        $builder->join('cliente', 'cliente.id = visita.id_cliente');
        $builder->join('imovel', 'imovel.id = visita.id_imovel');
        $builder->orderBy('visita.data', 'DESC');

        return $builder->get()->getResult('object');
    }
}