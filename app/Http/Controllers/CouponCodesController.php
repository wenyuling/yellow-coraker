<?php

namespace App\Http\Controllers;

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
     */
    public function show($code)
    {
        // 判断优惠券是否存在
        if (!$record = CouponCode::where('code', $code)->first()) {
            abort(404);
        }

        // 如果优惠券没有启用，则等同于优惠券不存在
        if (!$record->enabled) {
            abort(404);
        }

        if ($record->total - $record->used <= 0) {
            return response()->json(['msg' => '该优惠券已被兑完'], 403);
        }

        if ($record->not_before && $record->not_before->gt(Carbon::now())) {
            return response()->json(['msg' => '该优惠券现在还不能使用'], 403);
        }

        if ($record->not_after && $record->not_after->lt(Carbon::now())) {
            return response()->json(['msg' => '该优惠券已过期'], 403);
        }

        return $record;
    }
}
