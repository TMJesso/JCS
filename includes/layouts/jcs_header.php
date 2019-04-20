<?php
global $session, $menu_type, $subtitle;
if (! isset($menu_type) && is_null($menu_type)) {
	$menu_type = Menu_Type::get_by_type("JCS", 9);
}
$menus = Menu::get_all_menus_by_type_id($menu_type->type_id);
// $menu_types = Menu_Type::get_all_type_by_order()
?>
<!-- Header -->
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>JCS :: Systems</title>
<link rel="stylesheet"
	href="<?php echo CSS_PATH . "foundation.min.css"; ?>">
<link rel="stylesheet" href="<?php echo CSS_PATH . "app.css"; ?>">
</head>
<body>
	<!-- Title Page -->
	<div class="grid-containter">
		<div class="grid-x grid-padding-x">
			<div class="large-12 medium-12 columns text-center">
				<h1>Jessop Digital Systems</h1>
					<?php if (isset($subtitle)) { ?>
					<h4><?php echo $subtitle; ?></h4>
					<?php } ?>
					
				</div>
		</div>
	</div>
	<!-- Title Page: END -->
	<!-- Breadcrumbs -->
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="large-offset-1 medium-offset-1 columns">
				<ul class="breadcrumbs">
					<li class="disabled"><?php echo hdent($menu_type->m_type); ?> Home</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- Breadcrumbs: END -->
	<!-- Menu -->
	<div class="grid-container">
			<div class="top-bar">
				<div class="top-bar-title" data-responsive-toggle="main_menu"
					data-hide-for="medium">
					<button class="menu-icon" type="button" data-toggle></button>
					&nbsp;<strong>Menu</strong>
				</div>

				<div id="main_menu">
					<div class="top-bar-left">
						<ul class="dropdown vertical medium-horizontal menu"
							data-responsive-menu="drilldown medium-dropdown"
							data-auto-height="true" data-animate-height="true">
							<li><?php if ($menu_type->m_type == 'JDS') { ?><img
								src="<?php echo MEDIA . "JDSLogo1.gif"; ?>"
								alt="<?php echo hdent($menu_type->m_type); ?>" width="25"
								height="25" style="margin-top: 6px"><?php } else { echo hdent($menu_type->m_type); } ?></li>
         				<?php if ($menu_type->m_type != "JDS") { ?>
        				<li><a href="/JCS/public/admin/index.php">JDS</a></li>
        				<?php } ?>
       			<?php foreach ($menus as $mt) { ?>
       				<?php if ((int)$mt->security == $session->get_security()) { ?>
                      <li><a href="<?php echo $mt->m_url; ?>"><?php echo hdent($mt->name); ?></a>
                        <?php $submenus = Tier1::get_all_submenu_by_menu_id($mt->m_id); ?>
                        <?php if ($submenus) { ?>
                        	<ul class="menu">
                        	<?php foreach ($submenus as $sub) { ?>
                        		<?php if ((int)$sub->t1_security == $session->get_security()) { ?>
                        			<?php $subsubmenus = Tier2::get_all_menu_by_tier1_id($sub->t1_id);?>
                        			<li><a href="<?php echo $sub->t1_url; ?>"><?php echo $sub->name; ?></a>
                        			<?php if ($subsubmenus) { ?>
										<ul class="menu">
	                      				<?php foreach ($subsubmenus as $bus) { ?>
	                      					<li><a href="<?php echo $bus->t2_url; ?>"><?php echo $bus->t2_name; ?></a></li>
	                         			<?php } ?>
	                         			</ul>
	                         			<?php } ?>
	                         		</li>
                        		<?php } ?>
                        	<?php } ?>
                        	</ul>
                        	
                        <?php } ?>
                      </li>
                      <?php } ?>
                  <?php } ?>
               </ul>
					</div>
				</div>
			</div>
	</div>
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="large-3 medium-3 columns">&nbsp;</div>
			<div class="large-6 medium-6 text-center columns">
				<?php echo output_message($session->message); ?>
				<?php echo output_errors($session->err); ?>
			</div>
			<div class="large-3 medium-3 columns">&nbsp;</div>
		</div>
	</div>
	<!-- Header: END -->