<?php

namespace App\Controllers;

use App\Models\ProposalModel;

class Proposal extends BaseController // ✅ Extend BaseController
{
    public function create()
    {
        $this->logNetworkActivity('Accessed Create Proposal Page'); // ✅ Use $this
        return view('dashboard/sk_create_proposal');
    }

    public function store()
    {
        helper(['form', 'url']); // Ensure helper loaded

        $proposalModel = new ProposalModel();

        $data = [
            'title' => $this->request->getPost('title'),
            'category' => $this->request->getPost('category'),
            'description' => $this->request->getPost('description'),
            'objectives' => $this->request->getPost('objectives'),
            'beneficiaries' => $this->request->getPost('beneficiaries'),
            'location' => $this->request->getPost('location'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'estimated_budget' => $this->request->getPost('estimated_budget'),
            'budget_breakdown' => $this->request->getPost('budget_breakdown'),
            'source_of_funds' => $this->request->getPost('source_of_funds'),
            'expected_outcomes' => $this->request->getPost('expected_outcomes'),
            'partners' => $this->request->getPost('partners'),
            'status' => 'Pending',
        ];

        // Handle attachment
        $file = $this->request->getFile('attachments');
        if ($file && $file->isValid()) {
            $newName = $file->getRandomName();
            $file->move('uploads', $newName);
            $data['attachments'] = $newName;
        }

        $proposalModel->insert($data);

        // ✅ Log activity using BaseController method
        $this->logNetworkActivity('Submitted a new proposal: ' . $data['title']);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Proposal submitted successfully!'
        ]);
    }

    public function listSK()
    {
        $proposalModel = new ProposalModel();
        $data['proposals'] = $proposalModel->findAll();

        $this->logNetworkActivity('Viewed SK Proposal List'); // ✅ Log activity

        if ($this->request->isAJAX()) {
            return view('dashboard/_proposal_table', $data);
        }

        return view('dashboard/sk_view_proposals', $data);
    }

    public function listBarangay()
    {
        $model = new ProposalModel();
        $search = $this->request->getGet('search');

        if ($search) {
            $proposals = $model->like('title', $search, 'after')->findAll();
        } else {
            $proposals = $model->findAll();
        }

        $this->logNetworkActivity('Viewed Barangay Proposal List'); // ✅ Log activity

        return view('dashboard/barangay_proposals', [
            'proposals' => $proposals,
            'search' => $search
        ]);
    }

    public function approve($id)
    {
        $model = new ProposalModel();
        $model->update($id, [
            'status' => 'Approved',
            'approved_by' => session()->get('user_id')
        ]);

        $this->logNetworkActivity("Approved proposal ID: $id");

        return redirect()->back()->with('success', 'Proposal approved.');
    }

    public function reject($id)
    {
        $model = new ProposalModel();
        $model->update($id, ['status' => 'Rejected']);

        $this->logNetworkActivity("Rejected proposal ID: $id");

        return redirect()->back()->with('error', 'Proposal rejected.');
    }

    public function view($id)
    {
        $model = new ProposalModel();
        $proposal = $model->find($id);

        if (!$proposal) {
            return $this->response->setStatusCode(404)->setBody('Proposal not found.');
        }

        $this->logNetworkActivity("Viewed SK Proposal ID: $id");

        if ($this->request->isAJAX()) {
            return view('dashboard/sk_proposal_detail', ['proposal' => $proposal]);
        }

        return redirect()->to('/proposals/sk');
    }

    public function barangayView($id)
    {
        $model = new ProposalModel();
        $proposal = $model->find($id);

        if (!$proposal) {
            return redirect()->to('/proposals/barangay')->with('error', 'Proposal not found.');
        }

        $this->logNetworkActivity("Viewed Barangay Proposal ID: $id");

        return view('dashboard/barangay_proposal_detail', ['proposal' => $proposal]);
    }

    public function getProposal($id)
    {
        $proposalModel = new ProposalModel();
        $proposal = $proposalModel->find($id);

        if (!$proposal) {
            return $this->response->setJSON(['error' => 'Proposal not found'], 404);
        }

        $this->logNetworkActivity("Fetched proposal data ID: $id");

        return $this->response->setJSON($proposal);
    }
}
