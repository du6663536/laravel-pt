<?php

namespace Modules\Demo\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [];
    protected $table = 'articles';

    public function comments()
    {
        return $this->hasMany('Modules\Demo\Models\Comment', 'article_id', 'id');
    }

    public function image()
    {
        return $this->morphOne('Modules\Demo\Models\Image', 'imageable');
    }
}
