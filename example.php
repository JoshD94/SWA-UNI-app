<?php
include_once('calendar.php');
$calendar2 = new Calendar('2021-02-02');
$calendar2->add_event('Birthday', '2021-02-03', 1, 'green');
$calendar2->add_event('Doctors', '2021-02-04', 1, 'red');
$calendar2->add_event('Holiday', '2021-02-16', 7);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Event Calendar</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link href="calendar.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	    <nav class="navtop">
	    	<div>
	    		<h1>Event Calendar</h1>
	    	</div>
	    </nav>
		<div class="content home">
			<?=$calendar2?>
		</div>
	</body>
</html>