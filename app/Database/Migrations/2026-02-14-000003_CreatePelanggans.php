<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePelanggans extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pelanggan'=>[
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>true,
                'auto_increment'=>true
            ],
            'nama'=>[
                'type'=>'VARCHAR',
                'constraint'=>100
            ],
            'no_ktp'=>[
                'type'=>'CHAR',
                'constraint'=>16
            ],
            'alamat'=>[
                'type'=>'TEXT',
                'null'=>true
            ],
            'no_hp'=>[
                'type'=>'VARCHAR',
                'constraint'=>20
            ],
        ]);

        $this->forge->addKey('id_pelanggan', true);

        $this->forge->createTable('pelanggans', true, [
            'ENGINE' => 'InnoDB'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('pelanggans');
    }
}