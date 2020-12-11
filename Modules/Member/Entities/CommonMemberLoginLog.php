<?php

namespace Modules\Member\Entities;

use Illuminate\Database\Eloquent\Model;

class CommonMemberLoginLog extends Model
{
    protected $fillable = [];

    protected $table = 'common_member_login_log';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
