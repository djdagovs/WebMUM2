<?php

if (isset($_POST["domainNew"])) {
    if (!empty($_POST["domainNew"])) {
        $mail->NEWDOMAIN = $_POST["domainNew"];
        if ($mail->existsDomain()) {
            if ($mail->createDomain()) {
                require 'views/success.domain.tpl';
            } else {
                require 'views/error.domainNoInput.tpl';
            }
        } else {
            require 'views/error.domainExists.tpl';
        }
    } else {
        require 'views/error.domainNoInput.tpl';
    }
}

if (isset($_GET['domainDel'])) {
    $mail->DID = $_GET['domainDel'];
    if ($mail->domainDependencies()) {
        require 'views/error.domainDependencies.tpl';
    } else {
        if ($mail->deleteDomain()) {
            require 'views/success.domainDelete.tpl';
        }
    }
}
