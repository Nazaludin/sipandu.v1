<?php

namespace App\Models;

use CodeIgniter\Model;

class AnswerModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'answer';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'id_instrument', 'id_question', 'skor', 'answer', 'type'];

    // Dates
    protected $useTimestamps = false;
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

    public function getAnswerByUserAndInstrument($id_user, $id_instrument)
    {
        $db      = \Config\Database::connect();
        $query = $db->table('answer')
            ->select('answer.id AS id_answer, answer.answer, answer.skor, question.id AS id_question, question.number, question.question, question.type')
            ->join('question', 'question.id = answer.id_question')
            ->where('answer.id_user', $id_user)
            ->where('answer.id_instrument', $id_instrument)
            ->get();

        $results = $query->getResultArray();
        return $results;
    }
}
