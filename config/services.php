<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'weixinweb' => [
        'client_id'     => env('WEIXIN_KEY', 'wx027d7c0a1f14a06c'),
        'client_secret' => env('WEIXIN_SECRET', '47d1803b34b09cacec20b0f213396ec0'),
        'redirect'      => env('WEIXIN_REDIRECT_URI' ,'http://yellow-croaker.test/auth/weixin/callback'),

        # 这一行配置非常重要，必须要写成这个地址。
//        'auth_base_uri' => 'https://open.weixin.qq.com/connect/qrconnect',
    ],

];
