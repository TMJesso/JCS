<?php
class Menu_Type extends Common {
    protected static $table_name = 'menu_type';
    protected static $db_fields = array('id', 'type_id', 'm_type', 'visible', 'type_order', 'security', 'clearance');
    
    public $id;
    
    public $type_id;
    
    public $m_type;
    
    public $visible;
    
    public $type_order;
    
    public $security;
    
    public $clearance;
    
    public static function get_by_type($menu_type, $sec) {
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE m_type = '{$menu_type}' ";
        $sql .= "AND $sec >= security ";
    }
    
    public static function get_all_type_by_order() {
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "ORDER BY type_order";
        return self::find_by_sql($sql);
    }
}


?>
