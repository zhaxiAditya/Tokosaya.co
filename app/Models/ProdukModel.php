<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table = 'produk';
    protected $id = 'id_user';
    protected $allowedFields = [
            'idProduk',
            'id_user',
            'namaProduk',
            'kategori',
            'jumlah',
            'harga',
            'exp'
    ];
}