<?php include('../perch/runtime.php'); ?>
<?php 
	//we can get the event Title using perch_events_event_field
	$title = perch_events_event_field(perch_get('s'),'eventTitle',true);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Event: <?php echo $title; ?></title>
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
			<h1>Event</h1>
			<?php 		
				perch_events_custom(array(
					'filter'=>'eventSlug',
					'match'=>'eq',
					'value'=>perch_get('s'),
					'template'=>'listing/event-detail.html'
				));
			?>			
		</div>

		<nav class="sidebar">
		    <!--  By category listing -->
		    <?php perch_events_event_categories(perch_get('s')); ?>
    	</nav>

	</div>

	<?php perch_get_javascript(); ?>
</body>
</html>
