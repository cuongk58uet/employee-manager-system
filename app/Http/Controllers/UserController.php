<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Department;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Excel;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('protectResetPassword', ['only' => ['showResetForm', 'reset']]);
        // $this->middleware('firstLoginOrResetPassword');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();

        $memberOf = '';
        $managerOf = '';

        foreach ($user->isMemberOfDepartment as $department) {
            $memberOf = $department->name;
        }
        foreach ($user->isManagerOfDepartment as $department) {
            $managerOf = $department->name;
        }

        return view('users.show', compact('user', 'memberOf', 'managerOf'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
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
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'email' => Rule::unique('users')->ignore($user->id),
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'gender' => 'required|string',
            'birthday' => 'required|date',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->email = $request->email;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->birthday = $request->birthday;

        if ($user->save()) {
            return redirect('/dashboard')->with('success', 'Profile has been updated');
        }

        return back()->with('danger', 'Error occurred. Please try again');
    }

    /**
     * Show the reset form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showResetForm()
    {
        $current_user = Auth::user();
        return view('users.reset', compact('current_user', $current_user));
    }

    public function reset(Request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required|string|confirmed|min:6|max:255',
        ]);
        $current_user = Auth::user();
        $current_user->password = Hash::make($request->password);
        $current_user->first_login = false;
        if ($current_user->is_reset_password) {
            $current_user->is_reset_password = false;
        }

        if($current_user->save()) {
            return redirect('/dashboard')->with('success', 'Your password has been updated');
        }
        return back()->with('danger', 'Error occurred. Please try again');
    }

    public function myDepartment()
    {
        $user = Auth::user();
        $managerOf = '';
        $members = '';
        $memberOf = '';

        if ($user->isManagerOfDepartment->first()) {
            $managerOf = $user->isManagerOfDepartment->first();

            $members = $managerOf->getMembers()->paginate(10);

        }

        if ($user->isMemberOfDepartment->first()) {
            $memberOf = $user->isMemberOfDepartment->first();
        }

        return view('users.department', compact('managerOf', 'members', 'memberOf'));
    }

    public function showMemberProfile($id)
    {
        $user = User::findOrFail($id);

        return view('users.member_profile', compact('user'));
    }

    public function exportToCSV()
    {
        Excel::create('Members List', function($excel) {
            $excel->sheet('Sheet 1', function ($sheet) {
                $user = Auth::user();

                $department = $user->isManagerOfDepartment->first();
                $members = $department->getMembers;
                $sheet->fromModel($members, null, 'A1', true);
            });
        })->download('xlsx');
    }

}
