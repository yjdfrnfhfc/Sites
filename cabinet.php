<?php
require_once ("Includes/session.php");

        $userid = $_SESSION['userid'];
        $login = $_SESSION['login'];
        /*
        if ($login)
        {
        $query = "SELECT login FROM users_profile WHERE login = ? AND password = SHA(?) LIMIT 1";
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('ss', $login, $password);

        $statement->execute();
        $statement->store_result();

        if ($statement->num_rows == 1)
        {
            $statement->bind_result($_SESSION['userid'],$_SESSION['login']);
            $statement->fetch();
        }
        }*/
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <?php 
        foreach ($_SESSION as $item=>$description)
            echo  "$item: $description <br>";?>
    </body>
</html>
