<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//FE
// Route::get('/', function () {
//     return view('fronts.welcome');
// });

Route::get('/', function () {
    return view('auth.admin_login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/bus', [App\Http\Controllers\HomeController::class, 'bus'])->name('bus');
Route::get('/hotel', [App\Http\Controllers\HomeController::class, 'hotel'])->name('hotel');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

Route::prefix('user')->group(function () {
    Route::get('register', 'Auth\RegisterController@index')->name('user.register');
    // Route::get('/send-email', [MailController::class, 'sendEmail']);
    Route::post('register/save', 'Auth\RegisterController@save')->name('user.register.save');
    Route::get('verify', 'Auth\RegisterController@verify')->name('user.register.verify');
    Route::post('verify/save', 'Auth\RegisterController@verify_save')->name('user.verify.save');
    Route::get('login', 'Auth\LoginController@login')->name('user.login');
    Route::get('logout', 'Auth\LoginController@logout')->name('user.logout');
    Route::post('login/credentials', 'Auth\LoginController@credentials')->name('user.credentials');


});

//Admin
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        if(auth()->guard('admin')->check()){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('admin.login');
        }
    });
    
    Route::get('login', function () {
        return view('auth.admin_login');
    });
    Route::post('login', 'Auth\LoginController@admin_login')->name('admin.login');
    Route::get('logout', 'Auth\LoginController@admin_logout')->name('admin.logout');
    Route::get('dashboard', 'Admin\DashboardController@dashboard')->name('admin.dashboard');
    
    //admin_user
    Route::get('admins_user','Admin\UserController@index')->name('admin.admin_user');
    Route::get('admins_user/edit/{id}','Admin\UserController@edit')->name('admin_user.edit');
    Route::post('admins_user/update','Admin\UserController@update')->name('admin_user.update');
    Route::get('admins_user/delete/{id}','Admin\UserController@delete')->name('admin_user.delete');
    Route::get('/search/user','Admin\UserController@search')->name('search.user');

    //role management
    Route::get('user_role','Admin\RoleController@index')->name('admin.user_role');
    Route::get('user_role/edit/{id}','Admin\RoleController@edit')->name('user_role.edit');
    Route::post('user_role/update','Admin\RoleController@update')->name('user_role.update');

    //admin_bus
    Route::get('/show_user','API\BusController@show_user')->name('admin.user');

    Route::get('admins_bus','API\BusController@index')->name('admin.admin_bus');
    Route::get('admins_bus/create','API\BusController@create')->name('admin_bus.create');
    Route::post('admins_bus/save','API\BusController@save')->name('admin_bus.save');
    Route::get('admins_bus/edit/{id}','API\BusController@edit')->name('admin_bus.edit');
    Route::post('admins_bus/update','API\BusController@update')->name('admin_bus.update');
    Route::get('admins_bus/delete/{id}','API\BusController@delete')->name('admin_bus.delete');

    //admin_busticket
    Route::get('user_ticket', 'API\TicketController@index')->name('admin.user_ticket');
    Route::get('user_ticket/create','API\TicketController@create')->name('user_ticket.create');
    Route::post('user_ticket/save','API\TicketController@save')->name('user_ticket.save');
    Route::get('user_ticket/edit/{id}','API\TicketController@edit')->name('user_ticket.edit');
    Route::post('user_ticket/update','API\TicketController@update')->name('user_ticket.update');
    Route::get('user_ticket/delete/{id}','API\TicketController@delete')->name('user_ticket.delete');
    Route::get('list_bus','API\TicketController@list_bus')->name('user_ticket.bus');

    //admin_booking
    Route::get('user_booking', 'API\BookticketController@index')->name('admin.user_booking');
    Route::get('user_booking/create','API\BookticketController@booking')->name('user_booking.create');
    Route::post('user_booking/save','API\BookticketController@save')->name('user_booking.save');
    
    Route::get('show_bus','API\BookticketController@show_bus')->name('user_booking.bus');
    Route::get('list_user','API\BookticketController@list_bus')->name('user_booking.user');


    //booking
    Route::get('/list_customer','API\BookbusController@list_customer')->name('admin.bookbus.customer');
    Route::get('/list_schedule','API\BookbusController@list_schedule')->name('admin.bookbus.schedule');
    

    // admin_booking
    Route::get('admins_booking', 'API\BookbusController@index')->name('admin.admin_bookbus');
    Route::get('admins_booking/create','API\BookbusController@create')->name('admin_bookbus.create');
    Route::put('admins_booking/save','API\BookbusController@save')->name('admin_bookbus.save');
    Route::get('admins_booking/edit/{id}','API\BookbusController@edit')->name('admin_bookbus.edit');
    Route::post('admins_booking/update','API\BookbusController@update')->name('admin_bookbus.update');
    Route::get('admins_booking/delete/{id}','API\BookbusController@delete')->name('admin_bookbus.delete');

});