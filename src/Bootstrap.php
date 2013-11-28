<?php

use Illuminate\Database\Capsule\Manager as Capsule;  

class Bootstrap {

    function boot()
    {
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

        return null;
    }
}