<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use App\Models\Category;
use App\Models\Permission;
use App\Models\AdminMenu;
use App\Models\User;


class Helper
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }

    public static function getParentCategory($id)
    {
        $res  = Category::where("id",$id)->first(); 
        if(!empty($res->title)){
           return $res->title;
        }
    }

    public static function adminType($user_id){
        $admintype= User::select('roles.role_type','users.name','users.email')->leftjoin('roles','users.user_type','=','roles.id')->where('users.id',$user_id)->first();
        if(!empty($admintype)){
            return $admintype;
         }else{
            return 0;
         }
    }

    public static function checkMenuPermission($user_type,$id)
    {
        $res  = Permission::where("menu_id",$id);
        $res = $res->where("role_id",$user_type);
        $res = $res->count(); 
        if(!empty($res)){
           return 1;
        }else{
           return 0;
        }
    }

    public static function menu(){
        $navbars = AdminMenu::orderBy('ordering')->get();
        if(!empty($navbars)){
            return $navbars;
         }else{
            return 0;
         }
    }

    public static function checkOperation($user_type,$menu_id,$permission){
        $res=Permission::select('*')->whereRaw('FIND_IN_SET(?, permission)',[$permission])->where("menu_id",$menu_id);
        $res = $res->where("role_id",$user_type);
        $res= $res->count();
        if(!empty($res)){
           return 1;
        }else{
           return 0;
        }
    }

}