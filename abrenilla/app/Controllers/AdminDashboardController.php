<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProposalModel;

class AdminDashboardController extends BaseController
{
    // --- Dashboard Stats ---
    public function totalUsers()
    {
        $userModel = new UserModel();
        $totalUsers = $userModel->countAllResults();
        return $this->response->setJSON(['totalUsers' => $totalUsers]);
    }

    public function totalProposals()
    {
        $proposalModel = new ProposalModel();
        $totalProposals = $proposalModel->countAllResults();
        return $this->response->setJSON(['totalProposals' => $totalProposals]);
    }

    public function pendingApprovals()
    {
        $proposalModel = new ProposalModel();
        $pendingApprovals = $proposalModel->where('status', 'Pending')->countAllResults();
        return $this->response->setJSON(['pendingApprovals' => $pendingApprovals]);
    }

    public function approvedProposals()
    {
        $proposalModel = new ProposalModel();
        $approvedProposals = $proposalModel->where('status', 'Approved')->countAllResults();
        return $this->response->setJSON(['approvedProposals' => $approvedProposals]);
    }

    public function recentActivities()
    {
        $activities = [
            ['message' => 'User John Doe created a proposal.'],
            ['message' => 'Proposal #123 was approved.'],
            ['message' => 'Admin updated user permissions.']
        ];
        return $this->response->setJSON(['activities' => $activities]);
    }

    // --- User Management ---
    public function index()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();
        return view('users/manage', $data);
    }

    public function view($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('/users')->with('error', 'User not found.');
        }

        return view('users/view', ['user' => $user]);
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('/users')->with('error', 'User not found.');
        }

        return view('users/edit', ['user' => $user]);
    }

    public function update($id)
    {
        $userModel = new UserModel();
        $data = $this->request->getPost();
        $userModel->update($id, $data);

        // 🧠 Log the action
        $this->logNetworkActivity("Updated user ID #{$id}");

        return redirect()->to('/users')->with('success', 'User updated successfully.');
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);

        // 🧠 Log the action
        $this->logNetworkActivity("Deleted user ID #{$id}");

        return redirect()->to('/users')->with('success', 'User deleted successfully.');
    }

    public function getUsers()
    {
        $userModel = new UserModel();
        $users = $userModel->findAll();
        return $this->response->setJSON($users);
    }
}
