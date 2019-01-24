<?php

namespace App\Models;

use Carbon\Carbon;
use App\Exceptions\CouponCodeUnavailableException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CouponCode extends Model
{
    // 用常量的方式定义支持的优惠券类型
    const TYPE_FIXED = 'fixed';
    const TYPE_PERCENT = 'percent';

    public static $typeMap = [
        self::TYPE_FIXED   => '固定金额',
        self::TYPE_PERCENT => '比例',
    ];

    protected $fillable = [
        'name',
        'code',
        'type',
        'value',
        'total',
        'used',
        'min_amount',
        'not_before',
        'not_after',
        'enabled',
    ];
    protected $casts = [
        'enabled' => 'boolean',
    ];
    // 指明这两个字段是日期类型
    protected $dates = ['not_before', 'not_after'];

    protected $appends = ['description'];

    /**
     * 类型、 折扣 和 最低金额 三个字段可以用更友好的形式输出，比如 满 100 减 50，已用 和 总量 可以用 10 / 1000 这样的形式
     *
     * @author: wenyuling(wenyuling10@163.com)
     * @dateTime: 2018/11/30 下午2:52
     * @return string
     */
    public function getDescriptionAttribute()
    {
        $str = '';

        if ($this->min_amount > 0) {
            $str = '满'.str_replace('.00', '', $this->min_amount);
        }
        if ($this->type === self::TYPE_PERCENT) {
            return $str.'优惠'.str_replace('.00', '', $this->value).'%';
        }

        return $str.'减'.str_replace('.00', '', $this->value);
    }

    /**
     * 生成优惠券
     * @author: wenyuling(wenyuling10@163.com)
     * @dateTime: 2018/11/30 下午2:37
     * @param int $length
     * @return string
     */
    public static function findAvailableCode($length = 16)
    {
        do {
            // 生成一个指定长度的随机字符串，并转成大写
            $code = strtoupper(Str::random($length));
            // 如果生成的码已存在就继续循环
        } while (self::query()->where('code', $code)->exists());

        return $code;
    }

    /**
     * 检查优惠券是否可用
     * @author: wenyuling(wenyuling10@163.com)
     * @dateTime: 2018/11/30 下午4:34
     * @param null $orderAmount
     * @throws CouponCodeUnavailableException
     */
    public function checkAvailable(User $user, $orderAmount = null)
    {
        if (!$this->enabled) {
            throw new CouponCodeUnavailableException('优惠券不存在');
        }

        if ($this->total - $this->used <= 0) {
            throw new CouponCodeUnavailableException('该优惠券已被兑完');
        }

        if ($this->not_before && $this->not_before->gt(Carbon::now())) {
            throw new CouponCodeUnavailableException('该优惠券现在还不能使用');
        }

        if ($this->not_after && $this->not_after->lt(Carbon::now())) {
            throw new CouponCodeUnavailableException('该优惠券已过期');
        }

        if (!is_null($orderAmount) && $orderAmount < $this->min_amount) {
            throw new CouponCodeUnavailableException('订单金额不满足该优惠券最低金额');
        }

        /**
         * 通常来说一张优惠券对每一个用户来说只能使用一次
         * 有关联了此优惠券的未付款且未关闭订单或者已付款且未退款成功订单
         * 查询构造器最终生成的 SQL 类似：
         * select * from orders where user_id = xx and coupon_code_id = xx
         * and (
         * ( paid_at is null and closed = 0 )
         * or ( paid_at is not null and refund_status != 'success' )
         * )
         */
        $used = Order::where('user_id', $user->id)
            ->where('coupon_code_id', $this->id)
            ->where(function($query) {
                $query->where(function($query) { // where(function($query) {}) 嵌套是用来生成的 SQL 里的括号
                    $query->whereNull('paid_at')
                        ->where('closed', false);
                })->orWhere(function($query) {
                    $query->whereNotNull('paid_at')
                        ->where('refund_status', '!=', Order::REFUND_STATUS_SUCCESS);
                });
            })
            ->exists();
        if ($used) {
            throw new CouponCodeUnavailableException('你已经使用过这张优惠券了');
        }
    }

    /**
     * 计算优惠后金额
     * @author: wenyuling(wenyuling10@163.com)
     * @dateTime: 2018/11/30 下午5:43
     * @param $orderAmount
     * @return mixed|string
     */
    public function getAdjustedPrice($orderAmount)
    {
        // 固定金额
        if ($this->type === self::TYPE_FIXED) {
            // 为了保证系统健壮性，我们需要订单金额最少为 0.01 元
            return max(0.01, $orderAmount - $this->value);
        }

        return number_format($orderAmount * (100 - $this->value) / 100, 2, '.', '');
    }

    /**
     * 优惠券新增、减少用量
     * @author: wenyuling(wenyuling10@163.com)
     * @dateTime: 2018/11/30 下午5:47
     * @param bool $increase
     * @return int
     */
    public function changeUsed($increase = true)
    {
        // 传入 true 代表新增用量，否则是减少用量
        if ($increase) {
            // 与检查 SKU 库存类似，这里需要检查当前用量是否已经超过总量
            return $this->newQuery()->where('id', $this->id)->where('used', '<', $this->total)->increment('used');
        } else {
            return $this->decrement('used');
        }
    }
}
