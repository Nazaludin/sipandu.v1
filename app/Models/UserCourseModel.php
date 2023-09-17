<?php

namespace App\Models;

use CodeIgniter\Model;

class UserCourseModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user_course';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'id_course', 'id_user', 'status'];

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

    public function dataCourseUserByPage($user_id, $page)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user_course');
        $builder->where('id_user', $user_id);
        if ($page == 'daftar') {
            $builder->where('status', 'register');
            $builder->orWhere('status', 'revisi');
            $builder->orWhere('status', 'reject');
        } else if ($page = 'berlangsung') {
            $builder->where('status', 'accept');
        }
        $query   = $builder->get();
        return $query->getResultArray();
    }
}
