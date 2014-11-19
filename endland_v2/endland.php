<link rel="stylesheet" type="text/css" href="endland_v2/css/endland_style.css">

<?php
	$_endland = $_GET["endland"];
	if ($_endland == "charsheet") {
		include("charsheet.php");
	} elseif ($_endland == "create") {
		include("create_character.php");
	} elseif ($_endland == new_character) {
		include("new_character.php");
	} elseif ($_endland == insertindb) {
		include("database.php");
	} else {
?>

<div id="pencil">
	&nbsp;
</div>

<div id="dice">
	&nbsp;
</div>

<div id="charactersheet">
	<div id="endland_info">
		<img src="endland_v2/images/endland_cover.png" alt="Endland v2" class="img-thumbnail pull-left margin-right">
		<strong>AM ENDE DER WELT...</strong></br>
		<p>_Am Ende der Welt bin ich am Ende meiner Hoffnung.
		Durch schwarzen Dunst blicke ich von den Klippen hinab in ein loderndes Meer.
		Nach einem Leben entbehrungsreicher Wanderung begegnet mir statt meines Friedens nun die bittere Erkenntnis: Es gibt kein Entrinnen.</p>
		<p>Es gab kein Entrinnen.</p>
		<p>Jahrzehnte sind vergangen, die waren wie Kriege.
		Keines zog einfach vorüber. Nicht eines, das nicht zu versuchen schien, das Vorherige an Unheil zu übertreffen.</p>
		<p>Die Hoffnung, die mich trieb, die Angst, der Glaube, der Zorn in mir, die mich so lange am Leben hielten, sind fort. Am Abgrund zum Nichts fühle ich nichts.
		Womöglich hat das Schicksal mich hier in diesen Bergen vergessen. Womöglich ist die Gleichgültigkeit das Beste, was das Schicksal mir bescheren wollte.</p>
		<p>100 Jahre bin ich gerannt durch die Hölle, habe von meinem Körper gezehrt und meinen Verstand geopfert, Schritt für Schritt.
		Am Ende nun bleibt mir nichts außer Erinnerungen, verschwommenen Erinnerungen an die Zeit vor Nadir und danach.</p>
		<p>Du, der du meine Aufzeichnungen in den Händen hältst, sollst sie in die Städte der Erben bringen und ihren Gelehrten übergeben, dass sie die Geschichte des Schreibers nicht vergessen, der sah und erlebte, wie die Welt wurde zu dem, was sie ist.</p>
		<p>Der Schreiber, der seine Stimme verlor und seinen Namen vergaß, weil er der Letzte war von seiner Art...</p>
		</br>
		
		<div class="row">
			<form method="POST" action="index.php?&mode=endland_v2&endland=charsheet">
				<div class="col-md-6">
					<div class="input-group">
						<?php
							$_query = "SELECT * FROM endland_characters";
							$_result = mysql_query($_query) or die(mysql_error());
							$_dropdown = '<select class="form-control" name="character">';
							while($_row = mysql_fetch_assoc($_result)) {
								$_dropdown .= "\r\n<option value='{$_row['id']}'>{$_row['name']}</option>";
							}
							$_dropdown .= "\r\n</select>";
							echo $_dropdown;
						?>
						<span class="input-group-btn">
							<input type="submit" name="submit" class="btn btn-primary" value="ansehen">
						</span>
					</div>
				</div>
			</form>
			<div class="col-md-3">
				<div class="input-group">
					<span class="form-control">oder</span>
					<span class="input-group-btn">
						<a class="btn btn-info" href="index.php?&mode=endland_v2&endland=create">Charakter erstellen</a>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	}
?>