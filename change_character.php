<?php
	if ($_SESSION["login"] == 1) {
		$_roleset = $_GET["roleset"];
?>

<div id="content_pane">
	<?php
		if ($_roleset == "endlandv2") {
			include("endland_v2/change_character.php");
		}
	?>
</div>
<?php } ?>