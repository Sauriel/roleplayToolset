<h1>St&auml;dte:</h1>
<?php
	# Datenbank abfragen
	$_query = "SELECT * FROM endland_location WHERE type=1";
	$_result_s = mysql_query($_query) or die(mysql_error());
	while($_row = mysql_fetch_assoc($_result_s)) {
		echo "<h2>" , $_row['name'] , ":</h2>";
		echo "<b>Aussprache:</b> " , $_row['pronunciation'] , "</br>";
		echo "<b>Besonderheit:</b> " , $_row['notable'] , "</br>";
		echo "<b>Einwohner:</b> " , $_row['population'] , "</br>";
		echo "<b>Rassenverteilung</b></br>";
		echo "<table>";
			$_hum = ((100 / $_row['population']) * $_row['population_hum']);
			$_hum_r = round($_hum , $precision = 2);
			echo "<tr><td>HUM:</td><td align='right'>" , $_row['population_hum'] , "&nbsp;&nbsp;/</td><td align='right'>" , $_hum_r ,  "%</td></tr>";
			$_ika = ((100 / $_row['population']) * $_row['population_ika']);
			$_ika_r = round($_ika , $precision = 2);
			echo "<tr><td>IKA:</td><td align='right'>" , $_row['population_ika'] , "&nbsp;&nbsp;/</td><td align='right'>" , $_ika_r ,  "%</td></tr>";
			$_mad = ((100 / $_row['population']) * $_row['population_mad']);
			$_mad_r = round($_mad , $precision = 2);
			echo "<tr><td>MAD:</td><td align='right'>" , $_row['population_mad'] , "&nbsp;&nbsp;/</td><td align='right'>" , $_mad_r ,  "%</td></tr>";
			$_aqu = ((100 / $_row['population']) * $_row['population_aqu']);
			$_aqu_r = round($_aqu , $precision = 2);
			echo "<tr><td>AQU:</td><td align='right'>" , $_row['population_aqu'] , "&nbsp;&nbsp;/</td><td align='right'>" , $_aqu_r ,  "%</td></tr>";
			$_cer = ((100 / $_row['population']) * $_row['population_cer']);
			$_cer_r = round($_cer , $precision = 2);
			echo "<tr><td>CER:</td><td align='right'>" , $_row['population_cer'] , "&nbsp;&nbsp;/</td><td align='right'>" , $_cer_r ,  "%</td></tr>";
		echo "</table>";
		echo "<b>Regierungsform:</b> " , $_row['government'] , "</br>";
		echo "<b>Regent:</b> " , $_row['regent'] , "</br>";
		echo "<b>Herkunft des Namens:</b> " , $_row['name_origin'] , "</br>";
		echo "<b>Sehenswürdigkeiten:</b></br>";
		echo $_row['poi'] , "</br>";
	}
?>
<h1>D&ouml;rfer:</h1>
<?php
	# Datenbank abfragen
	$_query = "SELECT * FROM endland_location WHERE type=2";
	$_result_d = mysql_query($_query) or die(mysql_error());
	while($_row = mysql_fetch_assoc($_result_d)) {
		echo "<h2>" , $_row['name'] , ":</h2>";
		echo "<b>Aussprache:</b> " , $_row['pronunciation'] , "</br>";
		echo "<b>Besonderheit:</b> " , $_row['notable'] , "</br>";
		echo "<b>Einwohner:</b> " , $_row['population'] , "</br>";
		echo "<b>Rassenverteilung</b></br>";
		echo "<table>";
			$_hum = ((100 / $_row['population']) * $_row['population_hum']);
			$_hum_r = round($_hum , $precision = 2);
			echo "<tr><td>HUM:</td><td align='right'>" , $_row['population_hum'] , "&nbsp;&nbsp;/</td><td align='right'>" , $_hum_r ,  "%</td></tr>";
			$_ika = ((100 / $_row['population']) * $_row['population_ika']);
			$_ika_r = round($_ika , $precision = 2);
			echo "<tr><td>IKA:</td><td align='right'>" , $_row['population_ika'] , "&nbsp;&nbsp;/</td><td align='right'>" , $_ika_r ,  "%</td></tr>";
			$_mad = ((100 / $_row['population']) * $_row['population_mad']);
			$_mad_r = round($_mad , $precision = 2);
			echo "<tr><td>MAD:</td><td align='right'>" , $_row['population_mad'] , "&nbsp;&nbsp;/</td><td align='right'>" , $_mad_r ,  "%</td></tr>";
			$_aqu = ((100 / $_row['population']) * $_row['population_aqu']);
			$_aqu_r = round($_aqu , $precision = 2);
			echo "<tr><td>AQU:</td><td align='right'>" , $_row['population_aqu'] , "&nbsp;&nbsp;/</td><td align='right'>" , $_aqu_r ,  "%</td></tr>";
			$_cer = ((100 / $_row['population']) * $_row['population_cer']);
			$_cer_r = round($_cer , $precision = 2);
			echo "<tr><td>CER:</td><td align='right'>" , $_row['population_cer'] , "&nbsp;&nbsp;/</td><td align='right'>" , $_cer_r ,  "%</td></tr>";
		echo "</table>";
		echo "<b>Regierungsform:</b> " , $_row['government'] , "</br>";
		echo "<b>Regent:</b> " , $_row['regent'] , "</br>";
		echo "<b>Herkunft des Namens:</b> " , $_row['name_origin'] , "</br>";
		echo "<b>Sehenswürdigkeiten:</b></br>";
		echo $_row['poi'] , "</br>";
	}
?>