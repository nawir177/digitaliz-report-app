<?php

namespace App\Http\Controllers;

use App\Models\ListReport;
use Illuminate\Http\Request;
use App\Models\ProjectHasReport;
class ListReportController extends Controller
{
    public function listView($uuid)
    {
        $projectHasReport = ProjectHasReport::with('project')->where('uuid', $uuid)->get()->first();
        $listReports = ListReport::where('project_has_report_id', $projectHasReport['id'])->latest()->get();
        return view('pages.listReport.index', [
            'listReports' => $listReports,
            'projectHasReport' => $projectHasReport
        ]);
    }

    public function storeList(Request $request)
    {

        $request->validate([
            'content' => 'required|string|max:100',
            'projectHasReportId' => 'required',
            'image' => 'nullable|file|image|max:2048',
        ]);

        $listReport = ListReport::create([
            'content' => $request->content,
            'project_has_report_id' => $request->projectHasReportId
        ]);

        if ($request->hasFile('image')) {
            $listReport
                ->addMediaFromRequest('image')->toMediaCollection('images');
        }

        toast('list report added successfully', 'success');
        return back();
    }

    public function updateList(Request $request, $uuid)
    {

        $listReport = ListReport::with('projectHasReport')->where('uuid', $uuid)->first();
        $listReport->update([
            'content' => $request->content,
        ]);

        if ($request->hasFile('image')) {
            $listReport->clearMediaCollection('images');
            $listReport
                ->addMediaFromRequest('image')->toMediaCollection('images');
        }

        toast('list report updated successfully', 'success');
        return redirect()->route('projectHasReport.list', $listReport->projectHasReport->uuid);
    }

    public function editList($uuid)
    {
        $list = ListReport::where('uuid', $uuid)->first();
        if ($list) {
            return view('pages.listReport.edit', [
                'list' => $list,
            ]);
        } else {
            toast('Noting selected data', 'error');
            return redirect()->back();
        }
    }

    public function deleteList($uuid)
    {
        $list = ListReport::where('uuid', $uuid)->first();
        if ($list) {
            $list->clearMediaCollection('images');
            $list->delete();
            toast('Delete List Successfully', 'success');
        } else {
            toast('Delete failed', 'error');
        }
        return back();
    }



    
}
