<form method="POST" action="index.php?&mode=endland_v2&endland=create">

	<?php
		# MySQL Injections vorbeugen
		$_SESSION[new_character][sex] = mysql_real_escape_string($_POST["sex"]);
		$_SESSION[new_character][age] = mysql_real_escape_string($_POST["age"]);
		$_SESSION[new_character][figure] = mysql_real_escape_string($_POST["figure"]);
		$_SESSION[new_character][look] = mysql_real_escape_string($_POST["look"]);
		
		$_query = "SELECT * FROM endland_races WHERE id=" . $_SESSION[new_character][race];
		$_result = mysql_query($_query) or die(mysql_error());
		$_race = mysql_fetch_assoc($_result);
		
		if ($_SESSION[new_character][sex] == "m&auml;nnlich") {
			$_SESSION[new_character][size] = $_race[size_m_base];
			for ($_i = 0; $_i < $_race[size_m_count]; $_i++) {
				$_SESSION[new_character][size] += rand(1, 10);
			}
		} else {
			$_SESSION[new_character][size] = $_race[size_w_base];
			for ($_i = 0; $_i < $_race[size_w_count]; $_i++) {
				$_SESSION[new_character][size] += rand(1, 10);
			}
		}
		
		if (is_numeric($_SESSION[new_character][figure])) {
			$_SESSION[new_character][figure] = $_race["figure_w" . $_SESSION[new_character][figure]];
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
			</div>
		</div>
	</div>
	
	<?php
		$_figure_bonuses = array();
		$_bonuses = explode(";", $_race[figure_bonus]);
		foreach ($_bonuses as $_bonus) {
			$_temp = explode("=", $_bonus);
			$_figure_bonuses[$_temp[0]] = $_temp[1];
		}
		
		if (!empty($_figure_bonuses[$_SESSION[new_character][figure]])) {
						
			$_temp = explode(",", $_figure_bonuses[$_SESSION[new_character][figure]]);
				
			if (count($_temp) == 1) {
				$_SESSION[new_character][$_temp[0]] += 1;
			} else {
	?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Statur-Bonus</h3>
		</div>
		<div class="panel-body">
			<div class="row">
  				<div class="col-md-4">
  					<div class="input-group">
						<span class="input-group-addon">
							<input type="radio" name="bonus" value="gew">
						</span>
						<span class="form-control">Gewalt +1</span>
					</div>
  				</div>
  				<div class="col-md-4">
  					<div class="input-group">
						<span class="input-group-addon">
							<input type="radio" name="bonus" value="rea">
						</span>
						<span class="form-control">Reaktion +1</span>
					</div>
  				</div><div class="col-md-4">
  					<div class="input-group">
						<span class="input-group-addon">
							<input type="radio" name="bonus" value="kun">
						</span>
						<span class="form-control">K&uuml;nste +1</span>
					</div>
  				</div>
			</div>
		</div>
	</div>

	<?php
			}
		}
	?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Berufung</h3>
		</div>
		<div class="panel-body">

			<div class="row">		
			<?php
				$_query = "SELECT * FROM endland_professions";
				$_result = mysql_query($_query) or die(mysql_error());
				
				$_number_of_professions = 0;
				while ($_profession = mysql_fetch_assoc($_result)) {
					echo "<div class='col-md-4'>";
					echo "<div class='input-group'>";
					echo "<span class='input-group-addon'>";
					echo "<input type='radio' name='profession' value='" . $_profession[id] . "'></span>";
					
					echo "<span class='form-control'><a id='professionlink", $_profession[id], "' href='#' data-trigger='hover' data-content='", $_profession[info], "' data-placement='right' title='", $_profession[slogan] , "'>" . $_profession[name] . "</a></span>";
					
					?>
					
					<script type="text/javascript">
						$('#professionlink<?php echo $_profession[id];?>').popover({ container: 'body', html: true})
					</script>
					
					<?php
					echo "</div>";
					echo "</div>";
					$_number_of_professions++;
					if ($_number_of_professions % 3 == 0) {
						echo "</div></br>";
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