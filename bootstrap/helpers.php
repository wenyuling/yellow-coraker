<?php
/**
 * 自定义辅助函数
 *
 * Created by PhpStorm.
 * User: wenyuling
 * Date: 2018/9/14
 * Time: 下午6:00
 */

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

/**
 * ngrok 内网穿透
 * @author: wenyuling(wenyuling10@163.com)
 * @dateTime: 2018/12/11 下午5:47
 * @param $routeName
 * @param array $parameters
 * @return string
 */
function ngrok_url($routeName, $parameters = [])
{
    // 开发环境，并且配置了 NGROK_URL
    if(app()->environment('local') && $url = config('app.ngrok_url')) {
        // route() 函数第三个参数代表是否绝对路径
        return $url.route($routeName, $parameters, false);
    }

    return route($routeName, $parameters);
}

/**
 * 计算精度（即精确到小数点后几位）
 * @author: wenyuling(wenyuling10@163.com)
 * @dateTime: 2018/12/11 下午5:48
 * @param $number
 * @param int $scale
 * @return \Moontoast\Math\BigNumber
 */
function big_number($number, $scale = 2)
{
    // 默认的精度为小数点后两位
    return new \Moontoast\Math\BigNumber($number, $scale);
}



