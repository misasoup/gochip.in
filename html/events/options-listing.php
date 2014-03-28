<?php include('../perch/runtime.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />

	<title>Perch Events Example</title>
	<?php perch_get_css(); ?>
	<link rel="stylesheet" href="events.css" type="text/css" />
	
</head>

<body>
	<header class="layout-header">
		<div class="wrapper">
			<div class="company-name">Perch Events App - Company Name</div>
			<img src="<?php perch_path('feathers/quill/img/logo.gif'); ?>" alt="Your Logo Here" class="logo" />
		</div>
		<nav class="main-nav">
			<?php perch_pages_navigation(array(
					'levels'=>1
				));
			?>
		</nav>
	</header>
	
	<!--  change cols2-nav-right to cols2-nav-left if you want the sidebar on the left -->
	<div class="wrapper cols2-nav-right">
	
		<div class="primary-content">
			<h1>Events Listing</h1>
			<p>This an example of the Perch Event Listing view.</p>
		<?php 
			/**
			 * Change the categories listed to one or more which exist in your admin.
			 */
			perch_events_listing(array(
			    'past-events'=>true,
			    'category'=>array('one', 'two')
			));
		?>	
		</div>

	</div>

	<?php perch_get_javascript(); ?>
</body>
</html>
