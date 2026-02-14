<?php

namespace App\Models;

use CodeIgniter\Model;

class MobilModel extends Model
{
    /**
     * Model untuk tabel 'mobils'.
     * Menyimpan data armada mobil rental.
     */
    protected $table            = 'mobils';
    protected $primaryKey       = 'id_mobil';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['no_polisi', 'merk', 'tipe', 'harga_per_hari', 'status'];

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

    protected $validationRules      = [
        'id_mobil'  => 'permit_empty|is_natural_no_zero',
        'no_polisi' => 'required|is_unique[mobils.no_polisi,id_mobil,{id_mobil}]',
        'merk'      => 'required',
        'tipe'      => 'required',
        'harga_per_hari' => 'required|numeric',
        'status'    => 'required'
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
