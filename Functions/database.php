<?php
    require_once ("/Includes/base-config.php");

    function prep_DB_content ()
    {
        global $databaseConnection;

        create_tables($databaseConnection);
        create_admin($databaseConnection);
    }

    function create_tables($databaseConnection)
    {
        $query_users = "CREATE TABLE IF NOT EXISTS users (id INT NOT NULL AUTO_INCREMENT, login VARCHAR(50), password CHAR(40), PRIMARY KEY (id))";
        $databaseConnection->query($query_users);

    }


    function create_admin($databaseConnection)
    {
        // HACK: Storing config values in variables so that they aren't passed by reference later.
        $default_admin_username = DEFAULT_ADMIN_USERNAME;
        $default_admin_password = DEFAULT_ADMIN_PASSWORD;

        $query_check_admin_exists = "SELECT id FROM users WHERE login = ? LIMIT 1";
        $statement_check_admin_exists = $databaseConnection->prepare($query_check_admin_exists);
        $statement_check_admin_exists->bind_param('s', $default_admin_username);
        $statement_check_admin_exists->execute();
        $statement_check_admin_exists->store_result();
        if($statement_check_admin_exists->num_rows == 0)
        {
            $query_insert_admin = "INSERT INTO users (login, password) VALUES (?, SHA(?))";
            $statement_insert_admin = $databaseConnection->prepare($query_insert_admin);
            $statement_insert_admin->bind_param('ss', $default_admin_username, $default_admin_password);
            $statement_insert_admin->execute();
            $statement_insert_admin->store_result();

            
        }
    }
?>