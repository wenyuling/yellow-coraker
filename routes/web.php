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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'PagesController@root')->name('root');

# 用户点击登录按钮时请求的地址
Route::get('auth/weixin', 'WeixinController@redirectToProvider');
# 微信接口回调地址
Route::get('auth/weixin/callback', 'WeixinController@handleProviderCallback');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/email_verify_notice', 'PagesController@emailVerifyNotice')->name('email_verify_notice');
    Route::get('/email_verification/verify', 'EmailVerificationController@verify')->name('email_verification.verify'); //验证激活邮箱
    Route::get('/email_verification/send', 'EmailVerificationController@send')->name('email_verification.send'); //手动发送激活邮件

    Route::group(['middleware' => 'email_verified'], function() {
        Route::get('user_addresses', 'UserAddressesController@index')->name('user_addresses.index');
        Route::get('user_addresses/create', 'UserAddressesController@create')->name('user_addresses.create');
        Route::post('user_addresses', 'UserAddressesController@store')->name('user_addresses.store'); //新增收货地址
        Route::get('user_addresses/{user_address}', 'UserAddressesController@edit')->name('user_addresses.edit'); //修改收货地址
        Route::put('user_addresses/{user_address}', 'UserAddressesController@update')->name('user_addresses.update'); //更新
        Route::delete('user_addresses/{user_address}', 'UserAddressesController@destroy')->name('user_addresses.destroy');
    });

    Route::redirect('/', '/products')->name('root');
    Route::get('products', 'ProductsController@index')->name('products.index'); //商品首页列表

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
