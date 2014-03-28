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
			<img src="<?php perch_path('feathers/quill/img/logo.gif'); ?>" alt="Your Logo Here" class="logo"/>
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
		<h1>Events Example Pages</h1>
		
		
	   
		<p>These pages are examples of how to use the events functionality on your pages. Install the Events add-on and add some events and categories, then try the links below to see the kind of pages you can create. Simply copy the functions into your own site design.</p>
		
		<ul>
			<li><a href="basic-calendar.php">Basic calendar</a></li>
			<li><a href="options-calendar.php">Calendar with options</a></li>
			<li><a href="basic-listing.php">Basic listing</a></li>
			<li><a href="options-listing.php">Listing with options</a></li>
			<li><a href="events-custom.php">Using events custom to display a listing with a detail page</a></li>
		</ul>
		
		</div>
		
		
	</div>
	<?php perch_get_javascript(); ?>
</body>
</html>
