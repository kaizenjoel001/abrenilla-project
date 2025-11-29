<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProposalsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'proposal_id'       => ['type' => 'INT', 'auto_increment' => true],
            'title'             => ['type' => 'VARCHAR', 'constraint' => 255],
            'category'          => ['type' => 'VARCHAR', 'constraint' => 100],
            'description'       => ['type' => 'TEXT'],
            'objectives'        => ['type' => 'TEXT'],
            'beneficiaries'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'location'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'start_date'        => ['type' => 'DATE'],
            'end_date'          => ['type' => 'DATE'],
            'estimated_budget'  => ['type' => 'DECIMAL', 'constraint' => '12,2'],
            'budget_breakdown'  => ['type' => 'TEXT'],
            'source_of_funds'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'expected_outcomes' => ['type' => 'TEXT'],
            'partners'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'attachments'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status'            => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'Pending'],
            'created_by'        => ['type' => 'INT'],
            'approved_by'       => ['type' => 'INT', 'null' => true],
            'created_at'        => ['type' => 'DATETIME', 'null' => true],
            'updated_at'        => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('proposal_id', true);
        $this->forge->createTable('proposals');
    }

    public function down()
    {
        $this->forge->dropTable('proposals');
    }
}
