<?php

require 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;  

$capsule = new Capsule; 

$capsule->addConnection(array(
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'wordpress',
    'username'  => 'username',
    'password'  => 'password',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => ''
));

$capsule->bootEloquent();

$a = csv::csv2array('example.csv');



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


echo csv::array2csv($a);