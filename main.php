<?php

require 'vendor/autoload.php';

Bootstrap::boot();

$a = Csv::csv2array('example.csv');

foreach ($a as $k => $member) {
    if (Member::where('email', $member[2])->count() == 0 AND Member::where('identification', $member[3])->count() == 0) {
        $invite = sha1($member[0] . " " . $member[1] . ", " . date('c'));
        if (! Member::where('invite_code', $invite)->count()) {
            $m = new Member;
            $m->invite_code = $invite;
            $login = substr($member[3], 0, strpos($member[3], "@"));
            if (Member::where('login', $login)->count() == 0)
                $m->login = $login;
            elseif (Member::where('login', $login + 1)->count() == 0)
                $m->login = $login + '1';
            elseif (Member::where('login', $login + 2)->count() == 0)
                $m->login = $login + '2';
            $m->identification = $member[3];
            $m->name = ucwords(strtolower($member[0])) + " " + ucwords(strtolower($member[1]));
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
