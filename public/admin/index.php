<?php
require_once '../../includes/initialize.php';
$menu_type = Menu_Type::get_by_type("JCS", 9);

if (!$session->is_logged_in()) { redirect_to('login.php'); }
?>

<?php include_layout_template('jcs_header.php'); ?>




<?php include_layout_template('jcs_footer.php'); ?>

