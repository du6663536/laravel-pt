<?php

namespace Modules\Demo\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [];
    protected $table = 'comments';

    public function article()
    {
        return $this->belongsTo('Modules\Demo\Models\Article', 'article_id', 'id');
    }
}
