<?php

namespace Modules\Demo\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [];
    protected $table = 'ngs_order';
    protected $primaryKey = 'order_id';
    public $timestamps = false;

    public function contract()
    {
        return $this->belongsTo('Modules\Demo\Models\Contract', 'contract_id', 'confirm_contract_id');
    }

    // public function sample()
    // {
    //     return $this->hasMany('Modules\Demo\Models\Sample', 'order_id', 'order_id');
    // }
}
