<?php
class AutoKeyCipher {
    private static $letters = [];

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
        $cipher = "";
        for ($i = 0; $i < strlen($text); $i++) {
            $p = array_search($text[$i], self::$letters);
            if ($i == 0) {
                $k = array_search($key, self::$letters);
            } else {
                $k = array_search($text[$i - 1], self::$letters);
            }
            $c = ($p + $k) % 58;
            $cipher .= self::$letters[$c];
        }
        return $cipher;
    }

    public function decode($cipher, $key) {
        $plainText = "";        
        for ($i = 0; $i < strlen($cipher); $i++) {
            $c = array_search($cipher[$i], self::$letters);
            if ($i == 0) {
                $k = array_search($key, self::$letters);
            } else {
                $k = array_search($plainText[$i - 1], self::$letters);
            }
            $p = ($c - $k) % 58;
            if ($p < 0) {
                $p += 58;
            }
            $plainText .= self::$letters[$p];
        }
        return $plainText;
    }
}


