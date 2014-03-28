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
			<?php
				perch_events_category(perch_get('cat'));
			?>

			<p>This shows events by category, and then filtered by date.</p>

			<h2>Upcoming events</h2>

			<?php 
			 	perch_events_custom(array(
					'category'   => perch_get('cat'),
					'filter'     => 'eventDateTime',
					'match'      => 'gte',
					'value'      => date('Y-m-d'),
					'sort'       => 'eventDateTime',
					'sort-order' => 'desc',
					'template'   => 'listing/custom-listing-day.html'
	            ));
			?>

			<h2>Past events</h2>

			<?php 
			 	perch_events_custom(array(
					'category'   => perch_get('cat'),
					'filter'     => 'eventDateTime',
					'match'      => 'lt',
					'value'      => date('Y-m-d'),
					'sort'       => 'eventDateTime',
					'sort-order' => 'desc',
					'template'   => 'listing/custom-listing-day.html'
	            ));
			?>
		</div>

		<nav class="sidebar">
		    <!--  By category listing -->
		    <?php perch_events_categories(); ?>
    	</nav>
		
		
	</div>


	<?php perch_get_javascript(); ?>
</body>
</html>




