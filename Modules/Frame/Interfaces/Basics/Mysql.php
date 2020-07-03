<?php

namespace Modules\Frame\Interfaces\Basics;

use Modules\Frame\Interfaces\Basics\ModelInterface;

class Mysql implements ModelInterface{

    public function getName()
    {
        return 'Mysql';
    }
}