<?php

namespace Modules\Member\Models;

use Illuminate\Database\Eloquent\Model;

class CommonDepartment extends Model
{
    protected $fillable = [];

    /**
     * 与模型关联的表名
     *
     * @var string
     */
    protected $table = 'common_department';

    /**
     * 重定义主键
     *
     * @var string
     */
    protected $primaryKey = 'department_id';

    /**
     * 指示是否自动维护时间戳 created_at 和 updated_at
     *
     * @var bool
     */
    public $timestamps = false;

    public function commonMember()
    {
        return $this->hasMany('Modules\Member\Models\CommonMember', 'department_id', 'department_id');//第一个 department_id 在 common_member 表中，  第二个department_id 在 common_department 表中
    }

    public function getMemberlist()
    {
        //员工列表信息  但是没有部门信息
        $data = $this->find(4)->commonMember;// $data = $this->find(4)->commonMember()->get();
        print_r($data->toArray());
    }

    public function getMemberlistWithDepartment()
    {
        //一个部门 对应 多个员工信息， 若 是一个部门维度列表，确实不合适在列表显示所有员工信息。
        //所以类似下面代码，在CommonMember 模型中完成 员工维度列表，可附带部门信息。
        // $search['st'] = 1;
        // $data = $this->whereHas('CommonMember', function ($query) use ($search) {
        //     $query->where('st', '=', $search['st']);
        // })->with(['CommonMember:member_id,real_name'])->get()->take(100);
        // print_r($data->toArray());

        //部门列表  附加所有相关员工信息
        $data = $this->with([
            'CommonMember' => function ($query) {
                $query->select('member_id', 'real_name', 'department_id'); //必须加上 外键 department_id  ？
                $query->where('st', '=', 1);
            }
        ])->select('department_id', 'department_name')->take(10)->get();



        // $data = $this->with('CommonMember')->get()->take(10);//take和get两者顺序不分前后
        print_r($data->toArray());
    }

    public function test()
    {
        // $data = $this->take(4)->get(); //ok 返回的是模型的集合  // $data = $this->take(4)->commonMember;//报错
        // $sorted = $data->sortBy('first_letter');
        // dd($sorted);

        // $data = $this->find(4); //返回的是一个模型的实例   // $sorted = $data->sortBy('first_letter'); 报错
        // dd($data);

        // $data = $this->take(4);//返回 查询构造器实例
        // dd($data);


        //$data = $this->find(4)->hasManyCommonMember()->with('CommonDepartment');//$this->find(4)->hasManyCommonMember()->with('CommonDepartment') 得到的是 Illuminate\Database\Eloquent\Relations\HasMany

        //多对多  第三个参数是本类的 id，第四个参数是第一个参数那个类的 id。

    }
}
