
<?php
    // Start the session
    session_start();
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Matt Bozelka - CST336 Home Page</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="media/css/styles.css">
    </head>
    <body>
        <section> 
            <div class="wrapper">
                <?php 
                    
                    if( $_SESSION['results'] ){
                        echo "<h1>Based on our unique algorithm your lucky numbers are!</h1>";
                        echo "<div class=\"numbers\">";
                            foreach( $_SESSION['results'] as $number ){
                                echo "<div><span>";
                                echo $number;
                                echo "</span></div>";
                            }
                        echo "</div>";
                    }else{
                        echo "<h1>Sorry, but it appears you are not very lucky :(</h1>";
                    }
                
                ?>
            </div>
        </section>

    </body>
</html>
