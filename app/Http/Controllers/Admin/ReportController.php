<?php

namespace App\Http\Controllers\Admin;

use App\Models\Report;
use App\Models\Project;
use App\Models\ListReport;
use Illuminate\Http\Request;
use App\Models\ProjectHasReport;
use App\Http\Controllers\Controller;


class ReportController extends Controller
{
    public function show(string $uuid)
    {
        $report = Report::where('uuid', $uuid)->get()->first();
        $projectHasReport = ProjectHasReport::with(['project', 'report'])->where('report_id', $report->id)->latest()->get();
        $project = Project::all();
        return view(
            'pages.admin.reports.show',
            [
                'projectHasReport' => $projectHasReport,
                'project' => $project,
                'report' => $report
            ]
        );
    }

    public function listView($uuid)
    {
        $projectHasReport = ProjectHasReport::with('project')->where('uuid', $uuid)->get()->first();
        $listReports = ListReport::where('project_has_report_id', $projectHasReport['id'])->latest()->get();
        return view('pages.admin.reports.listReport', [
            'listReports' => $listReports,
            'projectHasReport' => $projectHasReport
        ]);
    }

    public function reportAccept($uuid){
        $report = Report::where('uuid', $uuid)->get()->first();
        $report->update([
            'status' => 'approved'
        ]);
        toast('Report has been approved!','success');
        return redirect()->route('admin.dashboard');
        
    }

    public function reportReject($uuid, Request $request){
        $report = Report::where('uuid', $uuid)->get()->first();
        $report->update([
            'status' => 'rejected',
            'note' => $request->note
        ]);
        toast('Report has been rejected!','success');
        return redirect()->route('admin.dashboard');
    }
}
