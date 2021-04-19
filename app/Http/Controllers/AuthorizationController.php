<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use App\User;


class AuthorizationController extends Controller
{
    public function role_index()
    {
        $roles=Role::all();
        return view('Role.index')->withRoles($roles);
    }

    public function role_create()
    {
        return view('Role.create');
    }

    public function role_store(Request $request)
    {
        $role=new Role;
        $role->name=$request->name;
        $role->display_name=$request->display_name;
        $role->description=$request->description;
        $role->save();
        return redirect()->route('i.role');
    }

    public function role_edit($id)
    {
        $role=Role::find($id);
        $permissions=Permission::all();
        return view('Role.edit')->withRole($role)->withPermissions($permissions);
    }

    public function role_update(Request $request, $id)
    {
        $role=Role::find($id);
        $role->name=$request->name;
        $role->display_name=$request->display_name;
        $role->description=$request->description;
        $role->permissions()->sync($request->permissions);
        $role->save();
        return redirect()->route('i.role');     
    }

    public function role_destroy($id)
    {
        $role=Role::find($id);
        $role->delete();
        return redirect()->back();
    }

//permission functions

    public function permission_index()
    {
        $permissions=Permission::all();
        return view('Permission.permission_list')->withPermissions($permissions);
    }

    public function permission_create()
    {
        return view('Permission.create');
    }

    public function permission_store(Request $request)
    {
        $permission=new Permission;
        $permission->name=$request->name;
        $permission->display_name=$request->display_name;
        $permission->description=$request->description;
        $permission->save();
        return redirect()->route('i.permission');
    }

    public function permission_edit($id)
    {
        $permission=Permission::find($id);
        return view('Permission.edit')->withPermission($permission);
    }

    public function permission_update(Request $request, $id)
    {
        $permission=Permission::find($id);
        $permission->name=$request->name;
        $permission->display_name=$request->display_name;
        $permission->description=$request->description;
        $permission->save();
        return redirect()->route('i.permission');     
    }
    

    //user role functions

    public function user_role_index()
    {
        $users=User::all();
        return view('UserRole.index')->withUsers($users);
    }

    public function user_role_edit($id)
    {
        $user=User::find($id);
        $roles=Role::all();
        return view('UserRole.edit')->withUser($user)->withRoles($roles);   
    }
    
    public function user_role_update(Request $request, $id)
    {
        $user=User::find($id);
        $user->roles()->sync($request->roles);
        $user->save();
        return redirect()->route('i.user_role');
    }

    
    
}
