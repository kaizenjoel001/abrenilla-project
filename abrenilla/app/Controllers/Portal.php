<?php
namespace App\Controllers;

use App\Models\EventModel;

class Portal extends BaseController
{
    public function youth()
    {
        $model = new EventModel();
        $data['events'] = $model->orderBy('event_date', 'asc')->findAll();

        // ✅ Log activity
        $this->logNetworkActivity("Accessed Youth Portal page");

        return view('public/youth_portal', $data);
    }
}
