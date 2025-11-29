<?php


namespace App\Controllers;
use App\Models\MilestoneModel;

class MilestoneController extends BaseController
{
    
public function upload()
{
    $model = new MilestoneModel();
    $title = $this->request->getPost('title');
    $description = $this->request->getPost('description');
    $category = $this->request->getPost('category'); // <-- Make sure this is here!
    $file = $this->request->getFile('attachment');
    $filename = '';

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $filename = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads/milestones', $filename);
    }

    $model->save([
        'title' => $title,
        'description' => $description,
        'category' => $category, // <-- Make sure this is here!
        'attachment' => $filename,
        'user_id' => session()->get('user_id')
    ]);

    return redirect()->to(base_url('dashboard/sk'))->with('toast_success', 'Milestone uploaded!');
}
    
public function sk()
{
    $milestoneModel = new \App\Models\MilestoneModel();
    $milestones = $milestoneModel->findAll();

    return view('dashboard/sk', [
        'milestones' => $milestones,
        // ...other data
    ]);
}
}