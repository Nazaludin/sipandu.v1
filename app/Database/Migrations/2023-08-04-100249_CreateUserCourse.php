<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserCourse extends Migration
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
            'id_course' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
            'id_user'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_course', 'course', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_user', 'users', 'id', '', 'CASCADE');
        $this->forge->createTable('user_course');
    }

    public function down()
    {
        $this->forge->dropTable('user_course');
    }
}
