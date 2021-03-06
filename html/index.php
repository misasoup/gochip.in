<?php include('perch/runtime.php');?>


<!doctype html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="ja" dir="ltr"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7 " lang="ja" dir="ltr"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="ja" dir="ltr"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="ja" dir="ltr"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<?php perch_content('meta'); ?>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
<!-- 	<link rel="stylesheet" type="text/css" href="css/style.css" > -->
	<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
</head>
<body>
	<?php perch_content('login'); ?>
	<?php perch_content('register'); ?>

<div id="mainmap" style="width: 500px; height: 400px;"></div>
<?php

	perch_content_create('mainmap', array(
		'template'  => 'maininfo.html',
		'multiple'  => true,
		'edit-mode' => 'listdetail',
	));


	if (perch_get('s')) {

	// Detail mode
			perch_content_custom('mainmap', array(
				'template' => 'maininfo.html',
				'filter'   => 'slug',
				'match'    => 'eq',
				'value'    => perch_get('s'),
				'count'    => 1,
			));

	} else {

	// List mode
			perch_content_custom('mainmap', array(
				'template' => 'mainmap.html',
			));
	}

?>

<script type="text/javascript">
	var locations = [
		<?php perch_content('mainmap_location'); ?>
	];
	var map = new google.maps.Map(document.getElementById('mainmap'), {
		zoom: 10,
		center: new google.maps.LatLng(-33.92, 151.25),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	var infowindow = new google.maps.InfoWindow();

	var marker, i;

	for (i = 0; i < locations.length; i++) {
		marker = new google.maps.Marker({
		position: new google.maps.LatLng(locations[i][2], locations[i][3]),
		map: map
		});

		var locLink = 'http://gochip.in' +locations[i][4];

			google.maps.event.addListener(marker, 'click', (function(marker, i) {
			return function() {
			infowindow.setContent(locations[i][0] + "<br>" + locations[i][1] + '<br><a href="'+locLink+'">詳細はこちら</a>');
			infowindow.open(map, marker);
			}
		})(marker, i));
	}
</script>

</body>
</html>