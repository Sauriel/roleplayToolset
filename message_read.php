<?php
	if ($_SESSION["login"] == 1) {
	$_id = $_POST[message_id];
	$_query = "SELECT * FROM messages WHERE id=" . $_id;
	$_result = mysql_query($_query) or die(mysql_error());
	$_message = mysql_fetch_assoc($_result);
	
	$_query_s = "SELECT * FROM users WHERE id=" . $_message[sender];
	$_result_s = mysql_query($_query_s) or die(mysql_error());
	$_var = mysql_fetch_assoc($_result_s);
	$_message[sender] = $_var[username];
	
	$_query_read = "UPDATE messages SET new=0 WHERE id=" . $_id;
	mysql_query($_query_read);
?>

<div class="panel panel-info">
	<div class="panel-heading">
		<?php echo "<h3 class='panel-title'>" . $_message[subject] . "</h3>"; ?>
	</div>
	<div class="panel-body">
		<div class="row">
 			<div class="col-md-6">
 				<div class="input-group">
					<span class="input-group-addon">Von</span>
					<?php
						echo "<span class='form-control'>" . $_message[sender] . "</span>";
					?>
				</div>
 			</div>
 			<div class="col-md-6">
 				<div class="input-group">
					<span class="input-group-addon">am</span>
					<?php
						echo "<span class='form-control'>" . $_message[date] . "</span>";
					?>
				</div>
 			</div>
		</div>
		</br>
		<div class="row">
 			<div class="col-md-12">
 				<div class="input-group">
					<span class="input-group-addon">Betreff</span>
					<?php
						echo "<span class='form-control'>" . $_message[subject] . "</span>";
					?>
				</div>
			</div>
		</div>
		</br>
		<div class="row">
 			<div class="col-md-12">
 				<?php
					echo $_message[message];
				?>
			</div>
		</div>
	</div>
</div>

<?php } ?>