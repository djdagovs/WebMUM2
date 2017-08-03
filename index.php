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

$user = new User($db);

if ($user->isUserLogin()) {
    if (isset($_GET["go"])) {
        switch ($_GET["go"]) {
        }
    } else {
        require 'dashboard.php';
    }
} else {
    require 'includes/login.php';
}
