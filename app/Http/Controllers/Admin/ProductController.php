<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\DepartmentModel;
use App\Models\ProductLogModel;
use App\Models\ProductModel;
use App\Models\PurchaseModel;
use App\Models\StoreModel;
use App\Models\UniteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
//    public function ProductIndex(){
//        $Product  =  ProductModel::select( 'product.*',DB::raw('(select total_quantity from product_log where product_log.product_id  =   product.product_id order by product_log_id DESC limit 1) as total_quantity'))
//            ->orderBy('product.product_id','desc')
//            ->paginate(10);
//        return view('Admin/Pages/ProductPages/ProductListPage',compact('Product'));
//    }

    public function ProductIndex(){

        $product_id = \request('product_id');
        $category_id = \request('category_id');
        $store_id = \request('store_id');

        $query = ProductModel::join('users', 'users.id', '=', 'product.modifier')
            ->leftJoin('view_total_quantity', 'view_total_quantity.product_id', '=', 'product.product_id')
            ->leftJoin('category', 'category.category_id', '=', 'product.category_id')
            ->leftJoin('store', 'store.store_id', '=', 'product.store_id')
            ->select('users.name','view_total_quantity.total_quantity','category.category_name','store.store_name','product.*')
            ->orderBy('product.product_id','desc');

         if ($category_id){
             $query = $query->where('category.category_id', '=',$category_id);
         }
        if ($product_id){
            $query = $query->where('product.product_id', '=',$product_id);
        }
         if ($store_id){
             $query = $query->where('store.store_id', '=',$store_id);
         }

         $Product = $query->paginate(20);

        $Category = CategoryModel::where('status',1)->get();
        $Store = StoreModel::where('status',1)->get();

        return view('Admin/Pages/ProductPages/ProductListPage',compact('Product','Category','Store'));
    }


    public function ProductCreate(){
        $user_id = Auth::user()->role;
        $store_manager = Auth::user()->store_manager;
        $store = explode(' ',$store_manager);

        $Category = CategoryModel::where('status',1)->get();

        $query = StoreModel::where('status',1);
        if ($store_manager){
            $query = $query->whereIn('store_id',$store);
        }
        $Store = $query->get();

        $Unite = UniteModel::where('status',1)->get();
        if ($user_id <= 2 || $user_id == 5){
            return view('Admin/Pages/ProductPages/ProductCreatePage',compact('Category','Store','Unite'));
        }else{
            return redirect('product-list');
        }
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
//        $data['purchase_date'] = $request->purchase_date;
        $data['status'] = 1;
        $data['creator'] = $request->creator;
        $data['modifier'] = $request->creator;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");

        $purchase_date = $request->input('purchase_date');


        $ProductId = ProductModel::insertGetId($data);

        $PurchaseId = PurchaseModel::insertGetId([
            'total_quantity'=>$request->quantity,
            'supplier'=>"Initial Supplier",
            'memo_number'=>$request->reference,
            'note'=>"This is Initial Note",
            'purchase_date'=>$purchase_date,
            'creator'=>$request->creator,
            'modifier'=>$request->creator,
            'created_date'=>date("Y-m-d h:i:s"),
            'modified_date'=>date("Y-m-d h:i:s"),
        ]);


        if ($ProductId){
            $dataLog =  array();
            $dataLog['product_id'] = $ProductId;
            $dataLog['product_mode'] = 1;
            $dataLog['quantity'] = $request->quantity;
            $dataLog['reference'] = $PurchaseId;
            $dataLog['memo_number'] = $request->reference;
            $dataLog['user_ref'] = $request->creator;
            $dataLog['status'] = 1;
            $dataLog['product_created_date'] = $purchase_date;
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

        $store_manager = Auth::user()->store_manager;
        $store = explode(' ',$store_manager);

        $Product = ProductModel::where('product_id',$id)->first();
        $Category = CategoryModel::where('status',1)->get();

        $query = StoreModel::where('status',1);
        if ($store_manager){
            $query = $query->whereIn('store_id',$store);
        }
        $Store = $query->get();

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

    public function ProductLogIndex(){

        $category = \request('category');
        $store = \request('store');
        $reference = \request('reference');
        $product_mode = \request('product_mode');
        $start_date = \request('start_date');
        $end_date = \request('end_date');

        $query = ProductLogModel::leftJoin('users', 'users.id', '=', 'product_log.user_ref')
            ->leftJoin('product', 'product.product_id', '=', 'product_log.product_id')
            ->leftJoin('category', 'category.category_id', '=', 'product.category_id')
            ->select('users.name','category.*','product.*','product_log.*')
            ->orderBy('product_log_id','desc');

        if($start_date && $end_date){
            $query = $query->whereBetween('product_log.created_date', [$start_date, $end_date]);
        }
        if ($category){
            $query = $query->where('product.category_id','=',$category);
        }
        if ($store){
            $query = $query->where('product.store_id','=',$store);
        }
        if ($reference){
            $query = $query->where('product_log.reference', 'like', '%' . $reference . '%');
        }
        if ($product_mode){
            $query = $query->where('product_log.product_mode','=',$product_mode);
        }
        $ProductLog = $query->paginate(10);

        $Category = CategoryModel::where('status',1)->get();
        $Store = StoreModel::where('status',1)->get();



        if (Auth::user()->role <= 2){
            return view('Admin/Pages/ProductPages/ProductLogPage',compact('ProductLog','Category','Store'));
        }else{
            return redirect('product-list');
        }

    }

    public function ProductStock(Request $request){
        $ProductId = $request->input('product_id');
        $purchase = ProductLogModel::where('product_id',$ProductId)->whereIn('product_mode',[1, 2])->sum('quantity');
        $delivered = ProductLogModel::where('product_id',$ProductId)->where('product_mode',3)->sum('quantity');
        $Stock = $purchase-$delivered;
        return $Stock;
    }

}
