<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Installment;
use Illuminate\Auth\Access\HandlesAuthorization;

class InstallmentPolicy
{
    use HandlesAuthorization;

    /**
     * 给详情页加上权限验证，只能对应的用户才能看到
     * @author: wenyuling(wenyuling10@163.com)
     * @dateTime: 2018/12/12 下午3:01
     * @param User $user
     * @param Installment $installment
     * @return bool
     */
    public function own(User $user, Installment $installment)
    {
        return $installment->user_id == $user->id;
    }

}
