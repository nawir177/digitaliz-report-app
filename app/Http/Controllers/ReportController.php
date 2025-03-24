<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\ProjectHasReport;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $totalProject = ProjectHasReport::whereHas('report', function($query) use ($user_id){
            $query->where('user_id', $user_id);
        })->get()->count();
        return view('pages.reports.index',[
            'reports'=>Report::where('user_id',$user_id)->latest()->paginate(6),
            'totalReport' => Report::where('user_id', auth()->user()->id)->count(),
            'totalProject' => $totalProject,
            'reportApprove' => Report::where('status','approve')->where('user_id', auth()->user()->id)->count(),
            'reportNotApprove' => Report::where('status','!=','approve')->where('user_id', auth()->user()->id)->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     
        $user_id = auth()->user()->id;
        $request->validate([
            'start_date'=>'required|date',
            'end_date'=>'required|date'
        ]);
        $report = Report::create([
            'user_id'=>$user_id,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date
        ]);
        toast('Add your report successfully!', 'success');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $report = Report::where('uuid', $uuid)->get()->first();
        $projectHasReport = ProjectHasReport::with(['project','report'])->where('report_id',$report->id)->latest()->get();
        $project = Project::all();
        return view('pages.reports.show',[
            'projectHasReport'=>$projectHasReport,
            'project'=>$project,
            'report'=>$report,
        ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        return view('pages.reports.edit',[
            'report'=>Report::where('uuid',$uuid)->get()->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {

        $request->validate([
            'start_date'=>'required|date',
            'end_date'=>'required|date'
        ]);
        $report = Report::where('uuid',$uuid)->get()->first();
        $report->update($request->all());
        toast('Report has been updated successfully', 'success');
        return redirect()->route('report.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $report = Report::where('uuid',$uuid)->get()->first();
        $projectHasReport = ProjectHasReport::where('report_id',$report->id)->get();

        foreach($projectHasReport as $project){
            $listReport = $project->listReport;
            if($listReport){
                foreach ($listReport as $list) {
                    $list->clearMediaCollection('images');
                }
            }
        }

        $report->delete();
        toast('Report has been deleted successfully', 'success');
        return redirect()->route('report.index');
    }
}
