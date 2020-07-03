<?php

namespace Modules\Frame\Services;

use Modules\Frame\Interfaces\Container\SuperModuleInterface;

class Superman
{
    protected $module;

    public function __construct(SuperModuleInterface $module)
    {
        $this->module = $module;
    }

    public function getModule()
    {
        return $this->module;
    }
}