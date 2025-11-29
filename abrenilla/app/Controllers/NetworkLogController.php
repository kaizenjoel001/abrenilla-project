<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\NetworkLogModel;
use App\Models\UserModel;

class NetworkLogController extends Controller
{
    public function __construct()
    {
        helper('NetworkHelper'); // Load our MAC/IP helper
    }

    /**
     * Display logs page
     */
    public function index()
    {
        $db = \Config\Database::connect();

        $logs = $db->table('network_logs')
            ->select('*')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();

        return view('admin/network_logs', ['logs' => $logs]);
    }

    /**
     * Record a network action with IP and MAC
     */
    public function record(string $action)
    {
        $session = session();
        $userId = $session->get('user_id') ?? null;

        $userModel = new UserModel();
        $user = $userModel->find($userId);
        $userName = $user['full_name'] ?? 'Unknown User';

        $network = getUserNetworkInfo(); // Use helper
        $ip  = $network['ip'];
        $mac = $network['mac'];

        $logModel = new NetworkLogModel();
        $logModel->insert([
            'user_id'     => $userId,
            'full_name'   => $userName,
            'ip_address'  => $ip,
            'mac_address' => $mac,
            'action'      => $action,
        ]);
    }
    

    /**
     * Clear all network logs
     */
    public function clear()
    {
        $model = new NetworkLogModel();
        $model->truncate();

        session()->setFlashdata('success', 'All logs cleared successfully.');
        return redirect()->to(site_url('network-logs'));
    }

    /**
     * Fetch logs as JSON (for live frontend updates)
     */
    public function fetch()
    {
        $model = new NetworkLogModel();
        $logs = $model->orderBy('created_at', 'DESC')->findAll();

        return $this->response->setJSON($logs);
    }
}
