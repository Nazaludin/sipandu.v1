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
    protected $allowedFields    = ['id', 'id_course', 'id_user', 'status', 'certificate_number', 'certificate_file_name', 'certificate_file_location', 'comment'];

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
        if ($page == 'daftar') {
            $where = "id_user = '{$user_id}' AND (status = 'register' OR status = 'revisi' OR status = 'reject' OR status = 'renew')";
        } else if ($page == 'berlangsung') {
            $where = "id_user='{$user_id}' AND status='accept'";
        } else if ($page == 'riwayat') {
            $where = "id_user='{$user_id}' AND status='passed'";
        }
        $builder->where($where);
        $query   = $builder->get();
        return $query->getResultArray();
    }

    public function setStatusPassed($id_course)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user_course');
        $builder->where("id_course='{$id_course}' AND status='accept'");
        return $builder->update(['status' => 'passed']);
    }
}
