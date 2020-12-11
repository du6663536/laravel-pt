<?php

namespace Modules\Demo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class PropertyController extends Controller
{
    public function yield(Int $is_yield)
    {
        $rs = \Modules\Demo\Services\Property\TestYield::cycle($is_yield);
    }

    public function multiYield()
    {
        $rs = \Modules\Demo\Services\Property\TestYield::multiYield();
    }

}
