<?php

require 'vendor/autoload.php';

Bootstrap::boot();

$a = Csv::csv2array('example.csv');

foreach ($a as $k => $member) {
    if (! Member::where('email', $member[2])->count() AND Member::where('login', $member[3])->count()) {
        $invite = sha1($member[0] . " " . $member[1] . ", " . date('c'));
        if (! Member::where('invite_code', $invite)->count()) {
            $m = new Member;
            $m->invite_code = $invite;
            $m->login = $member[3];
            $m->name = $member[0] + " " + $member[1];
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