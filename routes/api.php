<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\common\HelpController;
use App\Http\Controllers\api\TokenController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['namespace' => 'API'], function () {
    Route::get('/',[TokenController::class, 'index']);
    Route::group(['middleware' => 'auth.token'],function () {
        Route::prefix('product')->group(function () {
            Route::post('/sold',[ProductController::class, 'update']);
            Route::post('/variant',[ProductController::class, 'getTopVariant']);
            Route::post('/create',[ProductController::class, 'store']);
        });
        Route::prefix('seller')->group(function () {
            Route::get('/',[UserController::class, 'index']);
            Route::get('/show',[UserController::class, 'show']);
        });
});
});
