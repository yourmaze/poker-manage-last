<?php


namespace App\Http\Services;



class SiteService
{
    public static function getValueFromPercent(int $value, int $percent): int
    {
        return $value * $percent / 100;
    }

    public static function my_bcmod( $x, $y )
    {
        // how many numbers to take at once? carefull not to exceed (int)
        $take = 5;
        $mod = '';

        do
        {
            $a = (int)$mod.substr( $x, 0, $take );
            $x = substr( $x, $take );
            $mod = $a % $y;
        }
        while ( strlen($x) );

        return (int)$mod;
    }
}
