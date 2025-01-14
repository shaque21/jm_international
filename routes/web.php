<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;

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
Start Route for warehouses 
-----------------------------------------------------------------------------------*/
Route::get('/admin/warehouses',[WarehouseController::class,'index']);
Route::get('/admin/warehouses/create',[WarehouseController::class,'create']);
Route::post('/admin/warehouses/submit',[WarehouseController::class,'store'])->name('products.store');
Route::get('/admin/warehouses/view/{slug}',[WarehouseController::class,'view']);
Route::get('/admin/warehouses/edit/{slug}',[WarehouseController::class,'edit']);
Route::post('/admin/warehouses/update',[WarehouseController::class,'update']);
Route::get('/admin/warehouses/soft-delete/{slug}',[WarehouseController::class,'soft_delete']);



/*--------------------------------------------------------------------------------- 
End Route for warehouses 
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
/*--------------------------------------------------------------------------------- 
Start Route for Supplier 
-----------------------------------------------------------------------------------*/
Route::get('/admin/suppliers',[SupplierController::class,'index']);
Route::get('/admin/suppliers/create',[SupplierController::class,'create']);
Route::post('/admin/suppliers/submit',[SupplierController::class,'store'])->name('customers.store');
Route::get('/admin/suppliers/view/{slug}',[SupplierController::class,'view']);
Route::get('/admin/suppliers/edit/{slug}',[SupplierController::class,'edit']);
Route::post('/admin/suppliers/update',[SupplierController::class,'update']);
Route::get('/admin/suppliers/soft-delete/{slug}',[SupplierController::class,'soft_delete']);



/*--------------------------------------------------------------------------------- 
End Route for Supplier 
-----------------------------------------------------------------------------------*/

/*------------------------------------------------------------------------------------------
Start Route for users
--------------------------------------------------------------------------------------------*/

    Route::get('/admin/users',[UserController::class,'index']);
    Route::get('/admin/users/add',[UserController::class,'add']);
    Route::get('/admin/users/view/{slug}',[UserController::class,'view']);
    Route::get('/admin/users/edit/{slug}',[UserController::class,'edit']);
    Route::post('/admin/users/update',[UserController::class,'update']);
    Route::get('/admin/users/soft-delete/{slug}',[UserController::class,'soft_delete']);
    Route::post('/admin/users/submit',[UserController::class,'insert']);
    Route::get('/admin/restore/users',[UserController::class,'trash_user']);
    Route::get('/admin/restore/users/{slug}',[UserController::class,'restore_user']);
    Route::get('/admin/restore/users/delete/{slug}',[UserController::class,'destroy']);
/*------------------------------------------------------------------------------------------
End Route for users
--------------------------------------------------------------------------------------------*/

/*------------------------------------------------------------------------------------------
Start Route for profile
--------------------------------------------------------------------------------------------*/
Route::get('/admin/profile/user_profile/{slug}',[UserController::class,'user_profile']);
Route::get('/admin/profile/edit_user_password/{slug}',[UserController::class,'edit_user_password']);
Route::get('/admin/profile/edit_user_profile/{slug}',[UserController::class,'edit_user_profile']);
Route::post('/admin/profile/profile_update',[UserController::class,'profile_update']);
Route::post('/admin/profile/password_update',[UserController::class,'password_update']);

/*------------------------------------------------------------------------------------------
End Route for profile
--------------------------------------------------------------------------------------------*/


Route::get('/admin/dashboard', function () {
    return view('admin.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
