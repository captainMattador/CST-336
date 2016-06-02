<?php

// connect to db
function connect($config)
{
	try{
    	$conn = new PDO(
	        'mysql:host=localhost;dbname=' . $config['DB'], 
	        $config['DB_USERNAME'],
	        $config['DB_PASSWORD']
	    );
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	    return $conn;
	}catch(Exception $e){
	    return false;
	}
}