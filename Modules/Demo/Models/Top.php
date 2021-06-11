<?php

namespace Modules\Demo\Models;

use Illuminate\Database\Eloquent\Model;

class Top extends Model
{
    protected $fillable = [];
    protected $table = 'tops';

    public function authorFamousBooks()
    {
        return $this->hasOneThrough(
            'Modules\Demo\Models\FamousBook',
            'Modules\Demo\Models\Author',
            'top_id', // Author表外键
            'author_id', // FamousBook表外键
            'id', // Top表本地键
            'id' // Author表本地键
        );

    }

    public function authorBooks()
    {
        return $this->hasManyThrough(
            'Modules\Demo\Models\Book',
            'Modules\Demo\Models\Author',
            'top_id', // Author表外键
            'author_id', // Book表外键
            'id', // Top表本地键
            'id' // Author表本地键
        );

    }

}
