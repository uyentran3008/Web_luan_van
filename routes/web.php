<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ExportMaterialController;
use App\Http\Controllers\admin\ImportMaterialController;
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Route::resource('roles', RoleController::class);
Route::prefix('roles')->controller(RoleController::class)->name('roles.')->group(function(){
    Route::get('/', 'index')->name('index')->middleware('show-role');
    Route::post('/', 'store')->name('store')->middleware('create-role');
    Route::get('/create', 'create')->name('create')->middleware('create-role');
    Route::get('/{coupon}', 'show')->name('show')->middleware('show-role');
    Route::put('/{coupon}', 'update')->name('update')->middleware('update-role');
    Route::delete('/{coupon}', 'destroy')->name('destroy')->middleware('delete-role');
    Route::get('/{coupon}/edit', 'edit')->name('edit')->middleware('update-role');
});

// Route::resource('users', UserController::class);
Route::prefix('users')->controller(UserController::class)->name('users.')->group(function(){
    Route::get('/', 'index')->name('index')->middleware('permission:show-user');
    Route::post('/', 'store')->name('store')->middleware('permission:create-user');
    Route::get('/create', 'create')->name('create')->middleware('permission:create-user');
    Route::get('/{coupon}', 'show')->name('show')->middleware('permission:show-user');
    Route::put('/{coupon}', 'update')->name('update')->middleware('permission:update-user');
    Route::delete('/{coupon}', 'destroy')->name('destroy')->middleware('permission:delete-user');
    Route::get('/{coupon}/edit', 'edit')->name('edit')->middleware('permission:update-user');
});

// Route::resource('categories', CategoryController::class);
Route::prefix('categories')->controller(CategoryController::class)->name('categories.')->group(function(){
    Route::get('/', 'index')->name('index')->middleware('permission:show-category');
    Route::post('/', 'store')->name('store')->middleware('permission:create-category');
    Route::get('/create', 'create')->name('create')->middleware('permission:create-category');
    Route::get('/{coupon}', 'show')->name('show')->middleware('permission:show-category');
    Route::put('/{coupon}', 'update')->name('update')->middleware('permission:update-category');
    Route::delete('/{coupon}', 'destroy')->name('destroy')->middleware('permission:delete-category');
    Route::get('/{coupon}/edit', 'edit')->name('edit')->middleware('permission:update-category');
});

// Route::resource('products', ProductController::class);
Route::prefix('products')->controller(ProductController::class)->name('products.')->group(function(){
    Route::get('/', 'index')->name('index')->middleware('permission:show-product');
    Route::post('/', 'store')->name('store')->middleware('permission:create-product');
    Route::get('/create', 'create')->name('create')->middleware('permission:create-product');
    Route::get('/{coupon}', 'show')->name('show')->middleware('permission:show-product');
    Route::put('/{coupon}', 'update')->name('update')->middleware('permission:update-product');
    Route::delete('/{coupon}', 'destroy')->name('destroy')->middleware('permission:delete-product');
    Route::get('/{coupon}/edit', 'edit')->name('edit')->middleware('permission:update-product');
});

// Route::resource('sizes', SizeController::class);
Route::prefix('sizes')->controller(SizeController::class)->name('sizes.')->group(function(){
    Route::get('/', 'index')->name('index')->middleware('permission:show-size');
    Route::post('/', 'store')->name('store')->middleware('permission:create-size');
    Route::get('/create', 'create')->name('create')->middleware('permission:create-size');
    Route::get('/{coupon}', 'show')->name('show')->middleware('permission:show-size');
    Route::put('/{coupon}', 'update')->name('update')->middleware('permission:update-size');
    Route::delete('/{coupon}', 'destroy')->name('destroy')->middleware('permission:delete-size');
    Route::get('/{coupon}/edit', 'edit')->name('edit')->middleware('permission:update-size');
});
// Route::resource('coupons', CouponController::class);
Route::prefix('coupons')->controller(CouponController::class)->name('coupons.')->group(function(){
    Route::get('/', 'index')->name('index')->middleware('permission:show-coupon');
    Route::post('/', 'store')->name('store')->middleware('permission:create-coupon');
    Route::get('/create', 'create')->name('create')->middleware('permission:create-coupon');
    Route::get('/{coupon}', 'show')->name('show')->middleware('permission:show-coupon');
    Route::put('/{coupon}', 'update')->name('update')->middleware('permission:update-coupon');
    Route::delete('/{coupon}', 'destroy')->name('destroy')->middleware('permission:delete-coupon');
    Route::get('/{coupon}/edit', 'edit')->name('edit')->middleware('permission:update-coupon');
});
// Route::resource('suppliers',SupplierController::class);
Route::prefix('suppliers')->controller(SupplierController::class)->name('suppliers.')->group(function(){
    Route::get('/', 'index')->name('index')->middleware('permission:show-supplier');
    Route::post('/', 'store')->name('store')->middleware('permission:create-supplier');
    Route::get('/create', 'create')->name('create')->middleware('permission:create-supplier');
    Route::get('/{coupon}', 'show')->name('show')->middleware('permission:show-supplier');
    Route::put('/{coupon}', 'update')->name('update')->middleware('permission:update-supplier');
    Route::delete('/{coupon}', 'destroy')->name('destroy')->middleware('permission:delete-supplier');
    Route::get('/{coupon}/edit', 'edit')->name('edit')->middleware('permission:update-supplier');
});
// Route::resource('materials',MaterialController::class);
Route::prefix('materials')->controller(MaterialController::class)->name('materials.')->group(function(){
    Route::get('/', 'index')->name('index')->middleware('permission:show-material');
    Route::post('/', 'store')->name('store')->middleware('permission:create-material');
    Route::get('/create', 'create')->name('create')->middleware('permission:create-material');
    Route::get('/{coupon}', 'show')->name('show')->middleware('permission:show-material');
    Route::put('/{coupon}', 'update')->name('update')->middleware('permission:update-material');
    Route::delete('/{coupon}', 'destroy')->name('destroy')->middleware('permission:delete-material');
    Route::get('/{coupon}/edit', 'edit')->name('edit')->middleware('permission:update-material');
});
// Route::resource('imports',ImportMaterialController::class);
Route::prefix('imports')->controller(ImportMaterialController::class)->name('imports.')->group(function(){
    Route::get('/', 'index')->name('index')->middleware('permission:show-import');
    Route::post('/', 'store')->name('store')->middleware('permission:create-import');
    Route::get('/create', 'create')->name('create')->middleware('permission:create-import');
    Route::get('/{coupon}', 'show')->name('show')->middleware('permission:show-import');
    Route::put('/{coupon}', 'update')->name('update')->middleware('permission:update-import');
    Route::delete('/{coupon}', 'destroy')->name('destroy')->middleware('permission:delete-import');
    Route::get('/{coupon}/edit', 'edit')->name('edit')->middleware('permission:update-import');
});
// Route::resource('exports',ExportMaterialController::class);
Route::prefix('exports')->controller(ExportMaterialController::class)->name('exports.')->group(function(){
    Route::get('/', 'index')->name('index')->middleware('permission:show-export');
    Route::post('/', 'store')->name('store')->middleware('permission:create-export');
    Route::get('/create', 'create')->name('create')->middleware('permission:create-export');
    Route::get('/{coupon}', 'show')->name('show')->middleware('permission:show-export');
    Route::put('/{coupon}', 'update')->name('update')->middleware('permission:update-export');
    Route::delete('/{coupon}', 'destroy')->name('destroy')->middleware('permission:delete-export');
    Route::get('/{coupon}/edit', 'edit')->name('edit')->middleware('permission:update-export');
});



Route::get('orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
Route::post('update-status/{id}', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.update_status')->middleware('update-order-status');

});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
