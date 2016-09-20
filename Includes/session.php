<?php
    session_start();
    require_once  ("Includes/connectDB.php");

    function logged_on()
    {
        return isset($_SESSION['login']);
    }

    function confirm_is_admin() {
        if (!logged_on())
        {
            header ("Location: logon.php");
        }

        if (!is_admin())
        {
            header ("Location: index.php");
        }
    }

    function is_admin()
    {
        return 1;
    }
?>