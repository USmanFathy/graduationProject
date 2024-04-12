<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\BorrowDashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardConroller;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\RoleController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware'=> ['auth:admin','cors'],
    'prefix'    => 'admin/dashboard'
] , function (){
    Route::get('/' , [DashboardConroller::class , 'index'])->name('dashboard');
    /////////////////////////////////////Categories////////////////////////////////////
    Route::get('/categories/trash' , [CategoriesController::class , 'trash'])->name('categories.trash');
    Route::put('/categories/{category}/restore' , [CategoriesController::class , 'restore'])->name('categories.restore');
    Route::delete('/categories/{category}/force-delete' , [CategoriesController::class , 'force_delete'])->name('categories.force-delete');
    Route::resource('categories' , CategoriesController::class);
    ///////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////Products////////////////////////////////////////
    Route::get('/products/trash' , [CategoriesController::class , 'trash'])->name('products.trash');
    Route::put('/products/{category}/restore' , [CategoriesController::class , 'restore'])->name('products.restore');
    Route::delete('/products/{category}/force-delete' , [CategoriesController::class , 'force_delete'])->name('products.force-delete');
    Route::resource('products' , ProductController::class);
    /////////////////////////////////Profile /////////////////////////////////////////
    Route::get('/profile' ,[ProfileController::class ,'edit'])->name('dashboard.profile.edit');
    Route::patch('/profile' ,[ProfileController::class ,'update'])->name('dashboard.profile.update');

    Route::resource('orders' , ProductController::class);
    Route::post('borrows/approve/{borrow}',[BorrowDashboardController::class,'approve'])->name('borrows.approve');
    Route::post('borrows/reject/{borrow}',[BorrowDashboardController::class,'reject'])->name('borrows.reject');
    Route::resource('borrows' , BorrowDashboardController::class);

    Route::resource('/roles', RoleController::class);
    Route::resource('/admins', AdminController::class);
});
