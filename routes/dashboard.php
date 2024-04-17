<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\BorrowDashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\CategoryImportController;
use App\Http\Controllers\Dashboard\DashboardConroller;
use App\Http\Controllers\Dashboard\OrdersDashboardController;
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
    Route::post('/categories/{category}/Feature' , [CategoriesController::class , 'enableFeature'])->name('categories.feature');
    Route::post('/categories/{category}/Disable-Feature' , [CategoriesController::class , 'disableFeature'])->name('categories.disable-feature');
    Route::post('/categories/import' , [CategoryImportController::class ,'import'])->name('categories.import');
    Route::delete('/categories/{category}/force-delete' , [CategoriesController::class , 'force_delete'])->name('categories.force-delete');
    Route::resource('categories' , CategoriesController::class);
    ///////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////Products////////////////////////////////////////
    Route::get('/products/trash' , [ProductController::class , 'trash'])->name('products.trash');
    Route::post('/products/import' , [ProductController::class ,'import'])->name('products.import');
    Route::post('/products/{product}/Feature' , [ProductController::class, 'enableFeature'])->name('products.feature');
    Route::post('/products/{product}/Disable-Feature' , [ProductController::class , 'disableFeature'])->name('products.disable-feature');
    Route::put('/products/{product}/restore' , [ProductController::class , 'restore'])->name('products.restore');
    Route::delete('/products/{category}/force-delete' , [ProductController::class , 'force_delete'])->name('products.force-delete');
    Route::resource('products' , ProductController::class);
    /////////////////////////////////Profile /////////////////////////////////////////
    Route::get('/profile' ,[ProfileController::class ,'edit'])->name('dashboard.profile.edit');
    Route::patch('/profile' ,[ProfileController::class ,'update'])->name('dashboard.profile.update');

    Route::resource('orders' , OrdersDashboardController::class);
    Route::post('borrows/approve/{borrow}',[BorrowDashboardController::class,'approve'])->name('borrows.approve');
    Route::post('borrows/reject/{borrow}',[BorrowDashboardController::class,'reject'])->name('borrows.reject');
    Route::resource('borrows' , BorrowDashboardController::class);

    Route::resource('/roles', RoleController::class);
    Route::resource('/admins', AdminController::class);
});
