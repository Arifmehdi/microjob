<?php

if (!function_exists('balanceFormat')) {
    function balanceFormat($balance = 0, $currency = true)
    {
        $data = $currency ? '৳' : '';
        $data .= number_format($balance, 3, '.', ',');
        return $data;
    }
}
