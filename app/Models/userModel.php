<?php

namespace App\Models;

use CodeIgniter\Model;

class userModel extends Model
{
    protected $table = 'pemiliktoko';
    protected $primaryKey = 'idPemilik';
    protected $allowedFields = [
        'email',
        'password',
        'namaToko',
        'status',
        'tanggalAkhir'
    ];
}