<?php

namespace App\Helper;

class Helper
{
    public static function money_format($number = 0, $currency = '')
    {
        if (strpos(strval($number), '.')) {
            $number = explode('.', $number);
            return $currency . number_format($number[0], 0, ',', '.') . ',' . $number[1];
        } else {
            return $currency . number_format($number, 0, ',', '.');
        }
    }

    public static function replace_money($number = 0)
    {
        return (int)str_replace('.', '', preg_replace('/Rp /', '', $number));
    }
}
