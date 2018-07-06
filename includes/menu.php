<?php
class Menu extends Common {
    protected static $table_name = 'menu';
    protected static $db_fields = array('id', 'm_id', 'type_id', 'name', 'm_url', 'm_order', 'visible', 'security', 'clearance');
    
    public $id;
    
    public $m_id;
    
    public $type_id;
    
    public $name;
    
    public $m_url;
    
    public $m_order;
    
    public $visible;
    
    public $security;
    
    public $clearance;
    
    /**
     * find a single menu by its id
     * 
     * @param string $id
     * @return object|boolean
     */
    public static function get_menu_by_m_id($id='') {
        if (self::validate_string($id)) {
            $sql  = "SELECT * FROM " . self::$table_name . " ";
            $sql .= "WHERE m_id = '{$id}' ";
            $sql .= "LIMIT 1";
            $result = self::find_by_sql($sql);
            return self::confirm_single_result($result);
        } else {
            return false;
        }
    }
    
    public static function get_all_visible_menus($sec) {
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE visible AND $sec >= security";
        $sql .= "ORDER BY m_order";
        $results = self::find_by_sql($sql);
        return self::confirm_all_results($results);
    }
    
    public static function get_all_menus_by_type_id($id='') {
        if (empty($id)) {
            return false;
        }
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE type_id = '{$id}' ";
        $sql .= "ORDER BY m_order";
        return self::find_by_sql($sql);
    }
 }

?>
