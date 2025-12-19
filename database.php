<?php
    $db_server = "localhost"; // Database server address
    $db_username = "root"; // Database username
    $db_password = ""; // Database password
    $db_name = "portfolio_website"; // Database name

    try {
        $conn = mysqli_connect($db_server, $db_username, 
                            $db_password, $db_name);

    } catch (mysqli_sql_exception) {
        echo "could not connect. <br>";
    }

    // if ($conn) {
    //     echo "connected to database.<br>";
    // }
?>