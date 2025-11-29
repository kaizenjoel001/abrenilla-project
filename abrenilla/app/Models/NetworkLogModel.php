<?php

namespace App\Models;
use CodeIgniter\Model;

class NetworkLogModel extends Model
{
    protected $table = 'network_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'full_name', 'ip_address', 'mac_address', 'action', 'created_at'];
}
