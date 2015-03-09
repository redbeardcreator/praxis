<?php

namespace RC\ProgrammingPraxis;
use org\bovigo\vfs\vfsStream;

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

    public function test_printMultiplicationTable()
    {
        $expected = <<<EOD
   1   2   3   4   5   6   7   8   9  10  11  12
   2   4   6   8  10  12  14  16  18  20  22  24
   3   6   9  12  15  18  21  24  27  30  33  36
   4   8  12  16  20  24  28  32  36  40  44  48
   5  10  15  20  25  30  35  40  45  50  55  60
   6  12  18  24  30  36  42  48  54  60  66  72
   7  14  21  28  35  42  49  56  63  70  77  84
   8  16  24  32  40  48  56  64  72  80  88  96
   9  18  27  36  45  54  63  72  81  90  99 108
  10  20  30  40  50  60  70  80  90 100 110 120
  11  22  33  44  55  66  77  88  99 110 121 132
  12  24  36  48  60  72  84  96 108 120 132 144

EOD;
        $this->expectOutputString($expected);
        $this->yegge->printMultiplicationTable();
    }

    public function test_sumFromFile()
    {
        $fname = 'getit.txt';
        $values = [ 1, 20, 13, 57, 185 ];
        $expected = array_sum($values);
        $root = vfsStream::setup();
        $file = vfsStream::newFile($fname)
              ->withContent(implode("\n", $values))
              ->at($root);

        $actual = $this->yegge->sumFile($file->url());

        $this->assertSame($expected, $actual);
    }
    public function test_printOddNums()
    {
        $expected = "  1  3  5  7  9 11 13 15 17 19 21 23 25 27 29\n"
                  . " 31 33 35 37 39 41 43 45 47 49 51 53 55 57 59\n"
                  . " 61 63 65 67 69 71 73 75 77 79 81 83 85 87 89\n"
                  . " 91 93 95 97 99\n";

        $this->expectOutputString($expected);
        $this->yegge->printOddNums();
    }

}
