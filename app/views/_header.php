<!DOCTYPE html> 
<html> 
	<head> 
	<title>MVC <?php echo formatTitle($title)?></title> 
	
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="app/assets/css/styles.css" />
</head> 
<body> 

<div>
	<div class="header">
		<table>
			<tr>
				<td><a href="<?php echo __SITE_URL; ?>"><img src="app/assets/img/icon.jpg" alt="MVC" /></a></td>
				<td><h2>MVC</h2></td>
			</tr>
		</table>
	</div>
	<div class="main_container">
		<table style="width:100%;">
			<tr>
				<td class="sidebar">
				<?php if(Session::get('loggin') == true) { ?>
					Welcome, <?php echo Session::get('firstname'); ?>.
					<ul>
						<?php if( Session::get('role') == "Employee") { ?>				
						<li><a href="?controller=rewardprogram">Reward Programs</a></li>
						<li><a href="?controller=course">Courses</a></li>
						<li><a href="?controller=product">Products</a></li>
						<li><a href="?controller=user">Users</a></li>
						<li><a href="?controller=user&action=view&id=<?php echo Session::get('id'); ?>">Profile</a></li>					
						<?php } ?>
						<?php if( Session::get('role') == "Partner") { ?>
						<li><a href="?controller=user&action=profile&id=<?php echo Session::get('id'); ?>">Profile</a></li>
						<?php } ?>
						<li><a href="?controller=login&action=logout">Logout</a></li>
					</ul>
				<?php } ?>
				</td>
				<td class="container">
					<h1><?php echo $title?></h1>