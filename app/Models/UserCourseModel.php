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
        if ($page == 'daftar') {
            $where = "id_user = '{$user_id}' AND (status = 'register' OR status = 'revisi' OR status = 'reject')";
            // $builder->where(['status' => 'register', 'id_user' => $user_id]);
            // $builder->orWhere(['status' => 'revisi', 'id_user' => $user_id]);
            // $builder->orWhere(['status' => 'reject', 'id_user' => $user_id]);
        } else if ($page = 'berlangsung') {
            $where = "id_user='{$user_id}' AND status='accept'";
            // $builder->where(['status' => 'accept', 'id_user' => $user_id]);
        }
        $builder->where($where);
        // $builder->where('id_user', $user_id);
        $query   = $builder->get();
        return $query->getResultArray();
    }
}
