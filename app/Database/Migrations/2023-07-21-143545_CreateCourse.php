<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCourse extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
            'condition' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'start_registration' => [
                'type' => 'datetime',
                'null' => TRUE,
            ],
            'end_registration' => [
                'type' => 'datetime',
                'null' => TRUE,
            ],
            'target_participant' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'batch' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
            'quota' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
            'target_participant' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'contact_person' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'schedule_file' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],


        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('course');
    }

    public function down()
    {
        $this->forge->dropTable('course');
    }
}
