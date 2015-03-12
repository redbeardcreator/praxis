<?php

namespace RC\ProgrammingPraxis;

/**
 * Determine number of times a string appears in a second, continuous or discontinuous
 *
 * In other words, CAT appears in CATAPULT three times: CATapult, CAtapulT & CatApulT.
 *
 * Based on the challenge at http://programmingpraxis.com/2015/03/10/count-all-matches/
 */
class CountAllMatches
{
    public function match($needle, $haystack)
    {
        $needleLength = strlen($needle);
        $haystackLength = strlen($haystack);
        $end = $haystackLength - $needleLength;

        if ($needleLength == 0 || $haystackLength == 0 || $end < 0) {
            return 0;
        }

        $count = 0;
        $start = 0;

        if (strlen($needle) == 1) {
            return substr_count($haystack, $needle);
        }

        $firstLetter = substr($needle, 0, 1);
        $needleRemainder = substr($needle, 1);

        while ($start <= $end) {
            $where = strpos($haystack, $firstLetter, $start);
            if ($where !== false) {
                $count += $this->match($needleRemainder, substr($haystack, $where + 1));
                $start = $where + 1;
            } else {
                $start++;
            }
        }

        return $count;
    }
}
