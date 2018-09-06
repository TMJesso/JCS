<?php
require_once '../../../../includes/initialize.php';
$user = User::get_user_by_username($session->get_user_id());
$user_id = $user->user_id;
unset($user);
$summary = Summary::get_all_summary_by_user_id($user_id);

?>

<?php include_layout_template('jcs_header.php'); ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
		<div class="large-6 medium-6 cell">
			<h3 class="text-center">Add / Edit Summaries</h3>
			<select name="select_summary" id="select_summary" required>
				<option value="">Select a Summary to edit</option>
				<option value="new">New Summary</option>
				<?php foreach ($summary as $sum) { ?>
				
				<?php } ?>
			</select>
		</div>
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
	</div>
</div>
<?php if ($summary) { ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
		<div class="large-6 medium-6 cell">
			<h4 class="text-center">Current List of Summaries</h4>
			<table>
				<tr>
					<th>Summary</th>
				</tr>
				<?php foreach ($summary as $sum) { ?>
				<tr>
					<td></td>
				</tr>
				<?php } ?>
			</table>
		</div>
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
	</div>
</div>
<?php } ?>
<?php include_layout_template('jcs_footer.php'); ?>

