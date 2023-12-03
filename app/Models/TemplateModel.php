<?php

namespace App\Models;

use CodeIgniter\Model;

class TemplateModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'template';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_instrument', 'name'];

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

    public function getInstrument($templateId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('template');

        $builder->select('
            template.id AS id_template,
            template.name AS name_template,
            instrument.id AS id_instrument, 
            instrument.name AS name_instrument, 
            instrument.description, 
            instrument.start_fill, 
            instrument.end_fill, 
            section.id AS id_section, 
            section.section, 
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
            question_option.option_e
        ');

        $builder->join('instrument', 'template.id_instrument = instrument.id');
        $builder->join('section', 'instrument.id = section.id_instrument');
        $builder->join('question', 'section.id = question.id_section');
        $builder->join('question_option', 'question.id = question_option.id_question AND question.type = 1', 'left');

        $builder->where('template.id', $templateId);

        $query = $builder->get();

        $results = $query->getResultArray();
        return $results;
    }
}
