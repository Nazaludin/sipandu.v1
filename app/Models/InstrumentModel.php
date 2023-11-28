<?php

namespace App\Models;

use CodeIgniter\Model;

class InstrumentModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'instrument';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_course', 'name', 'description', 'start_fill', 'end_fill'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getInstrument($id_course)
    {
        $db      = \Config\Database::connect();
        $query = $db->table('instrument')
            ->select('instrument.id AS id_instrument, 
            instrument.name, 
            instrument.description, 
            instrument.start_fill, 
            instrument.end_fill, 
            question.id AS id_question, 
            question.number, 
            question.question, 
            question.type,
            question.key, 
            question.linked, 
            question_option.option_a,
            question_option.option_b,
            question_option.option_c,
            question_option.option_d,
            question_option.option_e')
            ->join('question', 'instrument.id = question.id_instrument')
            ->join('question_option', 'question.id = question_option.id_question AND question.type = 1', 'left')
            ->where('instrument.id_course', $id_course)
            ->get();

        $results = $query->getResultArray();
        return $results;
    }
}
