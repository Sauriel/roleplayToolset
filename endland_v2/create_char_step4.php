<form method="POST" action="index.php?&mode=endland_v2&endland=create">

	<?php
		# MySQL Injections vorbeugen
		$_bonus = mysql_real_escape_string($_POST["bonus"]);
		$_SESSION[new_character][profession] = mysql_real_escape_string($_POST["profession"]);
		
		$_query = "SELECT * FROM endland_professions WHERE id=" . $_SESSION[new_character][profession];
		$_result = mysql_query($_query) or die(mysql_error());
		$_profession = mysql_fetch_assoc($_result);
		$_SESSION[new_character][profession_name] = $_profession[name];
		
		if (!empty($_bonus)) {
			$_SESSION[new_character][$_bonus] += 1;
		}
		$_SESSION[new_character][gew] += $_profession[bonus_gew];
		$_SESSION[new_character][rea] += $_profession[bonus_rea];
		$_SESSION[new_character][kun] += $_profession[bonus_kun];
		$_SESSION[new_character][wei] += $_profession[bonus_wei];
		$_SESSION[new_character][gun] += $_profession[bonus_gun];
		
		$_query = "SELECT * FROM endland_races WHERE id=" . $_SESSION[new_character][race];
		$_result = mysql_query($_query) or die(mysql_error());
		$_race = mysql_fetch_assoc($_result);
		
		if (($_SESSION[new_character][age] > $_race[young]) && ($_SESSION[new_character][age] < $_race[teen])) {
			$_SESSION[new_character][age_period] = "jung";
		} elseif (($_SESSION[new_character][age] > $_race[teen]) && ($_SESSION[new_character][age] < $_race[old])) {
			$_SESSION[new_character][age_period] = "jugendlich";
		} elseif ($_SESSION[new_character][age] > $_race[old]) {
			$_SESSION[new_character][age_period] = "alt";
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
		</div>
	</div>
	
	<?php
		$_free_bonus = $_profession[bonus_free];
		
		for ($_i = 0; $_i < $_free_bonus; $_i++) {
	?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Berufungs-Bonus #<?php echo $_i + 1; ?></h3>
		</div>
		<div class="panel-body">
			<div class="row">
  				<div class="col-md-4">
  					<div class="input-group">
						<span class="input-group-addon">
							<input type="radio" name="<?php echo "bonus" . $_i; ?>" value="gew">
						</span>
						<span class="form-control">Gewalt +1</span>
					</div>
  				</div>
  				<div class="col-md-4">
  					<div class="input-group">
						<span class="input-group-addon">
							<input type="radio" name="<?php echo "bonus" . $_i; ?>" value="rea">
						</span>
						<span class="form-control">Reaktion +1</span>
					</div>
  				</div>
  				<div class="col-md-4">
  					<div class="input-group">
						<span class="input-group-addon">
							<input type="radio" name="<?php echo "bonus" . $_i; ?>" value="kun">
						</span>
						<span class="form-control">K&uuml;nste +1</span>
					</div>
  				</div>
			</div>
			</br>
			<div class="row">
  				<div class="col-md-4">
  					<div class="input-group">
						<span class="input-group-addon">
							<input type="radio" name="<?php echo "bonus" . $_i; ?>" value="gew">
						</span>
						<span class="form-control">Weisheit +1</span>
					</div>
  				</div>
  				<div class="col-md-4">
  					<div class="input-group">
						<span class="input-group-addon">
							<input type="radio" name="<?php echo "bonus" . $_i; ?>" value="rea">
						</span>
						<span class="form-control">Gunst +1</span>
					</div>
  				</div>
			</div>
		</div>
	</div>

	<?php
		}
	?>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Gesinnung</h3>
		</div>
		<div class="panel-body">

			<div class="row">		
			<?php
				$_query = "SELECT * FROM endland_ethos";
				$_result = mysql_query($_query) or die(mysql_error());
				
				$_number_of_ethen = 0;
				while ($_ethos = mysql_fetch_assoc($_result)) {
					echo "<div class='col-md-4'>";
					echo "<div class='input-group'>";
					echo "<span class='input-group-addon'>";
					echo "<input type='radio' name='ethos' value='" . $_ethos[id] . "'></span>";
					
					echo "<span class='form-control'><a id='ethoslink", $_ethos[id], "' href='#' data-trigger='hover' data-content='", $_ethos[description], "' data-placement='right' title='", $_ethos[name] , "'>" . $_ethos[name] . "</a></span>";
					
					?>
					
					<script type="text/javascript">
						$('#ethoslink<?php echo $_ethos[id];?>').popover({ container: 'body', html: true})
					</script>
					
					<?php
					echo "</div>";
					echo "</div>";
					$_number_of_ethen++;
					if ($_number_of_ethen % 3 == 0) {
						echo "</div></br>";
						echo "<div class='row'>";
					}					
				}
			?>
			</div>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Temperament, Stimmung, Wille und Triebe</h3>
		</div>
		<div class="panel-body">

			<ul id="tabscreate" class="nav nav-tabs">
				<li><a href="#roll" data-toggle="tab">ausw&uuml;rfeln</a></li>
				<li><a href="#free" data-toggle="tab">frei w&auml;hlen</a></li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane fade active in" id="roll">
					</br>
					<table class="table table-hover">
						
						<?php
							$_query = "SELECT * FROM endland_mentals";
							$_result = mysql_query($_query) or die(mysql_error());
							while ($_mental = mysql_fetch_assoc($_result)) {
								echo "<tr>";
								echo "<td id='" . $_mental[shortcode] . "' data-trigger='hover' data-content='" . $_mental[description] . "' data-placement='top' title='" . $_mental[name] . "'>" . $_mental[name] . "</td>";
								$_rolled_dice = rand(1, 9);
								echo "<td><input type='hidden' name='r_" . $_mental[shortcode] . "' value='" . $_rolled_dice . "'>" . $_rolled_dice . "</td>";
								echo "</tr>";
						?>
								
						<script type="text/javascript">
							$('#<?php echo $_mental[shortcode]; ?>').popover({ container: 'body', html: true})
						</script>
						
						<?php
							}
						?>
					</table>
				</div>

				<div class="tab-pane fade" id="free">
					</br>
					<div class="alert alert-success">
						<p>Du hast 45 Punkte zur freien Verteilung. Mindestens 1, maximal 9 Punkte.</p>
					</div>
					<table class="table table-hover">
						
						<?php
							$_query = "SELECT * FROM endland_mentals";
							$_result = mysql_query($_query) or die(mysql_error());
							while ($_mental = mysql_fetch_assoc($_result)) {
								echo "<tr>";
								echo "<td id='x" . $_mental[shortcode] . "' data-trigger='hover' data-content='" . $_mental[description] . "' data-placement='top' title='" . $_mental[name] . "'>" . $_mental[name] . "</td>";
								echo "<td><div class='col-lg-3'><input type='text' class='form-control input-sm' name='" . $_mental[shortcode] . "'></div></td>";
								echo "</tr>";
						?>
								
						<script type="text/javascript">
							$('#x<?php echo $_mental[shortcode]; ?>').popover({ container: 'body', html: true})
						</script>
						
						<?php
							}
						?>
					</table>
			
				</div>
		
			</div>

			<script type="text/javascript">
    			jQuery(document).ready(function ($) {
        			$('#tabscreate').tab();
    			});
			</script>

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