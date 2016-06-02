<?php 
    
    session_start();
    
    //$_SESSION['results'] = NULL:
    //$_SESSION['error'] = NULL:

    // cach some variable
    $fname = $_POST['fname'];
    $color = $_POST['color'];
    $born = $_POST['born'];
    $month = $_POST['month'];
    $status = $_POST['status'];
    
    // do some quick error checking
    if( 
        empty($fname) ||
        empty($color) ||
        empty($born) ||
        !isset($status)
      )
    {
        $_SESSION['error'] = "error";
        header( 'Location: ../../index.php');
    }else{
    
        // form is fine
        $fname = preg_replace("/[^a-zA-Z]/", "", $fname);
        $color = preg_replace("/[^a-zA-Z]/", "", $color);
        $born = preg_replace("/[^a-zA-Z]/", "", $born);
        $charArray = $fname . $color . $born . $month . $status;
        $charArray = strtolower( trim($charArray) );
        $charArray = str_split($charArray);

        // generate numbers// try five times for unique vals otherwise tell user they are unlucky
        for( $i = 0; $i < 5; $i++){
            $finalVals = generateNumbers($charArray);
            $numUniqueVals = sizeof( array_unique($finalVals) );
            if( $numUniqueVals == 6 ){
                // we have a winning ticket;
                break;
            }
            $finalVals = NULL;
        }

        $_SESSION['results'] = $finalVals;
        header( 'Location: ../../luckyNumbers.php');
    }

    function generateNumbers($arr){
        
        $returnArray=array();
        
        // randomize the array
        shuffle($arr);
        
        // get random array value
        $randomValue = array_rand($arr,1);
        array_push($returnArray, $randomValue);
        
        // total num of array elements
        $numElements = count($arr);
        array_push($returnArray, $numElements);
        
        // num of unique vals
        $numUniqueVals = sizeof( array_unique($arr) );
        array_push($returnArray, $numUniqueVals);
        
        // least common and most common chars
        $c = array_count_values($arr); 
        $mostCommon = array_search(max($c), $c);
        $leastCommon = array_search(min($c), $c);
        array_push($returnArray, getVal($leastCommon));
        array_push($returnArray, getVal($mostCommon));
        
        // 7 char turned to a number
        $seventhVal = array_slice($arr,6,1);
        array_push($returnArray, getVal($seventhVal[0]));
        
        return $returnArray;
    }

    function getVal($char){
        $val = NULL;
        switch($char){
            case 'a':
                $val = 1;
                break;
            case 'b':
                $val = 2;
                break;
            case 'c':
                $val = 3;
                break;
            case 'd':
                $val = 4;
                break;
            case 'e':
                $val = 5;
                break;
            case 'f':
                $val = 6;
                break;
            case 'g':
                $val = 7;
                break;
            case 'h':
                $val = 8;
                break;
            case 'i':
                $val = 9;
                break;
            case 'j':
                $val = 10;
                break;
            case 'k':
                $val = 11;
                break;
            case 'l':
                $val = 12;
                break;
            case 'm':
                $val = 13;
                break;
            case 'n':
                $val = 14;
                break;
            case 'o':
                $val = 15;
                break;
            case 'p':
                $val = 16;
                break;
            case 'q':
                $val = 17;
                break;
            case 'r':
                $val = 18;
                break;
            case 's':
                $val = 19;
                break;
            case 't':
                $val = 20;
                break;
            case 'u':
                $val = 21;
                break;
            case 'v':
                $val = 22;
                break;
            case 'w':
                $val = 23;
                break;
            case 'x':
                $val = 24;
                break;
            case 'y':
                $val = 25;
                break;
            case 'z':
                $val = 26;
                break;
        }
        
        return $val;
    }
?>