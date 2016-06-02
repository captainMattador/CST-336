<?php

    $host     = "localhost";
    $dbname   = "boze4420";
    $username = "boze4420";
    $password = "Anxious2016";

    //establishes database connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    //shows errors when connecting to database
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

?>