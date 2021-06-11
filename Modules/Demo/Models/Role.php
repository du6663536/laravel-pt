<?php

namespace Modules\Demo\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [];
    protected $table = 'roles';

    public function users()
    {
        return $this->belongsToMany('Modules\Demo\Models\User', 'role_user', 'role_id', 'user_id');
    }
}
