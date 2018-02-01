<?php
/**
 * @project: streams
 * @package: Stream
 * @author: Tom Ganz
 * @date: 01.02.2018
 */

namespace Stream;


use Exception;

class NoElementException extends Exception
{
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}