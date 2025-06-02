<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductCategory extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
            ],
           
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('kategori');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('kategori');
    }
}