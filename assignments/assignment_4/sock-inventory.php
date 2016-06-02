<?php 

require '../../global/scripts/config.php';
require '../../global/scripts/db-conn-class.php';

$status = NULL;
$fullItems;
$conn = new DB($config);


// test database connection
if($conn->getConn()){

    $color = getUniqueFieldValues($conn, 'color');
    $style = getUniqueFieldValues($conn, 'style');
    $price = getUniqueFieldValues($conn, 'price');
    $sortBy = isset($_POST['filterBTN']) ? $_POST['sort'] : "ASC";
    $prodCount = $conn->queryAll( "SELECT COUNT(*) FROM products");
    $prodCount = ($prodCount > 0) ? $prodCount[0]['COUNT(*)'] : "0";
    $maxPrice = $conn->queryAll( "SELECT MAX(price) FROM products");
    $maxPrice = ($maxPrice > 0) ? $maxPrice[0]['MAX(price)'] : "0";
    $socks = getItems($conn);
    if(!$socks > 0)
        $status = "No matches in the database.";
}

// connection failed
else{

    $status = "Sorry the inventory is currently down.";

}

function getItems($conn){

    global $sortBy;
    $filterBy = getFilterValues();
    $socks = buildCall($conn, $filterBy, $sortBy);
    return $socks;
}

function buildCall($conn, $filterBy, $sortBy){
    $filters = buildWhereList($filterBy);
    $search = array(
        "select" => "SELECT * FROM products",
        "where" => "WHERE $filters",
        "order" => "ORDER BY price $sortBy"
    );

    if (empty($filterBy)) {
        unset($search["where"]);
    }

    $search = implode(' ', $search);
    $arr = $conn->queryAll( $search );
    return $arr;
}

function getUniqueFieldValues($conn, $field){
        
    $arr = $conn->queryAll( "SELECT DISTINCT ".$field." FROM products");
    return $arr;
        
}

function getFilterValues(){
    $arr = array();
    if( isset($_POST['filterBTN']) ){
        foreach ($_POST as $key => $value){
            if(!empty($value) && $key != 'filterBTN' && $key != 'sort')
                $arr[$key] = $value;
        }
    }
    return $arr;
        
}

function buildWhereList($arr){
    $where = NULL;
    foreach ($arr as $key => $value){
        $where = isset($where) ? $where . " AND $key='$value'" : $where . "$key='$value' ";
    }
    return $where;
        
}