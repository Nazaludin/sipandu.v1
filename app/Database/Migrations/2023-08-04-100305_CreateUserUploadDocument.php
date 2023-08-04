<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserUploadDocument extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_user_course' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
            'id_upload_document' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'link' => [
                'type' => 'VARCHAR',
                'constraint' => 300,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => TRUE,
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => TRUE,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_user_course', 'user_course', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_upload_document', 'upload_document', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('user_upload_document');
    }

    public function down()
    {
        $this->forge->dropTable('user_upload_document');
    }
}
