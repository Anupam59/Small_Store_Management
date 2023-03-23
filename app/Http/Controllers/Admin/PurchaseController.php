<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductLogModel;
use App\Models\ProductModel;
use App\Models\PurchaseCartModel;
use App\Models\PurchaseModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{


    public function ProductPurchaseCreate(){
        $Product = ProductModel::where('status',1)->get();
        if(Auth::user()->role <= 2){
            return view('Admin/Pages/PurchasePages/PurchaseCreatePage',compact('Product'));
        }else{
            return redirect('/');
        }

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
        if($ProductCart->quantity >= 1){
            $data['quantity'] = $ProductCart->quantity+1;
            $res = PurchaseCartModel::where('purchase_cart_id',$purchase_cart_id)->where('user_id',$user_id)->update($data);
            return $res;
        }else{
            return 0;
        }
    }
    public function ProductQuantityDecrement(Request $request){
        $purchase_cart_id= $request->input('purchase_cart_id');
        $user_id= $request->input('user_id');
        $ProductCart = PurchaseCartModel::where('purchase_cart_id',$purchase_cart_id)->where('user_id',$user_id)->first();
        $data =  array();
        if ($ProductCart->quantity > 1){
            $data['quantity'] = $ProductCart->quantity-1;
            $res = PurchaseCartModel::where('purchase_cart_id',$purchase_cart_id)->where('user_id',$user_id)->update($data);
            return $res;
        }else{
            return 0;
        }

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
    function PurchaseAdd(Request $request){
        $total_quantity = $request->input('total_quantity');
        $supplier = $request->input('supplier');
        $memo_number = $request->input('memo_number');
        $note = $request->input('note');
        $creator = $request->input('creator');
        $modifier = $request->input('creator');
        $created_date = date("Y-m-d h:i:s");
        $modified_date = date("Y-m-d h:i:s");

        $PurchaseId = PurchaseModel::insertGetId([
            'total_quantity'=>$total_quantity,
            'supplier'=>$supplier,
            'memo_number'=>$memo_number,
            'note'=>$note,
            'creator'=>$creator,
            'modifier'=>$modifier,
            'created_date'=>$created_date,
            'modified_date'=>$modified_date,
        ]);
        $purchases = PurchaseCartModel::where('user_id',$creator)->get();
        foreach ($purchases as $key => $purchase) {
            $product_id = $purchase['product_id'];
            $product_mode = 2; //purchase mode = 2
            $quantity = $purchase['quantity'];
            $reference = $PurchaseId;
            $user_ref = $creator;
            $status = 1;
            $created_date = date("Y-m-d h:i:s");
            $lastData = ProductLogModel::where('product_id',$product_id)->orderBy('product_log_id','desc')->first();
            $TotalQuantity = $lastData->total_quantity;
            $result = ProductLogModel::insert([
                'product_id'=>$product_id,
                'product_mode'=>$product_mode,
                'quantity'=>$quantity,
                'total_quantity'=>$TotalQuantity+$quantity,
                'reference'=>$reference,
                'user_ref'=>$user_ref,
                'status'=>$status,
                'created_date'=>$created_date,
            ]);
        }

//        PurchaseCartModel::truncate(); //full table delete
        PurchaseCartModel::where('user_id',$creator)->delete();
        return $PurchaseId;
    }

    public function PurchaseList(){
        $supplier = \request('supplier');
        $memo_no = \request('memo_no');
        $start_date = \request('start_date');
        $end_date = \request('end_date');

        $query = PurchaseModel::leftJoin('users', 'users.id', '=', 'purchase.creator')
            ->select('users.name','purchase.*')
            ->orderBy('purchase_id','desc');
        if($start_date && $end_date){
            $query = $query->whereBetween('purchase.created_date', [$start_date, $end_date]);
        }
        if ($supplier){
            $query = $query->where('supplier', 'like', '%' . $supplier . '%');
        }
        if ($memo_no){
            $query = $query->where('memo_number', 'like', '%' . $memo_no . '%');
        }
        $Purchase = $query->paginate(10);

        if(Auth::user()->role <= 2){
            return view('Admin/Pages/PurchasePages/PurchaseListPage',compact('Purchase'));
        }else{
            return redirect('/');
        }



    }
}
