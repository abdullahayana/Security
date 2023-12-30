<?php
class VigenereCipher {
    private static $letters = [];

    public function __construct() {
        self::$letters = $this->makeLetters();
    }

    private function makeLetters() {
        $letters = [' ',',','.','?','!','\''];
        for ($i = 0; $i < 26; $i++) {
            $letters[$i + 5] = chr($i + 97);
        }
        for ($i = 0; $i < 26; $i++) {
            $letters[$i + 32] = chr($i + 65);
        }
        return $letters;
    }

    public function encode($text, $key) {
        $keyRepeated = $this->repeatKey($text, $key);
        $cipher = '';

        for ($i = 0; $i < strlen($text); $i++) {
            $p = array_search($text[$i], self::$letters);
            $k = array_search($keyRepeated[$i], self::$letters);
            $c = ($p + $k) % 58;
            $cipher .= self::$letters[$c];
        }

        return $cipher;
    }

    public function decode($cipher, $key) {
        $keyRepeated = $this->repeatKey($cipher, $key);
        $plainText = '';

        for ($i = 0; $i < strlen($cipher); $i++) {
            $c = array_search($cipher[$i], self::$letters);
            $k = array_search($keyRepeated[$i], self::$letters);
            $p = ($c - $k) % 58;
            if ($p < 0) {
                $p += 58;
            }
            $plainText .= self::$letters[$p];
        }

        return $plainText;
    }

    private function repeatKey($text, $key) {
        $repeatedKey = '';
        for ($i = 0; $i < strlen($text); $i++) {
            $repeatedKey .= $key[$i % strlen($key)];
        }
        return $repeatedKey;
    }
}

