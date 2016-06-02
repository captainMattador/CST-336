<?php 

require '../../global/scripts/config.php';
require '../../global/scripts/db-conn-class.php';

$status = NULL;
$noMatch = "Username or Password did not match.";
$faliedConnection = "Connection to database failed.";
$conn = new DB($config);

// test database connection
if(!$conn->getConn())
    $status = $faliedConnection;


if( isset($_POST['loginBTN']) ){

    // capture form values
    $formUsername = empty($_POST['username']) ? NULL : $_POST['username'];
    $formPassword = empty($_POST['password']) ? NULL : $_POST['password'];

    // getvalues from database
    $dbUser = $conn->query( "SELECT * FROM users WHERE email = :email", 
         array('email' => $formUsername ) );

    $dbPassword = $conn->query( "SELECT pw FROM user_pw WHERE user_id = :user_id", 
         array('user_id' => $dbUser['user_id']) );

    if(
        !$formUsername ||
        !$formPassword ||
        $dbPassword['pw'] != hash("sha1", $formPassword ) 
    ){
        $status = $noMatch;
    }
    else{

        // write time stamp to the database for the user
        $conn->update( "UPDATE user_time_stamp SET last_login = :last_login WHERE user_id = :user_id", 
            array('last_login'=> date('Y-m-d H:i:s'), 'user_id' => $dbUser['user_id']) );

        $date = $conn->query( "SELECT last_login FROM user_time_stamp WHERE user_id = :user_id", 
            array('user_id' => $dbUser['user_id']) );

        // set session variables
        $_SESSION['last_login'] = ( $date ) ? $date : '0:00';
        $_SESSION['currentUser'] = $dbUser;
        header('location: index.php');
    }

}



// helper funtions
