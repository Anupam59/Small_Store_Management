<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DepartmentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
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


    public function DepartmentIndex(){
        $Department = DepartmentModel::join('users', 'users.id', '=', 'department.modifier')
            ->select('users.name','department.*')
            ->orderBy('department_id','asc')->paginate(15);
        return view('Admin/Pages/DepartmentPages/DepartmentListPage',compact('Department'));
    }

    public function DepartmentCreate(){
        return view('Admin/Pages/DepartmentPages/DepartmentCreatePage');
    }

    public function DepartmentEntry(Request $request){
        $validation = $request->validate([
            'department_name' => 'required|unique:department',
        ]);

        $data =  array();
        $data['department_name'] = $request->department_name;
        $data['status'] = 1;
        $data['creator'] = $request->creator;
        $data['modifier'] = $request->creator;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");

        $res = DepartmentModel::insert($data);
        if ($res){
            $success_notification = array(
                'success_message' => 'Department Add Successfully!',
            );
            return redirect('/department-list')->with($success_notification);
        }else{
            $error_notification = array(
                'error_message' => 'Department Add Fail!',
            );
            return back()->with($error_notification);
        }



    }

    public function DepartmentEdit($id){
        $Department = DepartmentModel::where('department_id',$id)->first();
        return view('Admin/Pages/DepartmentPages/DepartmentUpdatePage',compact('Department'));
    }

    public function DepartmentUpdate(Request $request, $id){
        $request->validate([
            'department_name' => 'required|unique:department,department_name,'. $id .',department_id'
        ]);
        $data =  array();
        $data['department_name'] = $request->department_name;
        $data['status'] = $request->status;
        $data['modifier'] = $request->creator;
        $data['modified_date'] = date("Y-m-d h:i:s");

        $res = DepartmentModel::where('department_id','=',$id)->update($data);
        if ($res){
            $success_notification = array(
                'success_message' => 'Department Update Successfully',
            );
            return redirect('/department-list')->with($success_notification);
        }else{
            $error_notification = array(
                'error_message' => 'Department Update Fail',
            );
            return back()->with($error_notification);
        }

    }
}
