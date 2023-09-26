<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'course';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'status_sistem', 'condition', 'start_registration', 'end_registration', 'startdate', 'enddate', 'target_participant', 'place', 'batch', 'quota', 'contact_person', 'schedule_file_name', 'schedule_file_location', 'source_funds', 'method'];

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

    public function dataInsert(array $data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('users');

        if ($builder->insert($data)) {
            return $db->insertID();
        } else {
            return FALSE;
        }
    }
    public function getDataCourseMonth()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('course');
        $builder->where('MONTH(DATE(startdate))', date('m'));
        $query = $builder->get();

        return $query->getResultArray();
    }
    public function getDataCourseYear()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('course');
        $builder->where('YEAR(DATE(startdate))', date('Y'));
        $query = $builder->get();

        return $query->getResultArray();
    }
}
