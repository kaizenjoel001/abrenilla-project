<?php

namespace App\Controllers;

use App\Models\EventModel;

class Youth extends BaseController
{
    /**
     * Display youth events
     */
    public function index()
    {
        $model = new EventModel();
        $data['events'] = $model->orderBy('event_date', 'asc')->findAll();

        // 🧠 Log view access
        $this->logNetworkActivity("Accessed Youth Portal page");

        return view('public/youth_portal', $data);
    }
}
