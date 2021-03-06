<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class DepartmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('firstLoginOrResetPassword');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::withTrashed()->orderBy('id', 'asc')->paginate(5);
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $department = new Department($request->all());
        if ($department->save()) {
            return redirect('/departments')->with('success', 'Department has been created!');
        }
        return redirect('/departments/create')->with('danger', 'Error occurred. Please try again');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::withTrashed()->findOrFail($id);
        $manager = '';
        $manager = $department->getManager()->first();
        $members = '';
        $members = $department->getMembers()->paginate(2);

        return view('departments.show', compact('department', 'manager', 'members'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::withTrashed()->findOrFail($id);
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $department = Department::withTrashed()->findOrFail($request->id);
        $department->name = $request->name;
        $department->description = $request->description;

        if ($department->save()) {
            return redirect('/departments')->with('success', 'Department has been updated');
        }
        return redirect()->back()->with('danger', 'Error occurred. Please try again');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $department = Department::withTrashed()->findOrFail($request->id);

        if ($department->users->first()) {
            $department->users()->detach();
        }

        if (is_null($department->deleted_at)) {
            $department->delete();
            return redirect('/departments')->with('success', 'Department has been deleted.');
        } else {
            $department->forceDelete();
            return redirect('/departments')->with('warning', 'Department has been force deleted.');
        }

        return redirect()->back()->with('danger', 'Error occurred. Please try again');
    }
}
