<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\NetworkLogModel;
use App\Models\UserModel;

abstract class BaseController extends Controller
{
    protected $request;
    protected $helpers = [];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Load helpers and session globally
        helper('url');
        session();
    }

    /**
     * ✅ Reusable method to record network activity.
     * Automatically saves both user_id and full_name.
     * Example usage: $this->logNetworkActivity("Accessed dashboard");
     */
    protected function logNetworkActivity(string $action): void
    {
        $request = service('request');
        $session = session();

        $userId = $session->get('user_id') ?? null;

        // ✅ Fetch user's full name based on ID
        $userName = 'Unknown User';
        if ($userId) {
            $userModel = new UserModel();
            $user = $userModel->find($userId);
            $userName = $user['full_name'] ?? $userName;
        }

        $ip = $request->getIPAddress();
        $mac = $this->getMacAddress($ip);

        $logModel = new NetworkLogModel();
        $logModel->insert([
            'user_id'    => $userId,
            'full_name'  => $userName,
            'ip_address' => $ip,
            'mac_address'=> $mac,
            'action'     => $action,
        ]);
    }

    /**
     * 🔍 Helper to get MAC Address (LAN or localhost)
     */
    private function getMacAddress(string $ip): string
{
    if ($ip === '127.0.0.1' || $ip === '::1') return 'LOCALHOST';
    $mac = 'UNKNOWN';
    $os = strtoupper(substr(PHP_OS, 0, 3));

    if (preg_match('/^(192\.168|10\.|172\.(1[6-9]|2[0-9]|3[0-1]))\./', $ip)) {
        if ($os !== 'WIN') {
            @exec("ping -c 1 $ip", $pingOutput);
            $arpOutput = [];
            @exec("arp -n $ip", $arpOutput);
            foreach ($arpOutput as $line) {
                if (preg_match('/([0-9a-f]{2}[:-]){5}[0-9a-f]{2}/i', $line, $matches)) {
                    $mac = strtoupper(str_replace('-', ':', $matches[0]));
                    break;
                }
            }
        } else {
            @exec("ping -n 1 $ip", $pingOutput);
            $arpOutput = [];
            @exec("arp -a $ip", $arpOutput);
            foreach ($arpOutput as $line) {
                if (preg_match('/([0-9A-F]{2}[:-]){5}[0-9A-F]{2}/i', $line, $matches)) {
                    $mac = strtoupper(str_replace('-', ':', $matches[0]));
                    break;
                }
            }
        }
    }
    return $mac;
}

    /**
     * ⚙️ Log activity when toggling system mode
     */
    protected function logSystemModeToggle(string $newMode): void
    {
        $action = "Toggled system mode to " . strtoupper($newMode);
        $this->logNetworkActivity($action);
    }
}
