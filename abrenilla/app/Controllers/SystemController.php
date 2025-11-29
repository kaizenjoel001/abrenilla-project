<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class SystemController extends ResourceController
{
    protected $format = 'json';

    public function toggleSystemMode()
    {
        $configFile = WRITEPATH . 'system_mode.json';
        $systemMode = ['maintenance' => false];

        // Read existing mode
        if (is_file($configFile)) {
            $systemMode = json_decode(file_get_contents($configFile), true);
        }

        // Toggle
        $systemMode['maintenance'] = !$systemMode['maintenance'];

        // Save
        file_put_contents($configFile, json_encode($systemMode));

        return $this->respond([
            'success' => true,
            'maintenance' => $systemMode['maintenance']
        ]);
    }
}
