<?php
/**
 * @project: streams
 * @package: Stream
 * @author: Tom
 * @date: 01.02.2018
 */

namespace Stream;


interface Streamable
{
    public function filter(callable $callback);
    public function map(callable $callback);
}