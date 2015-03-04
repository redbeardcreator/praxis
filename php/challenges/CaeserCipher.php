<?php

namespace RC\ProgrammingPraxis;

/**
 * Implement a simple Caeser cipher
 *
 * Based on the challenge at http://programmingpraxis.com/2014/03/11/caesar-cipher/
 */
class CaeserCipher
{
    /** @var int ASCII_A  ASCII value of A, for converting to 0-25 */
    const ASCII_A = 65;

    /** @var int $shift  Amount to shift letters */
    protected $shift;

    /**
     * Create a CaeserCipher
     *
     * @param int $shift  How far to shift in the alphabet
     */
    public function __construct($shift = 3)
    {
        $this->setShift($shift);
    }

    /**
     * Retrieve the amount of shift
     *
     * @return int  The amount to shift letters
     */
    public function getShift()
    {
        return $this->shift;
    }

    /**
     * Set the amount to shift by
     *
     * @param int $shift  The amount to set
     */
    public function setShift($shift)
    {
        $this->shift = $this->normalizeShift($shift);
    }

    /**
     * Encrypt $plaintext
     *
     * @param string $plaintext  String to encrypt
     *
     * @return string  The encrypted text
     */
    public function encrypt($plaintext)
    {
        return $this->shiftText($this->shift, $plaintext);
    }

    /**
     * Decrypt $ciphertext
     *
     * @param string $ciphertext  String to decrypt
     *
     * @return string  The decrypted text
     */
    public function decrypt($ciphertext)
    {
        // Decrypting is just subtracting the shift. Normalize it by
        // subtracting from 26.
        return $this->shiftText(26 - $this->shift, $ciphertext);
    }

    /**
     * Shift $text alphabetic charaters by $shift
     *
     * Also upcases the result
     *
     * @param int    $shift  How far to shift the characters in $text
     * @param string $text   String to shift
     *
     * @return string  The shifted $text
     */
    private function shiftText($shift, $text)
    {
        // Convert to 0-25. Due to the fact that 65 % 26 = 13, addition or
        // subtraction would work here, after the modulo arithmatic. So,
        // ($x - 65) % 26 == ($x + 65) % 26 == ($x - 13) % 26
        $shift -= self::ASCII_A;
        $text = strtoupper($text);
        $shiftedText = '';
        for ($i = 0; $i < strlen($text); $i++) {
            $shiftedChar = $char = $text[$i];
            if (ctype_alpha($char)) {
                $ascii = ord($char) + $shift;
                $shiftedChar = chr($ascii % 26 + self::ASCII_A);
            }
            $shiftedText .= $shiftedChar;
        }

        return $shiftedText;
    }

    /**
     * Normalize a shift value so it is between 0 and 25
     *
     * @param int $shift  The shift value to normalize
     *
     * @return int  The normalized value of $shift
     */
    private function normalizeShift($shift)
    {
        // Makes sure that $shift is between 0 and 25.
        return $shift + 26 * (ceil(-$shift / 26));
    }
}
