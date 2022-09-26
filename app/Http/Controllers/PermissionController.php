<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\AdminMenu;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function grant_permission(){
        $roleList = Role::whereRaw("roles.id NOT IN(SELECT permissions.role_id FROM permissions)")->get();
        $adminMenu = AdminMenu::get();
        return view('backend.dashboard.permission', compact('roleList','adminMenu'));
    }

    public function store(Request $request){
        //dd($request->all());die;
        $p=0;
        foreach($request->input('menu_count') as $res){
           // echo $request->input('menu_id'.$p);
            $role_id = $request->role_id;
            $menu_id = $request->input('menu_id'.$p);
            $permission = $request->input('permission'.$p);
            $operation_id='';
            if(!empty( $permission)){
            $operation_id=  implode(",",$permission);
            }
            $operation = new Permission();
            $operation->menu_id= $menu_id;
            $operation->role_id= $role_id;
            $operation->permission = $operation_id;
            $operation->save();      
        $p++;
        }       
    }

    public function permission_view(Request $request){
        $role_type = Role::select('role_type')->where('id',$request->role_id)->first();
        $permissionDetails = Permission::select('permissions.menu_id','permissions.permission','admin_menus.menu')->leftjoin('admin_menus','admin_menus.id','=','permissions.menu_id')->where('permissions.role_id',$request->role_id)->get();
        return view('backend.dashboard.view-permission',compact('permissionDetails','role_type'));
    }

    public function permission_edit(Request $request){
        $adminMenu = Permission::select('permissions.menu_id','permissions.permission','admin_menus.menu','permissions.id as permission_id','admin_menus.id')->leftjoin('admin_menus','admin_menus.id','=','permissions.menu_id')->where('permissions.role_id',$request->role_id)->get();
        $role_type = Role::select('id','role_type')->where('id',$request->role_id)->first();
        return view('backend.dashboard.edit-permission',compact('role_type','adminMenu'));
    }

    public function permission_update(Request $request){
        $p=1;
        foreach($request->input('menu_count') as $res){
            $operation_id='';
              
        $permission = $request->input('permission'.$p);
        $permission_id = $request->input('permission_id'.$p);

        if(!empty( $permission)){
        $operation_id=  implode(",",$permission);
        }

        $updatePermission = Permission::where('id',$permission_id)->first();
        $updatePermission->permission= $operation_id;
        $updatePermission->save();
        $p++;
        }
    }

}
