<?php
	if ($_SESSION["login"] == 1) {
	
	$_receiver = mysql_real_escape_string($_POST["receiver"]);
	$_subject = mysql_real_escape_string($_POST["subject"]);
	$_message = mysql_real_escape_string($_POST["message"]);
	$_sender = $_SESSION[user][id];
	
	mysql_query("INSERT INTO `messages` (`id`, `sender`, `receiver`, `subject`, `message`, `date`, `new`)
					VALUES (NULL, '$_sender', '$_receiver', '$_subject', '$_message', NOW(), '1')");
				
	$_query_r = "SELECT * FROM users WHERE id=" . $_receiver;
	$_result_r = mysql_query($_query_r) or die(mysql_error());
	$_receiver_name = mysql_fetch_assoc($_result_r);
	$_receiver_name = $_receiver_name[username];
?>

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Die Nachricht wurde erfolgreich versendet.</h3>
	</div>
	<div class="panel-body">
		Deine Nachricht wurde erfolgreich an <?php echo $_receiver_name; ?> versendet.
	</div>
</div>

<?php } ?>