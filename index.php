<?php

    session_start();

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    // Connection to database
    require('config.php');

    // Checking if the files exist in 'controller', 'core' and 'models'
    spl_autoload_register(function($class) {

        if(file_exists('sources/controllers/'.$class.'.php')) {

            // Controllers
            require 'sources/controllers/'.$class.'.php';

        } else if(file_exists('sources/models/'.$class.'.php')) {

            // Models
            require 'sources/models/'.$class.'.php';

        } else if(file_exists('core/'.$class.'.php')) {

            // Core
            require 'core/'.$class.'.php';

        }

    });

    // Class core
    $core = new core();

    $core->start();

?>