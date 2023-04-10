<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role > 2) {
                return redirect('dashboard');
            }
            return $next($request);
        });
    }


    public function CategoryIndex(){
        $Category = CategoryModel::join('users', 'users.id', '=', 'category.modifier')
            ->select('users.name','category.*')
            ->orderBy('category_id','asc')->paginate(15);
        return view('Admin/Pages/CategoryPages/CategoryListPage',compact('Category'));
    }

    public function CategoryCreate(){
        return view('Admin/Pages/CategoryPages/CategoryCreatePage');
    }

    public function CategoryEntry(Request $request){
        $validation = $request->validate([
            'category_name' => 'required|unique:category',
        ]);

        $data =  array();
        $data['category_name'] = $request->category_name;
        $data['status'] = 1;
        $data['creator'] = $request->creator;
        $data['modifier'] = $request->creator;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");

        $res = CategoryModel::insert($data);
        if ($res){
            $success_notification = array(
                'success_message' => 'Category Add Successfully!',
            );
            return redirect('/category-list')->with($success_notification);
        }else{
            $error_notification = array(
                'error_message' => 'Category Add Fail!',
            );
            return back()->with($error_notification);
        }



    }

    public function CategoryEdit($id){
        $Category = CategoryModel::where('category_id',$id)->first();
        return view('Admin/Pages/CategoryPages/CategoryUpdatePage',compact('Category'));
    }

    public function CategoryUpdate(Request $request, $id){

        $request->validate([
            'category_name' => 'required|unique:category,category_name,'. $id .',category_id'
        ]);

        $data =  array();
        $data['category_name'] = $request->category_name;
        $data['status'] = $request->status;
        $data['modifier'] = $request->creator;
        $data['modified_date'] = date("Y-m-d h:i:s");

        $res = CategoryModel::where('category_id','=',$id)->update($data);
        if ($res){
            $success_notification = array(
                'success_message' => 'Category Update Successfully',
            );
            return redirect('/category-list')->with($success_notification);
        }else{
            $error_notification = array(
                'error_message' => 'Category Update Fail',
            );
            return back()->with($error_notification);
        }

    }
}
