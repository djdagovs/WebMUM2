<?php

require 'views/header.tpl';

if (isset($_POST['email'])) {
    
    $user->EMAIL = $_POST['email'];
    $user->PASSWORD = $_POST['password'];

    if ($user->login()) {
        header('Location: index.php');
        die();
    } else {
        require 'views/error.login.tpl';
    }
}
    require 'views/login.tpl';

require 'views/footer.tpl';
