<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{
    public function login_admin_view(){
        return view('backend.admin-login.index');
    }

    public function login_admin(Request $request){
        $validated = $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $query = User::where('email',$request->email)->where('user_type','!=',2)->count();
        if(!empty($query)){
        if(Auth::attempt($request->only('email','password'))){
            return redirect()->route('dashboard')->withSuccess('Welcome! '.ucwords(Auth::user()->name));
        }
        else{
            return redirect()->route('login_admin')->withError('Invalid Credentials.');
        }
        }
        else{
            return redirect()->route('login_admin')->withError('user type invalid');
        }       
    }

    public function dashboard(){
        return view('backend.dashboard.index');
    }

    public function register(){
        return view('frontend.auth.user-registration');
    }

    public function addUser(Request $request){
        $validatedData= $request->validate([
            'name'=>'required|max:200',
            'email'=>'required|unique:users|email',
            'password'=>'required|confirmed|max:15'
        ]); 
        $validatedData['user_type'] =$request->user_type; 
        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData);
        return back()->with('success', 'User created successfully.');
    }

    public function login_user(){
        return view('frontend.auth.login');
    }
    
    public function login(Request $request){
        $validated = $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $query = User::where('email',$request->email)->where('user_type',2)->count();
        if(!empty($query)){
        if(Auth::attempt($request->only('email','password'))){
            return redirect()->route('user_home')->withSuccess('Welcome!');
        }
        else{
            return redirect()->route('login_user')->withError('Invalid Credentials.');
        }
        }
        else{
            return redirect()->route('login_user')->withError('user type invalid');
        }       
    }

    public function logout_user(){
        Session::flush();
        Auth::logout();
        return redirect('/');
    }

    public function logout_admin(){
        Session::flush();
        Auth::logout();
        return redirect()->route('login_admin');
    }
    
    public function user_list(){
        return view('backend.dashboard.user-list');
    }

    public function getuser_list(Request $request){
        
        if ($request->ajax()) {
            $data = User::select('*')->where('user_type',2);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $actionBtn='';
                    
                    if(Auth::user()->user_type!=1){
                        $check = Helper::checkOperation(Auth::user()->user_type,1,2);
                        if(!empty($check)) {
                            $actionBtn = '<a onclick="EditUserInfo('.$data->id.');"" class="btn btn-success" data-toggle="modal" data-target="#editCustomerModal">&nbsp;<i class="fa fa-pencil"></i></a>';
                        }
                        $check1 = Helper::checkOperation(Auth::user()->user_type,1,3);
                        if(!empty($check1)) {
                            $actionBtn = '<a onclick="RemoveUser('.$data->id.');"class="btn btn-danger"><i class="fa fa-trash"></i></a>';
                        }
                        if(!empty($check && $check1)){
                            $actionBtn = '<a onclick="EditUserInfo('.$data->id.');"" class="btn btn-success" data-toggle="modal" data-target="#editCustomerModal">&nbsp;<i class="fa fa-pencil"></i></a> 
                            <a onclick="RemoveUser('.$data->id.');"class="btn btn-danger"><i class="fa fa-trash"></i></a>';
                        }
                    }else{

                    $actionBtn = '<a  onclick="EditUserInfo('.$data->id.');" class="btn btn-success" data-toggle="modal" data-target="#editCustomerModal">&nbsp;<i class="fa fa-pencil"></i></a> 
                    <a onclick="RemoveUser('.$data->id.');" class="btn btn-danger"><i class="fa fa-trash"></i></a>';
                    }
                    return $actionBtn;
                })
                ->editColumn('created_at',function($data){
                    
                    return date("d-m-Y", strtotime($data->created_at));
                }) 
                ->rawColumns(['action'])
                ->make(true);           
            }
    }

    public function remove_user(Request $request){
        $user = User::whereId($request->user_id)->first();
        $user->delete();
        return redirect()->route('admin.user-list');
    }

    public function list(){
        $team= User::select('roles.role_type','users.name')->leftjoin('roles','roles.id','=','users.user_type')->where('users.user_type','!=','2')->get();
        return view('backend.dashboard.team',compact('team'));
    }

    public function edit_info(Request $request){
        $info= User::where('id',$request->user_id)->first();
        return view('backend.dashboard.edit-customer',compact('info'));
    }

    public function update_info(Request $request){
        
        $userInfo=User::where('id',$request->user_id)->first();
        $userInfo->name=$request->name;
        $userInfo->email=$request->email;
        $userInfo->save();
        //print_r($userInfo);die;
        return response()->json('Customer Info Updated Successfully!');
    }
}
