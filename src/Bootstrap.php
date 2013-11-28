<?php

use Illuminate\Database\Capsule\Manager as Capsule;  

class Bootstrap {

    function boot()
    {
        $capsule = new Capsule; 

        $capsule->addConnection(array(
            'driver'    => 'pgsql',
            'host'      => 'localhost',
            'database'  => 'liquid_feedback',
            'username'  => 'www-data',
            'password'  => '',
            'charset'   => 'utf8',
            'prefix'    => '',
            'schema'   => 'public'
        ));

        $capsule->bootEloquent();

        return null;
    }
}