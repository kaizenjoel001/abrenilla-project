<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('home');
    }

    public function register()
    {
        $users = new UserModel();
        $email = $this->request->getPost('email');

        // Check if email already exists
        if ($users->where('email', $email)->first()) {
            return redirect()->back()->withInput()->with('toast_error', 'Email already registered.');
        }

        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $email,
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'      => $this->request->getPost('role'),
            'phone'     => $this->request->getPost('phone'),
            'address'   => $this->request->getPost('address'),
            'age'       => $this->request->getPost('age'),
        ];

        $users->save($data);

        // ✅ Log registration (no session yet, so user_id will be null)
        $this->logNetworkActivity("Registered new user: {$email}");

        return redirect()->to('/')->with('toast_success', 'Registration successful!');
    }

    public function login()
    {
        $session = session();
        $users = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $users->where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // ✅ Set session data
                $session->set([
                    'user_id'         => $user['user_id'],
                    'role'            => $user['role'],
                    'logged_in'       => true,
                    'full_name'       => $user['full_name'],
                    'profile_picture' => $user['profile_picture'] ?? null,
                ]);

                // ✅ Log successful login
                $this->logNetworkActivity("User logged in ({$user['role']})");

                // ✅ Redirect by role
                switch ($user['role']) {
                    case 'sk_official':
                        return redirect()->to('/dashboard/sk');
                    case 'barangay_official':
                        return redirect()->to('/dashboard/barangay');
                    case 'admin':
                        return redirect()->to('/dashboard/admin');
                    default:
                        return redirect()->to('/')->with('toast_error', 'Unknown user role.');
                }
            } else {
                return redirect()->back()->withInput()->with('toast_error', 'Invalid credentials.');
            }
        } else {
            return redirect()->back()->withInput()->with('toast_error', 'Email not found.');
        }
    }

    public function logout()
    {
        // ✅ Log logout before destroying session
        $this->logNetworkActivity("User logged out");

        session()->destroy();
        return redirect()->to('/');
    }
}
