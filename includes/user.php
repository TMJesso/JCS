<?php
class User extends Common {
    protected static $table_name = "user";
    protected static $db_fields = array('id', 'user_id', 'username', 'passcode', 'changepass', 'security', 'clearance');
    
    public $id;
    
    public $user_id;
    
    public $username;
    
    public $passcode;
    
    public $changepass;
    
    public $security;
    
    public $clearance;
    
    public static function get_all_users() {
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "ORDER BY username, security, clearance";
        return self::find_by_sql($sql);
    }
    
    public static function get_user_by_user_id($id='') {
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE user_id = '{$id}' ";
        $sql .= "LIMIT 1";
        $result = self::find_by_sql($sql);
        return ($result) ? array_shift($result) : false;
    }
    
    
}

?>
