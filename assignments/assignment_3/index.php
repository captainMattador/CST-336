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
                <h1>Your Lucky Lotto Number</h1>
                <?php 
                    if( isset( $_SESSION['error'] ) )
                    {
                        echo '<h2>** Please Fill Out All Form Elements **</h2>';
                    }
                ?>
                <form name="lucky-lotto-form" action="media/scripts/letter_scripts.php" method="POST">
                    
                    <div>
                        <label for="fname">Your Last Name</label><br>
                        <input type="text" name="fname" value="" maxlength="12">
                    </div>
                    
                    <div>
                        <label for="color">The Color of Your Eyes</label><br>
                        <input type="text" name="color" value="" maxlength="12">
                    </div>
                    
                    <div>
                        <label for="born">Where Were You Born</label><br>
                        <input type="text" name="born" value="" maxlength="15">
                    </div>
                    
                    <div>
                        <label for="month">An Important Month in Your Life?</label><br>
                        <select name="month">
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                    </div>
                    <div class="radio-btns">
                        <p>What's Your Marital Status?</p>
                        <span>
                            <label for="status">Signle</label>
                            <input type="radio" name="status" value="Single">
                        </span>
                        <span>
                            <label for="status">Married</label>
                            <input type="radio" name="status" value="Married">
                        </span>
                        <span>
                            <label for="status">Divorced</label>
                            <input type="radio" name="status" value="Divorced">
                        </span>
                    </div>
                    
                    <!-- form buttons -->
                    <div class="form-btns">
                        <span><input type="submit" name="submit" value="Get Your Numbers!"></span>
                        <span><input type="reset" name="reset" value="Clear Form"></span>
                    <div>
                    
                </form>
            </div>
        </section>

    </body>
</html>
