<?php

namespace App\Models;

use CodeIgniter\Model;

class userModel extends Model
{
    protected $table = 'pemilikToko';
    protected $allowedFields = [
        'email',
        'password',
        'namaToko'
    ];
}