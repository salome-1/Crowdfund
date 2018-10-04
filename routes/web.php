<?php


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'ProjectController@welcome');

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin', 'AdminController@adminDashboard');
    Route::resource('users', 'adminController');
	Route::resource('projects', 'ProjectController')->only(['create']); //harus admin yang membuat project
	Route::resource('topups', 'TopupController')->only(['index','edit']);
	Route::post('topups/{id}','TopupController@update');
});

// Projects
Route::resource('projects', 'ProjectController')->only(['index', 'show']); // guest bisa melihat list project(index) dan info lengkap dari project(single)

Route::group(['middleware' => ['auth']], function () {
    // Route::get('/admin', 'AdminController@adminDashboard');
	Route::resource('projects', 'ProjectController')->except(['index', 'show', 'create']); // user yang ter-auth bisa memakai fungsi CRUD nya. kecuali user biasa tidak bisa memakain fungsi create
	Route::resource('topups', 'TopupController')->except(['index','edit']);
	Route::get('/transaksi', 'TransaksiController@index');
});



// page yang bisa di lewati user tapi harus pake verifikasi email
// Route::get('profile', function () {
//     return 'dashboard';
// })->middleware('verified');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('refresh_captcha', 'HomeController@refreshCaptcha')->name('refresh_captcha');
