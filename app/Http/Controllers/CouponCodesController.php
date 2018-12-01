<?php

namespace App\Http\Controllers;

use App\Exceptions\CouponCodeUnavailableException;
use Illuminate\Http\Request;
use App\Models\CouponCode;
use Carbon\Carbon;

class CouponCodesController extends Controller
{
    /**
     * 用户在购物车界面上输入优惠券并检查是否有效
     *
     * @author: wenyuling(wenyuling10@163.com)
     * @dateTime: 2018/11/30 下午3:36
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     * @throws CouponCodeUnavailableException
     */
    public function show($code, Request $request)
    {
        // 判断优惠券是否存在
        if (!$record = CouponCode::where('code', $code)->first()) {
            throw new CouponCodeUnavailableException('优惠券不存在');
        }

        //调用检查优惠券是否可用接口
        $record->checkAvailable($request->user());

        return $record;
    }
}
