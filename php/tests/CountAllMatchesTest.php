<?php

namespace RC\ProgrammingPraxis;

class CountAllMatchesTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->matcher = new CountAllMatches;
    }

    public function test_occurs0InEmptyString()
    {
        $this->assertResult(0, 'something', '');
    }

    public function test_occursOnceInSelf()
    {
        $str = 'Something';
        $this->assertResult(1, $str, $str);
    }

    public function test_emptyOccurs0()
    {
        $this->assertResult(0, '', 'the-haystack');
    }

    public function test_occurs1InOneLonger()
    {
        $str = 'findme';
        $this->assertResult(1, $str, $str . 'a');
        $this->assertResult(1, $str, 'a' . $str);
    }

    public function test_aApparent()
    {
        $this->assertResult(2, 'a', 'apparent');
    }

    public function test_baBeachball()
    {
        $this->assertResult(3, 'ba', 'beachball');
    }

    public function test_catCatapult()
    {
        $this->assertResult(3, 'cat', 'catapult');
    }

    public function test_abAbcabcabc()
    {
        $this->assertResult(6, 'ab', 'abcabcab');
    }

    private function assertResult($expected, $needle, $haystack)
    {
        $actual = $this->matcher->match($needle, $haystack);
        $this->assertSame($expected, $actual);
    }

}
