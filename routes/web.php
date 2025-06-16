<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return redirect()->route('product.index');
})->name('home')->middleware('auth');

Route::resource('product', ProductController::class)->middleware('auth');
Route::get('/login', function() {
    return view('auth.login');
})->name('login');
Route::get('/register', function() {
    return view('auth.register');
})->name('register');
Route::post('/register-user', [UserController::class, 'register'])->name('register-user');
Route::post('/login-user', [UserController::class, 'login'])->name('login-user');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/user/topup', [UserController::class, 'showTopUpForm'])->name('user.topup')->middleware('auth');
Route::post('/user/topup', [UserController::class, 'topUp'])->name('user.topup.process')->middleware('auth');
Route::get('/book/{product}', [ProductController::class, 'show'])->name('product.show')->middleware('auth');

Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::post('/product/buy/{id}', [CartController::class, 'buy'])->name('product.buy')->middleware('auth');
Route::get('/cart', [CartController::class, 'view'])->name('cart.view')->middleware('auth');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove')->middleware('auth');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');
Route::get('/invoices', [CartController::class, 'invoices'])->name('cart.invoices')->middleware('auth');


Route::get('/user/home', function () {
    $products = Product::all();
    return view('user.home', compact('products'));
})->name('user.home')->middleware('auth');

Route::get('/admin/home', function () {
    $products = Product::all();
    return view('admin.home', compact('products'));
})->name('admin.home')->middleware('auth');

Route::get('/guest', function () {
    $products = Product::all();
    return view('guest.home', compact('products'));
})->name('guest.home');
