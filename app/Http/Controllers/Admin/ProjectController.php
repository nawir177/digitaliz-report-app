<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.project.index',[
            'projects' => Project::all()
        ]);    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required'
        ]);

        try {
            Project::create($validate);
            toast('Project created successfully','success');
            return redirect()->route('admin.project.index');
        } catch (\Exception $e) {
            toast('Failed to create project','error');
            return redirect()->route('admin.project.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $proeject = Project::find($id);
        return view('pages.admin.project.edit',[
            'project' => $proeject
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required'
        ]);

        try {
            Project::find($id)->update($validate);
            toast('Project updated successfully','success');
            return redirect()->route('admin.project.index');
        } catch (\Exception $e) {
            toast('Failed to update project','error');
            return redirect()->route('admin.project.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Project::find($id)->delete();
            toast('Project deleted successfully','success');
            return redirect()->route('admin.project.index');
        } catch (\Exception $e) {
            toast('Failed to delete project','error');
            return redirect()->route('admin.project.index');
        }
    }
}
