<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSewas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_sewa'=>[
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>true,
                'auto_increment'=>true
            ],
            'pelanggan_id'=>[
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>true
            ],
            'mobil_id'=>[
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>true
            ],
            'tgl_sewa'=>[
                'type'=>'DATE'
            ],
            'lama_sewa'=>[
                'type'=>'INT',
                'constraint'=>11
            ],
            'total_biaya'=>[
                'type'=>'INT',
                'constraint'=>11
            ],
        ]);

        $this->forge->addKey('id_sewa', true);

        $this->forge->addForeignKey(
            'pelanggan_id',
            'pelanggans',
            'id_pelanggan',
            'CASCADE',
            onDelete: 'RESTRICT'
        );

        $this->forge->addForeignKey(
            'mobil_id',
            'mobils',
            'id_mobil',
            'CASCADE',
            onDelete: 'RESTRICT'
        );

        $this->forge->createTable('sewas', true, [
            'ENGINE' => 'InnoDB'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('sewas');
    }
}