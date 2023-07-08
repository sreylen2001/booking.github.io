<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//FE
Route::get('/', function () {
    return view('fronts.welcome');
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
    Route::get('user_booking/create','API\BookticketController@create')->name('user_booking.create');
    Route::post('user_booking/save','API\BookticketController@save')->name('user_booking.save');
    
    Route::get('show_bus','API\BookticketController@show_bus')->name('user_booking.bus');
    Route::get('list_user','API\BookticketController@list_bus')->name('user_booking.user');



    //admin_driver
    Route::get('admins_driver','API\DriverController@index')->name('admin.admin_driver');
    Route::get('admins_driver/create','API\DriverController@create')->name('admin_driver.create');
    Route::post('admins_driver/save','API\DriverController@save')->name('admin_driver.save');
    Route::get('admins_driver/edit/{id}','API\DriverController@edit')->name('admin_driver.edit');
    Route::post('admins_driver/update','API\DriverController@update')->name('admin_driver.update');
    Route::get('admins_driver/delete/{id}','API\DriverController@delete')->name('admin_driver.delete');

    //admin_customer
    Route::get('admins_customer','API\CustomerController@index')->name('admin.admin_customer');
    Route::get('admins_customer/create','API\CustomerController@create')->name('admin_customer.create');
    Route::post('admins_customer/save','API\CustomerController@save')->name('admin_customer.save');
    Route::get('admins_customer/edit/{id}','API\CustomerController@edit')->name('admin_customer.edit');
    Route::post('admins_customer/update','API\CustomerController@update')->name('admin_customer.update');
    Route::get('admins_customer/delete/{id}','API\CustomerController@delete')->name('admin_customer.delete');

    //admin_region
    Route::get('admins_region','API\RegionController@index')->name('admin.admin_region');
    Route::get('admins_region/create','API\RegionController@create')->name('admin_region.create');
    Route::post('admins_region/save','API\RegionController@save')->name('admin_region.save');
    Route::get('admins_region/edit/{id}','API\RegionController@edit')->name('admin_region.edit');
    Route::post('admins_region/update','API\RegionController@update')->name('admin_region.update');
    Route::get('admins_region/delete/{id}','API\RegionController@delete')->name('admin_region.delete');

    //admin_destination
    Route::get('admins_destination','API\DestinationController@index')->name('admin.admin_destination');
    Route::get('admins_destination/create','API\DestinationController@create')->name('admin_destination.create');
    Route::post('admins_destination/save','API\DestinationController@save')->name('admin_destination.save');
    Route::get('admins_destination/edit/{id}','API\DestinationController@edit')->name('admin_destination.edit');
    Route::post('admins_destination/update','API\DestinationController@update')->name('admin_destination.update');
    Route::get('admins_destination/delete/{id}','API\DestinationController@delete')->name('admin_destination.delete');

    //admin_schedule
    Route::get('admins_schedule','API\ScheduleController@index')->name('admin.bus_schedule');
    Route::get('admins_schedule/create','API\ScheduleController@create')->name('admin_bus_schedule.create');
    //Route::post('admins_schedule/save','API\ScheduleController@save');
    Route::put('admins_schedule/save','API\ScheduleController@save')->name('admin_bus_schedule.save');
    Route::get('admins_schedule/edit/{id}','API\ScheduleController@edit')->name('admin_bus_schedule.edit');
    Route::post('admins_schedule/update','API\ScheduleController@update')->name('admin_bus_schedule.update');
    Route::get('admins_schedule/delete/{id}','API\ScheduleController@delete')->name('admin_bus_schedule.delete');

    //schedule
    Route::get('/show_region','API\ScheduleController@show_region')->name('admin.bus_schedule.region');
    Route::get('/show_bus','API\ScheduleController@show_bus')->name('admin.bus_schedule.bus');
    Route::get('/show_driver','API\ScheduleController@show_driver')->name('admin.bus_schedule.driver');
    Route::get('/show_destination','API\ScheduleController@show_destination')->name('admin.bus_schedule.destination');

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