<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
        ];

        // Simple check to avoid duplicates if seed is run multiple times
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        
        if ($builder->where('username', 'admin')->countAllResults() > 0) {
            $builder->where('username', 'admin')->update(['password' => $data['password']]);
        } else {
            $this->db->table('users')->insert($data);
        }
    }
}
