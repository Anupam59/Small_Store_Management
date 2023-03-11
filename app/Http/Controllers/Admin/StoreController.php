<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DepartmentModel;
use App\Models\StoreModel;
use Illuminate\Http\Request;

class StoreController extends Controller
{

    public function StoreIndex(){
        $Store = StoreModel::join('users', 'users.id', '=', 'store.modifier')
            ->select('users.name','store.*')
            ->orderBy('store_id','asc')->paginate(2);
        return view('Admin/Pages/StorePages/StoreListPage',compact('Store'));
    }


    public function StoreCreate(){
        return view('Admin/Pages/StorePages/StoreCreatePage');
    }

    public function StoreEntry(Request $request){
        $validation = $request->validate([
            'store_name' => 'required|unique:store',
        ]);

        $data =  array();
        $data['store_name'] = $request->store_name;
        $data['status'] = 1;
        $data['creator'] = $request->creator;
        $data['modifier'] = $request->creator;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");

        $res = StoreModel::insert($data);
        if ($res){
            $success_notification = array(
                'success_message' => 'Store Add Successfully!',
            );
            return redirect('/store-list')->with($success_notification);
        }else{
            $error_notification = array(
                'error_message' => 'Store Add Fail!',
            );
            return back()->with($error_notification);
        }
    }



    public function StoreEdit($id){
        $Store = StoreModel::where('store_id',$id)->first();
        return view('Admin/Pages/StorePages/StoreUpdatePage',compact('Store'));
    }



    public function StoreUpdate(Request $request, $id){
        $request->validate([
            'store_name' => 'required|unique:store,store_name,'. $id .',store_id'
        ]);
        $data =  array();
        $data['store_name'] = $request->store_name;
        $data['status'] = $request->status;
        $data['modifier'] = $request->creator;
        $data['modified_date'] = date("Y-m-d h:i:s");

        $res = StoreModel::where('store_id','=',$id)->update($data);
        if ($res){
            $success_notification = array(
                'success_message' => 'Store Update Successfully',
            );
            return redirect('/store-list')->with($success_notification);
        }else{
            $error_notification = array(
                'error_message' => 'Store Update Fail',
            );
            return back()->with($error_notification);
        }
    }


}
