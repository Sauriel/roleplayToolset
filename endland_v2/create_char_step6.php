<form method="POST" action="index.php?&mode=endland_v2&endland=create">

	<?php
		$_SESSION[new_character][elem_fire] = 0;
		$_SESSION[new_character][elem_air] = 0;
		$_SESSION[new_character][elem_water] = 0;
		$_SESSION[new_character][elem_earth] = 0;
		
		# MySQL Injections vorbeugen
		$_skill_list = array();
		foreach ($_POST as $_skill) {
			$_temp = explode(",", $_skill);
			if ($_temp[0] == "78") {
				$_SESSION[new_character][elem_fire] = $_temp[1];
				$_skill_list[$_temp[0]] = $_temp[1];
			}else if ($_temp[0] == "79") {
				$_SESSION[new_character][elem_air] = $_temp[1];
				$_skill_list[$_temp[0]] = $_temp[1];
			}else if ($_temp[0] == "80") {
				$_SESSION[new_character][elem_water] = $_temp[1];
				$_skill_list[$_temp[0]] = $_temp[1];
			}else if ($_temp[0] == "81") {
				$_SESSION[new_character][elem_earth] = $_temp[1];
				$_skill_list[$_temp[0]] = $_temp[1];
			}else if ($_temp[0] != "nächster Schritt") {
				$_SESSION[new_character][skills] .= "," . $_temp[0];
				$_SESSION[new_character][skills_value] .= "," . $_temp[1];
				$_skill_list[$_temp[0]] = $_temp[1];
			}
		}
		
		arsort($_skill_list);
		$_short_skill_list = array_slice($_skill_list, 0, 6, true);
		$_talent_list = array_keys($_short_skill_list);
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
			<h3 class="panel-title">Naturtalente</h3>
		</div>
		<div class="panel-body">
			<div class="alert alert-success">
				<p>Dies sind deine Sechs besten Fertigkeiten, bitte w&auml;hle drei von ihnen als Naturtalente aus.</p>
			</div>
			<div class="row">
			<?php
				for ($_i = 0; $_i < 6; $_i++) {
					$_query = "SELECT * FROM endland_skills WHERE id=" . $_talent_list[$_i];
					$_result = mysql_query($_query) or die(mysql_error());
					$_skill = mysql_fetch_assoc($_result);
					
  					echo "<div class='col-md-4'>";
  					echo "<div class='input-group'>";
					echo "<span class='input-group-addon'><input type='checkbox' name='talent_" . $_skill[id] . "' value='" . $_skill[id] . "'></span>";
					echo "<span class='form-control'>" . $_skill[name] . "</span>";
					echo "</div>";
  					echo "</div>";
  					if ($_i == 2) {
						echo "</div>";
						echo "</br>";
  						echo "<div class='row'>";
  					}
				}
			?>
			</div>
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