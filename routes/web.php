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
// Sửa đường dẫn trang chủ mặc định
// Route::get('/', 'HocsinhController@index');
// Route::get('/home', 'HocsinhController@index');
 
// Đăng ký thành viên
// Route::get('register', 'Auth\RegisterController@getRegister');
// Route::post('register', 'Auth\RegisterController@postRegister');
 
// // Đăng nhập và xử lý đăng nhập
// Route::get('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
// Route::post('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@postLogin']);
 
// Đăng xuất
// Route::get('logout', [ 'as' => 'logout', 'uses' => 'Auth\LogoutController@getLogout']);

Route::resource('ajaxproducts','ProductAjaxController');
Route::resource('contact','ContactController');
Route::resource('students', 'StudentController');
  
Route::get('/', function () {
    return view('welcome');
});

// Route::get('/test','Logincontroller@getCreat');

// Route::group(['prefix' => 'api'], function () {
//     Route::resource('users', 'UserController');    
// });
// Route::view('/{any}', 'welcome')
//     ->where('any', '.*');

Auth::routes();
Route::resource('user','UserController');

Route::get('/home', 'HomeController@index')->name('home');

