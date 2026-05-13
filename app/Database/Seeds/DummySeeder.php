<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DummySeeder extends Seeder
{
    public function run()
    {
        $productData = [
            [
                'name'        => 'Kamera DSLR',
                'price'       => 5000000,
                'stock'       => 10,
                'description' => 'Kamera DSLR berkualitas tinggi',
                'image'       => null,
            ],
            [
                'name'        => 'Lensa 50mm',
                'price'       => 2000000,
                'stock'       => 5,
                'description' => 'Lensa fix 50mm f/1.8',
                'image'       => null,
            ],
            [
                'name'        => 'Tripod',
                'price'       => 500000,
                'stock'       => 20,
                'description' => 'Tripod aluminium yang kokoh',
                'image'       => null,
            ],
        ];

        // Using Query Builder
        $this->db->table('products')->insertBatch($productData);
    }
}
