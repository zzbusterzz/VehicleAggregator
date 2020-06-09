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
    return view('welcome');
  //return view('customer.create');
});

Route::view('/login', 'login.login')->name('login');;
Route::post('/loginme', 'LoginController@login');
Route::post('/registerBooking', 'BookingsController@bookservice');
Route::post('/login', 'LoginController@login')->name('login');
Route::post('/login', 'LoginController@logout')->name('logout');

Route::resource('customer', 'CustomerController');

Route::view('/register', 'customer.register')->name('register');
Route::post('/register', 'CustomerController@login')->name('register');


Route::post('/updateprofile', 'CustomerController@updateUserProfile')->name('updateprofile');
Route::post('/updatepassword', 'CustomerController@updateUserPassword')->name('updatepassword');

Route::view('/type', 'accountType');
Route::post('/type', 'TypeController@login')->name('accountType');

Route::view('customerdashboard', 'customer.dashboard')->name('customerdashboard');
Route::view('customerbookservice', 'customer.bookservice')->name('customerbookservice');
Route::view('customershowbookings', 'customer.showcompletedbookings')->name('customershowbookings');
Route::view('customerplaceorder', 'customer.placeorder')->name('customerplaceorder');

Route::view('customerprofile', 'customer.customerprofile')->name('customerprofile');
Route::view('customerchangepassword', 'customer.customerchangepassword')->name('customerchangepassword');


Route::view('vendordashboard', 'vendor.dashboard')->name('vendordashboard');

Route::view('spdashboard', 'serviceprovider.dashboard')->name('spdashboard');
Route::view('pendingrequests', 'serviceprovider.pendingrequests')->name('pendingrequests');
Route::view('completedrequests', 'serviceprovider.completedrequests')->name('completedrequests');
ROute::view('addshop', 'serviceprovider.AddShop')->name('addshop');

Route::get('/getStates/{service}','BookingsController@fetchStates');
Route::get('/getCities/{service}/{state}','BookingsController@fetchCities');
Route::get('/getLocations/{service}/{state}/{cities}','BookingsController@fetchServiceProviders');

Route::get('/getBrandnames','BookingsController@fetchBrands');
Route::get('/getBrandmodels/{brandName}','BookingsController@fetchModels');

Route::get('/getBrandmodelsAndsub/{brandid}','BookingsController@fetchBrandsAndModel');
Route::get('/getLocationOnID/{locID}','BookingsController@fetchLocationOnID');
Route::get('/getServiceOnID/{service_id}','BookingsController@fetchServiceOnID');


Route::get('/type', function () {
    return view('userType');
});

Route::get('/admin', function () {
    return view('Administrator/AdminLogin');
});
Route::view('AdminDashboard', 'Administrator.AdminDashboard')->name('AdminDashboard');
Route::view('UserData', 'Administrator.UserData')->name('UserData');
Route::view('Confirmation', 'Administrator.Confirmation')->name('Confirmation');


Route::post('/adminSignin', 'AdminController@adminSignin');


Route::get('/adminSignin', function () {
    return view('login/adminLogin');
});

Route::resource('serviceprovider', 'ShopController');

Route::get('view-records','AdminDatabaseController@index');
