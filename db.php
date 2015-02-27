<?php

require_once 'dbConnData.php';

class DatabaseHandler { 

    private $conn;

    function __construct() {
        $dbConnData = new DbConnData("hostinger");

        $this->conn = new mysqli($dbConnData->getServer(), $dbConnData->getUser(), $dbConnData->getPassword(), $dbConnData->getDatabase());
        if ($this->conn->connect_errno > 0) {
            die('Unable to connect to database [' . $this->conn->connect_error . ']');
        }
    }

    function __destruct() {
        mysqli_close($this->conn);
    }

    public function queryDB($query, $what) {        
        if (!$result = $this->conn->query($query)) {
            die('There was an error running the query [' . $this->conn->error . ']');
        } else {
            if ($what != null) {
                $results = array();
                while ($row = $result->fetch_assoc()) {
                    $results[] = $row[$what];
                }
                /* for($i = 0; $i < $result->num_rows; $i++){
                  $results[$i] =
                  } */
                return $results;
            } else {
                return $result;
            }
        }
    }

}

?>