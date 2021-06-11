<?php

namespace Modules\Demo\Models;

use Illuminate\Database\Eloquent\Model;

class IdentityCard extends Model
{
    protected $fillable = [];
    protected $table = 'identity_cards';

    public function user(){
        // return $this->belongsTo('Modules\Demo\Models\User', 'user_id', 'id');
        return $this->belongsTo('Modules\Demo\Models\User', 'user_id', 'other_id');
    }

}
