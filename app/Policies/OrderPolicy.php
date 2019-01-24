<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * 授权策略类 (只允许订单的创建者可以看到对应的订单信息,可通过授权策略类（Policy）来实现)
 * Class OrderPolicy
 * @package App\Policies
 */
class OrderPolicy
{
    use HandlesAuthorization;

    public function own(User $user, Order $order)
    {
        return $order->user_id == $user->id;
    }
}