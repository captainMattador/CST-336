<?php 

require '../../global/scripts/config.php';
require '../../global/scripts/db-conn-class.php';

$status = NULL;
$fullItems;
$conn = new DB($config);
$laInventory = NULL;
$chInventory = NULL;
$socks = NULL;

// test database connection
if($conn->getConn()){

    $prod = empty($_POST['productId']) ? NULL : $_POST['productId'];

    if(isset($_POST['updateBTN']))
        updateItem($conn, $prod);

    if(isset($_POST['deleteBTN'])){
        deleteItem($conn, $prod);
        $prodId = "Product was deleted.";
    }else{

        //get socks
        $socks = $conn->query( "SELECT * FROM products WHERE productId = :productId", 
             array('productId' => $prod ) );

        $laInventory = $conn->query( "SELECT qty FROM LAInventory WHERE productId = :productId", 
             array('productId' => $prod) );

        $chInventory = $conn->query( "SELECT qty FROM CHinventory WHERE productId = :productId", 
             array('productId' => $prod) );

        $prodId = ($socks > 0) ? "# " . $socks['productId'] : "NULL";

        if(!$socks > 0)
            $status = "Sorry there was an error retreiving the product.";
    }
}

// connection failed
else{

    $status = "Sorry there was an error retreiving the product.";
}



function deleteItem($conn, $prod){
    $conn->remove( "products", "productId = '$prod'" );
    $conn->remove( "CHinventory", "productId = '$prod'" );
    $conn->remove( "LAInventory", "productId = '$prod'" );
}


function updateItem($conn, $prod){
    $desc = empty($_POST['desc']) ? NULL : $_POST['desc'];
    $color = empty($_POST['color']) ? NULL : $_POST['color'];
    $style = empty($_POST['style']) ? NULL : $_POST['style'];
    $price = empty($_POST['price']) ? NULL : $_POST['price'];
    $chInv = empty($_POST['chInvent']) ? NULL : $_POST['chInvent'];
    $laInv = empty($_POST['laInvent']) ? NULL : $_POST['laInvent'];

    if($desc){
        $conn->update( "UPDATE products SET description = :description WHERE productId = :productId", 
                array('description' => $desc, 'productId' => $prod ) );
    }

    if($color){
        $conn->update( "UPDATE products SET color = :color WHERE productId = :productId", 
                array('color' => $color, 'productId' => $prod ) );
    }

    if($style){
        $conn->update( "UPDATE products SET style = :style WHERE productId = :productId", 
                array('style' => $style, 'productId' => $prod ) );
    }

    if($price && is_numeric($price)){
        $conn->update( "UPDATE products SET price = :price WHERE productId = :productId", 
                array('price' => $price, 'productId' => $prod ) );
    }

    if($chInv && is_numeric($chInv)){
        $conn->update( "UPDATE CHinventory SET qty = :qty WHERE productId = :productId", 
                array('qty' => $chInv, 'productId' => $prod ) );
    }

    if($laInv && is_numeric($laInv)){
        $conn->update( "UPDATE LAInventory SET qty = :qty WHERE productId = :productId", 
                array('qty' => $laInv, 'productId' => $prod ) );
    }

}




