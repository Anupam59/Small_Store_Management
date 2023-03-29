<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UniteModel;
use Illuminate\Http\Request;

class UniteController extends Controller
{
    public function UniteIndex(){
        $Unite = UniteModel::join('users', 'users.id', '=', 'unite.modifier')
            ->select('users.name','unite.*')
            ->orderBy('unite_id','asc')->paginate(15);
        return view('Admin/Pages/UnitePages/UniteListPage',compact('Unite'));
    }

    public function UniteCreate(){
        return view('Admin/Pages/UnitePages/UniteCreatePage');
    }

    public function UniteEntry(Request $request){
        $validation = $request->validate([
            'unite_name' => 'required|unique:unite',
        ]);

        $data =  array();
        $data['unite_name'] = $request->unite_name;
        $data['status'] = 1;
        $data['creator'] = $request->creator;
        $data['modifier'] = $request->creator;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");

        $res = UniteModel::insert($data);
        if ($res){
            $success_notification = array(
                'success_message' => 'Unite Add Successfully!',
            );
            return redirect('/unite-list')->with($success_notification);
        }else{
            $error_notification = array(
                'error_message' => 'Unite Add Fail!',
            );
            return back()->with($error_notification);
        }



    }

    public function UniteEdit($id){
        $Unite = UniteModel::where('unite_id',$id)->first();
        return view('Admin/Pages/UnitePages/UniteUpdatePage',compact('Unite'));
    }

    public function UniteUpdate(Request $request, $id){

        $request->validate([
            'unite_name' => 'required|unique:unite,unite_name,'. $id .',unite_id'
        ]);

        $data =  array();
        $data['unite_name'] = $request->unite_name;
        $data['status'] = $request->status;
        $data['modifier'] = $request->creator;
        $data['modified_date'] = date("Y-m-d h:i:s");

        $res = UniteModel::where('unite_id','=',$id)->update($data);
        if ($res){
            $success_notification = array(
                'success_message' => 'Unite Update Successfully',
            );
            return redirect('/unite-list')->with($success_notification);
        }else{
            $error_notification = array(
                'error_message' => 'Unite Update Fail',
            );
            return back()->with($error_notification);
        }

    }
}
