<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;


class RoleController extends Controller
{
    public function list(){
        $roleList = Role::get();
        return view('backend.dashboard.role',['roleList'=>$roleList]);
    }

    public function store(Request $request){
        $role = new Role();
        $role->role_type = $request->role_type;
        $role->save();
        return response()->json(' Role Added Successfully');
    }

    public function remove_role(Request $request){
        $role = Role::whereId($request->role_id)->first();
        $role->all()->delete();
        // $permission = Permission::where('role_id',$request->role_id)->get();
        // $permission->all()->delete();
        return redirect()->route('admin.all-roles');
    }
    
    public function admin_register(Request $request){
        $role = $request->role_id;
        return view('backend.dashboard.register-admin-role',compact('role'));
    }

    public function addAdmin(Request $request){
       // dd($request->all());die;
        $validatedData= $request->validate([ 
            'name'=>'required|max:200',
            'email'=>'required|unique:users|email',
            'password'=>'required|confirmed|max:15'
        ]); 
        $validatedData['user_type'] =$request->user_type; 
        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData);
        return redirect()->route('admin.all-roles');
    }
}
