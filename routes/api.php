<?php

use App\Http\Controllers\API\BusController;
use App\Http\Controllers\Endpoint\EpBookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ApiDriverController;
use App\Http\Controllers\API\ApiCustomerController;
use App\Http\Controllers\API\ApiRegionController;
use App\Http\Controllers\API\ApiDestinationController;
use App\Http\Controllers\API\ApiBookbusController;
use App\Http\Controllers\API\StripeController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\Endpoint\EpRoleController;
use App\Http\Controllers\Endpoint\EpBusController;
use App\Http\Controllers\Endpoint\EpBusTicketController;
use App\Http\Controllers\StripePaymentController;

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

Route::group([
    'middleware'=> ['api']
], function(){
    Route::group([
        'prefix' => 'users'
    ], function()
    {
        //Auth
        Route::post('login', [AuthController::class, 'login']);
        Route::post('admin/login', [AuthController::class, 'adminLogin']);

        Route::post('register', [AuthController::class, 'register']);
        Route::post('request-reset-password', [PasswordResetController::class, 'send_reset_email_password']);
        Route::post('reset-password/{token}', [PasswordResetController::class, 'resetPassword']);
        //List Information
        Route::get('roles', [EpRoleController::class, 'list']);
        Route::get('role/detail/{id}', [EpRoleController::class, 'detail']);

        Route::post('stripe', [StripeController::class, 'payment']);
// Route::get('check', [StripePaymentController::class, 'getData']);

        Route::middleware(['auth:sanctum'])->group(function(){

            //User getBookingHistory
            Route::get('user', [AuthController::class, 'getUser']);

            //Bus Information
            Route::post('bus/create', [EpBusController::class, 'create']);
            Route::get('bus/detail/{id}', [EpBusController::class, 'detail']);
            Route::get('bus/list', [EpBusController::class, 'list']);
            Route::get('bus-available', [EpBusController::class, 'busAllAvailable']);
            Route::get('bus/available', [EpBusController::class, 'searchBusFromTo']);

            //Bus ticket Information
            Route::post('ticket/create', [EpBusTicketController::class, 'create']);
            Route::get('ticket/detail/{id}', [EpBusTicketController::class, 'detail']);
            Route::get('ticket/list', [EpBusTicketController::class, 'list']);

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
//            Route::post('booking/create', [ApiBookbusController::class, 'create']);
//            Route::get('booking/detail/{id}', [ApiBookbusController::class, 'detail']);
//            Route::get('booking/list', [ApiBookbusController::class, 'list']);
            Route::post('booking', [EpBookingController::class, 'booking']);
            Route::get('booking-history', [EpBookingController::class, 'getBookingHistory']);
            Route::get('booking-all-user-history', [EpBookingController::class, 'getAllUserBookingHistory']);

            //Payment
            //Route::post('stripe', [StripeController::class, 'payment']);
            //Route::get('check', [StripePaymentController::class, 'getData']);


            Route::get('profile', [AuthController::class, 'profile']);
            Route::post('/profile/change-password', [AuthController::class, 'change_password']);
            Route::patch('/profile/update-profile', [AuthController::class, 'updateProfile']);
            Route::post('logout', [AuthController::class, 'logout']);

        });

    });
});
