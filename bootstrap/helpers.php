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

