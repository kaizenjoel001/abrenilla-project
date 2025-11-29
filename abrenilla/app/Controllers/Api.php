// app/Controllers/Api.php
<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Api extends Controller
{
    public function users()
    {
        $userModel = new UserModel();
        $users = $userModel->select('user_id, full_name, email, role, phone')->findAll(); // Only selected fields for display
        return $this->response->setJSON($users);
    }

}

