<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Department;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('firstLoginOrResetPassword');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withTrashed()->get(['username', 'first_login', 'is_reset_password', 'deleted_at']);
        $usersActive = 0;
        $usersLocked = 0;
        foreach ($users as $user) {
            if ($user->deleted_at) {
                $usersLocked++;
            } else {
                $usersActive++;
            }
        }

        $departments = Department::withTrashed()->get(['name', 'deleted_at']);
        $departmentsActive = 0;
        $departmentsLocked = 0;
        foreach ($departments as $department) {
            if ($department->deleted_at) {
                $departmentsLocked++;
            } else {
                $departmentsActive++;
            }
        }
        return view('dashboard', compact('usersActive', 'usersLocked', 'departmentsActive', 'departmentsLocked'));
    }
}
