<?php

namespace Modules\Member\Entities;

use Illuminate\Database\Eloquent\Model;

class CommonDepartment extends Model
{
    protected $fillable = [];

    protected $table = 'common_department';

    protected $primaryKey = 'department_id';

    public $timestamps = false;

    public function commonMember()
    {
        return $this->hasMany('Modules\Member\Entities\CommonMember', 'department_id', 'department_id');
    }

    public function list()
    {
        $data = $this->find(4)->commonMember;
        print_r($data->toArray());die;
    }
}
