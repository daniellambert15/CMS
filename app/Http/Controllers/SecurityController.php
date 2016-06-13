<?php

namespace App\Http\Controllers;

use Auth;
use Gate;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests;
use Illuminate\Http\Request;

class SecurityController extends Controller
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

    // Roles

    public function roleList()
    {
        if (Gate::denies('viewRoles')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        return view('admin.lists.roles', ['roles' => Role::all()]);
    }

    public function addRole()
    {
        if (Gate::denies('addRole')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        return view('admin.create.role');
    }

    public function saveRole(Request $request)
    {
        if (Gate::denies('addRole')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        $this->validate($request, [
            'name' => 'required',
            'label' => 'required'
        ]); 

        Role::create($request->input());
        Return redirect()->route('dashboard.roles')->with('success', 'Role "'.$request->input('name').'" has been added');
    }

    public function editRole($id)
    {
        if (Gate::denies('editRole')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        return view('admin.edit.role', ['role' => Role::findorFail($id)]);
    }

    public function saveEditRole(Request $request)
    {
        if (Gate::denies('editRole')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        $this->validate($request, [
            'name' => 'required',
            'label' => 'required'
        ]); 

        Role::findorFail($request->input('id'))->update($request->input());
        return redirect()->route('dashboard.roles')->with('success', 'Role Updated!');
    }

    public function deleteRole($id)
    {
        if (Gate::denies('deleteRole')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        Role::findorFail($id)->delete();
        return redirect()->route('dashboard.roles')->with('success', 'Role Deleted!');
    }

    // Permissions

    public function permissionList()
    {
        if (Gate::denies('viewPermissions')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        return view('admin.lists.permissions', ['permissions' => Permission::all()]);
    }

    public function addPermission()
    {
        if (Gate::denies('addPermission')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        return view('admin.create.permission');
    }

    public function savePermission(Request $request)
    {
        if (Gate::denies('addPermission')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }

        $this->validate($request, [
            'name' => 'required',
            'label' => 'required'
        ]); 

        Permission::create($request->input());
        Return redirect()->route('dashboard.permissions')->with('success', 'Permission "'.$request->input('name').'" has been added');
    }

    public function editPermission($id)
    {
        if (Gate::denies('editPermission')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        return view('admin.edit.permission', ['permission' => Permission::findorFail($id)]);
    }

    public function saveEditPermission(Request $request)
    {
        if (Gate::denies('editPermission')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        
        $this->validate($request, [
            'name' => 'required',
            'label' => 'required'
        ]); 

        Permission::findorFail($request->input('id'))->update($request->input());
        return redirect()->route('dashboard.permissions')->with('success', 'Permission Updated!');
    }

    public function deletePermission($id)
    {
        if (Gate::denies('deletePermission')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        Permission::findorFail($id)->delete();
        return redirect()->route('dashboard.permissions')->with('success', 'Permission Deleted!');
    }


    public function permissionRole($roleId)
    {
        if (Gate::denies('giveRolesPermissions')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        return view('admin.lists.permissionRole', ['role' => Role::findorFail($roleId), 'permissions' => Permission::all()]);
    }

    public function attachPermission($permissionId, $roleId)
    {
        if (Gate::denies('giveRolesPermissions')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        Role::findorFail($roleId)->permissions()->attach($permissionId);
        return redirect()->route('dashboard.permission.role', ['role' => $roleId])->with('success', 'Permission Attached');
    }

    public function detachPermission($permissionId, $roleId)
    {
        if (Gate::denies('giveRolesPermissions')) {
            return redirect()->route('dashboard.home')->with('error', 'You cannot do that!');
        }
        Role::findorFail($roleId)->permissions()->detach($permissionId);
        return redirect()->route('dashboard.permission.role', ['role' => $roleId])->with('success', 'Permission Detached');
    }
}
