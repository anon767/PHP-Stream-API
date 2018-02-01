<?php
/**
 * @project: streams
 * @package: Stream
 * @author: Tom Ganz
 * @date: 01.02.2018
 */

namespace Stream;


class Cell implements Streamable
{
    private $value = null;

    /**
     * Cell constructor.
     * @param null $value
     */
    public function __construct($value = null)
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function isPresent()
    {
        return $this->value != null;
    }

    /**
     * @param callable $callback
     * @return $this|Cell
     */
    public function map(callable $callback)
    {
        if (!$this->isPresent())
            return $this;
        return new Cell(call_user_func_array($callback, [$this->value]));
    }

    /**
     * @return null
     * @throws NoElementException
     */
    public function unwrap()
    {
        if (!$this->isPresent())
            throw new NoElementException("Cell is empty");
        return $this->value;

    }

    /**
     * @param $value
     * @return null
     */
    public function orElse($value)
    {
        if ($this->isPresent())
            return $this->value;
        else
            return $value;
    }

    /**
     * @param callable $callback
     * @return $this|Cell
     */
    public function filter(callable $callback)
    {
        if (!$this->isPresent())
            return new Cell();
        if (call_user_func_array($callback, [$this->value]))
            return $this;
        else
            return new Cell();
    }


}