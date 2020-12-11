<?php

namespace Modules\Demo\Services\Property;


class TestYield
{

    public static function createRange($number)
    {
        $data = [];
        for ($i=0; $i<$number; $i++) {
            $data[] = time();
        }
        return $data;
    }

    public static function createRangeYield($number){
        for($i=0;$i<$number;$i++){
            yield time();
        }
    }

    public static function cycle(Int $is_yield)
    {

        $data = $is_yield ? self::createRangeYield(10) : self::createRange(10);
        foreach($data as $value){
            sleep(1);//这里停顿1秒，我们后续有用
            echo $value.PHP_EOL;
        }
        dd($is_yield);
    }

    public static function gen()
    {
        yield 1;
        yield 2;
        yield 3;
    }

    public static function multiYield()
    {
        $g = self::gen();
        echo $g->valid();
        echo $g->current();
        echo "-</br>";
        echo $g->next();
        echo $g->valid();
        echo $g->current();
        echo "-</br>";
        echo $g->next();
        echo $g->valid();
        echo $g->current();
        echo "-</br>";
        echo $g->next();
        echo $g->valid();
        echo $g->current();
    }
}