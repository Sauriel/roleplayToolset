<?php
	if ($_SESSION["login"] == 1) {
	$_action = $_GET["action"];
	
	$_query = "SELECT * FROM messages WHERE receiver='" . $_SESSION["user"]["id"] . "'";
	$_result = mysql_query($_query) or die(mysql_error());
	
	$_query_2 = "SELECT * FROM messages WHERE sender='" . $_SESSION["user"]["id"] . "'";
	$_result_2 = mysql_query($_query_2) or die(mysql_error());
?>

<div id="content_pane">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Empfangen</h3>
		</div>
		<div class="panel-body">
			<table class="table table-hover">
				<tr>
					<th>Status</th>
					<th>Sender</th>
					<th>Betreff</th>
					<th>Datum</th>
					<th></th>
				</tr>
				<?php
					while ($_messages = mysql_fetch_assoc($_result)) {
						$_query_s = "SELECT * FROM users WHERE id=" . $_messages[sender];
						$_result_s = mysql_query($_query_s) or die(mysql_error());
						$_sender = mysql_fetch_assoc($_result_s);
						$_messages[sender] = $_sender[username];
						echo "<tr>";
						echo "<form method='POST' action='index.php?&mode=messages&action=read'>";
						if ($_messages["new"] == 1) {
							echo "<td><h5><span class='label label-success'>neu</span></h5></td>";
						} else {
							echo "<td></td>";
						}
						echo "<td>" . $_messages[sender] . "</td>";
						echo "<td>" . $_messages[subject] . "</td>";
						echo "<td>" . $_messages[date] . "</td>";
						echo "<td>";
						echo "<input type='hidden' name='message_id' value='" . $_messages[id] . "'>";
						echo "<input type='submit' name='submit' class='btn btn-primary' value='anzeigen'>";
						echo "</td>";
						echo "</form>";
						echo "</tr>";
					}
				?>
			</table>
		</div>
	</div>
	
	<?php
		if ($_action == "read") {
			include("message_read.php");
		}
	?>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Gesendet</h3>
		</div>
		<div class="panel-body">
			<table class="table table-hover">
				<tr>
					<th>Status</th>
					<th>Empf&auml;nger</th>
					<th>Betreff</th>
					<th>Datum</th>
					<th></th>
				</tr>
				<?php
					while ($_messages = mysql_fetch_assoc($_result_2)) {
						$_query_r = "SELECT * FROM users WHERE id=" . $_messages[receiver];
						$_result_r = mysql_query($_query_r) or die(mysql_error());
						$_receiver = mysql_fetch_assoc($_result_r);
						$_messages[receiver] = $_receiver[username];
						echo "<tr>";
						echo "<form method='POST' action='index.php?&mode=messages&action=read'>";
						if ($_messages["new"] == 1) {
							echo "<td><h5><span class='label label-warning'>ungelesen</span></h5></td>";
						} else {
							echo "<td><h5><span class='label label-info'>gelesen</span></h5></td>";
						}
						echo "<td>" . $_messages[receiver] . "</td>";
						echo "<td>" . $_messages[subject] . "</td>";
						echo "<td>" . $_messages[date] . "</td>";
						echo "<td>";
						echo "<input type='hidden' name='message_id' value='" . $_messages[id] . "'>";
						echo "<input type='submit' name='submit' class='btn btn-primary' value='anzeigen'>";
						echo "</td>";
						echo "</form>";
						echo "</tr>";
					}
				?>
			</table>
		</div>
	</div>
	
	<?
		
		if ($_action == "new") {
			include("new_message.php");
		} elseif ($_action == "success") {
			include("success_message.php");
		}
		if ($_action != "new") {
	?>
	
	<div class="panel panel-default">
		<div class="panel-body">
			<a href="index.php?&mode=messages&action=new" class="btn btn-primary pull-right">neue Nachricht schreiben</a>
		</div>
	</div>
	
</div>

<?php } } ?>