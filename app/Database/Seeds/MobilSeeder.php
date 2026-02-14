<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Fungsi ini bertujuan untuk mengisi data awal (dummy data) ke dalam tabel 'mobils'.
     * Data ini diperlukan untuk menyediakan pilihan mobil yang "tersedia" saat melakukan transaksi sewa.
     * Total ada 5 data mobil dengan status 'tersedia'.
     */
    public function run()
    {
        $data = [
            [
                'no_polisi' => 'B 1234 ABC',
                'merk'      => 'Toyota Avanza',
                'tipe'      => 'MPV',
                'harga_per_hari' => 350000,
                'status'    => 'tersedia'
            ],
            [
                'no_polisi' => 'B 5678 DEF',
                'merk'      => 'Honda Jazz',
                'tipe'      => 'Hatchback',
                'harga_per_hari' => 450000,
                'status'    => 'tersedia'
            ],
            [
                'no_polisi' => 'D 9012 GHI',
                'merk'      => 'Suzuki Ertiga',
                'tipe'      => 'MPV',
                'harga_per_hari' => 300000,
                'status'    => 'tersedia'
            ],
            [
                'no_polisi' => 'F 3456 JKL',
                'merk'      => 'Daihatsu Xenia',
                'tipe'      => 'MPV',
                'harga_per_hari' => 320000,
                'status'    => 'tersedia'
            ],
            [
                'no_polisi' => 'B 7890 MNO',
                'merk'      => 'Toyota Innova',
                'tipe'      => 'MPV',
                'harga_per_hari' => 600000,
                'status'    => 'tersedia'
            ],
        ];

        $this->db->table('mobils')->insertBatch($data);
    }
}
