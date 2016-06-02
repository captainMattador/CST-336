<?php 

require '../../global/scripts/config.php';
require '../../global/scripts/db-conn-class.php';

$status = NULL;
$noMatch = "Passwords did not match.";
$noDBMatch = "No user with that username found";
$faliedConnection = "Connection to database failed.";
$conn = new DB($config);

// test database connection
if(!$conn->getConn())
    $status = $faliedConnection;

if( isset($_POST['resetBTN']) ){

	// capture form values
    $formUsername = empty($_POST['username']) ? NULL : $_POST['username'];
    $formNewPassword = empty($_POST['newPw']) ? NULL : $_POST['newPw'];
    $formConfPassword = empty($_POST['confPw']) ? NULL : $_POST['confPw'];
    
    // getvalues from database
    $dbUser = $conn->query( "SELECT * FROM users WHERE email = :email", 
         array('email' => $formUsername ) );

    if( $formNewPassword != $formConfPassword ){
    	$status = $noMatch;
    }
 	else if($dbUser){
 		$dbuser = $conn->update( "UPDATE user_pw SET pw = :pw WHERE user_id = :user_id", 
   		     array('pw' => hash("sha1", $formNewPassword), 'user_id' => $dbUser['user_id'] ) );
 		header('location: login.php');
 	}else{
 		$status = $noDBMatch;
 	}

}


