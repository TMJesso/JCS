<?php
class Factory extends Common {
    private $db;
    
    private function __construct() {
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
        if (!$result) {
            die("Database Query Failed! ERROR: " . $this->db->error . " (" . $this->db->errno . ")");
        }
    }
}
$base = new Factory();


?>
