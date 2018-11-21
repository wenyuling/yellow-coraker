<?php

namespace App\Providers;

use Monolog\Logger;
use Yansongda\Pay\Pay;
use Illuminate\Support\ServiceProvider;

/**
 * 支付操作类实例注入到容器中
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 往服务容器中注入一个名为 alipay 的单例对象
        $this->app->singleton('alipay', function () {
            $config               = config('pay.alipay');
            //$config['notify_url'] = route('payment.alipay.notify'); //服务器端回调地址
            $config['notify_url'] = 'http://requestbin.leo108.com/1hhjvfj1'; //服务器端回调地址
            $config['return_url'] = route('payment.alipay.return'); //前端回调地址

            // 判断当前项目运行环境是否为线上环境
            if (app()->environment() !== 'production') {
                //不是线上环境，则启用开发模式
                $config['mode']         = 'dev';
                $config['log']['level'] = Logger::DEBUG;
            } else {
                $config['log']['level'] = Logger::WARNING;
            }
            // 调用 Yansongda\Pay 来创建一个支付宝支付对象
            return Pay::alipay($config);
        });

        $this->app->singleton('wechat_pay', function () {
            $config = config('pay.wechat');
            $config['notify_url'] = 'http://requestbin.fullcontact.com/[http://yellow-croaker.test]';
            if (app()->environment() !== 'production') {
                $config['log']['level'] = Logger::DEBUG;
            } else {
                $config['log']['level'] = Logger::WARNING;
            }
            // 调用 Yansongda\Pay 来创建一个微信支付对象
            return Pay::wechat($config);
        });
    }

}
