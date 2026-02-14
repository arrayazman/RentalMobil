<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Fungsi ini bertujuan untuk mengisi data awal (dummy data) ke dalam tabel 'pelanggans'.
     * Data ini diperlukan agar aplikasi memiliki data pelanggan untuk simulasi transaksi sewa.
     * Total ada 5 data pelanggan yang akan ditambahkan.
     */
    public function run()
    {
        $data = [
            [
                'nama'   => 'Budi Santoso',
                'no_ktp' => '3201012345670001',
                'alamat' => 'Jl. Merdeka No. 10',
                'no_hp'  => '081234567890'
            ],
            [
                'nama'   => 'Siti Aminah',
                'no_ktp' => '3201012345670002',
                'alamat' => 'Jl. Sudirman No. 45',
                'no_hp'  => '081234567891'
            ],
            [
                'nama'   => 'Rudi Hartono',
                'no_ktp' => '3201012345670003',
                'alamat' => 'Jl. Thamrin No. 88',
                'no_hp'  => '081234567892'
            ],
            [
                'nama'   => 'Dewi Sartika',
                'no_ktp' => '3201012345670004',
                'alamat' => 'Jl. Gatot Subroto No. 12',
                'no_hp'  => '081234567893'
            ],
            [
                'nama'   => 'Andi Wijaya',
                'no_ktp' => '3201012345670005',
                'alamat' => 'Jl. Ahmad Yani No. 99',
                'no_hp'  => '081234567894'
            ],
        ];

        // Using simple insertBatch
        $this->db->table('pelanggans')->insertBatch($data);
    }
}
