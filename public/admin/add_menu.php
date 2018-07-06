<?php
require_once '../../includes/initialize.php';
$load = true;
$loadin = true;
if (isset($_POST["submit_type"]) || (isset($_GET["tid"]) && !isset($_POST["submit_menu"]) && !isset($_POST["submit_addmenu"]))) {
    $load = false;
    $loadin = true;
    if (isset($_POST["submit_type"])) {
        $type_id = $_POST["select_menu_type"];
    } elseif (isset($_GET["tid"])) {
        $type_id = $base->prevent_injection(hent($_GET["tid"]));
    }
    $menus = Menu::get_all_menus_by_type_id($type_id);
} elseif (isset($_POST["submit_menu"])) {
    $load = false;
    $loadin = false;
    $type_id = ucode($_GET["tid"]);
    $menu_id = $_POST["select_menu"];
    if ($menu_id == 'new') {
        $this_menu = new Menu();
        $this_menu->m_id = get_new_id();
        $this_menu->type_id = $type_id;
        $this_menu->m_order = -1;
    } else {
        $this_menu = Menu::get_menu_by_m_id($menu_id);
    }
    $menus = Menu::get_all_menus_by_type_id($type_id);
} elseif (isset($_POST["submit_addmenu"])) {
    $type_id = $base->prevent_injection(hent(ucode($_GET["tid"])));
    $menu_id = $base->prevent_injection(hent(ucode($_GET["mid"])));
    if ($menu_id == "new") {
        $this_menu = new Menu();
    } else {
        $this_menu = Menu::get_menu_by_m_id($menu_id);
    }
    $this_menu->m_id = get_new_id();
    $this_menu->type_id = $type_id;
    $this_menu->name = $base->prevent_injection(hent($_POST["txt_name"]));
    $this_menu->m_url = $base->prevent_injection(hent($_POST["txt_m_url"]));
    $this_menu->m_order = $_POST["select_order"];
    $this_menu->visible = $_POST["select_visible"];
    $this_menu->security = $_POST["select_security"];
    $this_menu->clearance = $_POST["select_clearance"];
    if ($this_menu->save()) {
        $message = "{$this_menu->name} was successfully saved!";
        $session->message($message);
    } else {
        $errors = array("{$this_menu->name} could NOT be saved!");
        $session->errors($errors);
    }
    redirect_to("add_menu.php");
} else {
    $menu_type = Menu_Type::get_all_type_by_order();
}
?>

<?php include_layout_template('jcs_header.php'); ?>
<?php show_title("Add / Edit Menu"); ?>
<?php if ($load && $loadin) {  // choose menu type to add menu to?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
		<div class="large-6 medium-6 cell">
			<form data-abide novalidate method="post" action="add_menu.php">
            	<div data-abide-error class="alert callout" style="display: none;">
            		<p><i class="fi-alert"></i> Please scroll down to view all errors on form.</p>
				</div>
				<label >
					<select name="select_menu_type" id="select_menu_type" required>
						<option value="">Select menu to add a menu item to</option>
						<?php foreach ($menu_type as $menu) { ?>
						<option value="<?php echo $menu->type_id; ?>"><?php echo hdent($menu->m_type); ?></option>
						<?php } ?>
					</select>
				</label>				
				<div class="text-center">
					<input type="submit" name="submit_type" id="submit_type" class="button" value="Go">
				</div>
			</form>
		</div>
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
	</div>
</div>
<?php } elseif (!$load && !$loadin) { // edit or add menu?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
		<div class="large-6 medium-6 cell">
			  <form data-abide novalidate method="post" action="add_menu.php?tid=<?php echo $type_id;?>&mid=<?php echo $menu_id; ?>">
                <div data-abide-error class="alert callout" style="display: none;">
                	<p><i class="fi-alert"></i> Please scroll down to view all errors on form.</p>
                </div>
<!-- Name -->
				<label for="txt_name">Name
					<input type="text" name="txt_name" id="txt_name" value="<?php echo $this_menu->name; ?>" maxlength="20" placeholder="Maximum characters of 20" required>
					<span class="form-error">
						You must enter the Name of this menu item
					</span>
				</label>
<!-- URL -->
				<label for="txt_m_url">URL
					<input type="text" name="txt_m_url" id="txt_m_url" value="<?php echo $this_menu->m_url; ?>" maxlength="75" placeholder="Enter the URL for this menu item" required>
					<span class="form-error">
						You must enter the URL for this menu item
					</span>
				</label>
<!-- Order -->
				<label for="select_order">Order
					<select name="select_order" id="select_order" required>
						<option value="">Choose the order for this menu item</option>
						<?php for ($x = 0; $x <= 25; $x++) { ?>
    						<?php $msg = ""; ?>
    						<?php foreach ($menus as $men) { ?>
    							<?php if ($men->m_order == $x) { ?>
    								<?php $msg = hdent($men->name); ?>
    							<?php } ?>
    						<?php } ?>
						<option value="<?php echo $x; ?>" <?php if (!empty($msg)) { if ((int)$this_menu->m_order === $x) { ?>selected <?php } else {?>disabled<?php }}?>><?php echo $x; if (!empty($msg)) { echo " used by " . $msg; } ?></option>
						<?php } ?>
					</select>
					<span class="form-error">
						Please choose the order of this menu
					</span>
				</label>
<!-- Visible -->
				<label for="select_visible">Visible
					<select name="select_visible" id="select_visible" required>
						<option value="">Choose visibility</option>
						<option value="0" <?php if ($this_menu->visible == 0) { ?>selected <?php } ?>>Not Visible</option>
						<option value="1" <?php if ($this_menu->visible == 1) { ?>selected <?php } ?>>Visible</option>
					</select>
					<span class="form-error">
						You must choose whether this menu item is visible or not visible
					</span>
				</label>
<!-- Security -->
				<label for="select_security">Security
					<select name="select_security" id="select_security" required>
						<option value="">Choose security value for this menu</option>
						<?php for ($x = 0; $x <= 9; $x++) { ?>
						<option value="<?php echo $x; ?>"<?php if ($x == $this_menu->security) { ?> selected<?php }?>><?php echo $x . ". " . get_security_text($x); ?></option>
						<?php } ?>
					</select>
				</label>
<!-- Clearance -->
				<label >Clearance
					<select name="select_clearance" id="select_clearance" required>
						<option value="">Choose clearance value for this menu</option>
						<?php for ($x = 0; $x <= 9; $x++) { ?>
						<option value="<?php echo $x; ?>" <?php if ($this_menu->clearance == $x) { ?> selected <?php } ?>><?php echo $x . ". " . get_clearance_text($x); ?></option>
						<?php } ?>
					</select>
				</label>
				<div class="text-center">
					<input type="submit" name="submit_addmenu" class="button" value="Go">
				</div>
			</form>
		</div>
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
	</div>
</div>
<?php } elseif (!$load && $loadin) { // choose menu to edit or add new ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
		<div class="large-6 medium-6 cell">
			  <form data-abide novalidate method="post" action="add_menu.php?tid=<?php echo $type_id;?>">
                <div data-abide-error class="alert callout" style="display: none;">
                	<p><i class="fi-alert"></i> Please scroll down to view all errors on form.</p>
                </div>
                <label for="select_menu">Choose Menu
                	<select name="select_menu" id="select_menu" required>
                		<option value="">Choose menu to edit or Add new menu</option>
                		<option value="new">Add new menu</option>
                		<?php foreach ($menus as $menu) { ?>
                		<option value="<?php echo $menu->m_id;?>"><?php echo $menu->m_order . ". " . $menu->name; ?></option>
                		<?php } ?>
                	</select>
                </label>
                <div class="text-center">
                	<input type="submit" name="submit_menu" id="submit_menu" class="button" value="Go">
                </div>
             </form>
        </div>
        <div class="large-3 medium-3 cell">
        	&nbsp;
        </div>
    </div>
</div>
<?php } ?>
<?php include_layout_template('jcs_footer.php'); ?>
