<?php

class Csv {

    static function csv2array($file)
    {
        $array = array();
        foreach (file($file) as $k => $line) {
            $ta = str_getcsv($line);
            $array[$k]=array_map('trim',$ta);
        }
        return $array;
    }

    static function array2csv($array)
    {
        foreach ($array as $k => $line)
            $array[$k] = implode(',', $line);
        return implode ("\n", $array);
    }

}