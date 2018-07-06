<?php

/**
 * debugging tool
 *
 * $input is the variable being passed in
 *
 * $desc is optional and it will display in the mylog file
 * @param $input
 * @param $desc
 */
function log_data_verbose($input, $desc=""){
    $string_format = var_export($input, true);
    $file = fopen(DS . "mylog.txt", "a");
    fwrite($file, "\n{\n" . var_export(date("h:i:s a m/d/y"), true) . " From: " . $_SERVER["REQUEST_URI"] . "\n");
    fwrite($file, $string_format);
    if (!empty($desc)) {
        fwrite($file, "\n[ " . $desc . " ]\n }\n\n");
    } else {
        fwrite($file, "\n}\n\n");
    }
    fclose($file);
}

function include_layout_template($template="") {
    include(LAYOUT.$template);
}

function get_security_text($num=0) {
    $sec_text = array('CEO', 'CFO', 'General Manager', 'Department Manager', 'Superintendent', 'Shift Supervisor', 'Foreman', 'Leader', 'Production', 'Public');
    if ($num < count($sec_text)) {
        return $sec_text[$num];
    } else {
        return false;
    }
}

function get_clearance_text($num=0) {
    $clr_text = array('High-High', 'High-Medium', 'High-Low', 'Medium-High', 'Medium-Medium', 'Medium-Low', 'Low-High', 'Low-Medium', 'Low-Low', 'Public');
    if ($num < count($clr_text)) {
        return $clr_text[$num];
    } else {
        return false;
    }
}

function get_new_id() {
    $id = "";
    
    for ($x = 1; $x < 13; $x++) {
        $id .= get_random_letter();
    }
    
    return $id;
    //return chr(mt_rand(65, 90)) . chr(mt_rand(65, 90)) . chr(mt_rand(65, 90)) . "00";
}

function get_random_letter() {
    $letter = "";
    switch (get_random_value()) {
        case 1:
            $letter = chr(mt_rand(48, 57)); // number
            break;
        case 2:
            $letter = chr(mt_rand(65, 90)); // upper case letter
            break;
        case 3:
            $letter = chr(mt_rand(97, 122)); // lower case letter
            break;
    }
    return $letter;
}

function get_random_value($min=1, $max=3) {
    return mt_rand($min, $max);
}

function output_message($message="") {
    if (!empty($message)) {
        return "<br/><div class=\"success callout text-center\"><h5>{$message}</h5></div>";
    } else {
        return "";
    }
}

function output_errors($errors="") {
    if (!empty($errors)) {
        return "<br/><div class=\"alert callout text-center\"><h4>{$errors}</h4></div>";
    } else {
        return "";
    }
}

function redirect_to($location = null) {
    if (!is_null($location)) {
        header("Location: {$location}");
        exit;
    }
}

/** urlencode
 *
 * @param string $code
 * @return string
 */
function ucode($code) {
    return urlencode($code);
}

/** urldecode
 *
 * @param string $code
 * @return string
 */
function udcode($code) {
    return urldecode($code);
}

/** html enties encode
 *
 *
 * @param string $entities
 * @param int $ent default ENT_QUOTES
 * @return string
 */
function hent($entities, $ent=ENT_QUOTES) {
    return htmlentities($entities, $ent);
}

/** html entities decode
 *
 * @param string $entities
 * @param int $ent default = ENT_QUOTES
 * @return string
 */
function hdent($entities, $ent=ENT_QUOTES) {
    return html_entity_decode($entities, $ent);
}

function show_title($title) { ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">
			&nbsp;
        </div>
        <div class="large-6 medium-6 cell">
        	<h4 class="text-center"><?php echo $title; ?></h4>
        </div>
        <div class="large-3 medium-3 cell">
 	       &nbsp;
        </div>
    </div>
</div>
<?php 
}

?>

