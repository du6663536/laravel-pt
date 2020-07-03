<?php

namespace Modules\Frame\Services;

class Api
{
    protected $module;

    public function __construct($module)
    {
        $this->module = $module;
    }

    public function getModule()
    {
        return $this->module;
    }
}