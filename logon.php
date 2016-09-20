<?php
    require_once ("Includes/session.php");
    require_once ("Includes/base-config.php"); 
    require_once ("Includes/connectDB.php");

if (isset($_POST['submit']))
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $query = "SELECT login FROM users WHERE login = ? AND password = SHA(?) LIMIT 1";
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('ss', $login, $password);

        $statement->execute();
        $statement->store_result();

        if ($statement->num_rows == 1)
        {
            $statement->bind_result($_SESSION['login']);
            $statement->fetch();
            header ("Location: index.php");
        }
        else
        {
            echo "Username/password combination is incorrect.";
        }
    }

?>

<div id="main">
        <form method="post" action="logon.php">
                <input type="text" name="login" value="" id="login" placeholder="enter your login">
                <input type="password" name="password" value="" id="password" placeholder="password">
                <input type="submit" name="submit" value="Submit">
        </form>
</div>


