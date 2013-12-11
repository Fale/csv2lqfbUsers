<?php

require 'vendor/autoload.php';

function checkFirstAvailable($name, $field)
{
    if (Member::where($field, $name)->count() == 0)
        return $name;
    $c = 0;
    while (1 < 2) {
        $c = $c + 1;
        if (Member::where($field, $name . $c)->count() == 0)
            return $name . $c;
    }
}

Bootstrap::boot();

$a = Csv::csv2array('example.csv');

foreach ($a as $k => $member) {
    if (Member::where('email', $member[2])->count() == 0 AND Member::where('identification', $member[3])->count() == 0) {
        $invite = sha1($member[0] . " " . $member[1] . ", " . date('c'));
        if (! Member::where('invite_code', $invite)->count()) {
            $m = new Member;
            $m->invite_code = $invite;
            $m->login = checkFirstAvailable(substr($member[2], 0, strpos($member[2], "@")), 'login')
            $m->identification = $member[3];
            $m->name = checkFirstAvailable(ucwords(strtolower($member[0])) . " " . ucwords(strtolower($member[1])), 'name');
            $m->save();
        } else {
            print_r($member);
            echo $invite;
        }

    } else
        $invite = "";
    $a[$k][4] = $invite;
}

echo Csv::array2csv($a);
