<?php

namespace App\Models;
use CodeIgniter\Model;

class MilestoneModel extends Model
{
    protected $table = 'milestones';
    protected $allowedFields = ['title', 'description', 'category', 'attachment', 'user_id'];
}