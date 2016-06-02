

<?php
    require '../../global/scripts/db-connection.php'; 
    
    // select team names and stadium names
    $sql = "SELECT teamName, stadiumId 
            FROM NFL_Team 
            ORDER BY teamName ASC";

    $stmt = $dbConn -> prepare($sql); //prepares a statement for execution and returns a statement object
    $stmt -> execute(); //execute the prepared statement
    $teamNames = $stmt->fetchAll(); //store the obtained data into an array variable
    
    /**** Getting stadiumInfo based on stadium Id ****/
    if (isset ($_GET['stadiumId'])) {
       $stadiumId = $_GET['stadiumId'];
       $sql = "SELECT * 
               FROM NFL_Stadium 
               WHERE stadiumId = :stadiumId";

       $stmt = $dbConn -> prepare($sql);
       $stmt -> execute( array (':stadiumId' => $stadiumId));
       $stadiumInfo = $stmt->fetch();
    }
    
    /******************* STEP 2 ***************************/
    /****  Top 5 states with the largest combined number of seats in NFL stadiums ***/
    function largestCombinedCapacity() {
        global $dbConn, $stmt;  //it uses the variables declared previously 
        $sql = "SELECT state, SUM( capacity ) combinedCapacity
                FROM NFL_Stadium 
                GROUP BY state
                ORDER BY combinedCapacity DESC
                LIMIT 5";
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute();
        return $stmt->fetchAll();
   }
   

    /******************* STEP 5 ***************************/
    /****  NFL teams and their home stadiums ***/
    function teamsAndStadiums() {
       global $dbConn, $stmt;  //it uses the variables declared previously 
        //NOTE: field names MUST match the ones in database, they are case sensitive!
        $sql = "SELECT teamName, stadiumName, state
                FROM NFL_Team t
                JOIN NFL_Stadium s ON t.stadiumId = s.stadiumId
                ORDER BY teamName";
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute();
        return $stmt->fetchAll();
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
        <title>Lab 4 - Part 1</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="../../global/css/styles.css">
        <link type="text/css" rel="stylesheet" href="media/css/styles.css">

    </head>
    <body>
        <section> 
            <div class="wrapper">
                <h2> NFL Teams &amp; Stadiums Queries </h2>
                <form>
                     <select name="stadiumId">
                       <option value="-1"> - Select Team -</option>
                       <?php
                            foreach ($teamNames as $team) {
                                echo "<option  value=" . $team['stadiumId'] . ">" . $team['teamName'] . "</option>";
                            }         
                       ?>   
                     </select>
                     <input type="submit" value="Get Stadium Info!" />
                 </form>
                
                 <?php
    
                    if (isset($stadiumInfo) && !empty($stadiumInfo)) {
                        echo "<p>" . $stadiumInfo['stadiumName'] . "<br>";
                        echo $stadiumInfo['street'] . "<br>";
                        echo $stadiumInfo['city'] . ", " . $stadiumInfo['state'] . " " . $stadiumInfo['zip']  . "</p>";
                    }

                ?>    
            </div>
        </section> 
        
        <section> 
            <div class="wrapper">                
                <!-------------- STEP 1 ----------------->
                <h2>Top 5 states with the largest combined number of seats in NFL stadiums</h2>
                
                <!-------------- STEP 3 ----------------->
                <?php
                    $records = largestCombinedCapacity();
                    echo "<p>";
                    foreach ($records as $record) {
                      echo $record['state'] . " - " . $record['combinedCapacity']  . "<br />";
                    } 
                    echo "</p>";
                ?>
                
                
            </div>
        </section> 
        
        <section> 
            <div class="wrapper">
                <!-------------- STEP 4 ----------------->
                <h2>List of all teams and their home stadium</h2>
                
                <!-------------- STEP 6 ----------------->
                <?php
                    $records = teamsAndStadiums();
                    echo "<p>";
                    foreach ($records as $record) {
                      echo $record['teamName'] . " - " . $record['stadiumName'] . "  - " . $record['state'] . "<br />";
                    } 
                    echo "</p>";
                ?>

                
                <!-- close connection -->
                <?php

                    $dbConn = null;

                ?>
                
            </div>
        </section> 
    </body>
</html>
