<?
    require '../../global/scripts/db-connection.php';

    function getStadium($stadiumId){
        global $dbConn;

        $sql = "SELECT * 
        FROM NFL_Stadium
        WHERE stadiumId = :stadiumId";
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute(array(":stadiumId"=>$stadiumId));
        return $stmt->fetch(); 
    }

    if (isset($_POST['save'])) { //checks whether we're coming from "save data" form

        $sql = "UPDATE NFL_Stadium
        SET stadiumName = :stadiumName,
        street = :street,
        city = :city
        WHERE stadiumId = :stadiumId";
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute(array(":stadiumName"=>$_POST['stadiumName'],
        ":street"=>$_POST['street'],
        ":city"=>$_POST['city'],
        ":stadiumId"=>$_POST['stadiumId']
        )); 

        echo "RECORD UPDATED!! <br> <br>"; 
        
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
        <title>Update Stadium</title>
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
            
                <h2>Update Stadium Info</h2>
            <?

            if (isset($_POST['stadiumId'])) {
            $stadiumInfo = getStadium($_POST['stadiumId']); ?>

            <form method="post">
            
            <div> 
                <p>Stadium Name:</p>
                <input type="text" name="stadiumName" value="<?=$stadiumInfo['stadiumName']?>" />
            </div>
                
            <div>
                <p>Street:</p>
                <input type="text" name="street" value="<?=$stadiumInfo['street']?>" />
            </div>
                
            <div>
                <p>City:</p>
                <input type="text" name="city" value="<?=$stadiumInfo['city']?>" />
            </div>
                
            <div>
            <input type="hidden" name="stadiumId" value="<?=$stadiumInfo['stadiumId']?>">
            </div>
                
            <div>
            <input type="submit" name="save" value="Save"> 
            </div>
                
            </form>

            <? }

            ?>
            <br /><br />
            <p><a href="index.php"> Go back to main page </a></p>

            </div>
        </section>
    </body>
</html>