<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function createUser()
    {
        $json = $this->request->getJSON(true);
        $model = new UserModel();

        if (empty($json['full_name']) || empty($json['email']) || empty($json['password'])) {
            return $this->response->setJSON([
                'success' => false,
                'error' => 'Missing required fields.'
            ]);
        }

        $data = [
            'full_name' => $json['full_name'],
            'email' => $json['email'],
            'password' => password_hash($json['password'], PASSWORD_DEFAULT),
            'role' => $json['role'] ?? 'SK Official',
            'phone' => $json['phone'] ?? '',
            'address' => $json['address'] ?? '',
            'age' => $json['age'] ?? 0,
            'profile_picture' => $json['profile_picture'] ?? '',
        ];

        if ($model->insert($data)) {
            // ✅ Log activity
            $this->logNetworkActivity("Created new user: {$data['full_name']}");
            return $this->response->setJSON(['success' => true]);
        }

        return $this->response->setJSON([
            'success' => false,
            'errors' => $model->errors()
        ]);
    }

    public function deleteUser($id)
    {
        $userModel = new \App\Models\UserModel();

        if ($userModel->delete($id)) {
            // ✅ Log activity
            $this->logNetworkActivity("Deleted user with ID: {$id}");
            return $this->response->setJSON(['success' => true, 'message' => 'User deleted successfully.']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete user.'], 500);
    }
}
