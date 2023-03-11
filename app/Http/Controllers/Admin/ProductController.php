<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductLogModel;
use App\Models\ProductModel;
use App\Models\StoreModel;
use App\Models\UniteModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function ProductIndex(){

        $Product = ProductModel::join('users', 'users.id', '=', 'product.modifier')
            ->select('users.name','product.*')
            ->orderBy('product_id','desc')->paginate(10);
        return view('Admin/Pages/ProductPages/ProductListPage',compact('Product'));

    }


    public function ProductCreate(){
        $Category = CategoryModel::where('status',1)->get();
        $Store = StoreModel::where('status',1)->get();
        $Unite = UniteModel::where('status',1)->get();
        return view('Admin/Pages/ProductPages/ProductCreatePage',compact('Category','Store','Unite'));
    }

    public function ProductEntry(Request $request){
        $validation = $request->validate([
            'product_name' => 'required|unique:product',
        ]);

        $data =  array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['store_id'] = $request->store_id;
        $data['unite_id'] = $request->unite_id;

        $data['barcode'] = $request->barcode;
        $data['status'] = 1;
        $data['creator'] = $request->creator;
        $data['modifier'] = $request->creator;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $ProductId = ProductModel::insertGetId($data);
        if ($ProductId){
            $dataLog =  array();
            $dataLog['product_id'] = $ProductId;
            $dataLog['product_mode'] = 1;
            $dataLog['quantity'] = $request->quantity;
            $dataLog['reference'] = $request->reference;
            $dataLog['user_ref'] = $request->creator;
            $dataLog['status'] = 1;
            $dataLog['created_date'] = date("Y-m-d h:i:s");

            $res = ProductLogModel::insert($dataLog);

            if ($res){
                $success_notification = array(
                    'success_message' => 'Product Add Successfully!',
                );
                return redirect('/product-list')->with($success_notification);
            }else{
                $error_notification = array(
                    'error_message' => 'Product Add Fail!',
                );
                return back()->with($error_notification);
            }
        }
    }


    public function ProductEdit($id){
        $Product = ProductModel::where('product_id',$id)->first();
        $Category = CategoryModel::where('status',1)->get();
        $Store = StoreModel::where('status',1)->get();
        $Unite = UniteModel::where('status',1)->get();
        return view('Admin/Pages/ProductPages/ProductUpdatePage',compact('Category','Store','Unite','Product'));
    }


    public function ProductUpdate(Request $request, $id){
        $request->validate([
            'product_name' => 'required|unique:product,product_name,'. $id .',product_id'
        ]);
        $data =  array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['store_id'] = $request->store_id;
        $data['unite_id'] = $request->unite_id;

        $data['status'] = $request->status;
        $data['modifier'] = $request->creator;
        $data['modified_date'] = date("Y-m-d h:i:s");

        $res = ProductModel::where('product_id','=',$id)->update($data);
        if ($res){
            $success_notification = array(
                'success_message' => 'Product Update Successfully',
            );
            return redirect('/product-list')->with($success_notification);
        }else{
            $error_notification = array(
                'error_message' => 'Product Update Fail',
            );
            return back()->with($error_notification);
        }

    }



}
