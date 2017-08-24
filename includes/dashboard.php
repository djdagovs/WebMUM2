<?php

require 'views/header.tpl';
require 'views/adminMenu.tpl';

require 'includes/dashboardActions.php';

if(isset($_GET["go"]))
{
    switch($_GET["go"])
    {
        case 'domain';
            require 'views/domain.tpl';
        break;
        case 'domainAdd';
            require 'views/domainAdd.tpl';
        break;
        case 'account';
            require 'views/account.tpl';
        break;
        case 'accountAdd';
            require 'views/accountAdd.tpl';
        break;
        default;
            header('Location: index.php');
        break;
    }
}

require 'views/footer.tpl';
