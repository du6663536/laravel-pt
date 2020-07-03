<?php

namespace Modules\Frame\Interfaces\Container;

use Modules\Frame\Interfaces\Container\SuperModuleInterface;

/**
 * 终极炸弹
 */
class UltraBomb implements SuperModuleInterface
{
    public function activate(array $target)
    {
        echo 'activate-UltraBomb';
        // 这只是个例子。。具体自行脑补
    }
}