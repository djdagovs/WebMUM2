<?php
session_start();

// check if there is a config file

    if (!file_exists('config/config.php')) {
        echo "Please create a config/config.php file!";
        die();
    }

// load config

$configValues = require 'config/config.php';
Config::init($configValues);

// load libs

require 'db/driver.mysql.php';
require 'lib/class.User.php';

$user = new User($db);

if($user->isUserLogin())
{
}
else {
}

