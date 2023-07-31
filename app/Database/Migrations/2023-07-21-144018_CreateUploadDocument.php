<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUploadDocument extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => TRUE,
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => TRUE,
            ],
            'deleted_at' => [
                'type' => 'datetime',
                'null' => TRUE,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('upload_document');
    }

    public function down()
    {
        $this->forge->dropTable('upload_document');
    }
}
