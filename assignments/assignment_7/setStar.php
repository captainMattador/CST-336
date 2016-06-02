
<?php

require '../../global/scripts/config.php';
require '../../global/scripts/db-conn-class.php';

$conn = new DB($config);
$updatedBook = array();
// test database connection
if($conn->getConn()){

	$bookId = isset($_GET["bookId"]) ? $_GET["bookId"] : NULL;
	$starLevel = isset($_GET["starLevel"]) ? $_GET["starLevel"] : NULL;

	if($bookId && $starLevel){
		
		$conn->update( "UPDATE book_reviews SET $starLevel = $starLevel + 1 WHERE id = :id", 
                array('id' => $bookId ) );

		$updatedBook = $conn->query( "SELECT * FROM book_reviews WHERE id = :id", 
         array('id' => $bookId) );
		
		echo json_encode($updatedBook);
	}

}
