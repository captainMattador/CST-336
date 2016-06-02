<?php


class DB
{
	// properties
	private $conn;
	private $username;
	private $dbname;
    private $fetchMode = PDO::FETCH_ASSOC;

	// constructors
	function __construct($config) 
    { 
        try{
        	$this->username = $config['DB_USERNAME'];
	        $this->dbname = $config['DB'];
	    	$this->conn = new PDO(
		        'mysql:host=' . $config['HOST'] . ';dbname=' . $this->dbname, 
		        $this->username,
		        $config['DB_PASSWORD']
		    );
		    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		}catch(Exception $e){
		    $this->conn = NULL;
	        $this->username = NULL;
	        $this->dbname = NULL;
		}
    } 

    // public methods
    public function getConn() 
    {
    	return $this->conn;
    }

    public function getDB() 
    {
    	return $this->dbname;
    }

    public function getUserName() 
    {
    	return $this->username;
    }

    public function query( $query, $bindings = NULL ) 
    {
    	try{
	    	$stmt = $this->conn->prepare($query);
	    	$stmt->execute($bindings);
            $stmt->setFetchMode($this->fetchMode); 
	    	$results = $stmt->fetch();
	    	return $results ? $results : false;
    	}catch(Exception $e){
    		return false;
    	}
    }

    public function queryAll( $query, $bindings = NULL ) 
    {
        try{
            $stmt = $this->conn->prepare($query);
            $stmt->execute($bindings);
            $stmt->setFetchMode($this->fetchMode); 
            $results = $stmt->fetchAll();
            return $results ? $results : false;
        }catch(Exception $e){
            return false;
        }
    }

    public function insert( $table, $names = NULL, $bindings = NULL ) 
    {
        try{
            $arr = array();
            $str = "INSERT INTO $table (" . implode(", ", $names) .") VALUES (:" . implode(", :", $names) .")";
            $stmt = $this->conn->prepare( $str );
            
            for($i = 0; $i < count($names); $i++){
                $arr[$names[$i]] = $bindings[$i];
            }
            $stmt->execute($arr);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function remove( $table, $values ) 
    {
        try{
            $sql = "DELETE FROM $table WHERE $values";
            $this->conn->exec($sql);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function update( $query, $bindings ) 
    {
        try{
            $stmt = $this->conn->prepare($query);
            $stmt->execute($bindings);
            return ($stmt->rowCount() > 0) ? $stmt->rowCount() : false;
        }catch(Exception $e){
            return false;
        }
    }

    public function getTable( $tableName ) 
    {
    	try{
    		$result = $this->conn->query("SELECT * FROM $tableName");
    		return ( $result->rowCount() > 0 ) ? $result : false;
    	}catch(Exception $e){
    		return false;
    	}
    }

    // private methods

    private function insertValues( $arr ) 
    {   
        $val = "(";
        $comma_separated = implode(",", $array);

        $val = $val . ")";
        return $val;
    }

}


