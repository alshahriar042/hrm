<?php

namespace App\Http\Controllers\Backend;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('departments.index');

        $departments = Department::all();
        return view('backend.department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('departments.create');
        return view('backend.department.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('departments.create');

        $this->validate($request,[
            'name'  => 'required|string|max:255|unique:departments',
        ]);

        try {
            Department::create([
                'name'   => $request->name,
                'status' => $request->filled('status'),
            ]);

            notify()->success("Department Created successfully.", "Success");
            return redirect()->route('departments.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Department Create Failed', 'Error');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        Gate::authorize('departments.edit');
        return view('backend.department.form', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        Gate::authorize('departments.edit');

        $this->validate($request,[
            'name'  => 'required|string|max:255|unique:departments,name,'.$department->id,
        ]);

        try {
            $department->update([
                'name'   => $request->name,
                'status' => $request->filled('status'),
            ]);

            notify()->success("Department Updated successfully.", "Success");
            return redirect()->route('departments.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Department Update Failed', 'Error');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
