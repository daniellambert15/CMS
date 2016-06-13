<?php

namespace App\Http\Controllers;

use Auth;
use Gate;
use App\Models\Role;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Http\Request;

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
    }

    public Function userList()
    {
        if (Gate::denies('viewUsers')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        return view('admin.lists.user', ['users' => User::all()]);
    }

    public function newUser()
    {
        if (Gate::denies('addUser')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        return view('admin.create.user');
    }

    public function saveUser(Request $request)
    {
        if (Gate::denies('addUser')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        $this->validate($request, [
            'email' => 'required|unique:users',
            'firstName' => 'required',
            'surname' => 'required',
            'password' => 'required',
            'fullName' => 'required',
        ]);


        $user = new user;
        $user->password = bcrypt($request->input('password'));
        $user->firstName = $request->input('firstName');
        $user->surname = $request->input('surname');
        $user->fullName = $request->input('fullName');
        $user->email = $request->input('email');

        $user->save();

        return redirect()->route('dashboard.user.list')->with('success', 'User Created!');
    }

    public function destroy(Request $request, User $user)
    {
        if (Gate::denies('removeUser')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        if(Auth::user()->id === $user->id)
        {
            return redirect()->route('dashboard.user.list')->with('error', 'You cannot delete yourself!');
        }

        $user->delete();
        
        return redirect()->route('dashboard.user.list')->with('success', 'User Removed!');
    }

    public function edit($id)
    {
        if (Gate::denies('editUser')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        return view('admin.edit.user', ['user' => User::findOrFail($id)]);
    }

    public function saveUpdateUser(Request $request)
    {
        if (Gate::denies('editUser')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        

        $user = User::findOrFail($request->input('id'));

        $user->firstName = $request->input('firstName');
        $user->surname = $request->input('surname');
        $user->fullName = $request->input('fullName');
        $user->email = $request->input('email');

        if($request->input('password') != "")
        {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return redirect()->route('dashboard.user.list')->with('success', 'User Updated!');
    }

    public function roleUser($id)
    {
        if (Gate::denies('giveRole')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        return view('admin.lists.roleUser', ['roles' => Role::all(), 'user' => User::findOrFail($id)]);
    }

    public function attachRole($id)
    {
        if (Gate::denies('attachRole')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        Auth::user()->roles()->attach($id);
        return redirect()->route('dashboard.role.user', ['id' => Auth::user()->id] )->with('success', 'Role Attached');
    }

    public function detachRole($id)
    {
        if (Gate::denies('detachRole')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        Auth::user()->roles()->detach($id);
        return redirect()->route('dashboard.role.user', ['id' => Auth::user()->id] )->with('success', 'Role Detached');
    }
}
