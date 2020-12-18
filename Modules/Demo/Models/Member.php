<?php

namespace Modules\Demo\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Member extends Model
{
    // public $id = 1;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function favoriteProducts()
    {
        $relation = '';
        $type = '';
        //在关联上运行一个禁用约束的回调函数
        return Relation::noConstraints(function () use ($relation, $type) {
            return $this->belongsToMany(Product::class, 'member_favorite_products')
            ->withTimestamps()
            ->orderBy('member_favorite_products.created_at', 'desc');
        });

    }
}
