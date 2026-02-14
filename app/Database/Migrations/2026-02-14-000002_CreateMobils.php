<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMobils extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_mobil' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'no_polisi' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'unique'     => true
            ],
            'merk' => [
                'type'       => 'VARCHAR',
                'constraint' => 50
            ],
            'tipe' => [
                'type'       => 'VARCHAR',
                'constraint' => 50
            ],
            'harga_per_hari' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'tersedia'
            ],
        ]);

        $this->forge->addKey('id_mobil', true);

        $this->forge->createTable('mobils', true, [
            'ENGINE' => 'InnoDB'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('mobils');
    }
}