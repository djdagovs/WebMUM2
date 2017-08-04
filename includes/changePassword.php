<?php

require 'views/header.tpl';
require 'views/userMenu.tpl';

if (isset($_POST['password'])) {
    if ($_POST["password_repeat"] == $_POST["password"]) {
        if (strlen(trim($_POST["password"])) < $config["password_min_length"]) {
            require 'views/error.passwordLength.tpl';
        } else {
            $user->PASSWORD = $_POST['password'];
            if ($user->changePassword()) {
                require 'views/success.password.tpl';
            } else {
                require 'views/error.passwordSet.tpl';
            }
        }
    } else {
        require 'views/error.password.tpl';
    }
}
require 'views/changePassword.tpl';

require 'views/footer.tpl';
