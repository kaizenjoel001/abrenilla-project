<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\SettingsModel;

class MaintenanceFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $model = new SettingsModel();
        $mode = $model->getSetting('system_mode')['value'] ?? 'online';

        $session = session();
        $isAdmin = $session->get('role') === 'admin';

        // Block everyone except admin if in maintenance
        if ($mode === 'maintenance' && !$isAdmin) {
            echo view('maintenance_message');
            exit;
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // nothing needed
    }
}
