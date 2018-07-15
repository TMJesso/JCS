<?php
require_once '../../includes/initialize.php';

echo $user = User::generate_table_and_data() . "<br>";
echo $menu_type = Menu_Type::generate_table_and_data() . "<br>";
echo $menu = Menu::generate_table_and_data() . "<br>";
echo $tier1 = Tier1::generate_table_and_data() . "<br>";
echo $tier2 = Tier2::generate_table_and_data() . "<br>";
echo $details = User_Detail::generate_table_and_data() . "<br>";


?>

