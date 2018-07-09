<?php
require_once '../../includes/initialize.php';
if (!$session->is_logged_in()) { redirect_to('login.php'); }


?>
<?php include_layout_template('jcs_header.php'); ?>



<?php include_layout_template('jcs_footer.php'); ?>
