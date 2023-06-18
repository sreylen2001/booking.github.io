<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ApiBusController;
use App\Http\Controllers\API\ApiDriverController;
use App\Http\Controllers\API\ApiCustomerController;
use App\Http\Controllers\API\ApiRegionController;
use App\Http\Controllers\API\ApiDestinationController;
use App\Http\Controllers\API\ApiBookbusController;
use App\Http\Controllers\PasswordResetController;

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

//


//Auth
Route::post('login', [AuthController::class, 'login']);
Route::post('admin/login', [AuthController::class, 'adminLogin']);

Route::post('register', [AuthController::class, 'register']);
Route::post('request-reset-password', [PasswordResetController::class, 'send_reset_email_password']);
Route::post('reset-password/{token}', [PasswordResetController::class, 'resetPassword']);

Route::middleware(['auth:sanctum'])->group(function(){
    //Bus Information
    Route::get('bus/detail/{id}', [ApiBusController::class, 'detail']);
    Route::get('bus/list', [ApiBusController::class, 'list']);

    //Driver Information
    Route::get('driver/detail/{id}', [ApiDriverController::class, 'detail']);
    Route::get('driver/list', [ApiDriverController::class, 'list']);

    //Customer Information
    Route::post('customer/create', [ApiCustomerController::class, 'create']);
    Route::get('customer/detail/{id}', [ApiCustomerController::class, 'detail']);
    Route::get('customer/list', [ApiCustomerController::class, 'list']);

    //Region Information
    Route::get('region/detail/{id}', [ApiRegionController::class, 'detail']);
    Route::get('region/list', [ApiRegionController::class, 'list']);

    //Destination Information
    Route::get('destination/detail/{id}', [ApiDestinationController::class, 'detail']);
    Route::get('destination/list', [ApiDestinationController::class, 'list']);

    //Booking
    Route::post('booking/create', [ApiBookbusController::class, 'create']);
    Route::get('booking/detail/{id}', [ApiBookbusController::class, 'detail']);
    Route::get('booking/list', [ApiBookbusController::class, 'list']);

    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('/profile/change-password', [AuthController::class, 'change_password']);
    Route::post('/profile/update-profile', [AuthController::class, 'updateProfile']);
    Route::post('logout', [AuthController::class, 'logout']);
    
});
