<?php

    if (!$_SESSION['user'])
    {
        if($_GET['lk'] == "register")
        {
            include "register.php";
        }
        else
        {
            include "login.php";
        }
    }
    else
    {
        include "lk.php";
    }
?>