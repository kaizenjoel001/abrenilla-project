<?php
namespace App\Models;

use CodeIgniter\Model;

class SKMemberModel extends Model
{
    protected $table = 'sk_members';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'full_name', 'age', 'gender', 'position', 'term_start', 'term_end',
        'status', 'photo', 'bio', 'achievements', 'projects', 'contact_info'
    ];
}
