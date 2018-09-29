<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class WeixinController extends Controller
{
    public function __construct()
    {

    }

    public function redirectToProvider(Request $request)
    {
        $redirect_url = config("services.weixinweb.redirect");
        dd($redirect_url);

        return Socialite::with('weixinweb')->redirect($redirect_url);
    }

    public function handleProviderCallback(Request $request)
    {
        $user_data = Socialite::with('weixinweb')->user();
        dd($user_data);
        //todo whatever
    }


}
