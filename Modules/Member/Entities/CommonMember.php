<?php

namespace Modules\Member\Entities;

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

    public function list()
    {
        //toArray  还会有 模型的关系 数据 $this->relationsToArray()
        $users = $this->find(1)->attributesToArray();
        print_r($users);die;

    }

    // public function department()
    // {
    //     return $this->belongsTo('Modules\Member\Entities\CommonDepartment', 'department_id', 'department_id');
    // }

}
