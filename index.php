<?php
session_start();

// check if there is a config file

    if (!file_exists('config/config.php')) {
        echo "Please create a config/config.php file!";
        die();
    }

// load config

require 'config/config.php';

// load libs

require 'db/driver.mysql.php';
require 'lib/class.User.php';
require 'lib/class.Mail.php';
require 'lib/AltoRouter.php';

$router = new AltoRouter();
$user = new User($db);
$mail = new Mail($db);

$router->map('GET', '/', function () {
    if ($user->isUserLogin()) {
        if (in_array($_SESSION["usermail"], $config["admin_mail"])) {
            require 'includes/dashboard.php';
        } else {
            require 'includes/changePassword.php';
        }
    } else {
        require 'includes/login.php';
    }
});

$router->map('GET', '/logout', function () {
    $user->logout();
    header('Location: .');
    die();
});

$match = $router->match();
