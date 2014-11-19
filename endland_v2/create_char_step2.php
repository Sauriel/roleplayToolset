<form method="POST" action="index.php?&mode=endland_v2&endland=create">

	<?php
		# MySQL Injections vorbeugen
		$_SESSION[new_character][race] = mysql_real_escape_string($_POST["race"]);
		
		$_query = "SELECT * FROM endland_races WHERE id=" . $_SESSION[new_character][race];
		$_result = mysql_query($_query) or die(mysql_error());
		$_race = mysql_fetch_assoc($_result);
		$_SESSION[new_character][race_name] = $_race[name];
		
		if (rand(1, 2) == 1) {
			$_SESSION[new_character][gew] = $_race[gew1];
		} else {
			$_SESSION[new_character][gew] = $_race[gew2];
		}
		if (rand(1, 2) == 1) {
			$_SESSION[new_character][rea] = $_race[rea1];
		} else {
			$_SESSION[new_character][rea] = $_race[rea2];
		}
		if (rand(1, 2) == 1) {
			$_SESSION[new_character][kun] = $_race[kun1];
		} else {
			$_SESSION[new_character][kun] = $_race[kun2];
		}
		if (rand(1, 2) == 1) {
			$_SESSION[new_character][wei] = $_race[wei1];
		} else {
			$_SESSION[new_character][wei] = $_race[wei2];
		}
		if (rand(1, 2) == 1) {
			$_SESSION[new_character][gun] = $_race[gun1];
		} else {
			$_SESSION[new_character][gun] = $_race[gun2];
		}
		$_SESSION[new_character][skills] = $_race[language1];
		$_SESSION[new_character][skills_value] = "5";
		if ($_race[language2] != 0) {
			$_SESSION[new_character][skills] .= "," . $_race[language2];
			$_SESSION[new_character][skills_value] .= ",5";
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
			</div>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Geschlecht &amp; Alter</h3>
		</div>
		<div class="panel-body">
			<div class="row">
			
				<?php if ($_race[id] == 3) { ?>
			
  				<div class="col-md-6">
  					<div class="input-group">
						<span class="input-group-addon">Geschlecht</span>
							<span class='form-control'>geschlechtslos</span>
							<input type="hidden" name="sex" value="geschlechtslos">
					</div>  				
  				</div>
  				
  				<?php } else { ?>
			
  				<div class="col-md-3">
  					<div class="input-group">
						<span class="input-group-addon">
							<input type="radio" name="sex" value="m&auml;nnlich">
						</span>
						<span class="form-control">m&auml;nnlich</span>
					</div>
  				</div>
  				<div class="col-md-3">
  					<div class="input-group">
						<span class="input-group-addon">
							<input type="radio" name="sex" value="weiblich">
						</span>
						<span class="form-control">weiblich</span>
					</div>
  				</div>
  				
  				<?php } ?>
  				
  				<div class="col-md-6">
  					<div class="input-group">
						<span class="input-group-addon">Alter</span>
						<?php
							echo "<input type='text' class='form-control' name='age' placeholder='Lebenserwartung: " . $_race[livespan] . " Jahre'>";
						?>
					</div>  				
  				</div>
			</div>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Statur</h3>
		</div>
		<div class="panel-body">

			<ul id="tabscreate" class="nav nav-tabs">
				<li><a href="#roll" data-toggle="tab">ausw&uuml;rfeln</a></li>
				<li><a href="#free" data-toggle="tab">frei w&auml;hlen</a></li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane fade active in" id="roll">
					</br>
					<?php
						$_rolled_dice = rand(1, 10);
						if (rand(1, 2) == 1) {
							$_rolled_figure = $_race["figure1_w" . $_rolled_dice];
						} else {
							$_rolled_figure = $_race["figure2_w" . $_rolled_dice];
						}
						echo "<input type='hidden' name='figure' value='" . $_rolled_figure . "'>";
						echo "<h4>Du hast eine " . $_rolled_dice . " gew&uuml;rfelt.</h4>";
					?>
				</div>

				<div class="tab-pane fade" id="free">
				
					<?php
						if (rand(1, 2) == 1) {
							$_figures = array();
							array_push($_figures, $_race[figure1_w1]);
							array_push($_figures, $_race[figure1_w2]);
							array_push($_figures, $_race[figure1_w3]);
							array_push($_figures, $_race[figure1_w4]);
							array_push($_figures, $_race[figure1_w5]);
							array_push($_figures, $_race[figure1_w6]);
							array_push($_figures, $_race[figure1_w7]);
							array_push($_figures, $_race[figure1_w8]);
							array_push($_figures, $_race[figure1_w9]);
							array_push($_figures, $_race[figure1_w10]);
							$_figures = array_unique($_figures);
						
							$_figure_bonuses = array();
							$_bonuses = explode(";", $_race[figure1_bonus]);
							foreach ($_bonuses as $_bonus) {
								$_temp = explode("=", $_bonus);
								$_figure_bonuses[$_temp[0]] = $_temp[1];
							}
						} else {
							$_figures = array();
							array_push($_figures, $_race[figure2_w1]);
							array_push($_figures, $_race[figure2_w2]);
							array_push($_figures, $_race[figure2_w3]);
							array_push($_figures, $_race[figure2_w4]);
							array_push($_figures, $_race[figure2_w5]);
							array_push($_figures, $_race[figure2_w6]);
							array_push($_figures, $_race[figure2_w7]);
							array_push($_figures, $_race[figure2_w8]);
							array_push($_figures, $_race[figure2_w9]);
							array_push($_figures, $_race[figure2_w10]);
							$_figures = array_unique($_figures);
						
							$_figure_bonuses = array();
							$_bonuses = explode(";", $_race[figure2_bonus]);
							foreach ($_bonuses as $_bonus) {
								$_temp = explode("=", $_bonus);
								$_figure_bonuses[$_temp[0]] = $_temp[1];
							}
						}
					?>
					
					</br>
					<div class="row">		
			<?php
				$_number_of_figures = 0;
				foreach ($_figures as $_figure) {
					echo "<div class='col-md-4'>";
					echo "<div class='input-group'>";
					echo "<span class='input-group-addon'>";
					echo "<input type='radio' name='figure' value='" . $_figure . "'></span>";
					
					if (!empty($_figure_bonuses[$_figure])) {
					
						$_comp_list = array("gew" => "Gewalt", "rea" => "Reaktion", "kun" => "Künste");
						
						$_tooltip = "Bonus: ";
						
						$_temp = explode(",", $_figure_bonuses[$_figure]);
						
						foreach ($_temp as $_t) {
							$_tooltip .= $_comp_list[$_t] . " oder ";
						}
						
						$_tooltip = substr($_tooltip, 0, strlen($_tooltip) - 6);
						
						$_tooltip .= " +1";
					
						echo "<span class='form-control'><a id='figurelink", $_figure, "' href='#' data-toggle='tooltip' title='", $_tooltip , "'>" . $_figure . "</a></span>";
					} else {
						echo "<span class='form-control'>" . $_figure . "</span>";
					}
					
					?>
					
					<script type="text/javascript">
						$('#figurelink<?php echo $_figure;?>').tooltip('toogle')
					</script>
					
					<?php
					echo "</div>";
					echo "</div>";
					$_number_of_figures++;
					if ($_number_of_figures % 3 == 0) {
						echo "</div></br>";
						echo "<div class='row'>";
					}					
				}
			?>
					</div>
				</div>
		
			</div>

			<script type="text/javascript">
    			jQuery(document).ready(function ($) {
        			$('#tabscreate').tab();
    			});
			</script>

		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Aussehen</h3>
		</div>
		<div class="panel-body">
			<input type="text" class="form-control" name="look" placeholder="Aussehen">
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