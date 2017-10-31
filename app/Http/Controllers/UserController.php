<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterAccountSusscess;
use Validator;
use Illuminate\Validation\Rule;

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
        $this->middleware('admin', ['except' => ['showResetForm', 'reset']]);
        $this->middleware('passwordReset', ['only' => ['showResetForm', 'reset']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(5);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|unique:users|max:255',
            'email' => 'required|string|email|unique:users|max:255'
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;

        $username = $request->username;
        $password = $this->generatePassword();

        $user->password = $this->hashPassword($password);

        if ($user->save()) {
            Mail::to($request->email)->send(new RegisterAccountSusscess($username, $password));
            return redirect('/users')->with('success', 'User has been created!');
        }
        return redirect('/users/create')->with('danger', 'Error occurred. Please try again');

    }

    protected function generatePassword()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = strlen($characters);
        $password = '';
        for ($i = 0; $i < 8; $i++) {
            $password .= $characters[rand(0, $length -1)];
        }

        return $password;
    }

    protected function hashPassword($password)
    {
        return $password = Hash::make($password);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->firstOrFail();
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
        $validator = Validator::make($request->all(), [
            'email' => Rule::unique('users')->ignore($request->id)
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::where('id', $request->id)->firstOrFail();
        $user->email = $request->email;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->gender = $request->gender;
        $user->address = $request->address;

        if ($user->save()) {
            return redirect('/users')->with('success', 'User has been updated');
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
        $user = User::where('id', $request->id)->firstOrFail();
        if ($user->is_admin) {
            return back()->with('danger', 'Can not delete admin account');
        }

        if ($user->delete()) {
            return redirect('/users')->with('success', 'User has been deleted.');
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
        $current_user = Auth::user();
        $current_user->password = Hash::make($request->password);
        $current_user->first_login = false;

        if($current_user->save()) {
            return redirect('/dashboard')->with('success', 'Your password has been updated');
        }
        return redirect('/reset/password')->with('danger', 'Error occurred. Please try again');
    }
}
