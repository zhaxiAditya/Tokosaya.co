<?php

namespace App\Models;

use CodeIgniter\Model;

class userModel extends Model
{
    protected $table = 'usermember';
    protected $allowedFields = [
        'email',
        'pass'
    ];
}