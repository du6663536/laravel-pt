<?php

namespace Modules\Frame\Interfaces\Container;

use Modules\Frame\Interfaces\Container\SuperModuleInterface;

/**
 * X-超能量
 */
class XPower implements SuperModuleInterface
{
    public function activate(array $target)
    {
        echo 'activate-XPower';
        // 这只是个例子。。具体自行脑补
    }
}