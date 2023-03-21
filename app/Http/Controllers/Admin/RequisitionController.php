<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DepartmentModel;
use App\Models\ProductLogModel;
use App\Models\ProductModel;
use App\Models\RequisitionCartModel;
use App\Models\RequisitionLogModel;
use App\Models\RequisitionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequisitionController extends Controller
{
    public function ProductRequisitionCreate(){
        $Department = DepartmentModel::where('status',1)->get();
        $Product = ProductModel::where('status',1)->get();
        return view('Admin/Pages/RequisitionPages/RequisitionCreatePage',compact('Department','Product'));
    }

    public function ProductRequisitionCart(Request $request){
        $product_id= $request->input('product_id');
        $user_id= $request->input('user_id');
        $Product = ProductModel::where('product_id',$product_id)->first();
        $ProductName = $Product->product_name;
        $data =  array();
        $ProductCart = RequisitionCartModel::where('product_id',$product_id)->where('user_id',$user_id)->first();
        if ($ProductCart){
            $data['quantity'] = $ProductCart->quantity+1;
            $res = RequisitionCartModel::where('product_id',$product_id)->where('user_id',$user_id)->update($data);
        }else{
            $data['product_id'] = $product_id;
            $data['product_name'] = $ProductName;
            $data['user_id'] = $user_id;
            $data['created_date'] = date("Y-m-d h:i:s");
            $res = RequisitionCartModel::insert($data);
        }
        return $res;
    }

    public function RequisitionQuantityIncrement(Request $request){
        $requisition_cart_id= $request->input('requisition_cart_id');
        $user_id= $request->input('user_id');
        $ProductCart = RequisitionCartModel::where('requisition_cart_id',$requisition_cart_id)->where('user_id',$user_id)->first();
        $data =  array();
        if($ProductCart->quantity >= 1){
            $data['quantity'] = $ProductCart->quantity+1;
            $res = RequisitionCartModel::where('requisition_cart_id',$requisition_cart_id)->where('user_id',$user_id)->update($data);
            return $res;
        }else{
            return 0;
        }
    }

    public function RequisitionQuantityDecrement(Request $request){
        $requisition_cart_id= $request->input('requisition_cart_id');
        $user_id= $request->input('user_id');
        $ProductCart = RequisitionCartModel::where('requisition_cart_id',$requisition_cart_id)->where('user_id',$user_id)->first();
        $data =  array();
        if ($ProductCart->quantity > 1){
            $data['quantity'] = $ProductCart->quantity-1;
            $res = RequisitionCartModel::where('requisition_cart_id',$requisition_cart_id)->where('user_id',$user_id)->update($data);
            return $res;
        }else{
            return 0;
        }

    }

    public function RequisitionCartDelete(Request $request){
        $requisition_cart_id= $request->input('requisition_cart_id');
        $user_id= $request->input('user_id');
        $res = RequisitionCartModel::where('requisition_cart_id',$requisition_cart_id)->where('user_id',$user_id)->delete();
        return $res;
    }

    public function ProductRequisitionCartShow(){
        $userId = Auth::id();
        $CartDara = RequisitionCartModel::where('user_id',$userId)->get();
        return $CartDara;
    }

    public function RequisitionAdd(Request $request){
        $total_quantity = $request->input('total_quantity');
        $department_id = $request->input('department_id');
        $note = $request->input('note');
        $creator = $request->input('creator');
        $modifier = $request->input('creator');
        $created_date = date("Y-m-d h:i:s");
        $modified_date = date("Y-m-d h:i:s");

        $RequisitionId = RequisitionModel::insertGetId([
            'total_quantity'=>$total_quantity,
            'department_id'=>$department_id,
            'note'=>$note,
            'creator'=>$creator,
            'modifier'=>$modifier,
            'created_date'=>$created_date,
            'modified_date'=>$modified_date,
        ]);
        $requisitions = RequisitionCartModel::where('user_id',$creator)->get();
        foreach ($requisitions as $key => $requisition) {
            $product_id = $requisition['product_id'];
            $product_mode = 2; //requisition mode = 2
            $quantity = $requisition['quantity'];
            $reference = $RequisitionId;
            $user_ref = $creator;
            $status = 1;
            $created_date = date("Y-m-d h:i:s");
            $result = RequisitionLogModel::insert([
                'product_id'=>$product_id,
                'product_mode'=>$product_mode,
                'quantity'=>$quantity,
                'reference'=>$reference,
                'user_ref'=>$user_ref,
                'status'=>$status,
                'created_date'=>$created_date,
            ]);
        }
//        RequisitionCartModel::truncate(); //full table delete
        RequisitionCartModel::where('user_id',$creator)->delete();
        return $RequisitionId;
    }

    public function RequisitionList(){
        $department_id = \request('department_id');
        $start_date = \request('start_date');
        $end_date = \request('end_date');
        $query = RequisitionModel::leftJoin('users', 'users.id', '=', 'requisition.creator')
            ->leftJoin('department', 'department.department_id', '=', 'requisition.department_id')
            ->select('users.name','department.department_name','requisition.*')
            ->orderBy('requisition_id','desc');
        if($start_date && $end_date){
            $query = $query->whereBetween('requisition.created_date', [$start_date, $end_date]);
        }
        if ($department_id){
            $query = $query->where('requisition.department_id', '=',$department_id);
        }
        $Requisition = $query->paginate(10);
        $Department = DepartmentModel::where('status',1)->get();
        return view('Admin/Pages/RequisitionPages/RequisitionListPage',compact('Requisition','Department'));
    }

    public function RequisitionDetails($requisition_id){
        $Requisition = RequisitionModel::join('users', 'users.id', '=', 'requisition.creator')
            ->join('department', 'department.department_id', '=', 'requisition.department_id')
            ->select('users.name','department.department_name','users.email','requisition.*')
            ->where('requisition_id',$requisition_id)->first();

        $ReqProduct = RequisitionLogModel::join('product', 'product.product_id', '=', 'requisition_log.product_id')
            ->select('product.product_name','requisition_log.*')
            ->where('reference',$requisition_id)->get();
        return view('Admin/Pages/RequisitionPages/RequisitionDetailsPage',compact('Requisition','ReqProduct'));
    }

    public function RequisitionEdit($requisition_id){
        $Requisition = RequisitionModel::join('users', 'users.id', '=', 'requisition.creator')
            ->join('department', 'department.department_id', '=', 'requisition.department_id')
            ->select('users.name','department.department_name','users.email','requisition.*')
            ->where('requisition_id',$requisition_id)->first();
        return view('Admin/Pages/RequisitionPages/RequisitionEditPage',compact('Requisition'));
    }

    public function RequisitionItemShow(Request $request){
        $requisition_id = $request->input('requisition_id');
        $CartDara = RequisitionLogModel::join('product', 'product.product_id', '=', 'requisition_log.product_id')
            ->select('product.product_name','requisition_log.*')
            ->where('reference',$requisition_id)->get();
        return $CartDara;
    }

    public function ReqUpdateQuantityIncrement(Request $request){
        $requisition_log_id= $request->input('requisition_log_id');
        $ProductCart = RequisitionLogModel::where('requisition_log_id',$requisition_log_id)->first();
        $data =  array();
        if($ProductCart->quantity >= 1){
            $data['quantity'] = $ProductCart->quantity+1;
            $res = RequisitionLogModel::where('requisition_log_id',$requisition_log_id)->update($data);
            return $res;
        }else{
            return 0;
        }
    }

    public function ReqUpdateQuantityDecrement(Request $request){
        $requisition_log_id= $request->input('requisition_log_id');
        $ProductCart = RequisitionLogModel::where('requisition_log_id',$requisition_log_id)->first();
        $data =  array();
        if ($ProductCart->quantity > 1){
            $data['quantity'] = $ProductCart->quantity-1;
            $res = RequisitionLogModel::where('requisition_log_id',$requisition_log_id)->update($data);
            return $res;
        }else{
            return 0;
        }

    }

    public function RequisitionTotalQuantityUpdate(Request $request){
        $requisition_id = $request->input('requisition_id');
        $total_quantity= $request->input('total_quantity');
        $result = RequisitionModel::where('requisition_id',$requisition_id)->update([
            'total_quantity'=>$total_quantity,
        ]);
        return $result;
    }

    public function RequisitionApproved(Request $request){
        $requisition_id = $request->input('requisition_id');
        $approved_by= $request->input('approved_by');
        $result = RequisitionModel::where('requisition_id',$requisition_id)->update([
            'status'=>2,
            'approved_by'=>$approved_by,
            'approved_date'=>date("Y-m-d h:i:s"),
        ]);
        return $result;
    }

    public function RequisitionCanceled(Request $request){
        $requisition_id = $request->input('requisition_id');
        $canceled_by= $request->input('user_id');
        $result = RequisitionModel::where('requisition_id',$requisition_id)->update([
            'status'=>4,
            'canceled_by'=>$canceled_by,
            'canceled_date'=>date("Y-m-d h:i:s"),
        ]);
        return $result;
    }


    public function ReqUpdateDelete(Request $request){
        $requisition_log_id= $request->input('requisition_log_id');
        $res = RequisitionLogModel::where('requisition_log_id',$requisition_log_id)->delete();
        return $res;
    }

    public function RequisitionDelivered(Request $request){
         $requisition_id= $request->input('requisition_id');
         $user_id= $request->input('user_id');
         $RequisitionDara = RequisitionLogModel::where('reference',$requisition_id)->get();
         foreach ($RequisitionDara as $key => $Requisition) {
             $product_id = $Requisition['product_id'];
             $product_mode = 3; //Delivered mode = 3
             $quantity = $Requisition['quantity'];
             $reference = 'Delivered';
             $user_ref = $user_id;
             $status = 1;
             $created_date = date("Y-m-d h:i:s");
             $lastData = ProductLogModel::where('product_id',$product_id)->orderBy('product_log_id','desc')->first();
             $TotalQuantity = $lastData->total_quantity;
             $result = ProductLogModel::insert([
                 'product_id'=>$product_id,
                 'product_mode'=>$product_mode,
                 'quantity'=>$quantity,
                 'total_quantity'=>$TotalQuantity-$quantity,
                 'reference'=>$reference,
                 'user_ref'=>$user_ref,
                 'status'=>$status,
                 'created_date'=>$created_date,
                 ]);
         }

        $result = RequisitionModel::where('requisition_id',$requisition_id)->update([
            'status'=>3,
            'delivered_by'=>$user_id,
            'delivered_date'=>date("Y-m-d h:i:s"),
        ]);
    }
}
