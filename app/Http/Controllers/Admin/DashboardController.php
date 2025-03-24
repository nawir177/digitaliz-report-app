<?php

namespace App\Http\Controllers\Admin;

use App\Models\Report;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $reports = Report::with('user')->latest()->paginate(5);
        return view('pages.admin.dashboard',[
            'reports' => $reports,
            'totalReport'=> Report::count(),
            'totalProject'=> Project::count(),
            'totalUser'=> User::count(),
            'reportPending'=> Report::where('status', 'pending')->count(),
        ]);
    }
}
