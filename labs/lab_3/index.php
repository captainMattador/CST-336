<?php
	
	// variables
	$result1 = 0 . " in";
    $result2 = 0;    
    
    // form one logic
    if(isset($_GET["submit1"])){
        if(!empty($_GET['cm'])){
            $cm = $_GET['cm'];
            $result1 = (is_numeric($cm)? $cm * 0.393701 . " in" : "The value entered was not a number.");
        }else{
            $result1 = "Please fill out the form.";
        }
    }
    
    // form two logic
    if(isset($_GET['submit2'])){
        if(!empty($_GET['inches'])){
            if(is_numeric($_GET['inches'])){
                if(isset($_GET['unit'])){
                    switch($_GET['unit']){
                        case "cms":
                            $result2 = $_GET['inches'] * 2.54 . " cm";
                            break;
                        case "yards":
                            $result2 = $_GET['inches'] * 0.0277778 . " yrds";
                            break;
                        case "feet":
                            $result2 = $_GET['inches'] * 0.0833333 . " ft";
                            break;
                    }
                }else{
                    $result2 = "Please select a conversion.";
                }
            }else{
                $result2 = "The value entered was not a number.";
            }
        }else{
            $result2 = "Please fill out the form.";
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
        <title>Lab 3</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="media/css/styles.css">

    </head>
    <body>
        <section> 
            <div class="wrapper">
                
                <div class="form-wrapper">
                    <h1>Coverting Tool</h1>
                    <form name="cmToInches" action="" method="GET">
                        <label for="cm">Enter CMs:</label>
                        <input type="text" name="cm" value="" >
                        <div class="form-btns">
                            <input type="submit" name="submit1" value="Convert to Inches">
                        </div>
                    </form>
                    <p>Results: <?php echo $result1 ?></p>
                </div>
                
                <div class="form-wrapper">
                    <form>
                        <label for="inches">Enter Inches:</label>
                        <input type="text" name="inches" value="" >
                        
                        <span class="radio-btns">
                            <label for="inches">Convert to:</label>
                            cm:
                            <input type="radio" name="unit" value="cms" >
                            yards:
                            <input type="radio" name="unit" value="yards" >
                            feet:
                            <input type="radio" name="unit" value="feet" >
                        </span>
                        
                        <div class="form-btns">
                            <input type="submit" name="submit2" value="Convert to Inches">
                        </div>
                    </form>
                    <p>Results: <?php echo $result2 ?></p>
                </div>

            </div>
        </section> 
    </body>
</html>
