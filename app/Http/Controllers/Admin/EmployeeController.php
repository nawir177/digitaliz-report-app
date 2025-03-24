<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class EmployeeController extends Controller
{
    public function index()
    {
        // user data not role admin in spatie
        return view('pages.admin.employee.index',[
            'employees' => User::where('id','!=',Auth::user()->id)->get(),
            'divisions' => \App\Models\Division::all()
        ]);
    }

// store
    public function store(Request $request)
    {

        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role' => 'required',
                'division_id' => 'required|exists:App\Models\Division,id'
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->division_id = $request->division_id;
            $user->assignRole($request->role);
            $user->save();
            toast('User created successfully', 'success');
            return redirect()->route('admin.employee.index');
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
          
            foreach ($errors as $error) {
                toast($error, 'error');
            }
            return back()->withInput();
        }
      
    }

    public function edit($id){
        $employee = User::find($id);
        return view('pages.admin.employee.edit',[
            'user'=>$employee,
            'divisions'=>Division::get()
        ]);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'division_id' => 'required|exists:App\Models\Division,id'
        ]);
        try {

            if ($request->filled('password')) {
                $validate['password'] = bcrypt($request->password);
            }

            $user = User::findOrFail($id);

            // Update user
            $user->update($validate);

            // Tampilkan notifikasi sukses
            toast('User updated successfully', 'success');
            return redirect()->route('admin.employee.index');
        } catch (\Exception $e) {
            // Catat error di log agar bisa ditelusuri
            log::error("User Update Error: " . $e->getMessage());

            // Tampilkan pesan error umum
            toast('Failed to update user. Please try again.', 'error');
            return back();
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        toast('User deleted successfully', 'success');
        return redirect()->route('admin.employee.index')->with('success','Employee deleted successfully');
    }
}
