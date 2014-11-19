<link rel="stylesheet" type="text/css" href="endland_v2/css/endland_mod_fixed.css">
<div id="pencil">
	&nbsp;
</div>

<div id="dice">
	&nbsp;
</div>

<div id="charactersheet">
</div>

<div id="overlaybg">
	&nbsp;
</div>

<?php
	if (empty($_POST["submit"])) {
		$_SESSION[create_step] = 1;
	} else {
		$_SESSION[create_step]++;
	}
	$_step = $_SESSION[create_step];
?>

<div id="progressbg">
	&nbsp;
</div>

<div id="progress">
	<ull class="list-unstyled">
			<?php
				echo "<li>";
				if ($_step == 1) {
					echo "<i class='glyphicon glyphicon-chevron-right'></i>&nbsp;<strong>";
				} else {
					echo "&nbsp;&nbsp;&nbsp;&nbsp;<strong class='light'>";
				}
				echo "1. Rasse</strong></li>";
				
				echo "<li>";
				if ($_step == 2) {
					echo "<i class='glyphicon glyphicon-chevron-right'></i>&nbsp;<strong>";
				} else {
					echo "&nbsp;&nbsp;&nbsp;&nbsp;<strong class='light'>";
				}
				echo "2. Aussehen</strong></li>";
				
				echo "<li>";
				if ($_step == 3) {
					echo "<i class='glyphicon glyphicon-chevron-right'></i>&nbsp;<strong>";
				} else {
					echo "&nbsp;&nbsp;&nbsp;&nbsp;<strong class='light'>";
				}
				echo "3. Berufung</strong></li>";
				
				echo "<li>";
				if ($_step == 4) {
					echo "<i class='glyphicon glyphicon-chevron-right'></i>&nbsp;<strong>";
				} else {
					echo "&nbsp;&nbsp;&nbsp;&nbsp;<strong class='light'>";
				}
				echo "4. mentale Eigenschaften</strong></li>";
				
				echo "<li>";
				if ($_step == 5) {
					echo "<i class='glyphicon glyphicon-chevron-right'></i>&nbsp;<strong>";
				} else {
					echo "&nbsp;&nbsp;&nbsp;&nbsp;<strong class='light'>";
				}
				echo "5. Fertigkeiten</strong></li>";
				
				echo "<li>";
				if ($_step == 6) {
					echo "<i class='glyphicon glyphicon-chevron-right'></i>&nbsp;<strong>";
				} else {
					echo "&nbsp;&nbsp;&nbsp;&nbsp;<strong class='light'>";
				}
				echo "6. Naturtalente</strong></li>";
				
				echo "<li>";
				if ($_step == 7) {
					echo "<i class='glyphicon glyphicon-chevron-right'></i>&nbsp;<strong>";
				} else {
					echo "&nbsp;&nbsp;&nbsp;&nbsp;<strong class='light'>";
				}
				echo "7. Thema</strong></li>";
			?>
	</ul>
</div>

<div id="overlay">
	<?php
		include("create_char_step" . $_step . ".php");
	?>
</div>