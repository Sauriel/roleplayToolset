<form method="POST" action="index.php?&mode=endland_v2&endland=create">
	<input type='hidden' name='step' value='1'>

	<?php
		unset($_SESSION[new_character]);
	
		$_races = array();
		$_query = "SELECT * FROM endland_races";
		$_result = mysql_query($_query) or die(mysql_error());
		while($_race = mysql_fetch_assoc($_result)) {
			array_push($_races, $_race); 
		}
	?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Rasse</h3>
		</div>
		<div class="panel-body">
		
			<div class="row">		
			<?php
				$_number_of_races = 0;
				foreach ($_races as $_race) {
					echo "<div class='col-md-4'>";
					echo "<div class='input-group'>";
					echo "<span class='input-group-addon'>";
					echo "<input type='radio' name='race' value='" . $_race[id] . "'></span>";
					
					echo "<span class='form-control'><a id='racelink", $_race[id], "' href='#' data-trigger='hover' data-content='", $_race[description], "' data-placement='right' title='", $_race[name] , "'>" . $_race[name] . "</a></span>";
					
					?>
					
					<script type="text/javascript">
						$('#racelink<?php echo $_race[id];?>').popover({ container: 'body', html: true})
					</script>
					
					<?php
					echo "</div>";
					echo "</div>";
					$_number_of_races++;
					if ($_number_of_races % 3 == 0) {
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