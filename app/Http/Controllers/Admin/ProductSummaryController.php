<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductLogModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductSummaryController extends Controller
{
    public function ProductSummaryIndex(){

        $Product = ProductModel::where('status',1)->get();
        $product_id = \request('product_id');
        

        $ProductSummary = '';
        $filter_status  = '';

        if($product_id){
            $start_date = \request('start_date');
            $end_date   = \request('end_date');
            $end_date   = \request('end_date');
            $filter_status = 1;
            $query = DB::table('product_log')->where('product_id',$product_id)->whereBetween('product_log.product_created_date', [$start_date, $end_date]); 
//             $query = ProductLogModel::leftJoin('users', 'users.id', '=', 'product_log.user_ref')
//                 ->leftJoin('product', 'product.product_id', '=', 'product_log.product_id')
//                 ->where('product.product_id', 1)
//                 ->select(
//                     DB::raw("GROUP_CONCAT(product.product_id) AS product_id"),
//                     DB::raw("GROUP_CONCAT(product.product_name) AS product_name"),
//                     DB::raw("sum(case when `product_mode` in (1,2) then `quantity` else 0 end) as `total_quantity`"),
// //                DB::raw("SUM(CASE
// //                    WHEN product_log.product_created_date > ='pay' && status='pay' THEN (amount)
// //                    WHEN status='cancel' THEN (amount)
// //                    ELSE 0 END) amount"),
//                     'product_log.product_created_date',
//                 )
//                 ->groupBy('product_log.product_created_date')
//                 ->orderBy('product_log_id','desc');

//             if($start_date && $end_date){
//                 $query = $query->whereBetween('product_log.created_date', [$start_date, $end_date]);
//             }
            $ProductSummary = $query->get();
            // print_r($ProductSummary); 
            // die(); 
        }
        return view('Admin/Pages/SummaryPage/ProductSummary',compact('Product','ProductSummary','filter_status'));
    }
}
