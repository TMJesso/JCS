<?php
require_once '../../../../includes/initialize.php';
if (!$session->is_logged_in()) { redirect_to(ADMIN_PATH.'login.php'); }

$user = User::get_user_by_username($session->get_user_id());
$details = User_Detail::get_details_by_user_id($user->user_id);
$subtitle = "Login info for " . $details->get_fullname();
$how_many = YekYm::howmany();
if (isset($_POST['submit_login'])) {
    $message = "";
    $pw = $base->prevent_injection(trim($_POST['area_pass']));
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
                for ($y = 0; $y < strlen($this_txt); $y++) {
                    $my_chr = substr($this_txt, $y, 1);
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
                    $codes->code_order = $y;
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
}


?>
<?php include_layout_template('jcs_header.php'); ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">
		<?php if ($how_many) { ?>
			<h5 class="text-center">Trackers: <?php echo $how_many; ?></h5>
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
					<input type="text" name="txt_descript" id="txt_descript" maxlength="75" placeholder="Description of Login! Max 75" value="" required>
					<span class="form-error">
						You must enter the Description for this login!
					</span>
				</label>
<!-- URL -->
				<label for="txt_url">URL
					<input type="text" name="txt_url" id="txt_url" maxlength="150" placeholder="URL of this login! Max 150" value="" required>
					<span class="form-error">
						If URL is not available at this time please place a # as a place holder.
					</span>
				</label>
<!-- Username -->
				<label for="txt_username">Username
					<input type="text" name="txt_username" id="txt_username" maxlength="75" placeholder="None for no username! Max 16" value="" required>
					<span class="form-error">
						You must enter a username for this login. Enter none if no username is used!
					</span>
				</label>
<!-- Passcode -->
				<label for="area_pass">Passcode
					<textarea rows="4" name="area_pass" id="area_pass" required></textarea>
					<span class="form-error">
						You must enter a passcode! Use none if no passcode is used.
					</span>
				</label>
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


<?php include_layout_template('jcs_footer.php'); ?>


<?php 
function get_random_number() {
    $loop = true;
    $n = null;
    while ($loop) {
        $n = mt_rand(32, 125);
        switch ($n) {
            case 34: case 39: case 96: case 124:
                break;
            default:
                $loop = false;
        }
    }
    return $n;
}

?>
