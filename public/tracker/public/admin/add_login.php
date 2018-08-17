<?php
require_once '../../../../includes/initialize.php';
if (!$session->is_logged_in()) { redirect_to(ADMIN_PATH.'login.php'); }
$load_first = false;
$load_second = false;
$form_file = TRACKER . 'add_login.php';
$user = User::get_user_by_username($session->get_user_id());

if (isset($_POST['submit_add_edit_button'])) {
    $load_first = true;
    $load_second = true;
     $details = User_Detail::get_details_by_user_id($user->user_id);
    $subtitle = "Login info for " . $details->get_fullname();
    $how_many = Login::howmany();
    if ($_POST['select_login'] === 'new') {
        
        
    } else {
        $descript = Login::get_login_by_login_id(Login::find_max_id())->descript;
        $tk = Login::get_login_by_id($_POST['select_login']);
        
        $tkunw = UnPw::get_all_by_login_id($tk->login_id);
        $tkuncodes = Codes::get_codes_by_id($tkunw[1]->unpw_id);
        $tkpwcodes = Codes::get_codes_by_id($tkunw[0]->unpw_id);
        $username = "";
        $passcode = "";
        foreach ($tkuncodes as $un) {
            $username .= $un->multiplier.$un->slt.$un->codex;
        }
        foreach ($tkpwcodes as $pw) {
            $passcode .= $pw->multiplier.$pw->slt.$pw->codex;
        }
    }
} elseif (isset($_POST['submit_login'])) {
    $message = "";
    $pw = trim($_POST['area_pass']);
    $ur = $base->prevent_injection(trim($_POST['txt_username']));
    $this_txt = "";
    $login = new Login();
    $login->login_id = get_new_id();
    $login->user_id = $user->user_id;
    $login->descript = $base->prevent_injection(hent(trim($_POST['txt_descript'])));
    $login->url = $base->prevent_injection(hent(trim($_POST['txt_url'])));
    if ($login->save()) {
        $message .= "Login data saved for<br>" . hdent($login->descript) . "!<br>";
        for ($x = 0; $x <= 1; $x++) {
            $unpw = new UnPw();
            $unpw->unpw_id = get_new_id();
            $unpw->login_id = $login->login_id;
            // 0 is username and 1 is passcode
            $unpw->user_pass = $x;
            
            if ($unpw->save()) {
                $message .= "UNPW data saved for<br>";
                if ($x == 0) {
                    $message .= "Username";
                    $this_txt = $ur;
                } else {
                    $message .= "Passcode";
                    $this_txt = $pw;
                }
                $message .= "!<br>";
                $a = 0;
                echo $this_txt;
                for ($y = 0; $y < strlen($this_txt); $y++) {
                    $my_chr = substr($this_txt, $y, 1);
                    if ($temp = check_invalid_characters(ord($my_chr))) {
                        continue;
                    }
                    $codes = new Codes();
                    $codes->gen_salt(12);
                    $codes->codes_id = get_new_id();
                    $codes->unpw_id = $unpw->unpw_id;
                    $weight = get_random_value(2, 9);
                    $x_value = get_random_number();
                    //$y_value = get_random_number();
                    $codes->multiplier = strrev(dechex($weight * $x_value));
                    $str_value = Yekym::generate_code($x_value, $my_chr);
                    
                    $codes->codex = strrev(dechex($weight * ord($str_value)));
                    $codes->weight = strrev(dechex($weight));
                    $codes->code_order = $a;
                    $a++;
                    if ($codes->save()) {
                        $message .= $codes->multiplier.$codes->slt.$codes->codex . "<br>";
                    } else {
                        $message .= $codes->multiplier.$codes->codex . " was NOT saved!<br>";
                    }
                }
            } else {
                $message .= "UNPW data was NOT saved!";
            }
            $message .= "<br><br>";
        }
    } else {
        $message .= "Login info was NOT saved!";
    }
    $session->message($message);
    redirect_to(TRACKER . 'add_login.php');
} elseif ($load_first) {
  
} else {
    $alpha = true;
    if (isset($_GET['alpha'])) {
        if ($_GET['alpha'] === 'true') {
            $alpha = true;
        } else {
            $alpha = false;
        }
    }
    $logins = Login::get_all_logins($user->user_id, $alpha);
    
}


?>
<?php include_layout_template('jcs_header.php'); ?>
<?php if (!$load_first && !$load_second) { ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">&nbsp;</div>
		<div class="large-6 medium-6 cell">
			<?php open_form($form_file); ?>				
				<label for="select_login">Tracker
   				<a href="<?php echo $form_file;?>?alpha=<?php if ($alpha) { echo 'false'; } else { echo 'true'; } ?>"><?php if ($alpha) { ?>Order by Number<?php } else { ?>Order Aphabetically<?php } ?></a><br>
    				<select name="select_login" id="select_login" required>
    					<option value="">Choose which Login to edit or Add New Login</option>
    					<option value="new">Add New Login</option>
    					<?php foreach ($logins as $logs) { ?>
    					<option value="<?php echo $logs->login_id?>"><?php echo $logs->id; ?>) <?php echo $logs->descript; ?></option>
    					<?php } ?>
    				</select>
    				<span class="form-error">
    					Please choose a Login to edit or select Add New Login
    				</span>
				</label>
				
				<div class="text-center">
					<input type="submit" class="button" name="submit_add_edit_button" id="submit_add_edit_button" value="Go">
				</div>
			<?php close_form(); ?>
		</div>
		<div class="large-3 medium-3 cell">&nbsp;</div>
	</div>
</div>
<?php } elseif ($load_first && $load_second) { ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">
		<?php if ($how_many) { ?>
			<h5 class="text-center">Trackers: <?php echo $how_many; ?></h5>
			<?php if (isset($descript)) { ?>
			<div class="text-center">
				<?php echo $descript; ?>
			</div>
			<?php } ?>
		<?php } else { ?>
			&nbsp;
		<?php } ?>
		</div>
		<div class="large-6 medium-6 cell">
			<form data-abide novalidate method="post" action="<?php echo TRACKER; ?>add_login.php">
            	<div data-abide-error class="alert callout" style="display: none;">
            		<p><i class="fi-alert"></i> Please scroll down to view all errors on form.</p>
				</div>
<!-- Description -->
				<label for="txt_descript">Description
					<input type="text" name="txt_descript" id="txt_descript" maxlength="75" placeholder="Description of Login! Max 75" value="<?php if (isset($tk)) { echo $tk->descript; }?>" required>
					<span class="form-error">
						You must enter the Description for this login!
					</span>
				</label>
<!-- URL -->
				<label for="txt_url">URL
 					<input type="text" name="txt_url" id="txt_url" maxlength="150" placeholder="URL of this login! Max 150" value="<?php if (isset($tk)) { echo $tk->url; } ?>" required>
					<span class="form-error">
						If URL is not available at this time please place a # as a place holder.
					</span>
				</label>
<!-- Username -->
				<label for="txt_username">Username
					<textarea rows="4" name="txt_username" id="txt_username" placeholder="None for no username!" required><?php if (isset($username)) { echo $username; } ?></textarea>
<!-- 					<input type="text" name="txt_username" id="txt_username" maxlength="200" placeholder="None for no username! Max 200" value="" required> -->
					<span class="form-error">
						You must enter a username for this login. Enter none if no username is used!
					</span>
				</label>
<!-- Passcode -->
				<label for="area_pass">Passcode 
					<textarea rows="4" name="area_pass" id="area_pass" aria-describedby="area_pass_help" required><?php if (isset($passcode)) { echo $passcode; } ?></textarea>
					<span class="form-error">
						You must enter a passcode! Use none if no passcode is used.
					</span>
				</label>
				<p class="help-text" id="area_pass_help">Invalid characters: (apostrophe) &#39;, (quotation mark) &quot;, (vertical line) |, &amp; (tilde) &#126;</p>
				<div class="text-center">
					<input type="submit" class="button" name="submit_login" id="submit_login" value="Save">
					<input type="reset" class="button" name="reset_login" id="reset_login" value="Cancel">
				</div>
			</form>
		</div>
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
	</div>
</div>
<?php } elseif (!$load_first && $load_second) { ?>


<?php } ?>
<?php include_layout_template('jcs_footer.php'); ?>


<?php 
function get_random_number() {
    $loop = true;
    $n = null;
    while ($loop) {
        $n = mt_rand(32, 125);
        switch ($n) {
            case 34: case 39: case 96: case 124: case 126:
                break;
            default:
                $loop = false;
        }
    }
    return $n;
}

function check_invalid_characters($letter=0) {
    switch ($letter) {
        case 34:
            return true;
            
        case 39:
            return true;
            
        case 96:
            return true;
            
        case 124:
            return true;
            
        case 126:
            return true;
            
        default:
            return false;
    }
}
?>
