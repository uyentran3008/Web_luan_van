<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\MaterialController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\SizeController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\client\CartController;
use App\Http\Controllers\client\HomeController;
use App\Http\Controllers\client\OrderController;
use App\Http\Controllers\client\ProductController as ClientProductController;
use App\Http\Controllers\admin\OrderController as AdminOrderController;
use App\Http\Controllers\admin\SupplierController;


;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
//});
// Route::get('/', function () {
//     return view('client.home.index');
// });

Route::get('/', [HomeController::class, 'index'])->name('client.home');
Route::get('product/{category_id}',[ClientProductController::class, 'index'])->name('client.products.index');
Route::get('product-detail/{id}',[ClientProductController::class, 'show'])->name('client.products.show');
Route::middleware('auth')->group(function(){
    Route::post('add-to-cart', [CartController::class, 'store'])->name('client.carts.add');
    Route::get('carts', [CartController::class, 'index'])->name('client.carts.index');
    Route::post('update-quantity-product-in-cart/{cart_product_id}', [CartController::class, 'updateQuantityProduct'])->name('client.carts.update_product_quantity');
    Route::post('remove-product-in-cart/{cart_product_id}', [CartController::class, 'removeProductInCart'])->name('client.carts.remove_product');
    // Route::post('apply-coupon', [CartController::class, 'applyCoupon'])->name('client.carts.apply_coupon');
    Route::get('checkout', [CartController::class, 'checkout'])->name('client.checkout.index')->middleware('user.can_checkout_cart');
    Route::post('process-checkout', [CartController::class, 'processCheckout'])->name('client.checkout.proccess')->middleware('user.can_checkout_cart');
    Route::get('list-orders', [OrderController::class, 'index'])->name('client.orders.index');
    Route::post('orders/cancel/{id}', [OrderController::class, 'cancel'])->name('client.orders.cancel');
});
Auth::routes();


Route::middleware('auth')->group(function(){
Route::get('/dashboard', function () {
    return view('admin.dashboard.index');
})->name('dashboard');
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('sizes', SizeController::class);
Route::resource('coupons', CouponController::class);
// Route::get('/admin/suppliers', 'SuppliersController@index')->name('admin.suppliers.index');
Route::get('orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
Route::post('update-status/{id}', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.update_status');
Route::resource('suppliers',SupplierController::class);
Route::resource('materials',MaterialController::class);
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
