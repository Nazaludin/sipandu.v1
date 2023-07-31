<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCourseUploadDokument extends Migration
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
            'id_upload_dokument' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_course', 'course', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_upload_dokument', 'upload_document', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('course_upload_document');
    }

    public function down()
    {
        $this->forge->dropTable('course_upload_document');
    }
}
