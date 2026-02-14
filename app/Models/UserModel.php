<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    /**
     * Model untuk tabel 'users'.
     * Menyimpan data login administrator (username & password).
     */
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['username', 'password'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'username'     => 'required|alpha_numeric_space|min_length[3]|is_unique[users.username]',
        'password'     => 'required|min_length[8]', 
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}