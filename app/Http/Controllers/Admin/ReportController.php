<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DepartmentModel;
use App\Models\ProductLogModel;
use App\Models\ProductModel;
use App\Models\PurchaseModel;
use App\Models\RequisitionLogModel;
use App\Models\RequisitionModel;
use App\Models\StoreModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function RequisitionReportList(){
        $store_managerS = Auth::user()->store_manager;
        $store_manager_Array = explode(' ',$store_managerS);
        $store_adminS = Auth::user()->store_admin;
        $store_admin_Array = explode(' ',$store_adminS);


        $dept_aoS = Auth::user()->dept_ao;
        $dept_ao_Array = explode(' ',$dept_aoS);
        $dept_adminS = Auth::user()->dept_admin;
        $dept_admin_Array = explode(' ',$dept_adminS);


        $department_id = \request('department_id');
        $store_id = \request('store_id');
        $product_id = \request('product_id');
        $status = \request('status');
        $start_date = \request('start_date');
        $end_date = \request('end_date');

        $userA = Auth::user();

        $requisition = RequisitionLogModel::where('product_id',$product_id)->get();
        $requisition_ids = array();
        foreach ($requisition as $row){
            $requisition_ids[] = $row->reference;
        }

//        with('req_log','req_log.product')->
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
        if ($store_id){
            $query = $query->where('requisition.store_id', '=',$store_id);
        }
        if ($requisition_ids){
            $query = $query->whereIn('requisition.requisition_id',$requisition_ids);
        }
        if ($status){
            $query = $query->where('requisition.status', '=',$status);
        }

        if ($userA->role == 4){
            $query = $query->where('requisition.creator', '=',$userA->id);
        }

        if ($userA->role == 3){
            $query = $query->whereIn('requisition.department_id',$dept_admin_Array);
        }

//        if ( $userA->role == 4){
//            $query = $query->whereIn('requisition.department_id',$dept_ao_Array);
//        }

        if ($userA->role == 5){
            $query = $query->whereIn('requisition.store_id',$store_manager_Array);
        }

        if ($userA->role == 6 ){
            $query = $query->whereIn('requisition.store_id',$store_admin_Array);
        }

        $Requisition = $query->get();
//        $Requisition = $query->get();

//        dd($Requisition);
//        dd($Requisition[0]->req_log[0]->product->product_name);

        $Dept = DepartmentModel::where('status',1);
        $dept_aoS = $userA->dept_ao;
        $dept_ao_Array = explode(' ',$dept_aoS);

        $dept_adminS = $userA->dept_admin;
        $dept_admin_Array = explode(' ',$dept_adminS);


        if ($userA->role == 3){
            $Dept = $Dept->whereIn('department_id',$dept_admin_Array);
        }
        if ($userA->role == 4){
            $Dept = $Dept->whereIn('department_id',$dept_ao_Array);
        }
        $Department = $Dept->get();


        $Sto = StoreModel::where('status',1);
        $store_adminS = $userA->store_admin;
        $store_adminS_Array = explode(' ',$store_adminS);

        $store_managerS = $userA->store_manager;
        $store_managerS_Array = explode(' ',$store_managerS);

        if ($userA->role == 6){
            $Sto = $Sto->whereIn('store_id',$store_adminS_Array);
        }
        if ($userA->role == 5){
            $Sto = $Sto->whereIn('store_id',$store_managerS_Array);
        }
        $Store = $Sto->get();

        $Product = ProductModel::where('status',1)->get();
        return view('Admin/Pages/ReportPages/RequisitionReport',compact('Requisition','Department','Store','Product'));
    }


    public function RequisitionReportDetails($requisition_id){
        $Requisition = RequisitionModel::leftJoin('users as creator', 'creator.id', '=', 'requisition.creator')
            ->leftJoin('users as approved_by', 'approved_by.id', '=', 'requisition.approved_by')
            ->leftJoin('users as approved_conf_by', 'approved_conf_by.id', '=', 'requisition.approved_conf_by')
            ->leftJoin('users as delivered_by', 'delivered_by.id', '=', 'requisition.delivered_by')

            ->leftJoin('department', 'department.department_id', '=', 'requisition.department_id')
            ->leftJoin('store', 'store.store_id', '=', 'requisition.store_id')
            ->select(
                'creator.name as creator_by',
                'creator.email as email',
                'approved_by.name as approved_by',
                'approved_conf_by.name as approved_conf_by',
                'delivered_by.name as delivered_by',
                'store.store_name','department.department_name','requisition.*')
            ->where('requisition_id',$requisition_id)->first();

//        dd($Requisition);

        $ReqProduct = RequisitionLogModel::join('product', 'product.product_id', '=', 'requisition_log.product_id')
            ->join('view_total_quantity', 'view_total_quantity.product_id', '=', 'requisition_log.product_id')
            ->select('view_total_quantity.total_quantity','product.product_name','requisition_log.*')
            ->where('reference',$requisition_id)->get();
        return view('Admin/Pages/ReportPages/RequisitionReportDetails',compact('Requisition','ReqProduct'));
    }



    public function PurchaseReportList(){
        $supplier = \request('supplier');
        $memo_no = \request('memo_no');
        $start_date = \request('start_date');
        $end_date = \request('end_date');

        $query = PurchaseModel::leftJoin('users', 'users.id', '=', 'purchase.creator')
            ->select('users.name','purchase.*')
            ->orderBy('purchase_id','desc');
        if($start_date && $end_date){
            $query = $query->whereBetween('purchase.purchase_date', [$start_date, $end_date]);
        }
        if ($supplier){
            $query = $query->where('supplier', 'like', '%' . $supplier . '%');
        }
        if ($memo_no){
            $query = $query->where('memo_number', 'like', '%' . $memo_no . '%');
        }
        $Purchase = $query->get();

        if(Auth::user()->role <= 2 || Auth::user()->role == 5 || Auth::user()->role == 6){
            return view('Admin/Pages/ReportPages/PurchaseReport',compact('Purchase'));
        }else{
            return redirect('/');
        }
    }


    public function PurchaseReportDetails($purchase_id){
        $Purchase = PurchaseModel::join('users', 'users.id', '=', 'purchase.creator')
            ->select('users.name','users.email','purchase.*')
            ->where('purchase_id',$purchase_id)->first();

        $PurProduct = ProductLogModel::join('product', 'product.product_id', '=', 'product_log.product_id')
            ->join('view_total_quantity', 'view_total_quantity.product_id', '=', 'product_log.product_id')
            ->select('view_total_quantity.total_quantity','product.product_name','product_log.*')
            ->where('reference',$purchase_id)->get();
        return view('Admin/Pages/ReportPages/PurchaseReportDetails',compact('Purchase','PurProduct'));

    }




}
