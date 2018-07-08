<?php
class Factory extends Common {
    private $db;
    
    function __construct() {
        $this->db_open();
    }
    
    private function db_open() {
        $this->db = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME, DB_PORT, DB_SOCKET);
        if ($this->db->connect_errno) {
            die ("Database connection failed: " . $this->db->connect_error . " (" . $this->db->connect_errno . ") ");
        }
        
        
        
        // *********************************************************************************************************** //
        // ** This is the procedural style of connecting to the database ********************************************* //
        // *********************************************************************************************************** //
        // ** $this->db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME, DB_PORT, DB_SOCKET); ****************** //
        // ** if (mysqli_connect_errno()) { ************************************************************************** //
        // ** die ("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" ); ** //
        // ** } ****************************************************************************************************** //
        // *********************************************************************************************************** //
    }
    
    public function db_close() {
        if (isset($this->db)) {
            $this->db->close();
            unset($this->db);
        }
    }
    
    public function query($sql="") {
        if (!empty($sql) || !is_null($sql)) {
            $results = $this->db->query($sql);
            $this->confirm_query($results);
            return $results;
        }
    }
    
    private function confirm_query($results) {
        if (!$results) {
            die("Database Query Failed! ERROR: " . $this->db->error . " (" . $this->db->errno . ")");
        }
    }
    
    public function prevent_injection($string) {
        $escaped_string = $this->db->real_escape_string($string);
        //$escaped_string = mysqli_real_escape_string($this->db, $string);
        return $escaped_string;
    }
    
    public function insert_id() {
        // get the last id inserted over the current db connection
        return $this->db->insert_id;
        //return mysqli_insert_id($this->db);
    }
    
    public function fetch_array($result_set) {
        if ($result_set) {
            return $result_set->fetch_array(MYSQLI_ASSOC);
            //return mysqli_fetch_array($result_set);
        } else {
            return false;
        }
    }
    
    public function affected_rows() {
        return $this->db->affected_rows;
        //return mysqli_affected_rows($this->db);
    }
    
}
$base = new Factory();


?>
