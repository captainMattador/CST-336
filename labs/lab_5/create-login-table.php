

<?php
    require '../../global/scripts/db-connection.php';
    
    $sql = "CREATE TABLE nfl_admin (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    firstname varchar (50),
    lastname varchar (50),
    username varchar (50) NOT NULL,
    password varchar (50) NOT NULL)";

    $stmt = $dbConn -> prepare($sql);
    $stmt -> execute();

    $sql = "INSERT INTO nfl_admin
    (firstname, lastname, username, password)
    VALUES
    (:firstname, :lastname, :username, :password)";
    $stmt = $dbConn -> prepare($sql);
    $stmt -> execute ( array (":firstname" => "Matt", ":lastname" => "Bozelka", ":username" => "boze83", ":password" => hash('sha1', 'secret')));


    echo "Your admin table is created!";
?>



<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Lab 5 - Create Log In Table</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="../../global/css/styles.css">
    </head> 
    <body>
        <section> 
            <div class="wrapper">               
            </div>
        </section> 
    </body>
</html>
