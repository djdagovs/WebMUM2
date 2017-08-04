<?php

require 'views/header.tpl';
require 'views/adminMenu.tpl';

require 'includes/dashboardActions.php';

if(isset($_GET["go"]))
{
    switch($_GET["go"])
    {
        case 'domainAdd';
            require 'views/domainAdd.tpl';
        break;
        default;
            header('Location: index.php');
        break;
    }
}

require 'views/footer.tpl';
