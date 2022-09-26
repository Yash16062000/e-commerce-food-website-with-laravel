<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;   
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function list(){
        $categoryList = Category::get();
        return view('backend.dashboard.category-list',['categoryList'=>$categoryList]);
    }

    public function getlist(Request $request){
        if ($request->ajax()) {
            $data = Category::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at',function($data){
                    
                    return date("d-m-Y", strtotime($data->created_at));
                })
                ->editColumn('parent_id',function($data){
                    $category = Helper::getParentCategory($data->parent_id);
                    if(!empty($category)){
                    return $category;
                    }else{
                        return "Parent";    
                    }
                })
                ->addColumn('action', function($data){
                    $actionBtn='';
                    
                    if(Auth::user()->user_type!=1){
                        $check = Helper::checkOperation(Auth::user()->user_type,3,2);
                        if(!empty($check)) {
                            $actionBtn = '<a href="'.route('admin.category-edit',[$data->id]).'" class="edit btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>';
                        }
                        $check1 = Helper::checkOperation(Auth::user()->user_type,3,3);
                        if(!empty($check1)) {
                            $actionBtn = '<a href="'.route('admin.category-destroy',[$data->id]).'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
                        }
                        if(!empty($check && $check1)){
                            $actionBtn = '<a href="'.route('admin.category-edit',[$data->id]).'" class="edit btn btn-success btn-sm"><i class="fa fa-pencil"></i></a> 
                            <a href="'.route('admin.category-destroy',[$data->id]).'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
                        }
                    }else{
                    $actionBtn = '<a href="'.route('admin.category-edit',[$data->id]).'" class="edit btn btn-success btn-sm"><i class="fa fa-pencil"></i></a> 
                    <a href="'.route('admin.category-destroy',[$data->id]).'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
                    }
                    return $actionBtn;
                })
                
                ->rawColumns(['action'])
                ->make(true);           
        }
    }

    public function store(Request $request){
        // dd($request->all());
        $validated = $request->validate([
            'title'=>'required|unique:categories|max:200']);
        $category = new Category();
        $category->title = $request->title;
        $category->parent_id = $request->parent_id;
        $category->save();
        return redirect()->route('admin.category-list')->withSuccess('New Category Created');
    }

    public function edit($id){
        //dd($id);
        $category = Category::where('id',$id)->first();
        return view('backend.dashboard.category-edit',compact('category'));
    }

    public function update(Request $request, $id){
        $category = Category::where('id',$id)->first();
        $category->title = $request->title;
        $category->save();
        return redirect()->route('admin.category-list');
    }

    public function destroy($id){
        $category = Category::whereId($id)->first();
        $category->delete();
        return redirect()->route('admin.category-list');
    }

}
