<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Matt Bozelka - Assignment 2</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="media/css/styles.css">

    </head>
    
    <?php
         // program variables
         $daysInMonth = date("t");
         $currentMonth = date("F");
         $currentDay = date("j");
         $currentDayWithLeadingZero = date("d");
         $currentMonthWithLeadingZero = date("m");
         $currentYear = date("y");
         $fullYear = date("o");
         $hexValue = $currentDayWithLeadingZero . $currentMonthWithLeadingZero . $currentYear;
         $timeStampOfTheFirst = mktime(0, 0, 0, $currentMonthWithLeadingZero, 1, $fullYear);
         $startingDay = $w= date("w", $timeStampOfTheFirst);
         $prevMonth = 0;
         $nextMonth = 0;
         $counter = 0;
    ?>
    <body>
        
        <section id="header"> 
            <div class="wrapper">
                <h1>Today's Hex Color Based on Date Is: <br><span style="color:#<?php echo $hexValue ?>;">#<?php echo $hexValue ?></span></h1>
            </div>
        </section>
        
        
        <section id="calendar"> 
            <?php
                $counter = 0;
    
                echo "<table><tr><th colspan=\"7\">Month of $currentMonth</th></tr>";
                
                // print the week day
                echo "<tr>";
                for($i = 0; $i < 7; $i++){
                    echo "<td class=\"day-of-week\">";
                    switch($i){
                        case 0:
                            echo "S";
                            break;
                        case 1:
                            echo "M";
                            break;
                        case 2:
                            echo "T";
                            break;
                        case 3:
                            echo "W";
                            break;
                        case 4:
                            echo "T";
                            break;
                        case 5:
                            echo "F";
                            break;
                        default:
                            echo "S";
                    }
                    echo "</td>";
                }
                echo "</tr>";
                
                // print the days of the month
                for($i = 0; $i < ceil(($daysInMonth + $startingDay)/7); $i++){
                    
                    echo "<tr>";
                        for($k = 0; $k < 7; $k++){
                            
                            if( $prevMonth < $startingDay ){
                                echo "<td class=\"prev-month\"></td>";
                                $prevMonth++;
                            }
                            else if( $counter < $daysInMonth ){
                                if( $counter + 1 == $currentDay )
                                    echo "<td class=\"current-month current-day\"><span style=\"background-color:#$hexValue\">" . ($counter + 1) . "</span></td>";
                                else
                                    echo "<td class=\"current-month\">" . ($counter + 1) . "</td>";
                                $counter++;
                            }else{
                                echo "<td class=\"next-month\"></td>";
                            }
                            
                        }
                    echo "</tr>";
                    
                }
                echo "</table>";
            ?>
            <div class="disclaimer">
             <p>
             *This program is a quick representation of an idea I read about in a blog 
             where the background color changes based on the dates 
             representation of a hexidecimal color. In my implementaion the calendar background 
             for the current day is the hex representation of the date.<br>
             <b>ex: 01/12/2015 = hex #120115;</b><br>
             Come back tomorrow and the color will be different :)</p>
            </div>
        </section>

    </body>
</html>
