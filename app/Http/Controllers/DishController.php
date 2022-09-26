<?php

namespace App\Http\Controllers;
use App\Models\Dish;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DishController extends Controller
{
    public function list(){
        $dishList = Dish::select('dishes.id','categories.title as category','dishes.image','dishes.title','dishes.description','dishes.price')
        ->leftjoin('categories','dishes.category_id','=','categories.id')->paginate(10);
        return view('backend.dashboard.dish-list',['dishList'=>$dishList]);
    }
    public function getlist(Request $request){
        if ($request->ajax()) {
            $data = Dish::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at',function($data){
                    
                    return date("d-m-Y", strtotime($data->created_at));
                })
                ->editColumn('category_id',function($data){
                    $category = Helper::getParentCategory($data->category_id);
                    if(!empty($category)){
                    return $category;
                    }else{
                        return "Parent";    
                    }
                })
                ->editColumn('image',function($data){
                    $image = asset('uploads/'.$data->image);
                    return '<img src="'.$image.'" width="50" height="50">';
                    
                })
                ->addColumn('action', function($data){
                    $actionBtn='';
                    
                    if(Auth::user()->user_type!=1){
                        $check = Helper::checkOperation(Auth::user()->user_type,2,2);
                        if(!empty($check)) {
                            $actionBtn = '<a href="'.route('admin.dish-edit',[$data->id]).'" class="edit btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>';
                        }
                        $check1 = Helper::checkOperation(Auth::user()->user_type,2,3);
                        if(!empty($check1)) {
                            $actionBtn = '<a href="'.route('admin.dish-destroy',[$data->id]).'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
                        }
                        if(!empty($check && $check1)){
                            $actionBtn = '<a href="'.route('admin.dish-edit',[$data->id]).'" class="edit btn btn-success btn-sm"><i class="fa fa-pencil"></i></a> 
                            <a href="'.route('admin.dish-destroy',[$data->id]).'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
                        }
                    }else{
                    $actionBtn = '<a href="'.route('admin.dish-edit',[$data->id]).'" class="edit btn btn-success btn-sm"><i class="fa fa-pencil"></i></a> 
                    <a href="'.route('admin.dish-destroy',[$data->id]).'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
                    }
                    return $actionBtn; 
                })
                
                ->rawColumns(['action','image'])
                ->make(true);           
        }
    }

    public function create(){
        $categoryList = Category::get();
        return view('backend.dashboard.add-dish',['categoryList'=>$categoryList]);
    }

    public function store(Request $request){
        // dd($request->all());
        $validated = $request->validate([
            'title'=>'required|unique:categories|max:200',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'description'=>'required',
            'category_id'=>'required',
            'price'=>'required|integer'
        ]);
       
        $validated = $request->all();
        $validated['image'] = time().'.'.$request->image->extension();
        $request->image->move(public_path('uploads'), $validated['image']);
        Dish::create($validated);
        return response()->json('New Dish Added Successfully');
    }

    public function edit($id){
        $categoryList = Category::get();
        $dish = Dish::where('id',$id)->first();
        return view('backend.dashboard.dish-edit',compact('dish','categoryList'));
    }
    
    public function update(Request $request, $id){
        $dish = Dish::where('id',$id)->first();
        $dish->title=$request->title;
        $dish->description=$request->description;
        $dish->price=$request->price;
        $dish->category_id=$request->category_id;
        if(!empty($request->image)){
            $dish->image = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'),$dish->image);
            unlink(public_path("uploads/'.$request->old_image"));
        }
        else{
            $dish->image=$request->old_image;
        }
        $dish->save();
        return response()->json(' Dish Updated Successfully');
    }

    public function destroy($id){
        $dish = Dish::whereId($id)->first();
        $dish->delete();
        return redirect()->route('admin.all-dishes');
    }
}
