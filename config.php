<?php

    // Request to know if the system is in 'development' or 'production' mode
    require 'environment.php';

    // define fuso
    date_default_timezone_set('America/Sao_Paulo');

    define('LOGO', isset($_SESSION['logo']) ? $_SESSION['logo'] : '');

    define('PAGE_LIMIT', 10);

    // Defining access settings for each
    $config = array();

    if(ENVIRONMENT == 'development') {

        // Defining cache to load links and scripts
        define("CACHE", md5(date('d-m-Y h:i:s') . rand(0,8888)));

        // Creating URL differenctiation
        define("HTTP", "https://localhost/easy-tickets");

        // Access data 'development'
        $config['name'] = 'easy_tickets';
        $config['host'] = '18.228.25.66';
        $config['user'] = 'hello';
        $config['password'] = 'hello@190309';

        $config['host'] = 'localhost';
        $config['user'] = 'root';
        $config['password'] = '';

    }

    if(ENVIRONMENT == 'production') {

        // Defining cache to load links and scripts
        define("CACHE", md5(date('d-m-Y h:i:s') . rand(0,8888)));

        // Creating URL differenctiation
        define("HTTP", "https://workle.com.br/previews/easy-tickets");

        // Access data 'development'
        $config['name'] = 'easy_tickets';
        $config['host'] = 'localhost';
        $config['user'] = 'root';
        $config['password'] = 'hello@190309';

    }

    // load and define default links by head
    ob_start();
    include(__DIR__ . '/sources/views/pages/links.php');
    $links = ob_get_clean();
    define("LINKS", $links);

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