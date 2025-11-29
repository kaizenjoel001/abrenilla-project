<?php

namespace App\Controllers;

use App\Models\ResolutionModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Resolution extends BaseController
{
    public function store()
    {
        $model = new ResolutionModel();

        $file = $this->request->getFile('attachment');
        $fileName = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $fileName);
        }

        $data = [
            'resolution_no'       => $this->request->getPost('resolution_no'),
            'title'               => $this->request->getPost('title'),
            'date_passed'         => $this->request->getPost('date_passed'),
            'prepared_by'         => session()->get('full_name'),
            'resolution_content'  => $this->request->getPost('resolution_content'),
            'attachment'          => $fileName,
            'status'              => 'Pending'
        ];

        $model->insert($data);

        // ✅ Log activity
        $this->logNetworkActivity('Created a new resolution: ' . $data['title']);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Resolution submitted.']);
        }

        return redirect()->to('/resolutions')->with('success', 'Resolution submitted and marked as Pending.');
    }

    public function index()
    {
        $model = new ResolutionModel();
        $resolutions = $model->findAll();

        $resolutionCounts = [];
        foreach ($resolutions as $res) {
            $year = date('Y', strtotime($res['date_passed']));
            if (!isset($resolutionCounts[$year])) {
                $resolutionCounts[$year] = 0;
            }
            $resolutionCounts[$year]++;
        }

        return view('resolutions/view', [
            'resolutions' => $resolutions,
            'resolutionCounts' => $resolutionCounts
        ]);
    }

    public function approve($id)
    {
        $model = new ResolutionModel();
        $model->update($id, ['status' => 'Approved']);

        // ✅ Log activity
        $this->logNetworkActivity("Approved resolution ID: {$id}");

        return redirect()->to('/resolutions')->with('success', 'Resolution approved successfully.');
    }

    public function archive($id)
    {
        $model = new ResolutionModel();
        $model->update($id, ['status' => 'Archived']);

        // ✅ Log activity
        $this->logNetworkActivity("Archived resolution ID: {$id}");

        return redirect()->to('/resolutions')->with('success', 'Resolution archived successfully.');
    }

    public function printPDF($id)
    {
        $model = new ResolutionModel();
        $resolution = $model->find($id);

        if (!$resolution) {
            return redirect()->to('/resolutions')->with('error', 'Resolution not found.');
        }

        // ✅ Log activity
        $this->logNetworkActivity("Viewed/Printed resolution ID: {$id}");

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $html = view('resolutions/pdf_template', ['res' => $resolution]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Resolution_' . $resolution['resolution_no'] . '.pdf', ['Attachment' => false]);
    }

    public function downloadPDF($id)
    {
        $model = new ResolutionModel();
        $resolution = $model->find($id);

        if (!$resolution) {
            return redirect()->to('/resolutions')->with('error', 'Resolution not found.');
        }

        // ✅ Log activity
        $this->logNetworkActivity("Downloaded resolution ID: {$id}");

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $html = view('resolutions/pdf_template', ['res' => $resolution]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="Resolution_' . $resolution['resolution_no'] . '.pdf"')
            ->setBody($dompdf->output());
    }
}
