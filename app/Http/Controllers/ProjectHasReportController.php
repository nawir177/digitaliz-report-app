<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Project;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ProjectHasReport;

class ProjectHasReportController extends Controller
{
   

    public function store(Request $request)
    {
        // Validasi input
        $validate = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'report_id' => 'required|exists:reports,id',
        ]);

        // Cek apakah kombinasi project_id dan report_id sudah ada
        $exists = ProjectHasReport::where('project_id', $validate['project_id'])
            ->where('report_id', $validate['report_id'])
            ->exists();

        if ($exists) {
            toast('This project already has the selected report', 'error');
            return back();
        }

        ProjectHasReport::create($validate);

        // Tampilkan pesan sukses
        toast('Project report has been added successfully', 'success');
        return back();
    }

    public function generatePDF($uuid)
    {
        $report = Report::with('user')->where('uuid', $uuid)->get()->first();
        $projectHasReport = ProjectHasReport::with('listReport')->where('report_id', $report->id)->get();
        $data = [
            'title' => 'Example PDF',
            'content' => 'This is an example content for the PDF.',
            'report' => $report,
            'projectHasReport' => $projectHasReport
        ];

        // Render view ke PDF
        $pdf = Pdf::loadView('pdf.example', $data);

        // rename file
        $fileName = 'laporan_' . $report->user->name . '_from_' . $report->start_date . '_to_' . $report->end_date;
        
        return $pdf->stream($fileName . '.pdf');
    }



    public function downloadPDF($uuid)
    {
        $report = Report::with('user')->where('uuid', $uuid)->get()->first();
        $projectHasReport = ProjectHasReport::with('listReport')->where('report_id', $report->id)->get();
        $data = [
            'title' => 'Example PDF',
            'content' => 'This is an example content for the PDF.',
            'report' => $report,
            'projectHasReport' => $projectHasReport
        ];

        // Render view ke PDF
        $pdf = Pdf::loadView('pdf.example', $data);

        // rename file
        $fileName= 'laporan_'.$report->user->name.'_from_'.$report->start_date.'_to_'.$report->end_date;
        $pdf->save($fileName.'.pdf');

        // Download file PDF
        return $pdf->download($fileName.'.pdf');
    }

    

    public function edit($uuid){
        return view('pages.projectHasReport.edit',[
            'projectHasReport'=>ProjectHasReport::where('uuid',$uuid)->get()->first(),
            'project'=>Project::all()
        ]);
    }


    

    public function update(Request $request,$uuid){
      
        $validate = $request->validate([
            'project_id' => 'required|exists:projects,id',
        ]);

        $projectHasReport = ProjectHasReport::where('uuid',$uuid)->get()->first();
        $projectHasReport->update($validate);

        toast('Project report has been updated successfully', 'success');
        return redirect()->route('report.show',$projectHasReport->report->uuid);
    }


    public function destroy($uuid){

        $projectHasReport = ProjectHasReport::where('uuid',$uuid)->get()->first();
        $listReport = $projectHasReport->listReport;
        foreach($listReport as $list){
            $list->clearMediaCollection('images');
        }
        $projectHasReport->delete();

        toast('Project report has been deleted successfully', 'success');
        return back();
    }


    
}
