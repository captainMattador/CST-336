<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Lab 2</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="../../global/css/styles.css">
        <link type="text/css" rel="stylesheet" href="media/css/styles.css">

    </head>
    <body>
        
        <table>
        <?php
            $cols = 10;
            $even = 0;
            $odd = 0;

            for($i = 0; $i < $cols; $i++){
                echo "<tr>";
                for($k = 0; $k < $cols; $k++){
                    $randNum = rand(1, 100);
                    if($randNum % 2 == 0){
                        echo "<td class=\"even\">";
                        $even++;
                    }else{
                        echo "<td class=\"odd\">";
                        $odd++;
                    }
                    echo $randNum . "</td>";
                }
                echo "</tr>";
            }
        ?>
        </table>
        
        <h2>There are <span><?php echo $odd; ?></span> odd numbers and <span><?php echo $even; ?></span> even numbers.</h2>
        <h2>There are <span><?php echo $odd; ?> %</span> of odd numbers and <span><?php echo $even; ?> %</span> of even numbers.</h2>
        
    </body>
</html>
