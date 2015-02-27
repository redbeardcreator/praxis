<?php

namespace RC\ProgrammingPraxis;

class CaeserCipher
{
    const A = 65;

    public $shift;

    public function __construct($shift = 3)
    {
        $this->shift = $this->normalizeShift($shift);
    }

    public function encrypt($plaintext)
    {
        return $this->shiftText($this->shift, $plaintext);
    }

    public function decrypt($ciphertext)
    {
        // Decrypting is just subtracting the shift. Normalize it by
        // subtracting from 26.
        return $this->shiftText(26 - $this->shift, $ciphertext);
    }

    private function shiftText($shift, $text)
    {
        // Convert to 0-25. Due to the fact that 65 % 26 = 13, addition or
        // subtraction would work here, after the modulo arithmatic. So,
        // ($x - 65) % 26 == ($x + 65) % 26 == ($x - 13) % 26
        $shift -= self::A;
        $text = strtoupper($text);
        $shiftedText = '';
        for ($i = 0; $i < strlen($text); $i++) {
            $shiftedChar = $char = $text[$i];
            if (ctype_alpha($char)) {
                $ascii = ord($char) + $shift;
                $shiftedChar = chr($ascii % 26 + self::A);
            }
            $shiftedText .= $shiftedChar;
        }

        return $shiftedText;
    }

    private function normalizeShift($shift)
    {
        // Makes sure that $shift is between 0 and 25.
        return $shift + 26 * (ceil(-$shift / 26));
    }
}
