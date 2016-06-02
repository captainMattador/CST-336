

<?php
    require '../../global/scripts/db-connection.php';

    function getStadiums(){
        global $dbConn;

        $sql = "SELECT stadiumId, stadiumName
                FROM NFL_Stadium
                ORDER BY stadiumName";
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute();
        return $stmt->fetchAll();
    }


    function getTeamNames(){
        global $dbConn;

        $sql = "SELECT teamId, teamName
                FROM NFL_Team
                ORDER BY teamName";
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute();
        return $stmt->fetchAll();
    }
    
    if (isset($_POST['delete'])) { //checks whether the delete button was clicked

       $sql = "DELETE FROM NFL_Stadium
               WHERE stadiumId = :stadiumId";
       $stmt = $dbConn -> prepare($sql);
      // $stmt -> execute( array(":stadiumId"=> $_POST['stadiumId']));
       echo "Stadium Deleted! <br /><br />";      
    }


    if (isset ($_POST['addMatch'])) { //checks whether the "addMatch" button was clicked

         $sql = "INSERT INTO NFL_Match
                 (team1_id, team2_id, date)
                 VALUES
                 (:team1_id, :team2_id, :date)";
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute ( array (":team1_id" => $_POST['team1'],
                                  ":team2_id" => $_POST['team2'],
                                  ":date" => $_POST['date']));    

        $matchId = $dbConn->lastInsertId();

        $sql = "INSERT INTO NFL_Recap
                (matchId, recap)
                VALUES
                (:matchId, :recap)";
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute ( array (":matchId" => $matchId,
                                 ":recap"   => $_POST['recap']));

        echo "Record was added!";    


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
        <title>Lab 4 - Part 2</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="../../global/css/styles.css">
        <link type="text/css" rel="stylesheet" href="media/css/styles.css">
        
        <script>
            function confirmDelete(stadium){
                confirm('Are you sure you want to delete stadium ' + stadium);
            };
        </script>
    </head> 
    <body>
        <section> 
            <div class="wrapper">
                <h2>NFL Matches</h2>
      
                  <form method="post">
                      <div>
                          <p>Select Team 1:</p>
                          <select name="team1">
                              <?php
                                $teamNames = getTeamNames();
                                  foreach ($teamNames as $team) {
                                       echo "<option value='" . $team['teamId'] . "' >" . $team['teamName'] . "</option>";
                                  } 
                              ?>
                          </select>
                      </div>
                      <div>
                          <p>Select Team 2:</p>
                          <select name="team2">
                              <?php
                                  foreach ($teamNames as $team) {
                                       echo "<option value='" . $team['teamId'] . "' >" . $team['teamName'] . "</option>";
                                  }               
                              ?>
                          </select>
                      </div>
                      <div>
                          <p>Date:</p>
                          <input type="date" name="date">
                      </div>
                      <div>
                          <p>Enter Match Recap:</p>
                          <textarea name="recap" rows="15" cols="60"></textarea>
                      </div>
                      <div>
                          <input type="submit" value="Add Match" name="addMatch">
                      </div>
                  </form>                
            </div>
        </section> 
        
        <section> 
            <div class="wrapper">
                 <h2>NFL Stadiums</h2>
    
                    <?php $stadiumList = getStadiums(); ?>
                    <ul class="change-stadium">
                    <? foreach ($stadiumList as $stadium) { ?>
                    <li>
                    <span><?=$stadium['stadiumName']?></span>
                    <form method="post" action="updateStadium.php">
                        <input type="hidden" name="stadiumId" value="<?=$stadium['stadiumId']?>">
                        <input type="submit" name="update" value="Update">
                    </form>
                    <form method="post" onsubmit="confirmDelete('<?=$stadium['stadiumName']?>')" >
                        <input type="hidden" name="stadiumId" value="<?=$stadium['stadiumId']?>">            
                        <input type="submit" name="delete" value="Delete">
                    </form>
                    </li>
                    <? } ?>
                    </ul>
            
            </div>
        </section> 
    </body>
</html>
