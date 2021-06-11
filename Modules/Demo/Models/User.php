<?php

namespace Modules\Demo\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [];
    protected $table = 'users';

    public function identity_card(){
        return $this->hasOne('Modules\Demo\Models\IdentityCard', 'user_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany('Modules\Demo\Models\Role', 'role_user', 'user_id', 'role_id')->withPivot('created_at');
    }

}
