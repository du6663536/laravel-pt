<?php

namespace Modules\Demo\Models;

use Illuminate\Database\Eloquent\Model;

class Extraction extends Model
{
    protected $fillable = [];
    protected $table = 'z_ngs_task_1_extraction';
    protected $primaryKey = 'extraction_id';
    public $timestamps = false;

    public function sample()
    {
        return $this->belongsTo('Modules\Demo\Models\Sample', 'sample_id', 'sample_id');
    }

    // public function order()
    // {
    //     return $this->hasOneThrough(
    //         'Modules\Demo\Models\Order',//远程表
    //         'Modules\Demo\Models\Sample',//中间表
    //         'sample_id', // 中间表对主表的关联字段
    //         'order_id', // 远程表对中间表的关联字段
    //         'sample_id', // 主表对中间表的关联字段
    //         'order_id' // 中间表对远程表的关联字段
    //     );
    // }

    // public function order()
    // {
    //     return $this->belongsTo('Modules\Demo\Models\Order', 'order_id', 'order_id');
    // }

    // public function contract()
    // {
    //     return $this->belongsTo('Modules\Demo\Models\Contract', 'contract_id', 'confirm_contract_id');
    // }

    public function getExtraction()
    {

        $sample_where = [
            ['sample_pid', '=', 0],
            ['sa_save_st', '>', 1],
        ];
        $order_where = [
            ['is_check', '=', 1],
        ];
        $contract_where = [
            // ['sn', '=', 'MJ20201211107']
        ];

        // 16秒 需Sample 模型中 建好 contract 的 hasOneThrough
        // $data = $this->select('extraction_sn', 'sample_id')->orderBy('sample_id', 'desc')
        // ->with([
        //     'Sample:majorbio_sn,sample_name,sample_id,ngs_order_sample.order_id',
        //     'Sample.order:order_sn,is_check,contract_id,ngs_order.order_id',
        //     'Sample.contract:sn,confirm_contract_id'
        // ])
        // ->whereHasIn('Sample', function ($query) use ($sample_where) {
        //     $query->where($sample_where);
        // })
        // ->whereHasIn('Sample.order', function ($query) use ($order_where) {
        //     $query->where($order_where);
        // })
        // ->whereHasIn('Sample.contract', function ($query) use ($contract_where) {
        //     $query->where($contract_where);
        // });


        //16 秒 需本类中定义   只需要对应关系建好    【无需定义远程对应关系且更符合对应关系  可以考虑】
        $data = $this->select('extraction_sn', 'sample_id')->orderBy('sample_id', 'desc')
        ->with([
            'Sample:majorbio_sn,sample_name,sample_id,ngs_order_sample.order_id',
            'Sample.order:order_sn,is_check,contract_id,ngs_order.order_id',
            'Sample.order.contract:sn,confirm_contract_id'
        ])
        ->whereHasIn('Sample', function ($query) use ($sample_where) {
            $query->where($sample_where);
        })
        ->whereHasIn('Sample.order', function ($query) use ($order_where) {
            $query->where($order_where);
        })
        ->whereHasIn('Sample.order.contract', function ($query) use ($contract_where) {
            $query->where($contract_where);
        });

        // // 22 秒 需本类中定义   sample order contract  方法 【此方法需要 extraction 关联表中含有 sample_id  order_id  contract_id  实际情况可能不太符合且耗时不是最佳  暂不考虑】
        // $data = $this->select('extraction_sn', 'sample_id', 'order_id', 'contract_id')->orderBy('sample_id', 'desc')
        // ->with([
        //     'Sample:majorbio_sn,sample_name,sample_id,ngs_order_sample.order_id',
        //     'Order:order_sn,is_check,contract_id,ngs_order.order_id',
        //     'Contract:sn,confirm_contract_id'
        // ])
        // ->whereHasIn('Sample', function ($query) use ($sample_where) {
        //     $query->where($sample_where);
        // })
        // ->whereHasIn('Order', function ($query) use ($order_where) {
        //     $query->where($order_where);
        // })
        // ->whereHasIn('Contract', function ($query) use ($contract_where) {
        //     $query->where($contract_where);
        // });

        return $data;
    }



    // Laravel ORM的关联关系非常强大，基于关联关系的查询has也给我们提供了诸多灵活的调用方式，然而某些情形下，has使用了where exists语法实现

    // select * from A where exists (select * from B where A.id=B.a_id)
    // exists是对外表做loop循环，每次loop循环再对内表（子查询）进行查询，那么因为对内表的查询使用的索引（内表效率高，故可用大表），
    //而外表有多大都需要遍历，不可避免（尽量用小表），故内表大的使用exists，可加快效率。

    // 但是当A表数据量较大的时候，就会出现性能问题，那么这时候用where in语法将会极大的提高性能

    // select * from A where A.id in (select B.a_id from B)
    // in是把外表和内表做hash连接，先查询内表，再把内表结果与外表匹配，对外表使用索引（外表效率高，可用大表），
    //而内表多大都需要查询，不可避免，故外表大的使用in，可加快效率。

    // 因此在代码中使用has(hasMorph)或者hasIn(hasMorphIn)应由数据体量来决定
}
