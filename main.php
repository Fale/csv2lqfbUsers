<?php

require 'vendor/autoload.php';

Bootstrap::boot();

$a = Csv::csv2array('example.csv');

foreach ($a as $k => $user) {
    if (! User::where('email', $user[2])->count()) {
        $invite = sha1($user[0] + " " + $user[1] + ", " + date('c'));
        $u = new User;
        $u->inviteCode = $invite;
        $u->login = '?';
        $u->name = $user[0] + " " + $user[1];
    } else
        $invite = "";
    $a[$k][4] = $invite;
}

echo Csv::array2csv($a);