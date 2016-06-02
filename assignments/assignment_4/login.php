<?php 
    session_start();

    // if already loged in go to home page
    if( isset($_SESSION['currentUser']) )
        header('location: ');

    require 'model/login-logic.php';
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Socks Inventory - Login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="../../global/css/styles.css">
        <link type="text/css" rel="stylesheet" href="media/css/styles.css">
    </head>
    <body>

        <section id="header"> 
            <h1>Inventory List<br><span>Socks</span></h1>
        </section>

        <section> 
            <div class="login-wrapper">
                <div class="inner-wrap">
                    <h2>Login</h2>
                    <form method="POST">
                        <div>
                            <input type="text" name="username" value="" placeholder="Enter Username">
                        </div>
                        <div>
                            <input type="password" name="password" value="" placeholder="Enter Password">
                        </div>
                        <div class="form-btns">
                            <input type="submit" name="loginBTN" value="Login">
                        </div>
                    </form>
                    <div>
                        <p><a href="reset.php" title="Reset Password">Reset Password</a></p>
                        <!-- <p><a href="register.php" title="Register">Register</a></p> -->
                    </div>
                </div>     
            </div>
            <div class="clear"></div>
            <?php if(isset($status)): ?>
                <p class="login-status"><?= $status ?></p>
            <?php endif; ?> 
        </section>

    </body>
</html>