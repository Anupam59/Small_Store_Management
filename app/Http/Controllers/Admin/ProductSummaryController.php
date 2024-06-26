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
        $TodayTotal  = '';
        $filter_status  = '';
        $refData  = '';

        $ProductName = ProductModel::where('product_id',$product_id)->where('status',1)->select('product_name')->first();

        if($product_id){
            $fixed_date = "2023-01-01";

            $start_date = \request('start_date');
            $end_date   = \request('end_date');

            $time_original = strtotime($start_date);
            $time_add      = $time_original - (3600*24); //add seconds of one day
            $new_date      = date("Y-m-d", $time_add);
            $filter_status = 1;


            $fixedQ = ProductLogModel::leftJoin('users', 'users.id', '=', 'product_log.user_ref')
                ->leftJoin('product', 'product.product_id', '=', 'product_log.product_id')
                ->select(
                    DB::raw("sum(case when `product_mode` in (1,2) then `quantity` else 0 end) - sum(case when `product_mode` in (3) then `quantity` else 0 end) opening_stock"),
                )
                ->where('product.product_id', $product_id);
            if($new_date && $fixed_date){
                $fixedQ = $fixedQ->whereBetween('product_log.product_created_date', [$fixed_date, $new_date]);
            }
            $TodayTotal = $fixedQ->groupBy('product.product_id')->first();



            $query = ProductLogModel::leftJoin('users', 'users.id', '=', 'product_log.user_ref')
                 ->leftJoin('product', 'product.product_id', '=', 'product_log.product_id')
                 ->where('product.product_id', $product_id)
                 ->select(
                     'product_log.product_created_date',
                     'product.product_id',
                     DB::raw("sum(case when `product_mode` in (1,2) then `quantity` else 0 end) as `purchase`"),
                     DB::raw("sum(case when `product_mode` in (3) then `quantity` else 0 end) as `delivered`"),
                 );
             if($start_date && $end_date){
                 $query = $query->whereBetween('product_log.product_created_date', [$start_date, $end_date]);
             }
            $ProductSummary = $query->groupBy('product_log.product_created_date','product.product_id')->get();



             $refData = array();
             if ($ProductSummary){
                 foreach ($ProductSummary as $key => $dataItem) {
                     $refData[$key] = $this->getMenu($dataItem->product_created_date);
                 }
             }





//            dd($refData);
//             print_r($ProductSummary);
//             die();


        }
        return view('Admin/Pages/SummaryPage/ProductSummary',compact('Product','TodayTotal','ProductSummary','refData','filter_status','ProductName'));
    }




    public function getMenu($createDate){
        $MemoData = array();
        $Memo = ProductLogModel::whereIn('product_mode',[1,2])
            ->where('product_created_date', $createDate)
            ->select('memo_number')->get();
        if ($Memo){
            foreach ($Memo as $key => $MemoItem) {
                $MemoData[$key] = $MemoItem->memo_number;
            }
        }
        return implode(",",$MemoData);;
    }

}



//                 ->select(
//                     DB::raw("GROUP_CONCAT(product.product_id) AS product_id"),
//                     DB::raw("GROUP_CONCAT(product.product_name) AS product_name"),
//                     DB::raw("sum(case when `product_mode` in (1,2) then `quantity` else 0 end) as `total_quantity`"),
//                 DB::raw("SUM(CASE
//                     WHEN product_log.product_created_date > ='pay' && status='pay' THEN (amount)
//                     WHEN status='cancel' THEN (amount)
//                     ELSE 0 END) amount"),
//                     'product_log.product_created_date',
//                 )



