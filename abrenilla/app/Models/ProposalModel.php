<?php
namespace App\Models;

use CodeIgniter\Model;

class ProposalModel extends Model
{
    protected $table = 'proposals';
    protected $primaryKey = 'id'; // 👈 This is important to fix the error

    protected $allowedFields = [
        'title', 'category', 'description', 'objectives', 'beneficiaries',
        'location', 'start_date', 'end_date', 'estimated_budget',
        'budget_breakdown', 'source_of_funds', 'expected_outcomes',
        'partners', 'attachments', 'status', 'created_by', 'approved_by'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
