<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $this->middleware('passwordReset');
    }

    /**
     * Show the reset form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showResetForm()
    {
        $current_user = Auth::user();
        return view('user.reset', compact('current_user', $current_user));
    }

    public function reset(Request $request)
    {
        $current_user = Auth::user();
        $current_user->password = Hash::make($request->password);
        $current_user->first_login = false;

        if($current_user->save()) {
            return redirect('/dashboard')->with('success', 'Your password has been updated');
        }
        return redirect('/reset/password')->with('danger', 'Error occurred. Please try again');
    }
}
