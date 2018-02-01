<?php
/**
 * Created by PhpStorm.
 * User: tom
 * Date: 01.02.18
 * Time: 21:09
 */

namespace Stream;


use ArrayObject;

class ArrayList extends ArrayObject
{
    public function toStream()
    {
        return new Stream($this->getArrayCopy());
    }
}