<?php if ($_SESSION["login"] == 1) { ?>
<div id="content_pane">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Charaktere</h3>
		</div>
		<div class="panel-body">
			<?php
				$_query = "SELECT * FROM endland_characters WHERE user='" . $_SESSION["user"]["id"] . "' ORDER BY name ASC";
				$_result = mysql_query($_query) or die(mysql_error());
				while ($_character = mysql_fetch_assoc($_result)) {
					$_query_race = "SELECT name FROM endland_races WHERE id=" . $_character[race];
					$_result_race = mysql_query($_query_race) or die(mysql_error());
					$_var = mysql_fetch_assoc($_result_race);
					$_character[race] = $_var[name];
					echo "<character class='character_block'>";
						echo "<div class='thumbnail'>";
							echo "<img src='endland_v2/images/" . strtolower($_character[race]) . ".png' alt='" . $_character[race] . "'>";
							echo "<div class='caption'>";
								echo "<h3>" . $_character[name] . "</h3>";
								echo "<p><a href='index.php?&mode=endland_v2'>Endland v2</a></p>";
								echo "<div class='row'>";
									echo "<div class='col-md-6'>";
										echo "<form method='POST' action='index.php?&mode=endland_v2&endland=charsheet'>";
											echo "<input type='hidden' name='character' value='" . $_character[id] . "'>";
											echo "<input type='submit' name='submit' class='btn btn-primary' value='anzeigen'>";
										echo "</form>";
									echo "</div>";
									echo "<div class='col-md-6'>";
										echo "<form method='POST' action='index.php?&mode=change_character&roleset=endlandv2'>";
											echo "<input type='hidden' name='character' value='" . $_character[id] . "'>";
											echo "<input type='submit' name='submit' class='btn btn-default disabled' value='&auml;ndern'>";
										echo "</form>";
									echo "</div>";
								echo "</div>";
							echo "</div>";
						echo "</div>";
					echo "</character>";
				}
			?>
		</div>
	</div>
</div>
<?php } ?>