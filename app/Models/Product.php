<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const TYPE_NORMAL = 'normal';
    const TYPE_CROWDFUNDING = 'crowdfunding';

    public static $typeMap = [
        self::TYPE_NORMAL  => '普通商品',
        self::TYPE_CROWDFUNDING => '众筹商品',
    ];

    protected $fillable = [
        'title', 'description', 'image', 'on_sale',
        'rating', 'sold_count', 'review_count', 'price', 'type'
    ];

    protected $casts = [
        'on_sale' => 'boolean', // on_sale 是一个布尔类型的字段
    ];

    /**
     * 与商品SKU关联
     * @author: wenyuling(wenyuling10@163.com)
     * @dateTime: 2018/12/3 上午11:16
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skus()
    {
        return $this->hasMany(ProductSku::class);
    }

    /**
     * 关联类目表
     * @author: wenyuling(wenyuling10@163.com)
     * @dateTime: 2018/12/1 下午3:52
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 关联众筹表
     * @author: wenyuling(wenyuling10@163.com)
     * @dateTime: 2018/12/3 上午11:16
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function crowdfunding()
    {
        return $this->hasOne(CrowdfundingProduct::class);
    }
}
