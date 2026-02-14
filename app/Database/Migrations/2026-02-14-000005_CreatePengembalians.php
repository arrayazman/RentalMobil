<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengembalians extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengembalian'=>[
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>true,
                'auto_increment'=>true
            ],
            'sewa_id'=>[
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>true
            ],
            'tgl_kembali'=>[
                'type'=>'DATE'
            ],
            'denda'=>[
                'type'=>'INT',
                'constraint'=>11,
                'default'=>0
            ],
        ]);

        $this->forge->addKey('id_pengembalian', true);

        $this->forge->addForeignKey(
            'sewa_id',
            'sewas',
            'id_sewa',
            'CASCADE',
            onDelete: 'RESTRICT'
        );

        $this->forge->createTable('pengembalians', true, [
            'ENGINE' => 'InnoDB'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('pengembalians');
    }
}