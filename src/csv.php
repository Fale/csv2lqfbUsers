<?php

class csv {

    static function csv2array($file)
    {
        $array = array();
        foreach (file($file) as $k => $line)
            $array[$k] = str_getcsv($line);
        return $array;
    }

    static function array2csv($array)
    {
        foreach ($array as $k => $line)
            $array[$k] = implode(',', $line);
        return implode ('\n', $array);
    }

}