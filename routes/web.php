<?php

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

Route::get('/', function () {//Default route to login
    return view('login.login');
  //return view('customer.create');
});

Route::post('/loginme', 'LoginController@login');
Route::resource('customer', 'CustomerController');

Route::view('/login', 'login.login');
Route::view('/register', 'customer.create');

Route::view('/dashboard', 'dashboard');

Route::get('/getStates','BookingsController@fetchStates');
Route::get('/getCities/{state}','BookingsController@fetchCities');
Route::get('/getLocations/{state}/{cities}','BookingsController@fetchServiceProviders');