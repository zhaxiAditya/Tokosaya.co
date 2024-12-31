<?php

namespace App\Models;

use CodeIgniter\Model;

class produkModel extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'idProduk'; // Pastikan primary key adalah 'idProduk'
    protected $allowedFields = [
            'idProduk',
            'idPemilik',
            'kodeProduk',
            'namaProduk',
            'kategori',
            'harga',
            'jumlah',
    ];

    public function search($keyword){
        $builder = $this->table('produk');
        $builder->like('namaProduk', $keyword);
        $builder->orLike('kodeProduk', $keyword);
        return $builder;
    }
}