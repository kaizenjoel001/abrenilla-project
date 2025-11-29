<?php
namespace App\Controllers;

use App\Models\EventModel;

class Event extends BaseController
{
    public function store()
    {
        $eventModel = new EventModel();

        $file = $this->request->getFile('image');
        $fileName = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $fileName);
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'category'    => $this->request->getPost('category'),
            'event_date'  => $this->request->getPost('event_date'),
            'location'    => $this->request->getPost('location'),
            'image'       => $fileName,
            'created_by'  => session()->get('full_name')
        ];

        $eventModel->insert($data);

        // 🧠 Log the event creation
        $this->logNetworkActivity("Created new event: " . $data['title']);

        return redirect()->back()->with('toast_success', 'Event successfully posted!');
    }

    public function showYouthEvents()
    {
        $eventModel = new \App\Models\EventModel();
        $data['events'] = $eventModel->orderBy('event_date', 'DESC')->findAll();
        return view('youth_portal', $data);
    }

    public function register($id)
    {
        $eventModel = new \App\Models\EventModel();
        $event = $eventModel->find($id);
        return view('event_register', ['event' => $event]);
    }

    public function submitRegistration()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('event_registrations');

        $builder->insert([
            'event_id' => $this->request->getPost('event_id'),
            'name'     => $this->request->getPost('name'),
            'age'      => $this->request->getPost('age'),
            'contact'  => $this->request->getPost('contact'),
            'address'  => $this->request->getPost('address'),
            'reason'   => $this->request->getPost('reason'),
        ]);

        // 🧠 Log the registration
        $this->logNetworkActivity("New event registration for event ID #" . $this->request->getPost('event_id'));

        return redirect()->to('/youth')->with('message', 'You have successfully registered!');
    }

    public function portal()
    {
        return view('events/portal');
    }

    public function history()
    {
        $model = new \App\Models\EventModel();
        $data['events'] = $model->orderBy('event_date', 'desc')->findAll();
        return view('events/history', $data);
    }
}
