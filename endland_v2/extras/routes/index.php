<?php
	# mit Datenbank verbinden
	include("../../../config/conect_db.php");
	SESSION_START();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
 
		<title>ERC - Endland Route Calculator</title>
		
		<!-- Bootstrap -->
		<link href="../../../css/bootstrap.min.css" rel="stylesheet" media="screen">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="../../assets/js/html5shiv.js"></script>
			<script src="../../assets/js/respond.min.js"></script>
		<![endif]-->
 
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
			<script src="//code.jquery.com/jquery.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
			<script src="../../../js/bootstrap.min.js"></script>
			
		<link href="../../../css/style.css" rel="stylesheet" type="text/css">
	</head>

	<body>
	<div id="content_pane">
<?php
	require("Dijkstra.php");
	
	if (!empty($_POST["submit"])) {
	
		$_location_list = array(0 => "ERROR");
		
		$_query_locations = "SELECT * FROM endland_location ORDER BY id ASC";
		$_result_locations = mysql_query($_query_locations) or die(mysql_error());
		while ($_locations = mysql_fetch_assoc($_result_locations)) {
			array_push($_location_list, $_locations['name']);
		}
	
		$_graph = new Graph();
		
		$_query = "SELECT * FROM endland_routes";
		$_result = mysql_query($_query) or die(mysql_error());
		while ($_routes = mysql_fetch_assoc($_result)) {
			$_start = $_location_list[$_routes['start']];
			$_end = $_location_list[$_routes['end']];
			$_graph->addedge($_start, $_end, $_routes["weight"]);
		}
		
		$_from = $_location_list[$_POST['start']];
		
		$_to = $_location_list[$_POST['end']];
		
		list($distances, $prev) = $_graph->paths_from($_from);
	
		$_path = $_graph->paths_to($prev, $_to);
		
		$_distance = 0;
		$_complete_route = "<b>Route:</b> ";
		
		$_previous = NULL;
		$_actual = NULL;
		$_isFirst = true;
		
		foreach ($_path as $_route) {
			if (strpos($_route, "Kreuzung") !== false) {
				
			} else {
				$_complete_route .= $_route . " --> ";
			}
			
			if ($_isFirst) {
				$_previous = $_route;
				$_isFirst = false;
			} else {
				$_actual = $_route;
				$_locID = array_keys($_location_list, $_actual);
				$_locAcID = $_locID[0];
				$_locID = array_keys($_location_list, $_previous);
				$_locPrID = $_locID[0];
				$_query = "SELECT weight FROM endland_routes WHERE start=" . $_locPrID . " AND end=" . $_locAcID;
				$_result = mysql_query($_query) or die(mysql_error());
				$_var = mysql_fetch_assoc($_result);
				$_distance += $_var['weight'];
				$_previous = $_route;
			}
			
		}
		
		$_complete_route = substr($_complete_route, 0, strlen($_complete_route) - 5);
		
		echo $_complete_route . "</br>";
		echo "<b>Entfernung:</b> " . $_distance . " km</br>";
		echo "<table class='table table-hover'><tr><th>Reiseart</th><th>Geschwindigkeit</th><th>Dauer</th><th>reine Stunden</th></tr>";
		echo "<tr><td>zu Fuss</td><td>5 km/h</td><td>" . floor($_distance / 60) . " Tage " . (($_distance / 60) - floor($_distance / 60)) * 12 . " Stunden</td><td>" . ($_distance / 5) . " Stunden</td></tr>";
		echo "<tr><td>Karavane</td><td>10 km/h</td><td>" . floor($_distance / 120) . " Tage " . (($_distance / 120) - floor($_distance / 120)) * 12 . " Stunden</td><td>" . ($_distance / 10) . " Stunden</td></tr>";
		echo "<tr><td>Pferd, Schritt</td><td>5 km/h</td><td>" . floor($_distance / 60) . " Tage " . (($_distance / 60) - floor($_distance / 60)) * 12 . " Stunden</td><td>" . ($_distance / 5) . " Stunden</td></tr>";
		echo "<tr><td>Pferd, Trab</td><td>15 km/h</td><td>" . floor($_distance / 180) . " Tage " . (($_distance / 180) - floor($_distance / 180)) * 12 . " Stunden</td><td>" . ($_distance / 15) . " Stunden</td></tr>";
		echo "<tr><td>Pferd, Galopp</td><td>25 km/h</td><td>" . floor($_distance / 300) . " Tage " . (($_distance / 300) - floor($_distance / 300)) * 12 . " Stunden</td><td>" . ($_distance / 25) . " Stunden</td></tr>";
		echo "<tr><td>Auto</td><td>30 km/h</td><td>" . floor($_distance / 360) . " Tage " . (($_distance / 360) - floor($_distance / 360)) * 12 . " Stunden</td><td>" . ($_distance / 30) . " Stunden</td></tr>";
		echo "<tr><td>schnelles Auto</td><td>60 km/h</td><td>" . floor($_distance / 720) . " Tage " . (($_distance / 720) - floor($_distance / 720)) * 12 . " Stunden</td><td>" . ($_distance / 60) . " Stunden</td></tr>";
		echo "</table>";
		echo "<i>1 Tag entspricht 12 Stunden</i></br>";
		echo "</br></br>";
	}
?>

<form method="POST" action="index.php">
<table>
<tr>
<td><b>Start</b></td>
<td><b>Ende</b></td>
</tr>
<tr>
<td>
<?php
	$_query = "SELECT * FROM endland_location WHERE type=1 OR type=2 ORDER BY name ASC";
	$_result_1 = mysql_query($_query) or die(mysql_error());
	
	$_dropdown = '<select name="start">';
	while($_row = mysql_fetch_assoc($_result_1)) {
		$_dropdown .= "\r\n<option value='{$_row['id']}'>{$_row['name']}</option>";
	}
	$_dropdown .= "\r\n</select>";
	echo $_dropdown;
?>
</td>
<td>
<td>
<?php
	$_query = "SELECT * FROM endland_location WHERE type=1 OR type=2 ORDER BY name ASC";
	$_result_2 = mysql_query($_query) or die(mysql_error());
	
	$_dropdown2 = '<select name="end">';
	while($_row = mysql_fetch_assoc($_result_2)) {
		$_dropdown2 .= "\r\n<option value='{$_row['id']}'>{$_row['name']}</option>";
	}
	$_dropdown2 .= "\r\n</select>";
	echo $_dropdown2;
?>
</td>
</tr>
</table>
<input type="submit" name="submit" value="k&uuml;rzeste Routesuchen">
</form>
</div>
</body>
</html>