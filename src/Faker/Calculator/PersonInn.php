<?php

namespace Faker\Calculator;

class PersonInn
{
    /**
     * Generates INN Checksum
     *
     * https://ru.wikipedia.org/wiki/%D0%98%D0%B4%D0%B5%D0%BD%D1%82%D0%B8%D1%84%D0%B8%D0%BA%D0%B0%D1%86%D0%B8%D0%BE%D0%BD%D0%BD%D1%8B%D0%B9_%D0%BD%D0%BE%D0%BC%D0%B5%D1%80_%D0%BD%D0%B0%D0%BB%D0%BE%D0%B3%D0%BE%D0%BF%D0%BB%D0%B0%D1%82%D0%B5%D0%BB%D1%8C%D1%89%D0%B8%D0%BA%D0%B0
     *
     * @param string $inn
     * @return string Checksum (two digits)
     */
    public static function checksum($inn)
    {
        $multipliers1 = array(
            1 => 7,
            2 => 2,
            3 => 4,
            4 => 10,
            5 => 3,
            6 => 5,
            7 => 9,
            8 => 4,
            9 => 6,
            10 => 8
        );
        $sum1 = 0;
        for ($i = 1; $i <= 10; $i++) {
            $sum1 += intval(substr($inn, $i - 1, 1)) * $multipliers1[$i];
        }
        $n11 = strval(($sum1 % 11) % 10);
        $inn .= $n11;

        $multipliers2 = array(
            1 => 3,
            2 => 7,
            3 => 2,
            4 => 4,
            5 => 10,
            6 => 3,
            7 => 5,
            8 => 9,
            9 => 4,
            10 => 6,
            11 => 8
        );
        $sum2 = 0;
        for ($i = 1; $i <= 11; $i++) {
            $sum2 += intval(substr($inn, $i - 1, 1)) * $multipliers2[$i];
        }
        $n12 = strval(($sum2 % 11) % 10);
        return $n11 . $n12;
    }

    /**
     * @param string $inn
     * @return bool
     */
    public static function isValid($inn)
    {
        $checksum = self::checksum($inn);
        return
            substr($checksum, 0, 1) === substr($inn, 10, 1) &&
            substr($checksum, 1, 1) === substr($inn, 11, 1);
    }
}
