<?php

require 'vendor/autoload.php';

Bootstrap::boot();

$a = Csv::csv2array('example.csv');

foreach ($a as $k => $member) {
    if (! Member::where('email', $member[2])->count()) {
        $invite = sha1($member[0] + " " + $member[1] + ", " + date('c'));
        $m = new Member;
        $m->inviteCode = $invite;
        $m->login = '?';
        $m->name = $member[0] + " " + $member[1];
    } else
        $invite = "";
    $a[$k][4] = $invite;
}

echo Csv::array2csv($a);