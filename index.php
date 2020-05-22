<?php

    session_start();

    // Connection to database
    require('config.php');

    // Checking if the files exist in 'controller', 'core' and 'models'
    spl_autoload_register(function($class) {

        if(file_exists('sources/constrollers/'.$class.'.php')) {

            // Controllers
            require 'sources/constrollers/'.$class.'.php';

        } else if(file_exists('sources/models/'.$class.'.php')) {

            // Models
            require 'sources/models/'.$class.'.php';

        } else if(file_exists('core/'.$class.'.php')) {

            // Core
            require 'core/'.$class.'.php';

        }

    });

    // Class core
    $core = new Core();

    $core->start();

?>