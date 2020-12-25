<?php

namespace Modules\Member\Models;

use Illuminate\Database\Eloquent\Model;

class CommonMember extends Model
{
    protected $fillable = [];

    /**
     * 与模型关联的表名
     *
     * @var string
     */
    protected $table = 'common_member';

    /**
     * 重定义主键
     *
     * @var string
     */
    protected $primaryKey = 'member_id';

    /**
     * 指示是否自动维护时间戳 created_at 和 updated_at
     *
     * @var bool
     */
    public $timestamps = false;


    public function commonDepartment()
    {
        return $this->belongsTo('Modules\Member\Models\CommonDepartment', 'department_id', 'department_id');
    }

    public function getMemberAndDepartment()
    {
        // $search['department_id'] = 4;
        // $data = $this->whereHas('CommonDepartment', function ($query) use ($search) {
        //     $query->where('department_id', '=', $search['department_id']);
        // })->with(['CommonDepartment:department_id,department_name'])->get();

        //此写法，貌似代替了 join 语句
        // $search['is_show'] = 1;
        // $data = $this->whereHas('CommonDepartment', function ($query) use ($search) {
        //     $query->where('is_show', '=', $search['is_show']);
        // })->with(['CommonDepartment:department_id,department_name'])->get()->take(100);

        //没有 CommonDepartment 字段信息
        // $search['is_show'] = 1;
        // $data = $this->whereHas('CommonDepartment', function ($query) use ($search) {
        //     $query->where('is_show', '=', $search['is_show']);
        // })->get()->take(100);

        //也可以达到目的  在员工列表信息中带出部门信息
        $data = $this->select('member_id', 'real_name', 'department_id') //必须加外键 department_id  不然就不会显示 CommonDepartment 相关数据？
            ->with(['CommonDepartment:department_id,department_name'])->get()->take(100);

        print_r($data->toArray());
    }
}
