<?php

namespace App\Models;

use CodeIgniter\Model;

class transaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $id = 'idTransaksi';
    protected $allowedFields = [
            'idTransaksi',
            'idPemilik',
            'idMembership',
            'noResi',
            'tanggal'
    ];
    public function joinTable(){
        return $this->select('idTransaksi, namaMembership, harga, durasi, noResi, tanggal')->join('membership', 'membership.idMembership = detailmembership.idMembership')->limit(3);
    }
}