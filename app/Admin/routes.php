<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index');
    $router->get('users', 'UsersController@index');
    $router->get('products', 'ProductsController@index'); //商品列表
    $router->get('products/create', 'ProductsController@create'); //商品添加
    $router->post('products', 'ProductsController@store'); //商品新增
    $router->get('products/{id}/edit', 'ProductsController@edit'); //商品编辑
    $router->put('products/{id}', 'ProductsController@update');

    $router->get('orders', 'OrdersController@index')->name('admin.orders.index'); //订单列表
    $router->get('orders/{order}', 'OrdersController@show')->name('admin.orders.show'); //订单详情
    $router->post('orders/{order}/ship', 'OrdersController@ship')->name('admin.orders.ship'); //发货功能

    $router->post('orders/{order}/refund', 'OrdersController@handleRefund')->name('admin.orders.handle_refund'); //处理退款

    $router->get('coupon_codes', 'CouponCodesController@index'); //优惠券类别

});
