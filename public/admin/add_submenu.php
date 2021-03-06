<?php
require_once '../../includes/initialize.php';
if (! $session->is_logged_in()) {
	redirect_to(ADMIN_PATH . 'login.php');
}
$load = true;
$load_mega = false;
if (isset($_GET['mid']) && ! isset($_POST["submit_submenu"]) && ! isset($_POST["submit_choose_sub"]) && ! isset($_POST["submit_delete"]) && ! isset($_POST["submit_mega_save"]) && ! isset($_POST["submit_mega_menu"]) && ! isset($_POST["submit_mega_choose"]) && ! isset($_POST["submit_mega_delete"])) {
	$menu = Menu::get_menu_by_m_id($base->prevent_injection(hent($_GET["mid"])));
	// $menu_type = Menu_Type::get_by_type_id($menu->type_id);
	$submenus = Tier1::get_all_submenu_by_menu_id($menu->m_id);
	$load = true;
	$load_mega = false;
} elseif (isset($_POST['submit_choose_sub']) && isset($_GET['mid'])) {
	$load = false;
	$load_mega = false;
	$menu = Menu::get_menu_by_m_id($base->prevent_injection(hent($_GET["mid"])));
	$sub = $_POST['select_submenu'];
	// $menu_type = Menu_Type::get_by_type_id($menu->type_id);
	if ($sub == 'new') {
		$tier1 = new Tier1();
		$tier1->menu_id = $menu->m_id;
		$tier1->t1_id = $sub;
	} else {
		$tier1 = Tier1::get_submenu_by_id($sub);
	}
	$submenus = Tier1::get_all_submenu_by_menu_id($menu->m_id);
} elseif (isset($_GET['mid']) && isset($_POST["submit_submenu"])) {
	$load = false;
	$load_mega = false;
	// save the information
	$m_id = $base->prevent_injection(hent($_GET["mid"]));
	$tid = $base->prevent_injection(hent($_GET["tid"]));
	$menu = Menu::get_menu_by_m_id($m_id);
	if ($tid == 'new') {
		$tier1 = new Tier1();
		$tier1->menu_id = $m_id;
		$tier1->t1_id = get_new_id();
	} else {
		$tier1 = Tier1::get_submenu_by_id($tid);
	}
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
		$errors = array(
			"There was an error saving " . $tier1->name,
			$tier1->name . "was NOT saved for {$menu->name}!"
		);
		$session->errors($errors);
	}
	redirect_to('add_menu.php');
} elseif (isset($_POST["submit_delete"])) {
	$m_id = $base->prevent_injection(hent($_GET["mid"]));
	$t_id = $base->prevent_injection(hent($_GET["tid"]));

	$tier1 = Tier1::get_submenu_by_id($t_id);
	if ($tier1->delete()) {
		$message = "{$tier1->name} has been successfully removed!";
		$session->message($message);
		redirect_to('add_submenu.php?mid=' . $m_id);
	}
} elseif (isset($_POST["submit_mega_menu"])) { // get which sub-submenu to edit or save

	$load = false;
	$load_mega = true;
	$m_id = $base->prevent_injection(hent($_GET["mid"]));
	$t_id = $base->prevent_injection(hent($_GET["tid"]));
	$mega_submenus = Tier2::get_all_menu_by_tier1_id($t_id);
} elseif (isset($_POST["submit_mega_choose"])) {
	$load = true;
	$load_mega = true;
	$mid = $base->prevent_injection(hent($_GET["mid"]));
	$tid = $base->prevent_injection(hent($_GET["tid"]));
	$tier1 = Tier1::get_submenu_by_id($tid);
	$current_list = Tier2::get_all_menu_by_tier1_id($tid);
	if ($_POST["select_mega_submenu"] == "new") {
		$tier2 = new Tier2();
		$tier2->t1_id = $base->prevent_injection(hent($_GET["tid"]));
		$tier2->t2_id = $_POST["select_mega_submenu"];
	} else {
		$tier2 = Tier2::get_menu_by_id($_POST["select_mega_submenu"]);
	}
} elseif (isset($_POST["submit_mega_save"])) {
	// $mid = $base->prevent_injection(hent($_GET["mid"]));
	// $tid = $base->prevent_injection(hent($_GET["tid"]));
	if ($_POST["hidden_mega_t2id"] == "new") {
		$tier2 = new Tier2();
		$tier2->t1_id = $base->prevent_injection(hent($_GET["tid"]));
		$tier2->t2_id = get_new_id();
	} else {
		$tier2 = Tier2::get_menu_by_id($_POST["select_mega_submenu"]);
	}
	$tier2->t2_name = $base->prevent_injection(hent($_POST["mega_name"]));
	$tier2->t2_url = $base->prevent_injection(hent($_POST["mega_url"]));
	$tier2->t2_order = $base->prevent_injection(hent($_POST["mega_order"]));
	$tier2->t2_visible = $base->prevent_injection(hent($_POST["mega_visible"]));
	$tier2->t2_security = $base->prevent_injection(hent($_POST["mega_security"]));
	$tier2->t2_clearance = $base->prevent_injection(hent($_POST["mega_clearance"]));
	if ($tier2->save()) {
		$message = "";
		if ($_POST["hidden_mega_t2id"] == "new") {
			$message = "{$tier2->t2_name} has successfully been added!";
		} else {
			$message = "{$tier2->t2_name} was successfully updated!";
		}
		$session->message($message);
		redirect_to("add_menu.php");
	}
} elseif (isset($_POST["submit_mega_delete"])) {
	$sub_delete = Tier2::get_menu_by_id($base->prevent_injection(hent($_GET["sid"])));
	if ($sub_delete->delete()) {
		$message = "{$sub_delete->t2_name} has been removed from the menus";
		$session->message($message);
		redirect_to('add_menu.php');
	}
} else {

	$errors = array(
		"There was an error!",
		"The information I tried to retrieve was not available!"
	);
	$session->errors($errors);
	redirect_to('add_menu.php');
}
?>

<?php include_layout_template('jcs_header.php'); ?>
<?php if ($load && !$load_mega) { ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">&nbsp;</div>
		<div class="large-6 medium-6 cell">
			<?php open_form('add_submenu.php', '?mid='.$menu->m_id); ?>
				<label for="select_submenu"> <select name="select_submenu"
				id="select_submenu" required>
					<option value="">Choose submenu to edit or Add New Submenu</option>
					<option value="new">Add New Submenu</option>
					<?php foreach ($submenus as $sub) { ?>
					<option value="<?php echo $sub->t1_id; ?>"><?php echo $sub->name . " :: sec: " . $sub->t1_security . " clr: ".$sub->t1_clearance; ?></option>
					<?php } ?>
				</select> <span class="form-error">You must make a choice</span>
			</label>
			<div class="text-center">
			<?php get_submit_button('submit_choose_sub', 'Submit'); ?>
			<?php get_cancel_button('add_menu.php'); ?>
			<?php close_form();?>
			</div>
		</div>
		<div class="large-3 medium-3 cell">&nbsp;</div>
	</div>
</div>

<?php } elseif (!$load && !$load_mega) { ?>
<div class="grid-x grid-padding-x">
	<div class="large-3 medium-3 cell">&nbsp;1</div>
	<div class="large-6 medium-6 cell">
			<?php open_form('add_submenu.php', '?mid='. $menu->m_id, '&tid='.$tier1->t1_id); ?>
<!-- Which menu to add to -->
		<h5 class="text-center">Add a Submenu for <?php echo hdent($menu->name); ?></h5>
		<!-- Name -->
		<label for="txt_name">Submenu Name <input type="text" name="txt_name"
			id="txt_name" maxlength="20" value="<?php echo $tier1->name; ?>"
			placeholder="Maximum of 20 characters" required> <span
			class="form-error"> A Name must be entered for this submenu... </span>
		</label>
		<!-- URL -->
		<label for="txt_url">URL <input type="text" name="txt_url"
			id="txt_url" maxlength="75" value="<?php echo $tier1->t1_url; ?>"
			placeholder="Path and file that will be used for this menu item"
			required> <span class="form-error"> Enter the path and filename for
				this submenu. Maximum of 75 characters </span>
		</label>
		<!-- Order -->
		<label for="select_order">Submenu Order <select name="select_order"
			id="select_order" required>
				<option value="">Choose the order for submenu</option>
						<?php for ($x = 0; $x <= 25; $x++) { ?>
							<?php $msg = "{$x}."; ?>
						<option value="<?php echo $x; ?>"
					<?php if ($tier1->t1_order == $x && $sub != "new") { ?> selected
					<?php } ?>>
							<?php foreach ($submenus as $men) { ?>
								<?php if ($men->t1_order == $x) { ?>
									<?php $msg .= " used by " . hdent($men->name); ?>
								<?php } ?>
							<?php } ?>
							<?php echo $msg; ?></option>
						<?php } ?>
					</select> <span class="form-error"> Choose the order for this
				submenu </span>
		</label>
		<!-- Visibility -->
		<label for="select_visible">Visiblity <select name="select_visible"
			id="select_visible" required>
				<option value="">Visible or Not Visible</option>
				<option value="0" <?php if ($tier1->t1_visible == 0) { ?> selected
					<?php } ?>>Not Visible</option>
				<option value="1" <?php if ($tier1->t1_visible == 1) { ?> selected
					<?php } ?>>Visible</option>
		</select> <span class="form-error"> Choose visible or not visible for
				this submenu </span>
		</label>
		<!-- Security -->
		<label for="select_security">Security <select name="select_security"
			id="select_security" required>
				<option value="">Choose security level for this submenu</option>
						<?php for ($x = 0; $x <= 9; $x++) { ?>
						<option value="<?php echo $x; ?>"
					<?php if ($tier1->t1_security == $x) { ?> selected <?php } ?>><?php echo $x . ". " . get_security_text($x); ?></option>
						<?php } ?>
					</select> <span class="form-error"> Please choose the security
				level for this submenu... </span>
		</label>
		<!-- Clearance -->
		<label for="select_clearance">Clearance <select
			name="select_clearance" id="select_clearance" required>
				<option value="">Choose clearance level for this submenu</option>
						<?php for ($x = 0; $x <= 9; $x++) { ?>
						<option value="<?php echo $x; ?>"
					<?php if ($tier1->t1_clearance == $x) { ?> selected <?php } ?>><?php echo $x . ". " . get_clearance_text($x); ?></option>
						<?php } ?>
					</select> <span class="form-error"> Please choose the clearance
				level for this submenu... </span>
		</label>

		<div class="text-center">
			<?php get_submit_button('submit_submenu', 'Save'); ?>
				
			<?php if ($tier1->t1_id != 'new') { ?>
				
				<input type="submit" name="submit_delete" class="button"
				value="Delete"
				onclick="return confirm('Are you sure you want to remove 
				<?php echo $tier1->name; ?>?');"> <input type="submit"
				name="submit_mega_menu" id="submit_mega_menu"
				value="Add / Edit Sub-Submenu" class="button">
        		<?php } ?>
        		
			<?php get_cancel_button('add_submenu.php?mid='.$menu->m_id, 'Choose Other'); ?>
		</div>
	<?php close_form(); ?>
	</div>

	<div class="large-3 medium-3 cell">&nbsp;</div>
</div>
<?php } elseif ($load && $load_mega) { ?>
<div class="grid-x grid-padding-x">
	<div class="large-3 medium-3 cell">&nbsp;</div>
	<div class="large-6 medium-6 cell">
		<h5 class="text-center">Add a Sub-Submenu for <?php echo $tier1->name; ?></h5>
		<?php open_form('add_submenu.php', '?mid='. $mid, '&tid='.$tid, '&sid='.$tier2->t2_id); ?>
		<input type="hidden" name="hidden_mega_t2id" id="hidden_mega_t2id"
			value="<?php echo $tier2->t2_id; ?>">
		<!-- Name -->
		<label for="mega_name">Name <input type="text" name="mega_name"
			id="mega_name" value="<?php echo hdent($tier2->t2_name); ?>"
			maxlength="15" placeholder="Maximum 15 characters" required> <span
			class="form-error"> Please enter the name of for this Sub-Submenu </span>
		</label>
		<!-- URL -->
		<label for="mega_url">URL <input type="text" name="mega_url"
			id="mega_url" maxlength="75"
			value="<?php echo hdent($tier2->t2_url); ?>"
			placeholder="Maximum 75 characters" required> <span
			class="form-error"> Please enter the URL for this Sub-Submenu </span>
		</label>
		<!-- Order -->
		<label for="mega_order">Order <select name="mega_order"
			id="mega_order" required>
				<option value="">Choose the order for this Sub-Submenu</option>
				<?php for ($x = 0; $x <= 25; $x++) {?>
					<?php $msg = "{$x}. "; ?>
					<option value="<?php echo $x; ?>"
					<?php if ($tier2->t2_order == $x) { ?> selected <?php } ?>>
					<?php foreach ($current_list as $sub) { ?>
						<?php if ($sub->t2_order == $x) { ?>
							<?php $msg .= "used by {$sub->t2_name}"; ?>
						<?php }?>
					<?php } ?>
					<?php echo $msg; ?></option>
				<?php } ?>
			</select> <span class="form-error"> Please choose the order for this
				Sub-Submenu </span>
		</label>
		<!-- Visible -->
		<label for="mega_visible">Visible <select name="mega_visible"
			id="mega_visible" required>
				<option value="">Choose visibility</option>
				<option value="0" <?php if ($tier2->t2_visible == 0) { ?> selected
					<?php } ?>>Not Visible</option>
				<option value="1" <?php if ($tier2->t2_visible == 1) { ?> selected
					<?php } ?>>Visible</option>
		</select> <span class="form-error"> Please choose whether this
				Sub-Submenu is visible or not </span>
		</label>
		<!-- Security -->
		<label for="mega_security">Security <select name="mega_security"
			id="mega_security" required>
				<option value="">Choose the Security level</option>
				<?php for ($y = 0; $y <= 9; $y++) { ?>
				<option value="<?php echo $y; ?>"
					<?php if ($tier2->t2_security == $y) { ?> selected <?php } ?>><?php echo $y . ". " . get_security_text($y); ?></option>
				<?php } ?>
			</select> <span class="form-error"> Pleace choose the Security level
				for this Sub-Submenu </span>
		</label>
		<!-- Clearance -->
		<label for="mega_clearance">Clearance <select name="mega_clearance"
			id="mega_clearance" required>
				<option value="">Choose the Clearance level</option>
				<?php for ($z = 0; $z <= 9; $z++) { ?>
				<option value="<?php echo $z; ?>"
					<?php if ($tier2->t2_clearance == $z) { ?> selected <?php } ?>><?php echo $z . ". " . get_clearance_text($z); ?></option>
				<?php } ?>
			</select> <span class="form-error"> Please choose the Clearance level
				for this Sub-Submenu </span>
		</label>
		<div class="text-center">
			<input type="submit" name="submit_mega_save" id="submit_mega_save"
				class="button" value="Save"> 
			<?php if ($tier2->t2_id != "new"){ ?>
			<input type="submit" name="submit_mega_delete"
				id="submit_mega_delete" class="button"
				value="Delete <?php echo $tier2->t2_name; ?>"
				onclick="return confirm('Are you sure you want to remove <?php echo $tier2->t2_name?>?');">
			<?php } ?>
			<a href="add_menu.php" class="button">Cancel</a>
		</div>
		<?php close_form(); ?>
	</div>
</div>
<?php } elseif (!$load && $load_mega) { ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">&nbsp;</div>
		<div class="large-6 medium-6 cell">
			<?php open_form('add_submenu.php', '?mid='.$m_id, '&tid='.$t_id); ?>
				<label for="select_mega_submenu">Choose Sub-Submenu to Edit <select
				name="select_mega_submenu" id="select_mega_submenu" required>
					<option value="">Choose Sub-Submenu to edit or Add New Sub-Submenu</option>
					<option value="new">Add New Sub-Submenu</option>
					<?php foreach ($mega_submenus as $sub) { ?>
					<option value="<?php echo $sub->t2_id; ?>"><?php echo $sub->t2_name . " :: sec: " . $sub->t2_security . " clr: ".$sub->t2_clearance; ?></option>
					<?php } ?>
				</select> <span class="form-error">You must make a choice</span>
			</label>
			<div class="text-center">
			<?php get_submit_button('submit_mega_choose', 'Submit'); ?>
			<?php get_cancel_button('add_menu.php'); ?>
			<?php close_form();?>
			</div>
		</div>
		<div class="large-3 medium-3 cell">&nbsp;</div>
	</div>
</div>

<?php } else { ?>
An Error has occured!
<a href="add_submenu.php" class="button">Return</a>
<?php }?>

<?php include_layout_template('jcs_footer.php'); ?>




?>