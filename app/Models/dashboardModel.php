<?php

namespace App\Models;

use CodeIgniter\Model;

class dashboardModel extends Model
{
    protected $table = 'produk';
    protected $id = 'idPemilik';
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