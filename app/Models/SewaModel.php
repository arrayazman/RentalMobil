<?php

namespace App\Models;

use CodeIgniter\Model;

class SewaModel extends Model
{
    /**
     * Model untuk tabel 'sewas'.
     * Menyimpan data transaksi penyewaan (siapa menyewa apa, kapan, dan berapa lama).
     */
    protected $table            = 'sewas';
    protected $primaryKey       = 'id_sewa';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['pelanggan_id', 'mobil_id', 'tgl_sewa', 'lama_sewa', 'total_biaya'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'pelanggan_id' => 'required|integer',
        'mobil_id'     => 'required|integer',
        'tgl_sewa'     => 'required|valid_date',
        'lama_sewa'    => 'required|integer',
        'total_biaya'  => 'required|integer'
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
