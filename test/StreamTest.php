<?php
/**
 * @project: streams
 * @package: ${NAMESPACE}
 * @author: Tom
 * @date: 01.02.2018
 */

use PHPUnit\Framework\TestCase;
use Stream\ArrayList;
use Stream\Stream;

class StreamTest extends TestCase
{
    var $array = [1, 2, 3, 4, 5, 6, 7, 8, 9];


    public function testReduce()
    {
        $this->assertEquals((new Stream($this->array))->reduce(function ($accu) {
            return $accu + 1;
        }), 9);
    }

    public function testFilterAndFirst()
    {
        $this->assertEquals((new Stream($this->array))->filter(function ($v) {
            return $v == 1;
        })->first()->orElse(0), 1);
    }

    public function testEmpty()
    {
        $this->assertEquals(Stream::empty()->first()->orElse(null), null);
    }

    public function testFindFirst()
    {
        $this->assertEquals(Stream::asStream($this->array)->findFirst(function ($v) {
            return $v % 3 == 0;
        })->orElse(null), 3);
    }

    public function testMap()
    {
        $this->assertEquals(Stream::asStream($this->array)->map(function ($v) {
            return $v * $v;
        })->asArray(), [1, 4, 9,
            16, 25,
            36, 49,
            64,
            81]);
    }

    public function testEvery()
    {
        $this->assertEquals(Stream::asStream($this->array)->every(function ($v) {
            return $v % 3 == 0;
        }), false);
        $this->assertEquals(Stream::asStream($this->array)->every(function ($v) {
            return $v > 0;
        }), true);
    }

    public function testSome()
    {
        $this->assertEquals(Stream::asStream($this->array)->some(function ($v) {
            return $v % 3 == 0;
        }), true);
        $this->assertEquals(Stream::asStream($this->array)->some(function ($v) {
            return $v < 0;
        }), false);
    }


    public function arrayListTest()
    {
        $a = new ArrayList();
        $a[] = 1;
        $a[] = 2;
        $a[] = 3;
        $this->assertEquals($a->toStream()->first()->orElse(null), 1);
    }


}

