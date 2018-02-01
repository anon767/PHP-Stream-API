<?php
/**
 * @project: streams
 * @author: Tom Ganz
 * @date: 01.02.2018
 * Basic Stream Wrapper for Arrays
 */

namespace Stream;

class Stream implements Streamable
{
    private $array;

    /**
     * Stream constructor.
     * @param array $array
     */
    public function __construct(array $array)
    {
        $this->array = $array;
    }

    public static function asStream(array $array)
    {
        return new Stream($array);
    }

    /**
     * @return array
     */
    public function asArray()
    {
        return $this->array;
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function forEach(callable $callback)
    {
        foreach ($this->array as $key => $value) {
            call_user_func_array($callback, [$value, $key]);
        }
        return $this;
    }

    /**
     * @param callable $callback
     * @return Stream
     */
    public function map(callable $callback)
    {
        $array = $this->array;
        for ($i = 0; $i < count($array); $i++) {
            $array[$i] = call_user_func_array($callback, [$array[$i], $i]);
        }
        return new Stream($array);
    }

    /**
     * @param callable $callback
     * @return Stream
     */
    public function filter(callable $callback)
    {
        $array = $this->array;
        $newArray = [];
        for ($i = 0; $i < count($array); $i++) {
            if (call_user_func_array($callback, [$array[$i], $i]))
                array_push($newArray, $array[$i]);
        }
        return new Stream($newArray);
    }

    /**
     * @param callable|null $callback
     * @return Stream
     */
    public function sort(callable $callback = null)
    {
        $array = $this->array;
        if ($callback)
            sort($array, $callback);
        else
            sort($array);
        return new Stream($array);
    }

    /**
     * @return Stream
     */
    public function reverse()
    {
        $array = array_reverse($this->array);
        return new Stream($array);
    }

    /**
     * @param $n
     * @return Stream
     */
    public function skip($n)
    {
        return new Stream(array_slice($this->array, $n));
    }

    /**
     * @return int|mixed
     */
    public function sum()
    {
        return array_sum($this->array);
    }

    /**
     * @return int|mixed
     */
    public function count()
    {
        return count($this->array);
    }

    /**
     * @param callable $callback
     * @param int $accumulator
     * @return int|mixed
     */
    public function reduce(callable $callback, $accumulator = 0)
    {
        $array = $this->array;
        for ($i = 0; $i < count($array); $i++) {
            $accumulator = call_user_func_array($callback, [$accumulator, $array[$i], $i]);
        }
        return $accumulator;
    }

    /**
     * @return mixed
     */
    public function max()
    {
        $array = $this->array;
        return max($array);
    }

    /**
     * @return mixed
     */
    public function min()
    {
        $array = $this->array;
        return min($array);
    }

    /**
     * @return mixed
     */
    public function first()
    {
        $array = $this->array;
        if (count($array) <= 0)
            return new Cell(null);
        return new Cell($array[0]);
    }

    /**
     * @return mixed
     */
    public function last()
    {
        $array = $this->array;
        return new Cell($array[count($array) - 1]);
    }

    /**
     * @param callable $callback
     * @return mixed|null
     */
    public function findFirst(callable $callback)
    {
        $array = $this->array;
        for ($i = 0; $i < count($array); $i++) {
            if (call_user_func_array($callback, [$array[$i], $i]))
                return new Cell($array[$i]);
        }
        return new Cell(null);
    }

    /**
     * @param callable $callback
     * @return bool
     */
    public function every(callable $callback)
    {
        $array = $this->array;
        for ($i = 0; $i < count($array); $i++) {
            if (!call_user_func_array($callback, [$array[$i], $i]))
                return false;
        }
        return true;
    }

    /**
     * @return Stream
     */
    public static function empty()
    {
        return new Stream([]);
    }

    /**
     * @param callable $callback
     * @return bool
     */
    public function some(callable $callback)
    {
        $array = $this->array;
        for ($i = 0; $i < count($array); $i++) {
            if (call_user_func_array($callback, [$array[$i], $i]))
                return true;
        }
        return false;
    }


}