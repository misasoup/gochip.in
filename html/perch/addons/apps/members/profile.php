<?php include('../perch/runtime.php'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
	<title>Perch Example Page</title>
	<?php perch_get_css(); ?>
</head>
<body>
	<header class="layout-header">
		<div class="wrapper">
			<div class="company-name">Perch Members App</div>
			<img src="<?php perch_path('feathers/quill/img/logo.gif'); ?>" alt="Your Logo Here" class="logo"/>
		</div>
		<nav class="main-nav">
			<?php perch_pages_navigation(array(
					'levels'=>1
				));
			?>
		</nav>
	</header>
	
	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">

		<?php 
			if (perch_member_logged_in()) {
 				echo '<h1>Hi, '.perch_member_get('first_name').'! This is your profile</h1>';
				perch_member_form('profile.html');

				echo '<h2>Update your password</h2>';
				perch_member_form('password.html');
			}else{
				echo '<a href="/members/">Please log in</a>';
			}

		?>
	</div>
		
		<nav class="sidebar">
			<?php
				if (perch_member_logged_in()) {
			?>	
				<ul>
					<li><a href="profile.php">Edit profile</a></li>
					<li><a href="logout.php">Log out</a></li>
				</ul>

			<?php
				}else{
					perch_members_login_form();	
				}
			?>
		</nav>
		
	</div>
	
	<footer class="layout-footer">
		<div class="wrapper">
			<ul class="social-links">
				<li class="twitter"><a href="#" rel="me">Twitter</a></li>
				<li class="facebook"><a href="#" rel="me">Facebook</a></li>
				<li class="flickr"><a href="#" rel="me">Flickr</a></li>
				<li class="linkedin"><a href="#" rel="me">LinkedIn</a></li>
				<li class="rss"><a href="#">RSS</a></li>
			</ul>
			<small>Copyright &copy; 2013</small>
		</div>
	</footer>

    


    <?php perch_get_javascript(); ?>
</body>
</html>