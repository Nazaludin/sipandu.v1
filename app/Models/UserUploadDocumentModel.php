<?php

namespace App\Models;

use CodeIgniter\Model;

class UserUploadDocumentModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user_upload_document';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'id_user_course', 'id_upload_document', 'name', 'link', 'status'];

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

    public function getUserUploadDocument($id_user_course)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user_upload_document');
        $builder->select('upload_document.*, user_upload_document.link, user_upload_document.id as id_user_upload_document');
        $builder->join('upload_document', 'upload_document.id = user_upload_document.id_upload_document');
        $builder->where('user_upload_document.id_user_course', $id_user_course);
        $query = $builder->get();

        return $query->getResultArray();
    }
}
