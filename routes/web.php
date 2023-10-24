<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\SizeController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\client\CartController;
use App\Http\Controllers\client\HomeController;
use App\Http\Controllers\client\ProductController as ClientProductController;
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

});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
