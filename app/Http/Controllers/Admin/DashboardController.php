<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\DepartmentModel;
use App\Models\ProductModel;
use App\Models\StoreModel;
use App\Models\UniteModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function DashboardIndex(){
        $Department = DepartmentModel::where('status',1)->count();
        $Store = StoreModel::where('status',1)->count();
        $Product = ProductModel::where('status',1)->count();
        $Category = CategoryModel::where('status',1)->count();
        $Unite = UniteModel::where('status',1)->count();
        $ProductStock = ProductModel::join('view_total_quantity', 'view_total_quantity.product_id', '=', 'product.product_id')
            ->where('status',1)->sum('view_total_quantity.total_quantity');

        return view('Admin/Pages/Dashboard/Dashboard',compact('Department','Store','Product','Category','Unite','ProductStock'));
    }
}
