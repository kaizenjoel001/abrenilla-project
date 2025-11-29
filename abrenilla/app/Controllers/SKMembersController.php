<?php
namespace App\Controllers;

use App\Models\SKMemberModel;
use CodeIgniter\Controller;

class SKMembersController extends BaseController
{
    public function index()
    {
        $model = new SKMemberModel();
        $data['members'] = $model->findAll();

        $this->logNetworkActivity("Viewed SK members list");

        return view('skmembers/index', $data);
    }

    public function create()
    {
        $this->logNetworkActivity("Opened SK member creation form");
        return view('skmembers/create');
    }

    public function store()
    {
        $model = new SKMemberModel();
        $file = $this->request->getFile('photo');
        $newName = $file->getRandomName();
        $file->move('uploads/', $newName);

        $model->save([
            'full_name' => $this->request->getPost('full_name'),
            'age' => $this->request->getPost('age'),
            'gender' => $this->request->getPost('gender'),
            'position' => $this->request->getPost('position'),
            'term_start' => $this->request->getPost('term_start'),
            'term_end' => $this->request->getPost('term_end'),
            'status' => $this->request->getPost('status'),
            'photo' => $newName,
            'bio' => $this->request->getPost('bio'),
            'achievements' => $this->request->getPost('achievements'),
            'projects' => $this->request->getPost('projects'),
            'contact_info' => $this->request->getPost('contact_info'),
        ]);

        // ✅ Log activity
        $this->logNetworkActivity("Added new SK member: " . $this->request->getPost('full_name'));

        return redirect()->to('/skmembers');
    }

    public function edit($id)
    {
        $model = new SKMemberModel();
        $data['member'] = $model->find($id);

        $this->logNetworkActivity("Editing SK member with ID: {$id}");

        return view('skmembers/edit', $data);
    }

    public function update($id)
    {
        $model = new SKMemberModel();

        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'age' => $this->request->getPost('age'),
            'gender' => $this->request->getPost('gender'),
            'position' => $this->request->getPost('position'),
            'term_start' => $this->request->getPost('term_start'),
            'term_end' => $this->request->getPost('term_end'),
            'status' => $this->request->getPost('status'),
            'bio' => $this->request->getPost('bio'),
            'achievements' => $this->request->getPost('achievements'),
            'projects' => $this->request->getPost('projects'),
            'contact_info' => $this->request->getPost('contact_info'),
        ];

        if ($this->request->getFile('photo')->isValid()) {
            $file = $this->request->getFile('photo');
            $newName = $file->getRandomName();
            $file->move('uploads/', $newName);
            $data['photo'] = $newName;
        }

        $model->update($id, $data);

        // ✅ Log activity
        $this->logNetworkActivity("Updated SK member with ID: {$id}");

        return redirect()->to('/skmembers');
    }

    public function delete($id)
    {
        $model = new SKMemberModel();
        $model->delete($id);

        // ✅ Log activity
        $this->logNetworkActivity("Deleted SK member with ID: {$id}");

        return redirect()->to('/skmembers');
    }

    public function view()
    {
        $model = new SKMemberModel();
        $data['members'] = $model->findAll();

        $this->logNetworkActivity("Viewed SK members public page");

        return view('skmembers/view', $data);
    }

    public function search()
    {
        $model = new SKMemberModel();
        $keyword = $this->request->getGet('keyword');
        $data['members'] = $model->like('full_name', $keyword)->findAll();

        $this->logNetworkActivity("Searched SK members with keyword: {$keyword}");

        return view('skmembers/index', $data);
    }

    public function viewProfile($id)
    {
        $model = new SKMemberModel();
        $member = $model->find($id);

        if (!$member) {
            return '<div class="text-danger">Member not found.</div>';
        }

        // ✅ Log activity
        $this->logNetworkActivity("Viewed SK member profile with ID: {$id}");

        return view('skmembers/profile_modal', ['member' => $member]);
    }
}
