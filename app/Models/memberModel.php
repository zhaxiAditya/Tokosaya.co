<?php

namespace App\Models;

use CodeIgniter\Model;

class memberModel extends Model
{
    protected $table = 'detailmembership';
    protected $id = 'idMembership';

    public function joinTable(){
        return $this->select('idMember, namaMembership, harga, durasi, noToken')->join('membership', 'membership.idMembership = detailmembership.idMembership')->limit(3);
    }
}