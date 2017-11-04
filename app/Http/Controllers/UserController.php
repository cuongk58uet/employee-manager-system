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
use App\Department;

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
        $user = User::findOrFail($id);
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
    public function edit($id)
    {
        $user = User::findOrFail($id);

        if ($user->isMemberOfDepartment->first()) {
            $departmentId = $user->isMemberOfDepartment->first()->id;
        } else {
            $departmentId = '';
        }

        if ($user->isManagerOfDepartment->first()) {
            $managerDepartmentId = $user->isManagerOfDepartment->first()->id;
        } else {
            $managerDepartmentId = '';
        }

        $departments = Department::all();

        return view('users.edit', compact('user', 'departments', 'departmentId', 'managerDepartmentId'));
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
            'email' => Rule::unique('users')->ignore($request->id),
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'gender' => 'required|string',
            'member' => 'required|integer',
            'manager' =>'required|integer',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($request->id);

        $this->updateMemberField($request, $user);
        $this->updateManagerField($request, $user);

        $user->email = $request->email;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->gender = $request->gender;
        $user->address = $request->address;

        if ($user->save()) {
            return redirect('/users')->with('success', 'User has been updated');
        }
        return back()->with('danger', 'Error occurred. Please try again');
    }

    public function updateMemberField(Request $request,User $user)
    {
        // Validate department->id on select value, if department existing => update row on intermediate table, otherwise exit function
        $department = Department::find($request->member);

        // Case 0: Input wrong
        if (is_null($department) && $request->member != 0) {
            return 'Done';
        }

        // Case 1: Input: None and Output: None
        if (is_null($user->isMemberOfDepartment()->first()) && $request->member == 0) {
            return 'Done';
        }

        if ($user->isMemberOfDepartment->first() && $request->member == 0) {
            $user->isMemberOfDepartment()->detach();
            return 'Done';
        }

        // Case 2: User is member of a department
        if ($department) {
            if ($user->isMemberOfDepartment->first()) {
                $user->isMemberOfDepartment()->detach();
                $user->isMemberOfDepartment()->attach($request->member);
            } else {
                $user->isMemberOfDepartment()->attach($request->member);
            }
        }
    }

    public function updateManagerField(Request $request, User $user)
    {
        // Validate department->id on select value, if department existing => update row on intermediate table, otherwise exit function
        $department = Department::find($request->manager);

        // Case 0: Input value wrong
        if (is_null($department) && $request->manager != 0) {
            return 'Done';
        }
        // Case 1: Old managerField == None & new managerField == None
        if (is_null($user->isManagerOfDepartment->first()) && $request->manager == 0) {
            return 'Done';
        }
        // Case 2: User isn't a manager
        if(is_null($user->isManagerOfDepartment->first())) {
            if (is_null($department->getManager->first())) {
                $department->users()->attach($user->id, ['is_manager'=>true]);
                return 'Done';
            } else {
                $department->getManager()->detach();
                $department->users()->attach($user->id, ['is_manager'=>true]);
                return 'Done';
            }
        }
        // Case 3: User is a manager
        if (!is_null($user->isManagerOfDepartment->first())) {
            // Validated id of department
            if ($request->manager == 0) {
                $user->isManagerOfDepartment()->detach();
            } elseif ($user->isManagerOfDepartment->first()->id!=$request->manager) {
                if (is_null($department->getManager->first())) {
                    $user->isManagerOfDepartment()->detach();
                    $department->users()->attach($user->id, ['is_manager'=>true]);
                } else {
                    $department->getManager()->detach();
                    $user->isManagerOfDepartment()->detach();
                    $department->users()->attach($user->id, ['is_manager'=>true]);
                }
            } else {
                return 'Done';
            }
        }
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
        $validatedData = $request->validate([
            'password' => 'required|string|confirmed|min:6|max:255',
        ]);
        $current_user = Auth::user();
        $current_user->password = Hash::make($request->password);
        $current_user->first_login = false;

        if($current_user->save()) {
            return redirect('/dashboard')->with('success', 'Your password has been updated');
        }
        return redirect('/reset/password')->with('danger', 'Error occurred. Please try again');
    }
}
