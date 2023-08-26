<?php

if(!function_exists('formatNumberToThreeDigits')) {
    function formatNumberToThreeDigits($number)
    {
        return str_pad($number, 3, '0', STR_PAD_LEFT);
    }
}
