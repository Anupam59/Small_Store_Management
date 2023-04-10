<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\DepartmentModel;
use App\Models\ProductLogModel;
use App\Models\ProductModel;
use App\Models\RequisitionCartModel;
use App\Models\RequisitionLogModel;
use App\Models\RequisitionModel;
use App\Models\StoreModel;
use App\Models\UniteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequisitionController extends Controller
{



    public function AddProductRequisition(Request $request){
        $validation = $request->validate([
            'product_name' => 'required|unique:product',
        ]);

        $userId = Auth::user()->id;
        $data =  array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['store_id'] = $request->store_id;
        $data['unite_id'] = $request->unite_id;

        $data['barcode'] = null;
        $data['status'] = 1;
        $data['creator'] = $userId;
        $data['modifier'] =  $userId;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $ProductId = ProductModel::insertGetId($data);
        if ($ProductId){
            $dataLog =  array();
            $dataLog['product_id'] = $ProductId;
            $dataLog['product_mode'] = 1;
            $dataLog['quantity'] = 0;
            $dataLog['reference'] = 'Request';
            $dataLog['user_ref'] = $userId;
            $dataLog['status'] = 1;
            $dataLog['created_date'] = date("Y-m-d h:i:s");

            $res = ProductLogModel::insert($dataLog);
            if ($res){
                return 1;
            }else{
                return 0;
            }

        }
    }


    public function ProductRequisitionCreate(){
        $user_role = Auth::user()->role;
        $user_id = Auth::user()->id;
        RequisitionCartModel::where('user_id',$user_id)->delete();
        if($user_role == '4'){
            $user_department = Auth::user()->dept_ao;
            $DepArray = explode(' ',$user_department);
            $Department  = DepartmentModel::where('status',1)->whereIn('department_id', $DepArray)->get();
        }
        ///$Department = DepartmentModel::where('status',1)->get();
        $Category = CategoryModel::where('status',1)->get();
        $Unit = UniteModel::where('status',1)->get();
        $Store = StoreModel::where('status',1)->get();

        if ($user_role == 4){
            return view('Admin/Pages/RequisitionPages/RequisitionCreatePage',compact('Department','Store','Category','Unit'));
        }else{
            return redirect('requisition-list');
        }
    }



    public function RequisitionProduct(Request $request){
        $user_id= Auth::user()->id;
        $store_id= $request->input('store_id');
        RequisitionCartModel::where('user_id',$user_id)->delete();
        $Product = ProductModel::join('view_total_quantity', 'view_total_quantity.product_id', '=', 'product.product_id')
            ->select('view_total_quantity.total_quantity','product.*')
//            ->where('total_quantity','>',0)
            ->where('store_id',$store_id)
            ->where('status',1)
            ->get();
        $data = array();
        $data[] = "<option value=' '>Select Product</option>";
        foreach ($Product as $row){
            $data[] = "<option value='".$row->product_id."'>".$row->product_name."</option>";
        }
        return $data;
    }


    public function ProductRequisitionCart(Request $request){
        $product_id= $request->input('product_id');
        $user_id= $request->input('user_id');
        $Product = ProductModel::join('view_total_quantity', 'view_total_quantity.product_id', '=', 'product.product_id')
            ->select('view_total_quantity.total_quantity','product.*')
            ->where('product.product_id',$product_id)->first();
        $ProductName = $Product->product_name;
//        $TotalQuantity = $Product->total_quantity;
        $data =  array();
        $ProductCart = RequisitionCartModel::where('product_id',$product_id)->where('user_id',$user_id)->first();
//        if($TotalQuantity <= 0){
//            return 3;
//        }
        if($ProductCart){
            $data['quantity'] = $ProductCart->quantity+1;
            $res = RequisitionCartModel::where('product_id',$product_id)->where('user_id',$user_id)->update($data);
            return $res;
        }else{
            $data['product_id'] = $product_id;
            $data['product_name'] = $ProductName;
            $data['user_id'] = $user_id;
            $data['created_date'] = date("Y-m-d h:i:s");
            $res = RequisitionCartModel::insert($data);
            return $res;
        }

    }

    public function RequisitionQuantityIncrement(Request $request){
        $requisition_cart_id= $request->input('requisition_cart_id');
        $user_id= $request->input('user_id');

        $ProductCart = RequisitionCartModel::where('requisition_cart_id',$requisition_cart_id)->where('user_id',$user_id)->first();
//        $data =  array();
//        $data['quantity'] = $ProductCart->quantity+1;
//        $res = RequisitionCartModel::where('requisition_cart_id',$requisition_cart_id)->where('user_id',$user_id)->update($data);
//        return $res;

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
        $CartDara = RequisitionCartModel::join('view_total_quantity', 'view_total_quantity.product_id', '=', 'requisition_cart.product_id')
            ->select('view_total_quantity.total_quantity','requisition_cart.*')
            ->where('user_id',$userId)->get();
        return $CartDara;
    }

    public function RequisitionAdd(Request $request){
        $total_quantity = $request->input('total_quantity');
        $department_id = $request->input('department_id');
        $store_id = $request->input('store_id');
        $note = $request->input('note');
        $creator = $request->input('creator');
        $modifier = $request->input('creator');
        $created_date = date("Y-m-d h:i:s");
        $modified_date = date("Y-m-d h:i:s");

        $RequisitionId = RequisitionModel::insertGetId([
            'total_quantity'=>$total_quantity,
            'department_id'=>$department_id,
            'store_id'=>$store_id,
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
        $storeS = Auth::user()->store_manager;
        $StoreArray = explode(' ',$storeS);

        $dept_adminS = Auth::user()->dept_admin;
        $Dept_AdminArray = explode(' ',$dept_adminS);

        $department_id = \request('department_id');
        $start_date = \request('start_date');
        $end_date = \request('end_date');
        $query = RequisitionModel::leftJoin('users', 'users.id', '=', 'requisition.creator')
            ->leftJoin('department', 'department.department_id', '=', 'requisition.department_id')
            ->leftJoin('store', 'store.store_id', '=', 'requisition.store_id')
            ->select('users.name','store.store_name','department.department_name','requisition.*')
            ->orderBy('requisition_id','desc');
        if($start_date && $end_date){
            $query = $query->whereBetween('requisition.created_date', [$start_date, $end_date]);
        }
        if ($department_id){
            $query = $query->where('requisition.department_id', '=',$department_id);
        }
        if (Auth::user()->role == 4){
            $query = $query->where('requisition.creator', '=',Auth::user()->id);
        }
        if (Auth::user()->role == 3){
            $query = $query->whereIn('requisition.department_id',$Dept_AdminArray);
        }
        if (Auth::user()->role == 5 ){
            $query = $query->whereIn('requisition.store_id',$StoreArray);
        }
        $Requisition = $query->paginate(10);

        $Dept = DepartmentModel::where('status',1);
        $dept_aoS = Auth::user()->dept_ao;
        $Dept_AoArray = explode(' ',$dept_aoS);
        if (Auth::user()->role == 4){
            $Dept = $Dept->whereIn('department_id',$Dept_AoArray);
        }
        $Department = $Dept->get();
        return view('Admin/Pages/RequisitionPages/RequisitionListPage',compact('Requisition','Department'));
    }

    public function RequisitionDetails($requisition_id){
        $Requisition = RequisitionModel::join('users', 'users.id', '=', 'requisition.creator')
            ->join('department', 'department.department_id', '=', 'requisition.department_id')
            ->select('users.name','department.department_name','users.email','requisition.*')
            ->where('requisition_id',$requisition_id)->first();

        $ReqProduct = RequisitionLogModel::join('product', 'product.product_id', '=', 'requisition_log.product_id')
            ->join('view_total_quantity', 'view_total_quantity.product_id', '=', 'requisition_log.product_id')
            ->select('view_total_quantity.total_quantity','product.product_name','requisition_log.*')
            ->where('reference',$requisition_id)->get();
        return view('Admin/Pages/RequisitionPages/RequisitionDetailsPage',compact('Requisition','ReqProduct'));
    }

    public function RequisitionEdit($requisition_id){
        $Requisition = RequisitionModel::join('users', 'users.id', '=', 'requisition.creator')
            ->join('department', 'department.department_id', '=', 'requisition.department_id')
            ->select('users.name','department.department_name','users.email','requisition.*')
            ->where('requisition_id',$requisition_id)->first();
        if ($Requisition->status == 2 && Auth::user()->role == 6){
            //status = 1; pending Requisition
            //status = 2; Approved Requisition
            return view('Admin/Pages/RequisitionPages/RequisitionEditPage',compact('Requisition'));
        }else{
            return redirect('requisition-list');
        }

    }

    public function RequisitionItemShow(Request $request){
        $requisition_id = $request->input('requisition_id');
        $CartDara = RequisitionLogModel::join('product', 'product.product_id', '=', 'requisition_log.product_id')
            ->join('view_total_quantity', 'view_total_quantity.product_id', '=', 'requisition_log.product_id')
            ->select('view_total_quantity.total_quantity','product.product_name','requisition_log.*')
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
        $canceled_by= $request->input('canceled_by');
        $result = RequisitionModel::where('requisition_id',$requisition_id)->update([
            'status'=>4,
            'canceled_by'=>$canceled_by,
            'canceled_date'=>date("Y-m-d h:i:s"),
        ]);
        return $result;
    }



    public function RequisitionApprovedConfirm(Request $request){
        $requisition_id = $request->input('requisition_id');
        $approved_conf_by= $request->input('approved_conf_by');
        $result = RequisitionModel::where('requisition_id',$requisition_id)->update([
            'status'=>5,
            'approved_conf_by'=>$approved_conf_by,
            'approved_conf_date'=>date("Y-m-d h:i:s"),
        ]);
        return $result;
    }




    public function ReqUpdateDelete(Request $request){
        $requisition_log_id= $request->input('requisition_log_id');
        $res = RequisitionLogModel::where('requisition_log_id',$requisition_log_id)->delete();
        return $res;
    }

    public function RequisitionDeliveredCheck(Request $request){
        $requisition_id= $request->input('requisition_id');
        $user_id= $request->input('user_id');
        $RequisitionDara = RequisitionLogModel::join('view_total_quantity', 'view_total_quantity.product_id', '=', 'requisition_log.product_id')
            ->select('view_total_quantity.total_quantity','requisition_log.*')
            ->where('reference',$requisition_id)->get();

        foreach ($RequisitionDara as $key => $Requisition) {
            $quantity = $Requisition['quantity'];
            $total_quantity = $Requisition['total_quantity'];
            if ($quantity > $total_quantity){
                return 0;
                break;
            }
        }
        return 1;
    }



    public function RequisitionDelivered(Request $request){

         $requisition_id= $request->input('requisition_id');
         $user_id= $request->input('user_id');
         $RequisitionDara = RequisitionLogModel::join('view_total_quantity', 'view_total_quantity.product_id', '=', 'requisition_log.product_id')
             ->select('view_total_quantity.total_quantity','requisition_log.*')
             ->where('reference',$requisition_id)->get();

        foreach ($RequisitionDara as $key => $Requisition) {
            $quantity = $Requisition['quantity'];
            $total_quantity = $Requisition['total_quantity'];
            if ($quantity > $total_quantity){
                return 0;
                break;
            }
        }

         foreach ($RequisitionDara as $key => $Requisition) {
             $product_id = $Requisition['product_id'];
             $product_mode = 3; //Delivered mode = 3
             $quantity = $Requisition['quantity'];
             $total_quantity = $Requisition['total_quantity'];
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
        if ($result){
            return 1;
        }
    }
}
