<?php


namespace App\Libs;

class StringUtils
{
    public static function normalize(?string $string) {
        $string = trim( $string );
        $string = mb_strtolower( $string );
        $string = preg_replace( "/\p{Z}+/ui", " ", $string);
        $string = preg_replace( "/[^\p{M}\w\s]+/ui", " ", $string);
        $string = preg_replace( "/\s{2,}/", " ", $string);
        return trim($string);
    }

    public static function wordsCount(string $string) {
        return count(self::extractWords($string));
    }

    public static function countUniqueWords(string $string) {
        return count(self::extractUniqueWords($string));
    }

    public static function charactersCount(string $string) {
        if (preg_match_all("/\p{L}/ui", $string, $matches)) {
            return count($matches[0]);
        }
        return 0;
    }

    public static function extractWords(string $string) {
        $string = preg_replace( "/[\(\[].*[\)\]]/", " ", $string);
        $string = preg_replace( "/[\W\p{Z}\p{N}]/u", " ", $string);
        $string = preg_replace( "/\s{2,}/", " ", $string);

        $latin = $cjk = $hangul = $thai = $arabic = $cyrillic = $devanagari = [];
        if (preg_match_all("/[\p{Latin}]{2,}/ui", $string, $matches)) {
            $latin = $matches[0];
        }
        if (preg_match_all("/[\p{Hiragana}\p{Katakana}\p{Han}]/ui", $string, $matches)) {
            $cjk = $matches[0];
        }
        if (preg_match_all("/[\p{Hangul}]/ui", $string, $matches)) {
            $hangul = $matches[0];
        }
        if (preg_match_all("/[\p{Thai}]{1,2}/ui", $string, $matches)) {
            $thai = $matches[0];
        }
        if (preg_match_all("/[\p{Arabic}]{2,}/ui", $string, $matches)) {
            $arabic = $matches[0];
        }
        if (preg_match_all("/[\p{Cyrillic}]{2,}/ui", $string, $matches)) {
            $cyrillic = $matches[0];
        }
        if (preg_match_all("/[\p{Devanagari}]+/ui", $string, $matches)) {
            $devanagari = $matches[0];
        }

        return [...$latin, ...$cjk, ...$hangul, ...$thai, ...$arabic, ...$cyrillic, ...$devanagari];
    }

    public static function extractUniqueWords(string $string) : array {
        $words = self::extractWords($string);

        $unique_words = [];
        foreach ($words as $word) {
            if (strlen($word) < 3) {
                continue;
            }
            $word = preg_replace("/[^\p{L}]/u", "", $word);
            if (!$word) {
                continue;
            }
            $word = mb_strtolower($word);
            if (in_array($word, $unique_words)) {
                continue;
            }
            $unique_words[] = $word;
        }
        return $unique_words;
    }

    public static function detectLanguage(string $string) {
        return null;
    }

    public static function extractEmails(string $content = '') {
        if(preg_match_all(
        //"/\s([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6})*\s/",
            "/\s([a-z0-9_\.\+-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})(\s|$)/ui",
            $content,
            $matches)) {
            return array_map(fn($email) => self::trim($email), $matches[0]);
        }

        return [];
    }

    public static function extractPhones(string $content = '', bool $prefix = true) {
        if ($prefix) {
            $regex = "/(phone|tel|fax|Điện thoại|teléfonos|✆).{1,20}\+?\d{0,3}\s?(\(\d+\)|[\s\-\.]?\d{2,4})[\s\-\.]?\d{2,4}([\s\-\.]?\d{3,4})+/ui";
        } else {
            $regex = "/\+?\d{0,3}\s?(\(\d+\)|[\s\-\.]?\d{2,4})[\s\-\.]?\d{2,4}([\s\-\.]?\d{3,4})+/ui";
        }

        if (preg_match_all($regex, $content, $matches)) {
            $phones = array_map(fn($p) => self::trim($p), $matches[0]);
            return array_values(array_filter($phones, fn($p) => strlen($p) > 7));
        }

        return [];
    }

    public static function trim($str)
    {
        return preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $str);
    }
}
