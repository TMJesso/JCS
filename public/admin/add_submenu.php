<?php
require_once '../../includes/initialize.php';
if (!$session->is_logged_in()) { redirect_to('login.php'); }

if (isset($_GET['mid']) && !isset($_POST["submit_submenu"])) {
    $menu = Menu::get_menu_by_m_id($base->prevent_injection(hent($_GET["mid"])));
    $menu_type = Menu_Type::get_by_type_id($menu->type_id);
} elseif (isset($_GET['mid']) && isset($_POST["submit_submenu"])) {
    // save the information
    $m_id = $base->prevent_injection(hent($_GET["mid"]));
    $menu = Menu::get_menu_by_m_id($m_id);
    $tier1 = new Tier1();
    $tier1->menu_id = $m_id;
    $tier1->t1_id = get_new_id();
    $tier1->name = $base->prevent_injection(hent($_POST["txt_name"]));
    $tier1->t1_url = $base->prevent_injection(hent($_POST["txt_url"]));
    $tier1->t1_order = $_POST["select_order"];
    $tier1->t1_visible = $_POST["select_visible"];
    $tier1->t1_security = $_POST["select_security"];
    $tier1->t1_clearance = $_POST["select_clearance"];
    if ($tier1->save()) {
        $message = $tier1->name . " was successfully saved as a submenu of " . $menu->name;
        $session->message($message);
    } else {
        $errors = array("There was an error saving " . $tier1->name, $tier1->name . "was NOT saved for {$menu->name}!");
        $session->errors($errors);
    }
    redirect_to('add_menu.php');
} else {
    $errors = array("There was an error!", "The information I tried to retrieve was not available!");
    $session->errors($errors);
    redirect_to('add_menu.php');
}
?>

<?php include_layout_template('jcs_header.php'); ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">&nbsp;</div>
		<div class="large-6 medium-6 cell">
			<form data-abide novalidate method="post" action="add_submenu.php?mid=<?php echo $menu->m_id; ?>">
				<div data-abide-error class="alert callout" style="display: none;">
					<p>
						<i class="fi-alert"></i> Please scroll down to view all errors on form.
					</p>
				</div>
<!-- Which menu to add to -->
				<div class="callout">
    				<label for="txt_menu">Add a submenu for
    					<input type="text" id="txt_menu" value="<?php echo $menu->name;?>" disabled>
    				</label>
				</div>
<!-- Name -->
				<label for="txt_name">Submenu Name
					<input type="text" name="txt_name" id="txt_name" maxlength="20" value="" placeholder="Maximum of 20 characters" required>
					<span class="form-error">
						A Name must be entered for this submenu...
					</span>
				</label>
<!-- URL -->
				<label for="txt_url">URL
					<input type="text" name="txt_url" id="txt_url" maxlength="75" value="" placeholder="Path and file that will be used for this menu item" required>
					<span class="form-error">
						Enter the path and filename for this submenu. Maximum of 75 characters
					</span>
				</label>
<!-- Order -->
				<label for="select_order">Submenu Order
					<select name="select_order" id="select_order" required>
						<option value="">Choose the order for submenu</option>
						<?php for ($x = 0; $x <= 25; $x++) { ?>
						<option value="<?php echo $x; ?>"><?php echo $x; ?></option>
						<?php } ?>
					</select>
					<span class="form-error">
						Choose the order for this submenu
					</span>
				</label>
<!-- Visibility -->
				<label for="select_visible">Visiblity
					<select name="select_visible" id="select_visible" required>
						<option value="">Visible or Not Visible</option>
						<option value="0">Not Visible</option>
						<option value="1">Visible</option>
					</select>
					<span class="form-error">
						Choose visible or not visible for this submenu 
					</span>
				</label>
<!-- Security -->
				<label for="select_security">Security
					<select name="select_security" id="select_security" required>
						<option value="">Choose security level for this submenu</option>
						<?php for ($x = 0; $x <= 9; $x++) { ?>
						<option value="<?php echo $x; ?>"><?php echo $x . ". " . get_security_text($x); ?></option>
						<?php } ?>
					</select>
					<span class="form-error">
						Please choose the security level for this submenu...
					</span>
				</label>
<!-- Clearance -->
				<label for="select_clearance">
					<select name="select_clearance" id="select_clearance" required>
						<option value="">Choose clearance level for this submenu</option>
						<?php for ($x = 0; $x <= 9; $x++) { ?>
						<option value="<?php echo $x; ?>"><?php echo $x . ". " . get_clearance_text($x); ?></option>
						<?php } ?>
					</select>
					<span class="form-error">
						Please choose the clearance level for this submenu...
					</span>
				</label>
				
				<div class="text-center">
					<input type="submit" name="submit_submenu" id="submit_submenu" class="button" value="Go">
				</div>
			</form>
		</div>
		<div class="large-3 medium-3 cell">&nbsp;</div>	
	</div>
</div>




<?php include_layout_template('jcs_footer.php'); ?>
