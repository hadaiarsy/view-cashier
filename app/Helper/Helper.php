<?php

namespace App\Helper;

class Helper
{
    public function money_format($number = 0, $currency = '')
    {
        return $currency . number_format($number, 0, ',', '.');
    }

    public function replace_money($number = 0)
    {
        return (int)str_replace('.', '', preg_replace('/Rp /', '', $number));
    }
}
