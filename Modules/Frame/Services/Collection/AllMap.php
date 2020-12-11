<?php

namespace Modules\Frame\Services\Collection;

class AllMap
{

    public function getDemo(String $name)
    {
        call_user_func([$this, $name]);
    }

    public function All()
    {
        // dd(collect([1, 2, 3])->all());


        $average = collect([['foo' => 10], ['foo' => 10], ['foo' => 20], ['foo' => 40]])->avg('foo');
        dd($average);
    }
}