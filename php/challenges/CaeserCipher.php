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
        if ($shift < 0) {
            return $shift + 26 * (ceil(-$shift / 26));
        }

        return $shift % 26;
    }
}
