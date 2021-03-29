<?php

namespace App\Helper;

class Helper
{
    public function money_format($number = 0, $currency = '')
    {
        return $currency . number_format($number, 0, ',', '.');
    }
}
