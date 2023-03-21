<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ConsumerTypeController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\FeaturesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PropertyTypeController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\RequisitionController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\UniteController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::controller(CustomAuthController::class)->group(function(){
//    Route::get('login', 'index')->name('login');
//    Route::get('registration', 'registration')->name('registration');
//    Route::get('logout', 'logout')->name('logout');
//    Route::post('validate_registration', 'validate_registration')->name('sample.validate_registration');
//    Route::post('validate_login', 'validate_login')->name('sample.validate_login');
//    Route::get('dashboard', 'dashboard')->name('dashboard');
//});


Route::middleware('alreadyLoggedIn')->group(function (){
    Route::get('login', [CustomAuthController::class, 'index'])->name('login');
    Route::post('validate_login', [CustomAuthController::class, 'validate_login'])->name('sample.validate_login');
});
Route::get('registration', [CustomAuthController::class, 'registration'])->name('registration');
Route::post('validate_registration', [CustomAuthController::class, 'validate_registration'])->name('sample.validate_registration');
Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::middleware('isLoggedIn')->group(function (){

    // Route::get('/', function () {return view('welcome');});
    Route::get('/', [CustomAuthController::class, 'dashboard']);
    Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('home', function (){
        return view('Admin/Pages/HomePage');
    });

    Route::get('user-list', [UserController::class, 'UserIndex'])->name('user.list');
    Route::get('user-create', [UserController::class, 'UserCreate'])->name('user.create');
    Route::post('user-entry', [UserController::class, 'UserEntry'])->name('user.entry');
    Route::get('user-edit/{id}', [UserController::class, 'UserEdit']);
    Route::post('user-update/{id}', [UserController::class, 'UserUpdate']);

    Route::get('store-list', [StoreController::class, 'StoreIndex'])->name('store.list');
    Route::get('store-create', [StoreController::class, 'StoreCreate'])->name('store.create');
    Route::post('store-entry', [StoreController::class, 'StoreEntry'])->name('store.entry');
    Route::get('store-edit/{id}', [StoreController::class, 'StoreEdit']);
    Route::post('store-update/{id}', [StoreController::class, 'StoreUpdate']);

    Route::get('department-list', [DepartmentController::class, 'DepartmentIndex'])->name('department.list');
    Route::get('department-create', [DepartmentController::class, 'DepartmentCreate'])->name('department.create');
    Route::post('department-entry', [DepartmentController::class, 'DepartmentEntry'])->name('department.entry');
    Route::get('department-edit/{id}', [DepartmentController::class, 'DepartmentEdit']);
    Route::post('department-update/{id}', [DepartmentController::class, 'DepartmentUpdate']);

    Route::get('category-list', [CategoryController::class, 'CategoryIndex'])->name('category.list');
    Route::get('category-create', [CategoryController::class, 'CategoryCreate'])->name('category.create');
    Route::post('category-entry', [CategoryController::class, 'CategoryEntry'])->name('category.entry');
    Route::get('category-edit/{id}', [CategoryController::class, 'CategoryEdit']);
    Route::post('category-update/{id}', [CategoryController::class, 'CategoryUpdate']);

    Route::get('unite-list', [UniteController::class, 'UniteIndex'])->name('unite.list');
    Route::get('unite-create', [UniteController::class, 'UniteCreate'])->name('unite.create');
    Route::post('unite-entry', [UniteController::class, 'UniteEntry'])->name('unite.entry');
    Route::get('unite-edit/{id}', [UniteController::class, 'UniteEdit']);
    Route::post('unite-update/{id}', [UniteController::class, 'UniteUpdate']);

    Route::get('product-list', [ProductController::class, 'ProductIndex'])->name('product.list');
    Route::get('product-create', [ProductController::class, 'ProductCreate'])->name('product.create');
    Route::post('product-entry', [ProductController::class, 'ProductEntry'])->name('product.entry');
    Route::get('product-edit/{id}', [ProductController::class, 'ProductEdit']);
    Route::post('product-update/{id}', [ProductController::class, 'ProductUpdate']);
    Route::get('product-log-list', [ProductController::class, 'ProductLogIndex'])->name('product.log.list');
    Route::post('product-stock', [ProductController::class, 'ProductStock']);

    Route::get('product-purchase', [PurchaseController::class, 'ProductPurchaseCreate']);
    Route::post('product-purchase-cart', [PurchaseController::class, 'ProductPurchaseCart']);
    Route::get('product-purchase-cart-show', [PurchaseController::class, 'ProductPurchaseCartShow']);
    Route::post('product-quantity-increment', [PurchaseController::class, 'ProductQuantityIncrement']);
    Route::post('product-quantity-decrement', [PurchaseController::class, 'ProductQuantityDecrement']);
    Route::post('product-cart-delete', [PurchaseController::class, 'ProductCartDelete']);
    Route::post('product-purchase-add', [PurchaseController::class, 'PurchaseAdd']);
    Route::get('purchase-list', [PurchaseController::class, 'PurchaseList']);


    Route::get('product-requisition', [RequisitionController::class, 'ProductRequisitionCreate']);
    Route::post('product-requisition-cart', [RequisitionController::class, 'ProductRequisitionCart']);
    Route::get('product-requisition-cart-show', [RequisitionController::class, 'ProductRequisitionCartShow']);
    Route::post('requisition-item-show', [RequisitionController::class, 'RequisitionItemShow']);
    Route::post('requisition-quantity-increment', [RequisitionController::class, 'RequisitionQuantityIncrement']);
    Route::post('requisition-quantity-decrement', [RequisitionController::class, 'RequisitionQuantityDecrement']);
    Route::post('requisition-cart-delete', [RequisitionController::class, 'RequisitionCartDelete']);
    Route::post('product-requisition-add', [RequisitionController::class, 'RequisitionAdd']);
    Route::get('requisition-list', [RequisitionController::class, 'RequisitionList']);
    Route::get('requisition-details/{id}', [RequisitionController::class, 'RequisitionDetails']);
    Route::get('requisition-edit/{id}', [RequisitionController::class, 'RequisitionEdit']);

    Route::post('req-update-quantity-increment', [RequisitionController::class, 'ReqUpdateQuantityIncrement']);
    Route::post('req-update-quantity-decrement', [RequisitionController::class, 'ReqUpdateQuantityDecrement']);
    Route::post('req-update-delete', [RequisitionController::class, 'ReqUpdateDelete']);

    Route::post('req-total-quantity-update', [RequisitionController::class, 'RequisitionTotalQuantityUpdate']);
    Route::post('requisition-approved', [RequisitionController::class, 'RequisitionApproved']);
    Route::post('requisition-canceled', [RequisitionController::class, 'RequisitionCanceled']);

    Route::post('requisition-delivered', [RequisitionController::class, 'RequisitionDelivered']);
});
