<?php

namespace Modules\Demo\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [];
    protected $table = 'ngs_new_contract';
    protected $primaryKey = 'contract_id';
    public $timestamps = false;

}
