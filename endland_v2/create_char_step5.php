<form method="POST" action="index.php?&mode=endland_v2&endland=create">

	<?php
		# MySQL Injections vorbeugen		
		$_bonus1 = mysql_real_escape_string($_POST["bonus0"]);
		$_bonus2 = mysql_real_escape_string($_POST["bonus1"]);
		$_SESSION[new_character][ethos] = mysql_real_escape_string($_POST["ethos"]);
		
		if (empty($_POST["tem"])) {
			$_SESSION[new_character][temprament] = mysql_real_escape_string($_POST["r_tem"]);
			$_SESSION[new_character][mood] = mysql_real_escape_string($_POST["r_sti"]);
			$_SESSION[new_character][will] = mysql_real_escape_string($_POST["r_wil"]);
			$_SESSION[new_character][curiosity] = mysql_real_escape_string($_POST["r_neu"]);
			$_SESSION[new_character][vanity] = mysql_real_escape_string($_POST["r_eit"]);
			$_SESSION[new_character][greediness] = mysql_real_escape_string($_POST["r_hab"]);
			$_SESSION[new_character][powerneed] = mysql_real_escape_string($_POST["r_mac"]);
			$_SESSION[new_character][vengefulness] = mysql_real_escape_string($_POST["r_rac"]);
			$_SESSION[new_character][sexdrive] = mysql_real_escape_string($_POST["r_ges"]);
			$_SESSION[new_character][loveneed] = mysql_real_escape_string($_POST["r_lie"]);
		} else {
			$_SESSION[new_character][temprament] = mysql_real_escape_string($_POST["tem"]);
			$_SESSION[new_character][mood] = mysql_real_escape_string($_POST["sti"]);
			$_SESSION[new_character][will] = mysql_real_escape_string($_POST["wil"]);
			$_SESSION[new_character][curiosity] = mysql_real_escape_string($_POST["neu"]);
			$_SESSION[new_character][vanity] = mysql_real_escape_string($_POST["eit"]);
			$_SESSION[new_character][greediness] = mysql_real_escape_string($_POST["hab"]);
			$_SESSION[new_character][powerneed] = mysql_real_escape_string($_POST["mac"]);
			$_SESSION[new_character][vengefulness] = mysql_real_escape_string($_POST["rac"]);
			$_SESSION[new_character][sexdrive] = mysql_real_escape_string($_POST["ges"]);
			$_SESSION[new_character][loveneed] = mysql_real_escape_string($_POST["lie"]);
		}
		
		$_query = "SELECT * FROM endland_ethos WHERE id=" . $_SESSION[new_character][ethos];
		$_result = mysql_query($_query) or die(mysql_error());
		$_ethos = mysql_fetch_assoc($_result);
		$_SESSION[new_character][ethos_name] = $_ethos[name];
		
		if (!empty($_bonus1)) {
			$_SESSION[new_character][$_bonus1] += 1;
		}
		
		if (!empty($_bonus2)) {
			$_SESSION[new_character][$_bonus2] += 1;
		}
	?>
	
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">&Uuml;berblick</h3>
		</div>
		<div class="panel-body">
			<div class="row">
  				<div class="col-md-4">
  					<div class="input-group">
						<span class="input-group-addon">Rasse</span>
						<?php
							echo "<span class='form-control'>" . $_SESSION[new_character][race_name] . "</span>";
						?>
					</div>
  				</div>
  				<div class="col-md-4">
  					<div class="input-group">
						<span class="input-group-addon">Geschlecht</span>
						<?php
							echo "<span class='form-control'>" . $_SESSION[new_character][sex] . "</span>";
						?>
					</div>
  				</div>
  				<div class="col-md-4">
  					<div class="input-group">
						<span class="input-group-addon">Alter</span>
						<?php
							echo "<span class='form-control'>" . $_SESSION[new_character][age] . " Jahre</span>";
						?>
					</div>
  				</div>
			</div>
			</br>
			<div class="row">
  				<div class="col-md-4">
  					<div class="input-group">
						<span class="input-group-addon">Gr&ouml;&szlig;e</span>
						<?php
							echo "<span class='form-control'>" . $_SESSION[new_character][size] . " cm</span>";
						?>
					</div>
  				</div>
  				<div class="col-md-4">
  					<div class="input-group">
						<span class="input-group-addon">Statur</span>
						<?php
							echo "<span class='form-control'>" . $_SESSION[new_character][figure] . "</span>";
						?>
					</div>
  				</div>
  				<div class="col-md-4">
  					<div class="input-group">
						<span class="input-group-addon">Berufung</span>
						<?php
							echo "<span class='form-control'>" . $_SESSION[new_character][profession_name] . "</span>";
						?>
					</div>
  				</div>
			</div>
			</br>
			<div class="row">
  				<div class="col-md-4">
  					<div class="input-group">
						<span class="input-group-addon">Gesinnung</span>
						<?php
							echo "<span class='form-control'>" . $_SESSION[new_character][ethos_name] . "</span>";
						?>
					</div>
  				</div>
			</div>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Fertigkeiten</h3>
		</div>
		<div class="panel-body">
			
			<?php
				switch ($_SESSION[new_character][age_period]) {
				case "jung":
					echo "<div class='alert alert-success'>";
					echo "<p>Du kannst 2 Fertigkeiten auf Rang 2 und 4 auf Rang 1 setzen.</p>";
					echo "</div>";
					echo "<table class='table table-hover'>";
					echo "<tr>";
					echo "<th>Rang 2</th>";
					echo "<th>Rang 1</th>";
					echo "<th>Skill</th>";
					echo "</tr>";
					break;
				case "jugendlich":
					echo "<div class='alert alert-success'>";
					echo "<p>Du kannst 2 Fertigkeiten auf Rang 3, 4 auf Rang 2 und 6 auf Rang 1 setzen.</p>";
					echo "</div>";
					echo "<table class='table table-hover'>";
					echo "<tr>";
					echo "<th>Rang 3</th>";
					echo "<th>Rang 2</th>";
					echo "<th>Rang 1</th>";
					echo "<th>Skill</th>";
					echo "</tr>";
					break;
				case "alt":
					echo "<div class='alert alert-success'>";
					echo "<p>Du kannst 1 Fertigkeit auf Rang 4, 3 auf Rang 3, 5 auf Rang 2 und 5 auf Rang 1 setzen.</p>";
					echo "</div>";
					echo "<table class='table table-hover'>";
					echo "<tr>";
					echo "<th>Rang 4</th>";
					echo "<th>Rang 3</th>";
					echo "<th>Rang 2</th>";
					echo "<th>Rang 1</th>";
					echo "<th>Skill</th>";
					echo "</tr>";
					break;
				}
			
				$_query = "SELECT * FROM endland_professions WHERE id=" . $_SESSION[new_character][profession];
				$_result = mysql_query($_query) or die(mysql_error());
				$_profession = mysql_fetch_assoc($_result);
				
				$_proskill1 = $_profession[skill1];
				$_proskill2 = $_profession[skill2];
				$_proskill3 = $_profession[skill3];
				
				$_skilllist = 0;
				
				if ($_proskill1 != 0) {
					$_query = "SELECT * FROM endland_skills WHERE id=" . $_proskill1;
					$_result = mysql_query($_query) or die(mysql_error());
					$_proskill1 = mysql_fetch_assoc($_result);

					echo "<tr>";
					switch ($_SESSION[new_character][age_period]) {
					case "jung":
						echo "<td><input type='checkbox' name='skill_" . $_proskill1[id] . "' value='" . $_proskill1[id] . ",2'></td>";
						echo "<td><input type='checkbox' name='skill_" . $_proskill1[id] . "' value='" . $_proskill1[id] . ",1'></td>";
						break;
					case "jugendlich":
						echo "<td><input type='checkbox' name='skill_" . $_proskill1[id] . "' value='" . $_proskill1[id] . ",3'></td>";
						echo "<td><input type='checkbox' name='skill_" . $_proskill1[id] . "' value='" . $_proskill1[id] . ",2'></td>";
						echo "<td><input type='checkbox' name='skill_" . $_proskill1[id] . "' value='" . $_proskill1[id] . ",1'></td>";
						break;
					case "alt":
						echo "<td><input type='checkbox' name='skill_" . $_proskill1[id] . "' value='" . $_proskill1[id] . ",4'></td>";
						echo "<td><input type='checkbox' name='skill_" . $_proskill1[id] . "' value='" . $_proskill1[id] . ",3'></td>";
						echo "<td><input type='checkbox' name='skill_" . $_proskill1[id] . "' value='" . $_proskill1[id] . ",2'></td>";
						echo "<td><input type='checkbox' name='skill_" . $_proskill1[id] . "' value='" . $_proskill1[id] . ",1'></td>";
						break;
					}
					echo "<td><a id='skill", $_proskill1[id], "' href='#' data-trigger='hover' data-content='", $_proskill1[description], "' data-placement='left' title='", $_proskill1[name] , "'>" . $_proskill1[name] . "</a></td>";
					echo "</tr>";
					?>
					<script type="text/javascript">
						$('#skill<?php echo $_proskill1[id];?>').popover({ container: 'body', html: true})
					</script>
					<?php
				}
				
				if ($_proskill2 != 0) {
					$_query = "SELECT * FROM endland_skills WHERE id=" . $_proskill2;
					$_result = mysql_query($_query) or die(mysql_error());
					$_proskill2 = mysql_fetch_assoc($_result);

					echo "<tr>";
					switch ($_SESSION[new_character][age_period]) {
					case "jung":
						echo "<td><input type='checkbox' name='skill_" . $_proskill2[id] . "' value='" . $_proskill2[id] . ",2'></td>";
						echo "<td><input type='checkbox' name='skill_" . $_proskill2[id] . "' value='" . $_proskill2[id] . ",1'></td>";
						break;
					case "jugendlich":
						echo "<td><input type='checkbox' name='skill_" . $_proskill2[id] . "' value='" . $_proskill2[id] . ",3'></td>";
						echo "<td><input type='checkbox' name='skill_" . $_proskill2[id] . "' value='" . $_proskill2[id] . ",2'></td>";
						echo "<td><input type='checkbox' name='skill_" . $_proskill2[id] . "' value='" . $_proskill2[id] . ",1'></td>";
						break;
					case "alt":
						echo "<td><input type='checkbox' name='skill_" . $_proskill2[id] . "' value='" . $_proskill2[id] . ",4'></td>";
						echo "<td><input type='checkbox' name='skill_" . $_proskill2[id] . "' value='" . $_proskill2[id] . ",3'></td>";
						echo "<td><input type='checkbox' name='skill_" . $_proskill2[id] . "' value='" . $_proskill2[id] . ",2'></td>";
						echo "<td><input type='checkbox' name='skill_" . $_proskill2[id] . "' value='" . $_proskill2[id] . ",1'></td>";
						break;
					}
					echo "<td><a id='skill", $_proskill2[id], "' href='#' data-trigger='hover' data-content='", $_proskill2[description], "' data-placement='left' title='", $_proskill2[name] , "'>" . $_proskill2[name] . "</a></td>";
					echo "</tr>";
					?>
					<script type="text/javascript">
						$('#skill<?php echo $_proskill2[id];?>').popover({ container: 'body', html: true})
					</script>
					<?php
				}
				
				if ($_proskill3 != 0) {
					$_query = "SELECT * FROM endland_skills WHERE id=" . $_proskill3;
					$_result = mysql_query($_query) or die(mysql_error());
					$_proskill3 = mysql_fetch_assoc($_result);

					echo "<tr>";
					switch ($_SESSION[new_character][age_period]) {
					case "jung":
						echo "<td><input type='checkbox' name='skill_" . $_proskill3[id] . "' value='" . $_proskill3[id] . ",2'></td>";
						echo "<td><input type='checkbox' name='skill_" . $_proskill3[id] . "' value='" . $_proskill3[id] . ",1'></td>";
						break;
					case "jugendlich":
						echo "<td><input type='checkbox' name='skill_" . $_proskill3[id] . "' value='" . $_proskill3[id] . ",3'></td>";
						echo "<td><input type='checkbox' name='skill_" . $_proskill3[id] . "' value='" . $_proskill3[id] . ",2'></td>";
						echo "<td><input type='checkbox' name='skill_" . $_proskill3[id] . "' value='" . $_proskill3[id] . ",1'></td>";
						break;
					case "alt":
						echo "<td><input type='checkbox' name='skill_" . $_proskill3[id] . "' value='" . $_proskill3[id] . ",4'></td>";
						echo "<td><input type='checkbox' name='skill_" . $_proskill3[id] . "' value='" . $_proskill3[id] . ",3'></td>";
						echo "<td><input type='checkbox' name='skill_" . $_proskill3[id] . "' value='" . $_proskill3[id] . ",2'></td>";
						echo "<td><input type='checkbox' name='skill_" . $_proskill3[id] . "' value='" . $_proskill3[id] . ",1'></td>";
						break;
					}
					echo "<td><a id='skill", $_proskill3[id], "' href='#' data-trigger='hover' data-content='", $_proskill3[description], "' data-placement='left' title='", $_proskill3[name] , "'>" . $_proskill3[name] . "</a></td>";
					echo "</tr>";
					?>
					<script type="text/javascript">
						$('#skill<?php echo $_proskill3[id];?>').popover({ container: 'body', html: true})
					</script>
					<?php
				}
				
				$_query = "SELECT * FROM endland_skills WHERE profession=0 ORDER BY name ASC";
				$_result = mysql_query($_query) or die(mysql_error());
				while ($_skill = mysql_fetch_assoc($_result)) {
					$_known_skills = explode(",", $_SESSION[new_character][skills]);
					if(!in_array($_skill[id], $_known_skills)) {
						echo "<tr>";
						switch ($_SESSION[new_character][age_period]) {
						case "jung":
							echo "<td><input type='checkbox' name='skill_" . $_skill[id] . "' value='" . $_skill[id] . ",2'></td>";
							echo "<td><input type='checkbox' name='skill_" . $_skill[id] . "' value='" . $_skill[id] . ",1'></td>";
							break;
						case "jugendlich":
							echo "<td><input type='checkbox' name='skill_" . $_skill[id] . "' value='" . $_skill[id] . ",3'></td>";
							echo "<td><input type='checkbox' name='skill_" . $_skill[id] . "' value='" . $_skill[id] . ",2'></td>";
							echo "<td><input type='checkbox' name='skill_" . $_skill[id] . "' value='" . $_skill[id] . ",1'></td>";
							break;
						case "alt":
							echo "<td><input type='checkbox' name='skill_" . $_skill[id] . "' value='" . $_skill[id] . ",4'></td>";
							echo "<td><input type='checkbox' name='skill_" . $_skill[id] . "' value='" . $_skill[id] . ",3'></td>";
							echo "<td><input type='checkbox' name='skill_" . $_skill[id] . "' value='" . $_skill[id] . ",2'></td>";
							echo "<td><input type='checkbox' name='skill_" . $_skill[id] . "' value='" . $_skill[id] . ",1'></td>";
							break;
						}
						echo "<td><a id='skill", $_skill[id], "' href='#' data-trigger='hover' data-content='", $_skill[description], "' data-placement='left' title='", $_skill[name] , "'>" . $_skill[name] . "</a></td>";
						echo "</tr>";
						?>
						<script type="text/javascript">
							$('#skill<?php echo $_skill[id];?>').popover({ container: 'body', html: true})
						</script>
						<?php
					}
				}
			?>
			</table>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
		</div>
		<div class="col-md-4" align="right">
			<input type="submit" name="submit" class="btn btn-primary" value="n&auml;chster Schritt">
		</div>
	</div>
	</br>
	
</form>