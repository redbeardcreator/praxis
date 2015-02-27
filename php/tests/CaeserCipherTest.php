<?php

namespace RC\ProgrammingPraxis;

class CaeserCipherTest extends \PHPUnit_Framework_TestCase
{
    public function test_constructor_defaultsToShift3()
    {
        $cc = new CaeserCipher;
        $this->assertEquals(3, $cc->shift);
    }

    public function test_constructor_setsShift()
    {
        $shift = 17;
        $cc = new CaeserCipher($shift);
        $this->assertEquals($shift, $cc->shift);
    }

    public function test_encrypt_returnsEmptyString()
    {
        $this->assertDefaultEncrypt('', '');
    }

    public function test_encrypt_shiftsSingleLetter3()
    {
        $this->assertDefaultEncrypt('B', 'E');
    }

    public function test_encrypt_shiftsLetters3()
    {
        $this->assertDefaultEncrypt('ABCDEFGWXYZ', 'DEFGHIJZABC');
    }

    public function test_encrypt_shiftsLetters0()
    {
        $this->assertEncrypt(0, 'ABCDWXYZ', 'ABCDWXYZ');
    }

    public function test_encrypt_convertsToUppercase()
    {
        $this->assertEncrypt(0, 'abcdwxyz', 'ABCDWXYZ');
    }

    public function test_encrypt_shiftsLetters263()
    {
        $this->assertEncrypt(263, 'ABCDWXYZ', 'DEFGZABC');
    }

    public function test_encrypt_shiftsLettersMinus263()
    {
        $this->assertEncrypt(-263, 'ABCDWXYZ', 'XYZATUVW');
    }

    public function test_encrypt_ignoresNonalphabetics()
    {
        $this->assertDefaultEncrypt('abc-def+ghi/1234=xyz', 'DEF-GHI+JKL/1234=ABC');
    }

    public function test_decrypt_returnsEmptyString()
    {
        $this->assertDefaultDecrypt('', '');
    }

    public function test_decrypt_shiftsLetters0()
    {
        $this->assertDecrypt(0, 'ABCDEFG', 'ABCDEFG');
    }

    public function test_decrypt_shiftsLetters3()
    {
        $this->assertDefaultDecrypt('DEFGHIJ', 'ABCDEFG');
    }

    public function test_decrypt_convertsToUppercase()
    {
        $this->assertDecrypt(0, 'abcdwxyz', 'ABCDWXYZ');
    }

    public function test_decrypt_shiftsLetters263()
    {
        $this->assertDecrypt(263, 'defgzabc', 'ABCDWXYZ');
    }

    public function test_decrypt_shiftsLettersMinus263()
    {
        $this->assertDecrypt(-263, 'XYZATUVW', 'ABCDWXYZ');
    }

    public function test_decrypt_ignoresNonalphabetics()
    {
        $this->assertDefaultDecrypt('def-ghi+jkl/1234=abc', 'ABC-DEF+GHI/1234=XYZ');
    }

    private function assertDefaultEncrypt($source, $expected)
    {
        $cc = new CaeserCipher;
        $actual = $cc->encrypt($source);
        $this->assertSame($expected, $actual);
    }

    private function assertEncrypt($shift, $source, $expected)
    {
        $cc = new CaeserCipher($shift);
        $actual = $cc->encrypt($source);
        $this->assertSame($expected, $actual);
    }

    private function assertDefaultDecrypt($source, $expected)
    {
        $cc = new CaeserCipher;
        $actual = $cc->decrypt($source);
        $this->assertSame($expected, $actual);
    }

    private function assertDecrypt($shift, $source, $expected)
    {
        $cc = new CaeserCipher($shift);
        $actual = $cc->decrypt($source);
        $this->assertSame($expected, $actual);
    }
}