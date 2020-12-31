<?php

namespace Modules\Demo\Models;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    protected $fillable = [];
    protected $table = 'ngs_order_sample';
    protected $primaryKey = 'sample_id';
    public $timestamps = false;

    public function order()
    {
        return $this->belongsTo('Modules\Demo\Models\Order', 'order_id', 'order_id');
    }

    public function extraction()
    {
        return $this->hasMany('Modules\Demo\Models\Extraction', 'sample_id', 'sample_id');
    }

    // public function contract()
    // {
    //     return $this->hasOneThrough(
    //         'Modules\Demo\Models\Contract',//远程表
    //         'Modules\Demo\Models\Order',//中间表
    //         'order_id', // 中间表对主表的关联字段
    //         'confirm_contract_id', // 远程表对中间表的关联字段
    //         'order_id', // 主表对中间表的关联字段
    //         'contract_id' // 中间表对远程表的关联字段
    //     );
    // }

    public function getSampleListAndOrder()
    {

        $search['is_check'] = 1;
        $where = [
            ['sample_pid', '=', 0],
            ['sa_save_st', '>', 1],
        ];

        //whereHas的条件 实际是加载 $this  上   （在最后查出来的数据集上  更适合做筛选？【筛选用】）
        $data = $this->select('majorbio_sn', 'sample_name', 'sample_id', 'order_id')->where($where)->orderBy('sample_id', 'desc')
        ->with(['Order:order_sn,is_check,order_id,contract_id', 'Extraction:extraction_sn,extraction_id,sample_id', 'Contract:confirm_contract_id,sn'])
        ->whereHas('Order', function ($query) use ($search) {
            $query->where('is_check', '=', $search['is_check']);
        });

        // print_r($data->toArray());
        return $data;
    }

    public function getSamples()
    {
        $sample_where = [
            ['sample_pid', '=', 0],
            ['sa_save_st', '>', 1],
        ];
        $order_where = [
            ['is_check', '=', 1],
        ];
        $extraction_where = [];
        $contract_where = [];

        //（不是在最后查出来的数据集上 不适合做筛选？  解决n+1? 【with 更像 sql 中的 join，就是你存不存都有执行，存在结果不为空，存在关联结果，不存在结果为空，关联结果为空】）
        $data = $this->select('majorbio_sn', 'sample_name', 'sample_id', 'order_id')->where($sample_where)->orderBy('sample_id', 'desc')
        ->with([
            'Order' => function ($query) use ($order_where) {
                $query->select('order_sn', 'is_check', 'contract_id', 'ngs_order.order_id')->where($order_where);
            },
            'Extraction' => function ($query) use ($extraction_where) {
                $query->select('extraction_sn', 'extraction_id', 'sample_id')->where($extraction_where);
            },
            'Contract' => function ($query) use ($contract_where) {
                $query->select('sn', 'confirm_contract_id')->where($contract_where);
            },
        ]);

        return $data;
    }
}
