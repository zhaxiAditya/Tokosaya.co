<?php

namespace App\Models;

use CodeIgniter\Model;

class riwayatModel extends Model
{
    protected $table = 'riwayat';
    protected $id = 'idPemilik';
    protected $allowedFields = [
            'idPemilik',
            'kodeProduk',
            'namaProduk',
            'status',
            'jumlah',
            'tanggal'
    ];
}