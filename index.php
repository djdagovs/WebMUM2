<?php

// check if there is a config file

    if (!file_exists('config/config.php')) {
        echo "Please create a config/config.php file!";
        die();
    }

// load confis & libs

require 'config/config.php';
require 'db/driver.mysql.php';
require 'lib/AltoRouter.php';
require 'lib/class.User.php';

$router = new AltoRouter();
$user = new User($db);

// load login

if($user->isUserLogin())
{
    $router->map( 'GET', '/', 'render_dashboard', 'views/dashboard.php' );
}
else {
    $router->map( 'GET', '/', 'render_login', 'views/login.php' );
}

