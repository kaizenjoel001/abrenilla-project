<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'user_id';
    protected $allowedFields    = [
        'full_name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'age',
        'profile_picture',
        'is_verified'
    ];

    // ✅ Let CI automatically manage timestamps
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
}
