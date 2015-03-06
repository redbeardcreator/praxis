<?php

namespace RC\ProgrammingPraxis;

/**
 * Implement several phone interview questions from Steve Yegge
 *
 * Based on the challenge at http://programmingpraxis.com/2009/06/30/steve-yegges-phone-screen-coding-exercises/
 */
class Yegge
{
    /**
     * Reverse a string
     *
     * @param string $str  String to reverse
     *
     * @return string   $str in reverse
     */
    public function reverse($str)
    {
        $reversed = '';
        $start = strlen($str) - 1;
        for ($i = $start; $i >= 0; $i--) {
            $reversed .= $str[$i];
        }
        return $reversed;
    }

    /**
     * Calculate the $nth Fibonacci number
     *
     * Implementation is iterative. Tradiional recursive implementation was too slow.
     *
     * The value of $n must be < 47, until the PHP_INT_MAX is raised.
     *
     * @param int $n  Which Fibonacci number to compute
     *
     * @return int  The Fibonacci number at nth position
     */
    public function fib($n)
    {
        if ($n < 0) {
            throw new \Exception('$n must be >= 0');
        }

        if ($n == 0) {
            return 0;
        }

        // Initial values for $n = 3 or higher
        $a = 1;
        $b = 1;

        // Set $c for $n == 2, then make that bail early
        $n -= 2;
        $c = 1;

        // When $a + $b overflows, $c becomes a float
        while ($n > 0 && is_int($c)) {
            $c = ($a + $b);
            $a = $b;
            $b = $c;
            $n--;
        }

        if (!is_int($c)) {
            throw new \Exception('Result got too big.');
        }

        return $c;
    }

    /**
     * Print a 12 x 12 multiplication table to stdout
     */
    public function printMultiplicationTable()
    {
        // Use range to make it resistent to mutation testing
        foreach (range(1, 12) as $x) {
            foreach (range(1, 12) as $y) {
                printf("%4d", $x * $y);
            }
            echo "\n";
        }
    }

    /**
     * Sum the rows in the given file
     *
     * @param string $fileName  The path to the file to read
     *
     * @return int  Sum of each line of the file, which should be integers.
     */
    public function sumFile($fileName)
    {
        $data = file($fileName);

        // Could use array_sum(), but the instructions say to not use existing functionality
        $sum = array_reduce($data, function ($sum, $num) { return $sum + $num; }, 0);
        return $sum;
    }
}
