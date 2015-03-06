<?php

namespace RC\ProgrammingPraxis;

class YeggeTest extends \PHPUnit_Framework_TestCase
{
    private $yegge;

    public function setUp()
    {
        $this->yegge = new Yegge;
    }

    /**
     * @dataProvider reverseProvider
     */
    public function test_reverse($src, $expected)
    {
        $this->assertEquals($expected, $this->yegge->reverse($src));
    }

    public function reverseProvider()
    {
        return [
            ['a', 'a'],
            ['ab', 'ba'],
            ["Madam, I'm Adam", "madA m'I ,madaM"],
        ];
    }

    /**
     * @dataProvider fibProvider
     */
    public function test_fib($src, $expected)
    {
        $this->assertSame($expected, $this->yegge->fib($src));
    }

    /**
     * @expectedException Exception
     */
    public function test_fib_negativeThrows()
    {
        $this->yegge->fib(-1);
    }

    /**
     * @expectedException Exception
     */
    public function test_fib_barelyTooBigThrows()
    {
        $this->yegge->fib(47); // would be 4807526976
    }

    /**
     * @expectedException Exception
     */
    public function test_fib_wayTooBigThrows()
    {
        $this->yegge->fib(100); // would be 354224848179261915075
    }

    public function fibProvider()
    {
        return [
            [0, 0],
            [1, 1],
            [2, 1],
            [3, 2],
            [4, 3],
            [5, 5],
            [10, 55],
            [20, 6765],
            [46, 1836311903], // Highest fib that fits in a PHP int.
        ];
    }
}
