<?php

namespace Modules\Demo\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [];
    protected $table = 'blogs';

    public function image()
    {
        return $this->morphOne('Modules\Demo\Models\Image', 'imageable');
    }
}
