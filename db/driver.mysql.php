<?php

// create db connection
// use PDO

$db = new PDO("mysql:host=".$config["mysql_host"].";dbname=".$config["mysql_database"], $config["mysql_user"] , $config["mysql_password"]);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

