<?php

    $host     = "host";
    $dbname   = "db_name";
    $username = "username";
    $password = "pw";

    //establishes database connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    //shows errors when connecting to database
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

?>