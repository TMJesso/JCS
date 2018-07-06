<?php
class Tier1 extends Common {
    protected static $table_name = 'menu_tier1';
    protected static $db_fields = array('id', 't1_id', 'menu_id', 'name', 't1_url', 't1_order', 't1_visible', 't1_security', 't1_clearance');
    
    public $id;
    
    public $t1_id;
    
    public $menu_id;
    
    public $name;
    
    public $t1_url;
    
    public $t1_order;
    
    public $t1_visible;
    
    public $t1_security;
    
    public $t1_clearance;
    
    
    public static function get_tier1_by_t1_id($id='') {
        if (self::validate_string($id)) {
            $sql  = "SELECT * FROM " . self::$table_name . " ";
            $sql .= "WHERE t1_id = '$id' ";
            $sql .= "LIMIT 1";
            $result = self::find_by_sql($sql);
            return self::confirm_single_result($result);
        } else {
            return false;
        }
    }
    
    public static function get_all_tier1($sec) {
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE t1_security = $sec ";
        $sql .= "AND t1_visible";
        $sql .= "ORDER BY t1_order";
    }
    
    
    
}

?>
