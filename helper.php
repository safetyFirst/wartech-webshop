<?php

class Helper {

    public static function getLocationFields($string, $posOfNumber) {     
        $string = trim($string);
        $string_split = explode(" ", $string);

        if (count($string_split) != 2) {
            return false;
        } else if (!is_numeric($string_split[$posOfNumber])) {
            return false;
        } else {
            return $string_split;
        }
    }

    public static function getShorterString($string, $limit){
        if(strlen($string) > $limit){
            return substr($string, 0, $limit) . "...";
        }else {
            return $string;
        }
    }

    public static function getBrutto($netto, $mwst){
        return $netto / 100 * ($mwst + 100);
    }
}

?>