<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use App\Filters\Auth; // ✅ include your Auth filter

class Filters extends BaseConfig
{
    public array $aliases = [
        'csrf'    => CSRF::class,
        'toolbar' => DebugToolbar::class,
        'auth'    => Auth::class, // ✅ register the alias for 'auth'
         'maintenance' => \App\Filters\MaintenanceFilter::class,
    ];

    public array $globals = [
        'before' => [
            // 'csrf',
            'maintenance' => [
                'except' => [
                    '/',              // login page
                    'login',          // login POST
                    'register',       // register POST
                    'logout',         // logout
                    'api/*',          // API endpoints (optional)
                    'dashboard/admin*' // Admin dashboard and its subpages
                ],
            ],
        ],
        'after' => [
            'toolbar',
        ],
    ];

    public array $methods = [];

    public array $filters = [];
}
