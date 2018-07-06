<?php
    global $session;
?>
<!-- Header -->
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>Jessop Computer Services</title>
		<link rel="stylesheet" href="<?php echo CSS_PATH . "foundation.min.css"; ?>">
		<link rel="stylesheet" href="<?php echo CSS_PATH . "app.css"; ?>">
	</head>
	<body>
<!-- Title Page -->
		<div class="grid-containter">
			<div class="grid-x grid-padding-x">
				<div class="large-12 medium-12 cell text-center">
					<h1>Jessop Computer Services</h1>
					
				</div>
			</div>
		</div>
<!-- Title Page: END -->
<!-- Breadcrumbs -->
		<div class="grid-container">
			<div class="grid-x grid-padding-x">
				<div class="large-offset-1 medium-offset-1 cell">
					<ul class="breadcrumbs">
						<li class="disabled">Home</li>
					</ul>
				</div>
			</div>
		</div>
<!-- Breadcrumbs: END -->
<!-- Menu -->
		<div class="grid-container">
			<div class="top-bar" data-responsive-toggle="main_menu" data-hide-for="medium">
				<button class="menu-icon" type="button" data-toggle></button>
				<div class="title-bar-title text-left">&nbsp;&nbsp;Menu</div>
			</div>
        	<div class="top-bar" id="main_menu">
        		<div class="top-bar-left">
                     <ul class="dropdown menu" data-dropdown-menu>
        				<li class="menu-text" style="font-size: .83em;"><img src="media/JCSlogo1.gif" alt="JCS" width="25" height="25" ></li>
                      <li>
                        <a href="#Home">Home</a>
                        </li>
                        <li>
                        <a href="#Tracker">Tracker</a>
                        <ul class="menu">
                        	<li>
                        		<a href="#Tracker-login">Tracker Login</a>
                        	</li>
                        </ul>
                        </li>
                       <li>
                        <a href="#VMas">VMAS</a>
                        <ul class="menu">
                          <li><a href="#VMas-login">VMAS Login</a></li>
                        </ul>
                      </li>
                      <li><a href="#CLAD">CLAD</a>
                      	<ul class="menu">
                      		<li><a href="#CLAD-login">CLAD Login</a></li>
                      	</ul>
                      </li>
                      <li><a href="#Resume">R&eacute;sum&eacute;</a>
                      	<ul class="menu">
                      		<li><a href="#Resume-login">R&eacute;sum&eacute; Login</a>
                      	</ul>
                      </li>
                      <li><a href="#Utilities">Utilities</a>
                      	<ul class="menu">
                      		<li><a href="#Utilities-more">More Utilities</a></li>
                      	</ul>
                      </li>
                      <li><a href="#System">System</a>
                      	<ul class="menu">
                      		<li><a href="#System-more">More System</a></li>
                      	</ul>
                      </li>
                      <li><a href="#logout">Logout</a></li>
                    </ul>
            	</div>
        	</div>
		</div>
		<div class="grid-container">
			<div class="grid-x grid-padding-x">
			<div class="large-3 medium-3 cell">
				&nbsp;
			</div>
			<div class="large-6 medium-6 text-center cell">
				<?php echo output_message($session->message); ?>
				<?php echo output_errors($session->err); ?>
			</div>
			<div class="large-3 medium-3 cell">
				&nbsp;
			</div>
			</div>
		</div>
<!-- Header: END -->
