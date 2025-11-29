<?php
namespace App\Models;

use CodeIgniter\Model;

class SKOfficialModel extends Model
{
    protected $table = 'sk_officials';
    protected $primaryKey = 'id';
    protected $allowedFields = ['full_name', 'email', 'phone', 'position', 'profile_picture', 'password'];
    protected $returnType = 'array';
}
