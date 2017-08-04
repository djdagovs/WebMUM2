<?php

require 'views/header.tpl';

if(in_array($config['admin_mail'], $_SESSION["usermail"]))
{

}
else
{
    require 'views/changePassword.tpl';
}

require 'views/footer.tpl';
