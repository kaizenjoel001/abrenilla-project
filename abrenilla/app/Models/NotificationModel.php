<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'id';
    protected $allowedFields = ['message', 'user_id', 'user_role', 'type', 'created_at'];
    protected $useTimestamps = true;
}

