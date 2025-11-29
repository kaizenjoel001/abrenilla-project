<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title',
        'description',
        'category',
        'event_date',
        'location',
        'image',
        'created_by',
        'created_at' // Only include this if your table has it
    ];
    public $timestamps = false; // Disable if no created_at/updated_at
}
