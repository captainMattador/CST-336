<?php 

require '../../global/scripts/config.php';
require '../../global/scripts/db-conn-class.php';

$error = NULL;
$status = NULL;
$conn = new DB($config);

// test database connection
if($conn->getConn()){

    $status = "Please fill all elements correctly";

    if(isset($_POST['insertBTN'])){
        insertItem($conn);
    }
}

// connection failed
else{

    $status  = "Sorry there was an error with the database.";
}



function insertItem($conn){
    global $status;
    $pID = empty($_POST['id']) ? NULL : $_POST['id'];
    $desc = empty($_POST['desc']) ? NULL : $_POST['desc'];
    $color = empty($_POST['color']) ? NULL : $_POST['color'];
    $style = empty($_POST['style']) ? NULL : $_POST['style'];
    $price = empty($_POST['price']) ? NULL : $_POST['price'];
    $chInv = empty($_POST['chInvent']) ? NULL : $_POST['chInvent'];
    $laInv = empty($_POST['laInvent']) ? NULL : $_POST['laInvent'];

    // check everything is set
    if(
        !$pID ||
        !$desc ||
        !$color ||
        !$style ||
        !is_numeric($price) ||
        !is_numeric($chInv) ||
        !is_numeric($laInv)
    ){
        $status = "Please fill all elements correctly";
    }
    // all good so insert
    else{

        // lazy check to make up for not creating unique value
        $prodExists = $conn->queryAll( "SELECT * FROM products WHERE productId = :productId", 
             array('productId' => $pID ) );

        if($prodExists > 0){
            $status = "A product with that ID already exists";
        }else{
            $conn->insert('products', array('productId', 'description', 'color', 'style', 'price'), array($pID, $desc, $color, $style, $price) );
            $conn->insert('CHinventory', array('productID', 'qty'), array($pID, $chInv) );
            $conn->insert('LAInventory', array('productID', 'qty'), array($pID, $laInv) );
            header('location: index.php');
        }
    }
}
