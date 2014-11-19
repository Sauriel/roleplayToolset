<?php
	if ($_SESSION["login"] == 1) {
		$_character_id = $_POST[character];
		
		$_query = "SELECT * FROM endland_characters WHERE id=" . $_character_id;
		$_result = mysql_query($_query) or die(mysql_error());
		$_char = mysql_fetch_assoc($_result);
	
		$_query = "SELECT name FROM endland_professions WHERE id=" . $_char[profession];
		$_result = mysql_query($_query) or die(mysql_error());
		$_var = mysql_fetch_assoc($_result);
		$_char[profession] = $_var[name];
			
		$_query = "SELECT name FROM endland_races WHERE id=" . $_char[race];
		$_result = mysql_query($_query) or die(mysql_error());
		$_var = mysql_fetch_assoc($_result);
		$_char[race] = $_var[name];
			
		$_query = "SELECT name FROM endland_ethos WHERE id=" . $_char[ethos];
		$_result = mysql_query($_query) or die(mysql_error());
		$_var = mysql_fetch_assoc($_result);
		$_char[ethos] = $_var[name];
			
		$_query = "SELECT name FROM endland_skills WHERE id=" . $_char[talent1];
		$_result = mysql_query($_query) or die(mysql_error());
		$_var = mysql_fetch_assoc($_result);
		$_char[talent1] = $_var[name];
			
		$_query = "SELECT name FROM endland_skills WHERE id=" . $_char[talent2];
		$_result = mysql_query($_query) or die(mysql_error());
		$_var = mysql_fetch_assoc($_result);
		$_char[talent2] = $_var[name];
			
		$_query = "SELECT name FROM endland_skills WHERE id=" . $_char[talent3];
		$_result = mysql_query($_query) or die(mysql_error());
		$_var = mysql_fetch_assoc($_result);
		$_char[talent3] = $_var[name];
			
		$_skills = explode(",", $_char[skills]);
		$_skills_temp = array();
		foreach ($_skills as $_skill) {
    		$_query = "SELECT name FROM endland_skills WHERE id=" . $_skill;
			$_result = mysql_query($_query) or die(mysql_error());
			$_var = mysql_fetch_assoc($_result);
			array_push($_skills_temp, $_var[name]);
		}
		$_char[skills] = $_skills_temp;
			
		$_char[skills_value] = explode(",", $_char[skills_value]);
		
		print_r($_char);
?>

<div>
	<form>
		<div class="row">
			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon">###</span>
					<input type="text" class="form-control" placeholder="###">
				</div>
			</div>
			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon">###</span>
					<input type="text" class="form-control" placeholder="###">
				</div>
			</div>
			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon">###</span>
					<input type="text" class="form-control" placeholder="###">
				</div>
			</div>
		</div>
		</br>
		<div class="row">
			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon">###</span>
					<input type="text" class="form-control" placeholder="###">
				</div>
			</div>
			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon">###</span>
					<input type="text" class="form-control" placeholder="###">
				</div>
			</div>
			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon">###</span>
					<input type="text" class="form-control" placeholder="###">
				</div>
			</div>
		</div>
	</form>
</div>

<?php } ?>