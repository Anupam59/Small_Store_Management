<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductLogModel;
use App\Models\ProductModel;
use App\Models\PurchaseCartModel;
use App\Models\PurchaseTampModel;
use App\Models\StoreModel;
use App\Models\UniteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function ProductPurchaseIndex(){
        $Product = ProductModel::where('status',1)->get();
        return view('Admin/Pages/ProductPages/ProductPurchasePage',compact('Product'));
    }
    public function ProductPurchaseEntry(Request $request){
        $data =  array();
        $data['product_id'] = $request->product_id;
        $data['product_mode'] = 2;
        $data['quantity'] = $request->quantity;
        $data['reference'] = $request->reference;
        $data['user_ref'] = $request->creator;
        $data['status'] = 1;
        $data['created_date'] = date("Y-m-d h:i:s");
        $res = ProductLogModel::insert($data);
        if ($res){
            $success_notification = array(
                'success_message' => 'Product Purchase Successfully!',
            );
            return redirect('/product-log-list')->with($success_notification);
        }else{
            $error_notification = array(
                'error_message' => 'Product Purchase Fail!',
            );
            return back()->with($error_notification);
        }
    }

    public function ProductDistributeIndex(){
        $Product = ProductModel::where('status',1)->get();
        return view('Admin/Pages/ProductPages/ProductDistributePage',compact('Product'));
    }
    public function ProductDistributeEntry(Request $request){
        $data =  array();
        $data['product_id'] = $request->product_id;
        $data['product_mode'] = 3;
        $data['quantity'] = $request->quantity;
        $data['reference'] = $request->reference;
        $data['user_ref'] = $request->creator;
        $data['status'] = 1;
        $data['created_date'] = date("Y-m-d h:i:s");
        $res = ProductLogModel::insert($data);
        if ($res){
            $success_notification = array(
                'success_message' => 'Product Distribute Successfully!',
            );
            return redirect('/product-log-list')->with($success_notification);
        }else{
            $error_notification = array(
                'error_message' => 'Product Distribute Fail!',
            );
            return back()->with($error_notification);
        }
    }

    public function ProductLogIndex(){
        $ProductLog = ProductLogModel::join('users', 'users.id', '=', 'product_log.user_ref')
            ->select('users.name','product_log.*')
            ->orderBy('product_log_id','desc')->paginate(10);

        return view('Admin/Pages/ProductPages/ProductLogPage',compact('ProductLog'));
    }

    public function ProductCount(Request $request){
        $ProductId = $request->input('product_id');
        ProductLogModel::where('product_id',$ProductId)->where('product_mode',2)->sum('quantity');
        ProductLogModel::where('product_id',$ProductId)->where('product_mode',3)->sum('quantity');
    }


    public function ProductPurchaseCart(Request $request){
        $product_id= $request->input('product_id');
        $user_id= $request->input('user_id');
        $Product = ProductModel::where('product_id',$product_id)->first();
        $ProductName = $Product->product_name;
        $data =  array();
        $ProductCart = PurchaseCartModel::where('product_id',$product_id)->where('user_id',$user_id)->first();
        if ($ProductCart){
            $data['quantity'] = $ProductCart->quantity+1;
            $res = PurchaseCartModel::where('product_id',$product_id)->where('user_id',$user_id)->update($data);
        }else{
            $data['product_id'] = $product_id;
            $data['product_name'] = $ProductName;
            $data['user_id'] = $user_id;
            $data['created_date'] = date("Y-m-d h:i:s");
            $res = PurchaseCartModel::insert($data);
        }
        return $res;
    }


    public function ProductQuantityIncrement(Request $request){
        $purchase_cart_id= $request->input('purchase_cart_id');
        $user_id= $request->input('user_id');
        $ProductCart = PurchaseCartModel::where('purchase_cart_id',$purchase_cart_id)->where('user_id',$user_id)->first();
        $data =  array();
        $data['quantity'] = $ProductCart->quantity+1;
        $res = PurchaseCartModel::where('purchase_cart_id',$purchase_cart_id)->where('user_id',$user_id)->update($data);
        return $res;
    }

    public function ProductQuantityDecrement(Request $request){
        $purchase_cart_id= $request->input('purchase_cart_id');
        $user_id= $request->input('user_id');
        $ProductCart = PurchaseCartModel::where('purchase_cart_id',$purchase_cart_id)->where('user_id',$user_id)->first();
        $data =  array();
        $data['quantity'] = $ProductCart->quantity-1;
        $res = PurchaseCartModel::where('purchase_cart_id',$purchase_cart_id)->where('user_id',$user_id)->update($data);
        return $res;
    }


    public function ProductCartDelete(Request $request){
        $purchase_cart_id= $request->input('purchase_cart_id');
        $user_id= $request->input('user_id');
        $res = PurchaseCartModel::where('purchase_cart_id',$purchase_cart_id)->where('user_id',$user_id)->delete();
        return $res;
    }



    public function ProductPurchaseCartShow(){
        $userId = Auth::id();
        $CartDara = PurchaseCartModel::where('user_id',$userId)->get();
        return $CartDara;
    }



    function PurchaseAdd(Request $req){
        $total_qty= $req->input('total_quantity');
        $supplier_id= $req->input('supplier_id');
        $purchase_by = "Shuvon Talukdar";
        $status = "show";
        $created_date = date('Y-m-d');

        $purchasesId = PurchaseModel::insertGetId([
            'total_quantity'=>$total_qty,
            'sub_total'=>$sub_total,
            'total_discount'=>$discount,
            'grand_total'=>$grand_total,
            'pay'=>$pay,
            'due'=>$due,
            'pay_option'=>$pay_option,
            'supplier_id'=>$supplier_id,
            'purchase_by'=>$purchase_by,
            'status'=>$status,
            'created_date'=>$created_date,
        ]);


        $purchases = PurchaseCartModel::get();

        /* start ekan teke */


        foreach ($purchases as $key => $purchase) {

            $purchase_quantity = $purchase['product_quantity'];
            $purchase_item_total_price = $purchase['total_price'];
            $purchase_id = $purchasesId;
            $product_id = $purchase['product_id'];
            $status = 'show';
            $created_date = date('Y-m-d');

            $result = PurchaseProductModel::insert([
                'purchase_quantity'=>$purchase_quantity,
                'purchase_item_total_price'=>$purchase_item_total_price,
                'purchase_id'=>$purchase_id,
                'product_id'=>$product_id,
                'status'=>$status,
                'created_date'=>$created_date,
            ]);


            ProductModel::where('product_id','=',$purchase['product_id'])->update([
                'product_quantity'=>DB::raw('product_quantity +'.$purchase['product_quantity'])
            ]);

            $ProductQty = ProductModel::where('product_id','=',$purchase['product_id'])->first();
            ProductHistoryModel::insert([
                'product_quantity'=>$ProductQty->product_quantity,
                'product_id'=>$product_id,
                'created_date'=>$created_date,
            ]);



            $Stock = StockModel::where('product_id',$purchase['product_id'])
                ->where('created_date',$created_date)
                ->first();

            if ($Stock){
                StockModel::where('product_id',$purchase['product_id'])
                    ->where('created_date',$created_date)
                    ->update([
                        'available_qty'=>$ProductQty->product_quantity,
                        'purchase_item'=>$Stock->purchase_item +$purchase_quantity,
                    ]);
            }else{
                StockModel::insert([
                    'available_qty'=>$ProductQty->product_quantity,
                    'product_id'=>$product_id,
                    'purchase_item'=>$purchase_quantity,
                    'sell_item'=>0,
                    'created_date'=>$created_date,
                ]);
            }
        }


        PurchaseCartModel::truncate();
        return $purchasesId;
    }


}
