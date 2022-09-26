<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

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

//admin login //
Route::get('/admin', [UserController::class,'login_admin_view'])->name('login_admin');
Route::post('/admin-login', [UserController::class,'login_admin'])->name('admin_login')->middleware('throttle:3,1');
Route::get('/admin-logout', [UserController::class,'logout_admin'])->name('logout_admin');

//admin dashboard//
Route::group(['middleware'=>'disabled_back'],function(){
    Route::group(['middleware'=>'auth'],function(){
        Route::group(['prefix' => 'admin'], function () {  
            Route::get('/dashboard', [UserController::class,'dashboard'])->name('dashboard');
            Route::get('/category', [CategoryController::class,'list'])->name('admin.category-list');
            Route::get('/category-data', [CategoryController::class,'getlist'])->name('admin.getcategory-list');

            Route::post('/category-store', [CategoryController::class,'store'])->name('admin.category-store');
            Route::get('/category-edit/{id}', [CategoryController::class,'edit'])->name('admin.category-edit');
            Route::put('/category-update/{id}', [CategoryController::class,'update'])->name('admin.category-update');
            Route::get('/category-delete/{id}', [CategoryController::class,'destroy'])->name('admin.category-destroy');
            Route::get('/products', [DishController::class,'list'])->name('admin.all-dishes');
            Route::get('/products-data', [DishController::class,'getlist'])->name('admin.getproduct-list');

            Route::get('/add-dish', [DishController::class,'create'])->name('admin.add-dish');
            Route::post('/dish-store', [DishController::class,'store'])->name('admin.dish-store');
            Route::get('/dish-delete/{id}', [DishController::class,'destroy'])->name('admin.dish-destroy');
            Route::get('/dish-edit/{id}', [DishController::class,'edit'])->name('admin.dish-edit');
            Route::put('/dish-update/{id}', [DishController::class,'update'])->name('admin.dish-update');
            Route::get('/orders', [OrderController::class,'list'])->name('admin.order-history');
            Route::get('/orders-data', [OrderController::class,'getlist'])->name('admin.getorder-list');

            
            Route::get('/view-order', [OrderController::class,'order_view'])->name('admin.view-order-details');
            Route::get('/remove-order', [OrderController::class,'remove_order'])->name('admin.remove_order');
            Route::get('/remove-product', [OrderController::class,'remove_product'])->name('admin.remove_product');
            Route::get('/roles', [RoleController::class,'list'])->name('admin.all-roles');
            Route::post('/role-store', [RoleController::class,'store'])->name('admin.role_store');
            Route::get('/remove-role', [RoleController::class,'remove_role'])->name('admin.remove_role');
            Route::get('/permissions', [PermissionController::class,'grant_permission'])->name('admin.permissions');
            Route::post('/permission-store', [PermissionController::class,'store'])->name('admin.permission_store');
            Route::get('/view-permission', [PermissionController::class,'permission_view'])->name('admin.view-permission-details');
            Route::get('/edit-permission', [PermissionController::class,'permission_edit'])->name('admin.edit-permission-details');
            Route::post('/permission-update', [PermissionController::class,'permission_update'])->name('admin.permission-update');
            Route::get('/admin-registration', [RoleController::class,'admin_register'])->name('admin.admin-register');
            Route::post('/admin-registration-store', [RoleController::class,'addAdmin'])->name('admin.addAdmin');
            Route::get('/customers', [UserController::class,'user_list'])->name('admin.user-list');
            Route::get('/customers-data', [UserController::class,'getuser_list'])->name('admin.getuser-list');
            
            Route::get('/edit-customer-details', [UserController::class,'edit_info'])->name('admin.edit-user-details');
            Route::post('/update-customer-details', [UserController::class,'update_info'])->name('admin.update-user-details');
            Route::get('/remove-user', [UserController::class,'remove_user'])->name('admin.remove_user');
            Route::get('/team', [UserController::class,'list'])->name('admin.team');

        });
    });
});


Route::group(['middleware'=>'disabled_back'],function(){
    Route::group(['middleware'=>'auth'],function(){
        Route::get('/checkout', [HomeController::class,'checkout'])->name('checkout');
        Route::get('/order-history', [HomeController::class,'history'])->name('history');
        Route::get('/view-order-history', [HomeController::class,'order_history'])->name('view-order-history');
        //Order //
        Route::post('/place-order', [OrderController::class,'placeOrder'])->name('placeOrder');
    });
    Route::post('/add-to-cart', [HomeController::class,'addToCart'])->name('add-to-cart');
    Route::patch('/update-cart', [HomeController::class, 'update'])->name('update_cart');
    Route::delete('/remove-from-cart', [HomeController::class, 'remove'])->name('remove_cart');
});

//user-side //
Route::get('/', [HomeController::class,'index'])->name('user_home');
Route::get('/about-us', [HomeController::class,'about_us'])->name('about_us');
//user-login /registration //
Route::get('/user-registration', [UserController::class,'register'])->name('register');
Route::post('/user-registration', [UserController::class,'addUser'])->name('addUser');
Route::get('/user-login', [UserController::class,'login_user'])->name('login_user');
Route::post('/user-login', [UserController::class,'login'])->name('login')->middleware('throttle:3,1');
Route::get('/user-logout', [UserController::class,'logout_user'])->name('logout_user');







