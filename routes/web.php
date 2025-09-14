<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TranslatorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\CustomerAuth;
use App\Http\Middleware\fontendMiddleware;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductCommentController;

// Add main comment
Route::post('/product/comment', [ProductCommentController::class, 'store'])->name('product.comment.store')->middleware('auth');

// Add reply
Route::post('/product/comment/reply/{commentId}', [ProductCommentController::class, 'reply'])->name('product.comment.reply')->middleware('auth');

Route::get('', function () {
    return view('fontend.fontend');
});

// Route::get('/', function () {
//     return view('fontend.fontend');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
  Route::get('/admin', [AdminController::class, 'admin']);

  Route::resource('category', CategoryController::class);
  route::get('/category/activate/{id}',[CategoryController::class, 'active'])->name('category.active');
  route::get('/category/deactivate/{id}',[CategoryController::class, 'deactive'])->name('category.deactive');

  Route::resource('product', ProductController::class);
  route::get('/product/activate/{id}',[ProductController::class, 'active'])->name('product.active');
  route::get('/product/deactivate/{id}',[ProductController::class, 'deactive'])->name('product.deactive');

  Route::post('/customer/fontend', [CustomerController::class, 'login'])->name('customer.fontend');
  Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customer/login', [CustomerController::class, 'log'])->name('customer.login');
    Route::get('/customer/reg', [CustomerController::class, 'reg'])->name('customer.reg');

    Route::get('/customer/fontend', [CustomerController::class, 'login'])->name('customer.log');
    Route::post('/customer/logout', [CustomerController::class, 'logout'])->name('customer.logout');


Route::get('/pay', [PaymentController::class, 'pay'])->name('pay.now');
Route::post('/success', [PaymentController::class, 'success']);
Route::post('/fail', [PaymentController::class, 'fail']);
Route::post('/cancel', [PaymentController::class, 'cancel']);



Route::middleware('customer')->group(function () {
Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add.get');
Route::get('/cart/view', [CartController::class, 'cartView'])->name('cart.view');
Route::get('/cart/delete{id}', [CartController::class, 'cartdelete'])->name('cart.delete');
Route::get('/cart/singlecart/{id}', [CartController::class, 'singlecart'])->name('cart.single');
});


  Route::get('/translator', [TranslatorController::class, 'index'])->name('tr.d');
  Route::post('/translator', [TranslatorController::class, 'translate'])->name('translator.translate');

require __DIR__.'/auth.php';
