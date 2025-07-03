<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up(): void
    {
        // Cek dulu apakah tabel 'user' sudah ada
        if (! $this->db->tableExists('user')) {
            $this->forge->addField([
                'id' => [
                    'type'           => 'INT',
                    'unsigned'       => true,
                    'auto_increment' => true
                ],
                'username' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => false,
                    'unique'     => true,
                ],
                'email' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => false,
                    'unique'     => true,
                ],
                'password' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => false,
                ],
                'role' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 50,
                    'null'       => false,
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ]);

            $this->forge->addKey('id', true); // Primary key
            $this->forge->createTable('user' );
        }
    }

    public function down(): void
    {
        // Drop tabel hanya jika ada
        if ($this->db->tableExists('user')) {
            $this->forge->dropTable('user');
        }
    }
}
