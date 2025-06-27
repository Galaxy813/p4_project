<?php

namespace Core;

class Validator
{
    public static function string($value, $min = 1, $max = INF)
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function date($value)
    {
        // Huidige datum zonder tijd (middernacht vandaag)
        $now = new \DateTime('today');

        try {
            $d = new \DateTime($value);
        } catch (\Exception $e) {
            // Ongeldige datumstring
            return false;
        }

        // Datum mag niet in het verleden liggen
        if ($d < $now) {
            return false;
        }

        return true;
    }
}