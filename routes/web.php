<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\AuthController as UserAuthController;
use App\Http\Controllers\admin\AuthController as AdminAuthController;
use App\Http\Controllers\user\DashboardController as UserDashboardController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\user\PaymentController as UserPaymentController;
use App\Http\Controllers\admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\user\UserProfileController;
use App\Http\Controllers\admin\AdminProfileController;
use App\Http\Controllers\admin\seller\SellerController;
use App\Http\Controllers\user\ProductController;
use App\Http\Controllers\admin\product\ProductController as AdminProductController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\common\HelpController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('/', UserAuthController::class,  ['names' => 'userAuth']);
Route::post('login',[ UserAuthController::class, 'login'])->name('userLogin');
Route::get('verifyAccount/{token}',[ UserAuthController::class, 'verify'])->name('verifyAccount');
Route::get('forgot',[ UserAuthController::class, 'forgot'])->name('forgot');
Route::get('changePassword/{token}',[ UserAuthController::class, 'changePassword'])->name('changePassword');
Route::post('resetPassword',[ UserAuthController::class, 'resetPassword'])->name('resetPassword');
Route::post('userForgot',[ UserAuthController::class, 'userForgot'])->name('userForgot');

Route::group(['prefix' => 'seller', 'middleware' => 'auth.user'], function(){
    Route::resource('/', UserDashboardController::class, ['names' => 'userDashboard']);
    Route::get('/logout',[UserAuthController::class, 'logout'])->name('logout');
    Route::get('/profile',[UserProfileController::class, 'index'])->name('userProfile');
    Route::post('/updateProfile',[UserProfileController::class, 'update'])->name('updateProfile');
    Route::get('/support',[HelpController::class, 'index'])->name('userHelp');
    Route::get('/create-support',[HelpController::class, 'help'])->name('createUserHelp');
    Route::post('/helpStore',[HelpController::class, 'store'])->name('helpStore');
    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('productList');
        Route::get('/createItem/{id}', [ProductController::class, 'create'])->name('createItem');
        Route::post('/storeItem', [ProductController::class, 'store'])->name('storeItem');
        Route::post('/updateItem', [ProductController::class, 'update'])->name('updateItem');
        Route::get('/listItem', [ProductController::class, 'list'])->name('listItem');  
        Route::get('/show/{id}', [ProductController::class, 'show'])->name('productShow');  
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('productEdit');  
        Route::post('/update', [ProductController::class, 'update'])->name('productUpdate'); 
        Route::get('/searchProduct', [ProductController::class, 'search'])->name('searchProduct'); 
    });
    Route::prefix('payment')->group(function () {
        Route::get('/',[UserPaymentController::class, 'show'])->name('userPayment');
        Route::get('/withdraw',[UserPaymentController::class, 'withdraw'])->name('withdraw');
        Route::post('/withdraw/amount',[UserPaymentController::class, 'withdrawAmount'])->name('withdrawAmount');
        
    });
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth.admin'],function () {
    // Route::get('/',[AdminAuthController::class, 'login'])->name('adminLoginView');
    // Route::post('/login',[AdminAuthController::class, 'adminLogin'])->name('adminLogin');
    // Route::middleware(['auth.admin'])->group(function () {
        Route::get('/logout',[AdminAuthController::class, 'logout'])->name('adminLogout');
        Route::resource('/dashboard', AdminDashboardController::class, ['names' => 'adminDashboard']);
        Route::get('/profile',[AdminProfileController::class, 'index'])->name('adminProfile');
        Route::post('/updateProfile',[AdminProfileController::class, 'update'])->name('updateAdminProfile');
        Route::get('/tickets',[HelpController::class, 'tickets'])->name('tickets');
        Route::get('/ticketStatus',[HelpController::class, 'ticketStatus'])->name('ticketStatus');
        Route::get('/tickets/{id}',[HelpController::class, 'destroy'])->name('ticketsDelete');
        Route::get('/manageUsers',[UsersController::class, 'index'])->name('manageUsers');
        Route::get('/changeUserStatus',[UsersController::class, 'changeUserStatus'])->name('changeUserStatus');
        Route::get('/userEdit/{id}',[UsersController::class, 'edit'])->name('userEdit');
        Route::post('/updateUser/{id}',[UsersController::class, 'update'])->name('updateUser');
        Route::get('/userCreate',[UsersController::class, 'create'])->name('userCreate');
        Route::post('/userStore',[UsersController::class, 'store'])->name('userStore');
        Route::prefix('seller')->group(function () {
            Route::get('/',[SellerController::class, 'index'])->name('seller');
            Route::get('/userProducts/{id}',[SellerController::class, 'show'])->name('userProducts');
            Route::get('/userProductDelete/{id}',[SellerController::class, 'destroy'])->name('userProductDelete');
            Route::get('/productStatus/{id}/{status}/{note}',[SellerController::class, 'productStatus'])->name('productStatus');
        });
        Route::prefix('payment')->group(function () {
            Route::get('/',[adminPaymentController::class, 'index'])->name('adminPayment');
            Route::get('/transaction/{id}',[adminPaymentController::class, 'show'])->name('userTransaction');
            Route::get('/paid',[adminPaymentController::class, 'paid'])->name('paidPayments');
            
        });
        Route::prefix('product')->group(function () {
            Route::get('/',[AdminProductController::class ,'index'])->name('adminProducts');
            Route::get('/variant/{id}',[AdminProductController::class ,'show'])->name('adminProductVariants');
            Route::get('/variant/items/{id}/{variant}',[AdminProductController::class ,'items'])->name('adminVariants');
            
        });
    // });
});

Route::fallback(function () {
    return redirect()->route('userAuth.index')->with('error','Wrong Request');
});
