<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDiskonTable extends Migration
{
    public function up(): void
    {
        if (! $this->db->tableExists('diskon')) {
            $this->forge->addField([
                'id' => [
                    'type'           => 'INT',
                    'auto_increment' => true,
                    'unsigned'       => true
                ],
                'tanggal' => [
                    'type' => 'DATE',
                    'null' => false
                ],
                'nominal' => [
                    'type' => 'DOUBLE',
                    'null' => false
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true
                ]
            ]);

            $this->forge->addKey('id', true); // primary key
            $this->forge->createTable('diskon');
        }
    }

    public function down(): void
    {
        if ($this->db->tableExists('diskon')) {
            $this->forge->dropTable('diskon');
        }
    }
}
