<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DiskonSeeder extends Seeder
{
    public function run()
    {
        $date = new \DateTime();

        for ($i = 0; $i < 10; $i++) {
            $data = [
                'tanggal'    => $date->format('Y-m-d'),
                'nominal'    => 100000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->db->table('diskon')->insert($data);
            $date->modify('+1 day');
        }
    }
}
