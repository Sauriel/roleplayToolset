<form method="POST" action="index.php?&mode=endland_v2&endland=new_character">

	<?php
		# MySQL Injections vorbeugen
		$_talents = array();
		foreach ($_POST as $_talent) {
			if ($_talent != "nächster Schritt") {
				$_talents[] = $_talent;
			}
		}
		
		$_SESSION[new_character][talent1] = $_talents[0];
		$_SESSION[new_character][talent2] = $_talents[1];
		$_SESSION[new_character][talent3] = $_talents[2];
	?>
	<script>
		tinymce.init({
			language_url : 'js/tinymce/langs/de.js',
    		menubar : false,
    		toolbar: "undo redo | bold italic | link",
			selector:'textarea'
		});
	</script>
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
  				<div class="col-md-8">
  					<div class="input-group">
						<span class="input-group-addon">Naturtalente</span>
						<?php
							$_query = "SELECT name FROM endland_skills WHERE id=" . $_SESSION[new_character][talent1];
							$_result = mysql_query($_query) or die(mysql_error());
							$_var = mysql_fetch_assoc($_result);
							$_char[talent1] = $_var[name];
			
							$_query = "SELECT name FROM endland_skills WHERE id=" . $_SESSION[new_character][talent2];
							$_result = mysql_query($_query) or die(mysql_error());
							$_var = mysql_fetch_assoc($_result);
							$_char[talent2] = $_var[name];
			
							$_query = "SELECT name FROM endland_skills WHERE id=" . $_SESSION[new_character][talent3];
							$_result = mysql_query($_query) or die(mysql_error());
							$_var = mysql_fetch_assoc($_result);
							$_char[talent3] = $_var[name];
							echo "<span class='form-control'>" . $_char[talent1] . ", " . $_char[talent2] . ", " . $_char[talent3] . "</span>";
						?>
					</div>
  				</div>
			</div>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Name</h3>
		</div>
		<div class="panel-body">
			<div class="input-group">
				<span class="input-group-addon">Name</span>
				<input type="text" class="form-control" name="name" placeholder="Name">
			</div>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Charaktergeschichte</h3>
		</div>
		<div class="panel-body">
			<textarea name="notes"></textarea>
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