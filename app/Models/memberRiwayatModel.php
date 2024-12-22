<?php

namespace App\Models;

use CodeIgniter\Model;

class memberRiwayatModel extends Model
{
    protected $table = 'membership';
    protected $id = 'idMember';
    protected $allowedFields = [
            'idMember',
            'idPemilik',
            'idMembership',
            'harga',
            'durasi',
            'noToken'
    ];
}