<?php
class Tier1 extends Common {
    protected static $table_name = "menu_tier1";
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

    public static function get_all_submenu_by_menu_id($id='') {
        if (empty($id)) {
            return false;
        }
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE menu_id = '{$id}' ";
        return self::find_by_sql($sql);
    }
    
    public static function get_submenu_by_id($id='') {
        if (empty($id)) {
            return false;
        }
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE t1_id = '{$id}' ";
        $sql .= "LIMIT 1";
        $result = self::find_by_sql($sql);
        return ($result) ? array_shift($result) : false;
    }
}




?>
