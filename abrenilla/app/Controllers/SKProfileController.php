<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class SkProfileController extends BaseController
{
    public function index()
    {
        $session = session();
        $userId = $session->get('user_id');

        $model = new UserModel();
        $data['official'] = $model->find($userId);

        $milestoneModel = new \App\Models\MilestoneModel();
        $data['milestones'] = $milestoneModel->where('user_id', $userId)->findAll();

        // ✅ Log activity
        $this->logNetworkActivity("Accessed SK profile page");

        return view('sk/profile_view', $data);
    }

    public function updateProfile()
    {
        $userModel = new \App\Models\UserModel();
        $session = session();
        $userId = $session->get('user_id');

        $user = $userModel->find($userId);

        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
            'address'   => $this->request->getPost('address'),
        ];

        $file = $this->request->getFile('profile_picture');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/profile_pictures/', $newName);
            $data['profile_picture'] = $newName;
            $session->set('profile_picture', $newName);
        }

        $userModel->update($userId, $data);

        // ✅ Log activity
        $this->logNetworkActivity("Updated SK profile information");

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function changePassword()
    {
        $session = session();
        $userId = $session->get('user_id');
        $model = new UserModel();

        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');

        $user = $model->find($userId);

        if (!password_verify($currentPassword, $user['password'])) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        $model->update($userId, [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT)
        ]);

        // ✅ Log activity
        $this->logNetworkActivity("Changed SK account password");

        return redirect()->back()->with('success', 'Password changed successfully.');
    }
}
