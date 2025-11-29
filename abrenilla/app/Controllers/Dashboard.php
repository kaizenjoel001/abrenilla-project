<?php

namespace App\Controllers;

use App\Models\MilestoneModel;
use App\Models\ProposalModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $milestoneModel = new MilestoneModel();
        $milestones = $milestoneModel->findAll();

        $this->logNetworkActivity("Accessed main dashboard");

        return view('dashboard/sk', ['milestones' => $milestones]);
    }

    public function sk()
    {
        $milestoneModel = new MilestoneModel();
        $milestones = $milestoneModel->findAll();

        $this->logNetworkActivity("Accessed SK dashboard");

        return view('dashboard/sk', ['milestones' => $milestones]);
    }

    public function barangay()
    {
        $proposalModel = new ProposalModel();

        $totalProposals = $proposalModel->countAll();
        $approvedCount = $proposalModel->where('status', 'Approved')->countAllResults();
        $pendingCount = $proposalModel->where('status', 'Pending')->countAllResults();
        $recentProposals = $proposalModel->orderBy('created_at', 'DESC')->limit(5)->find();

        $this->logNetworkActivity("Accessed Barangay dashboard");

        return view('dashboard/barangay', [
            'totalProposals'  => $totalProposals,
            'approvedCount'   => $approvedCount,
            'pendingCount'    => $pendingCount,
            'recentProposals' => $recentProposals,
        ]);
    }

    public function viewProposal($id)
    {
        $model = new ProposalModel();
        $proposal = $model->find($id);

        if (!$proposal) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Proposal not found']);
        }

        $this->logNetworkActivity("Viewed proposal ID: {$id}");

        return $this->response->setJSON($proposal);
    }

    public function admin()
    {
        $this->logNetworkActivity("Accessed Admin dashboard");
        return view('dashboard/admin');
    }
}
