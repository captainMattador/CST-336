
<?php

session_start();

if (isset($_POST['username'])){
    require '../../global/scripts/db-connection.php';

    $sql = "SELECT *
    FROM nfl_admin
    WHERE username = :username
    AND password = :password";

    $stmt = $dbConn -> prepare($sql);
    $stmt -> execute(array(":username" => $_POST['username'], ":password" => hash("sha1", $_POST['password'])));

    $record = $stmt -> fetch();

    if (empty($record)){
        echo "Wrong username/password!";
    } else {
        $_SESSION['username'] = $record['username'];
        $_SESSION['name'] = $record['firstname'] . " " . $record['lastname'];
        header("Location: index.php");
    }
}

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Lab 5 - Log In</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="../../global/css/styles.css">
    </head> 
    <body>
        <section> 
            <div class="wrapper">
                <h2>Login</h2>
                <form method="post">
                    Username: <input type="text" name="username" /><br />
                    <p></p>
                    Password: <input type="password" name="password" /><br />
                    <p></p>
                    <input type="submit" value="Login" />
                    <p></p>
                </form>
                <p>
                Username: boze83<br />
                Password: secret
                </p>
            </div>
        </section> 
    </body>
</html>
