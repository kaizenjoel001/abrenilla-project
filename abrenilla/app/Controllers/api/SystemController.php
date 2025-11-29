<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\SettingsModel;

class SystemController extends BaseController
{
    public function getMode()
    {
        $model = new SettingsModel();
        $setting = $model->getSetting('system_mode');

        return $this->response->setJSON([
            'mode' => $setting['value'] ?? 'online'
        ]);
    }

    public function toggleMode()
    {
        $model = new SettingsModel();
        $setting = $model->getSetting('system_mode');

        $newMode = ($setting['value'] ?? 'online') === 'online' ? 'maintenance' : 'online';
        $model->updateSetting('system_mode', $newMode);

        // Log action
        $this->logNetworkActivity("Toggled system mode to: {$newMode}");

        return $this->response->setJSON([
            'success' => true,
            'newMode' => $newMode
        ]);
    }
}
