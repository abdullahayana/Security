<?php
class CaesarCipher {
    private static  $letters = [];

    public function __construct() {
        self::$letters = $this->makeLetters();
    }

    private function makeLetters() {
        $letters = [' ',',','.','?','!','\''];
        for ($i = 0; $i < 26; $i++) {
            $letters[$i + 6] = chr($i + 97);
        }
        for ($i = 0; $i < 26; $i++) {
            $letters[$i + 32] = chr($i + 65);
        }
        return $letters;
    }

     public function encode($text, $key) {
        $cipher = '';
        foreach (str_split($text) as $char) {
            $p = array_search($char, self::$letters);
            $c = ($p + $key) % 58;
            $cipher .= self::$letters[$c];
        }
        return $cipher;
    }

    public function decode($cipher, $key) {
        $plainText = '';
        foreach (str_split($cipher) as $char) {
            $c = array_search($char, self::$letters);
            $p = ($c - $key) % 58;
            if ($p < 0) {
                $p += 58;
            }
            $plainText .= self::$letters[$p];
        }
        return $plainText;
    }
}
