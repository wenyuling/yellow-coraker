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
Route::redirect('/', '/products')->name('root');
Route::get('products', 'ProductsController@index')->name('products.index'); //商品首页列表

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

        Route::post('products/{product}/favorite', 'ProductsController@favor')->name('products.favor'); //收藏
        Route::delete('products/{product}/favorite', 'ProductsController@disfavor')->name('products.disfavor'); //取消收藏
        Route::get('products/favorites', 'ProductsController@favorites')->name('products.favorites'); //收藏商品的列表

        Route::post('cart', 'CartController@add')->name('cart.add'); //添加购物车
        Route::get('cart', 'CartController@index')->name('cart.index'); //查看购物车
        Route::delete('cart/{sku}', 'CartController@remove')->name('cart.remove'); //购物车移除

        Route::post('orders', 'OrdersController@store')->name('orders.store'); //创建订单
        Route::get('orders', 'OrdersController@index')->name('orders.index'); //订单列表页
        Route::get('orders/{order}', 'OrdersController@show')->name('orders.show'); //订单详情

        Route::get('payment/{order}/alipay', 'PaymentController@payByAlipay')->name('payment.alipay'); //订单支付功能 （支付宝）
        Route::get('payment/alipay/return', 'PaymentController@alipayReturn')->name('payment.alipay.return'); //前端回调

        Route::get('payment/{order}/wechat', 'PaymentController@payByWechat')->name('payment.wechat'); //微信支付功能

        Route::post('orders/{order}/received', 'OrdersController@received')->name('orders.received'); //确认收货接口
    });

});

/**
 * 服务器端回调的路由不能放到带有 auth 中间件的路由组中，因为支付宝的服务器请求不会带有认证信息。
 */
Route::post('payment/alipay/notify', 'PaymentController@alipayNotify')->name('payment.alipay.notify'); //支付宝服务端回调
Route::post('payment/wechat/notify', 'PaymentController@wechatNotify')->name('payment.wechat.notify'); //微信服务端回调

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('products/{product}', 'ProductsController@show')->name('products.show'); //商品详情
