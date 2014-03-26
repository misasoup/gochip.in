<?php include('perch/runtime.php');?>

<!doctype html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="ja" dir="ltr"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7 " lang="ja" dir="ltr"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="ja" dir="ltr"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="ja" dir="ltr"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<title>testtest</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="keywords" content="" />
	<meta name="description" content="">
	<meta property="og:title" content="">
	<meta property="og:description" content="">
	<meta property="og:image" content="http://all-web.org/online/images/all-web-online-ogp.jpg">
	<meta property="og:url" content="http://gochip.in">
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="">
<!-- 	<link rel="stylesheet" type="text/css" href="css/style.css" > -->
	<script src="js/modernizr.custom.39135.js" async></script>
	<script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
</head>
<body>

<h1>講座</h1>
<?php
// $opts = array(
// 	'template'=>'events/listing/event-day.html',
//     'filter'=>'eventDateTime',
//     'match'=>'eqbetween',
//     'value'=>'2014-03-29, 2014-04-30'
// );
// perch_events_custom($opts);
perch_events_listing();
?>

<!-- <ul>
	<li>
		<h2>講座１</h2>
		<p>３/22まで</p>
	</li>
</ul> -->
</body>
</html>