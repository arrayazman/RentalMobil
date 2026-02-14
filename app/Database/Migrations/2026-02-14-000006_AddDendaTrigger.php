<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDendaTrigger extends Migration
{
    public function up()
    {
        $this->db->query("DROP TRIGGER IF EXISTS before_insert_pengembalians");

        // Note: 'sewa' table name changed to 'sewas' to match previous migrations
        $trigger = "
        CREATE TRIGGER before_insert_pengembalians
        BEFORE INSERT ON pengembalians
        FOR EACH ROW
        BEGIN
            DECLARE batas_kembali DATE;
            DECLARE terlambat INT DEFAULT 0;
            DECLARE denda_per_hari INT DEFAULT 50000;
            DECLARE var_tgl_sewa DATE;
            DECLARE var_lama_sewa INT;

            SELECT tgl_sewa, lama_sewa INTO var_tgl_sewa, var_lama_sewa
            FROM sewas
            WHERE id_sewa = NEW.sewa_id;

            SET batas_kembali = DATE_ADD(var_tgl_sewa, INTERVAL var_lama_sewa DAY);
            SET terlambat = DATEDIFF(NEW.tgl_kembali, batas_kembali);

            IF terlambat > 0 THEN
                SET NEW.denda = terlambat * denda_per_hari;
            ELSE
                SET NEW.denda = 0;
            END IF;
        END
        ";

        $this->db->query($trigger);
    }

    public function down()
    {
        $this->db->query("DROP TRIGGER IF EXISTS before_insert_pengembalians");
    }
}
