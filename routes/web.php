<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

/*--------------------------------------------------------------------------------- 
Start Route for product 
-----------------------------------------------------------------------------------*/
Route::get('/admin/products',[ProductController::class,'index']);
Route::get('/admin/products/create',[ProductController::class,'create']);
Route::post('/admin/products/submit',[ProductController::class,'store'])->name('products.store');
Route::get('/admin/products/view/{slug}',[ProductController::class,'view']);
Route::get('/admin/products/edit/{slug}',[ProductController::class,'edit']);
Route::post('/admin/products/update',[ProductController::class,'update']);
Route::get('/admin/products/soft-delete/{slug}',[ProductController::class,'soft_delete']);



/*--------------------------------------------------------------------------------- 
End Route for product 
-----------------------------------------------------------------------------------*/

/*--------------------------------------------------------------------------------- 
Start Route for customer 
-----------------------------------------------------------------------------------*/
Route::get('/admin/customers',[CustomerController::class,'index']);
Route::get('/admin/customers/create',[CustomerController::class,'create']);
Route::post('/admin/customers/submit',[CustomerController::class,'store'])->name('customers.store');
Route::get('/admin/customers/view/{slug}',[CustomerController::class,'view']);
Route::get('/admin/customers/edit/{slug}',[CustomerController::class,'edit']);
Route::post('/admin/customers/update',[CustomerController::class,'update']);
Route::get('/admin/customers/soft-delete/{slug}',[CustomerController::class,'soft_delete']);



/*--------------------------------------------------------------------------------- 
End Route for customer 
-----------------------------------------------------------------------------------*/
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
