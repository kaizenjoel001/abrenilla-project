<?php
namespace App\Models;

use CodeIgniter\Model;

class ResolutionModel extends Model
{
    protected $table = 'resolutions';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'resolution_no',
        'title',
        'date_passed',
        'prepared_by',
        'content',
        'attachment',
        'status'
    ];
}
