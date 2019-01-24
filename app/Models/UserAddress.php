<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
        'province',
        'city',
        'district',
        'address',
        'zip',
        'contact_name',
        'contact_phone',
        'last_used_at',
    ];
    protected $dates = ['last_used_at']; //时间日期类型

    protected $appends = ['full_address']; //full_address 属性并不是收货地址真实的数据库字段，而是我们后面添加的访问器

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 访问器
     *
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return "{$this->province}{$this->city}{$this->district}{$this->address}";
    }
}
