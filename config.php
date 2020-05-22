<?php

    // Request to know if the system is in 'development' or 'production' mode
    require 'environment.php';

    // Defining access settings for each
    $config = array();

    // Checking whick mode it is in, and setting the correct information
    if(ENVIRONMENT == 'development') {

        // Creating URL differenctiation
        define("BASE_URL", "http://localhost/my-mvc/");

        // Access data 'development'

        $config['name'] = 'my-mvc';

        $config['host'] = 'localhost';

        $config['user'] = 'root';

        $config['password'] = '';

    } else {

        // Creating URL differenctiation
        define("BASE_URL", "https://my-mvc.com.br/");

        // Access data 'production'

        $config['name'] = 'my-mvc';

        $config['host'] = 'localhost';

        $config['user'] = 'root';

        $config['password'] = '';

    }

    // Defininf this variable as global
    global $database;

    // Try connection to database
    try {

        $database = new PDO("mysql:dbname=".$config['name'].";host=".$config['host'], $config['user'], $config['password']);

    } catch(PDOException $e) {

        echo "Error: ".$e->getMessage();

        exit;

    }

?>