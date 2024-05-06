<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('users.index');

        $users = User::all();

        return view('backend.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('users.create');

        $roles = Role::where('id','<>',1)->get();
        $departments = Department::where('status', true)->get();

        return view('backend.user.form',compact('roles','departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('users.create');

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email'  => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|string|min:8',
            'address'   => 'required',
            'department'  => 'required',
            'designation'  => 'required',
            'employee_id'  => 'required',
            'joining_date' => 'required',
            'blood_group' => 'required',
            'avatar'    => 'required|image',
            'phone'  => 'required',
            'role' => 'required'
        ]);

        try {

            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $filename = 'IMG_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/user_images'), $filename);
            }

            User::create([
                'role_id'       => $request->role,
                'department_id' => $request->department,
                'designation'   => $request->designation,
                'address'       => $request->address,
                'employee_id'   => $request->employee_id,
                'joining_date'  => date('Y-m-d',strtotime($request->joining_date)),
                'blood_group'   => $request->blood_group,
                'name'          => $request->name,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'avatar'        => $request->hasFile('avatar') ? $filename : null,
                'password'      => Hash::make($request->password),
                'status'        => $request->filled('status'),
            ]);

            notify()->success("User create successfully.", "Success");
            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('User create Failed', 'Error');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('users.show');
        $user = User::findOrFail($id);

        return view('backend.user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        Gate::authorize('users.edit');

        $roles = Role::where('id','<>',1)->get();
        $departments = Department::where('status', true)->get();

        return view('backend.user.form',compact('roles','user','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        Gate::authorize('users.edit');

        if ($user->id == 1){
            return back();
        }

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email'  => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|confirmed|string|min:8',
            'address'   => 'required',
            'department'  => 'required',
            'designation'  => 'required',
            'employee_id'  => 'required',
            'joining_date' => 'required',
            'blood_group' => 'required',
            'avatar'   => 'nullable|image',
            'phone'  => 'required',
            'role' => 'required'
        ]);


        try {
            $user->update([
                'role_id'       => $request->role,
                'department_id' => $request->department,
                'designation'   => $request->designation,
                'address'       => $request->address,
                'employee_id'   => $request->employee_id,
                'joining_date'  => date('Y-m-d',strtotime($request->joining_date)),
                'blood_group'   => $request->blood_group,
                'name'          => $request->name,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'password'      => isset($request->password) ? Hash::make($request->password) : $user->password,
                'status'        => $request->filled('status')
            ]);

            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                @unlink(public_path('upload/user_images/'.$user->avatar));
                $filename = 'IMG_' . date('YmdHi') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/user_images'), $filename);
                $user->update([
                    'avatar'  => $filename,
                ]);
            }

            notify()->success("User update successfully.", "Success");
            return redirect()->route('users.index');

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('User Update Failed', 'Error');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Gate::authorize('users.destroy');

        @unlink(public_path('upload/user_images/'.$user->avatar));
        $user->delete();

        notify()->success("User delete successfully.", "Deleted");
        return back();
    }
}
