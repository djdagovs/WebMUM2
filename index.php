<?php

// check if there is a config file

    if (!file_exists('config/config.php')) {
        echo "Please create a config.php file!";
        die();
    }

// load confis & libs

require 'config/config.php';
require 'lib/AltoRouter.php';
