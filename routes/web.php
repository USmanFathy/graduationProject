<?php

use App\Http\Controllers\BorrowController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\Front\Auth\TwoFactorAuthController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\front\CheckOutController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PaymentsController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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


//
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});
Route::get('/autocomplete', [ProductController::class, 'autocomplete'])->name('autocomplete');
Route::get('/products/search', [ProductController::class, 'search'])->name('front.products.search');
Route::group(['prefix' => LaravelLocalization::setLocale()], function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');
/////////////////////////////////////////////////////////////////////////////////////////
    Route::middleware(['throttle:50,1','cors'])->group(function () {
        Route::get('/products', [ProductController::class, 'index'])
            ->name('front.products.index');
        Route::get('/products/{product:slug}', [ProductController::class, 'show'])
            ->name('front.products.show');
        Route::get('/products/{category:slug}/filter', [ProductController::class, 'productsFilters'])
            ->name('products_filter');
    });
/////////////////////////////////////////////////////////////////////////////////////////
    Route::resource('cart', CartController::class);
////////////////////////////////////////////////////////////////////////////////////////
    Route::get('/checkout', [CheckOutController::class, 'create'])->name('checkout.index')->middleware(['auth','cors']);
    Route::post('/checkout/store', [CheckOutController::class, 'store'])->name('checkout.store')->middleware(['auth','cors']);
////////////////////////////////////////////////////////////////////////////////////////////////
///
});
/// Borrowing routes
Route::resource('borrowing', BorrowController::class)->except('create')->middleware(['auth','cors']);
Route::get('borrowing/create/{product}', [BorrowController::class, 'create'])->name('borrowing.create');

Route::get('contactus', [ContactUsController::class,'index'])->name('contactus');
Route::post('contactus', [ContactUsController::class,'send'])->name('contactus');



//// payments
Route::get('order/{order}/payments', [PaymentsController::class, 'index'])->name('order.payments.index');
Route::post('order/{order}/stripe/paymentIntent/create', [PaymentsController::class, 'createStripePaymentIntent'])
    ->name('stripe.paymentsIntent.create');
Route::get('order/{order}/pay/stripe/callback', [PaymentsController::class, 'confirm'])
    ->name('stripe.return');

Route::get('order/{order}/test', [PaymentsController::class, 'test'])->name('order.payments.test');






require __DIR__.'/dashboard.php';
//require __DIR__.'/auth.php';



