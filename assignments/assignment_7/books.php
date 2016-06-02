
<?php

require '../../global/scripts/config.php';
require '../../global/scripts/db-conn-class.php';

$conn = new DB($config);
$books = array();

// test database connection
if($conn->getConn()){

	$bookID = isset($_GET["id"]) ? $_GET["id"] : NULL;

	//either return all the books or reutrn one book by id
	if($bookID == "all"){
		$books = $conn->queryAll( "SELECT * FROM book_reviews");
	}else{
		$books = $conn->query( "SELECT * FROM book_reviews WHERE id = :id", 
         array('id' => $bookID) );
	}

	$books = json_encode($books);

}

echo $books;