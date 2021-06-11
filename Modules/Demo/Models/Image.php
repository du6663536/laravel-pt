<?php

namespace Modules\Demo\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [];
    protected $table = 'images';

    public function imageable()
    {
        return $this->morphTo();
    }
}
