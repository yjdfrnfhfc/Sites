<?php  
    require_once ("Includes/session.php");
    require_once ("Includes/base-config.php"); 
    require_once  ("Includes/connectDB.php");

    if (isset($_POST['submit']))
    {
        
        $login = $_POST['login'];
        $password = $_POST['password'];

        $query = "SELECT id, login FROM users WHERE login = ? AND password = SHA(?) LIMIT 1";
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('ss', $login, $password);

        $statement->execute();
        $statement->store_result();

        if ($statement->num_rows == 1)
        {
            $statement->bind_result($_SESSION['userid'],$_SESSION['login']);
            $statement->fetch();
            
            header ("Location: home.php");
        }
        
        else
        {
         
        $query = "SELECT login FROM users WHERE login = ? LIMIT 1";
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('s', $login);

        $statement->execute();
        $statement->store_result();
            
        if ($statement->num_rows != 1)
           {
                $query = "INSERT INTO users (login, password) VALUES (?, SHA(?))";

                $statement = $databaseConnection->prepare($query);
                $statement->bind_param('ss', $login, $password);
                $statement->execute();
                $statement->store_result();

                $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
                if ($creationWasSuccessful)
                {
                    $userId = $statement->insert_id;
                    $_SESSION['userid'] = $userId;
                    $_SESSION['login'] = $login;
                    header ("Location: home.php");
                }
                else
                {
                    header ("Location: index.php");
                }
            
            }
            else{
                echo "Incorrect password";
            }
        }
    header ("Location: home.php");
    }
    
?>
<div id="main">

        <form action="register.php" method="post">
             
                <input type="text" name="login" value="" id="login" placeholder="your login" />                   
                <input type="password" name="password" value="" id="password" placeholder ="your password"/>        
                <input type="submit" name="submit" value="Submit" />

        </form>
     </div>
