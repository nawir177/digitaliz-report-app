<?php

namespace App\Http\Controllers\Admin;

use App\Models\Division;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DivisionController extends Controller
{
    public function index()
    {
        return view('pages.admin.division.index',[
            'divisions' => Division::all()
        ]);
    }



    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:100',
        ]);

        $validate['slug'] = Str::slug($request->slug);
        Division::create($validate);
        toast('Division created successfully', 'success');
        return redirect()->back();
    }

    public function edit($id)
    {
        return view('pages.admin.division.edit',[
            'division' => Division::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required |max:100',
        ]);

        try {
            $validate['slug'] = Str::slug($request->slug);
            Division::find($id)->update($validate);
            toast('Division updated successfully', 'success');
            return redirect()->route('admin.division.index');
        } catch (\Throwable $th) {
            toast($th, 'error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            Division::find($id)->delete();
            toast('Division deleted successfully', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast($th, 'error');
            return redirect()->back();
        }
    }
}
