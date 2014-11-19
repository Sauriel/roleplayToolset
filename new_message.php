<?php if ($_SESSION["login"] == 1) { ?>
<script>
	tinymce.init({
		language_url : 'js/tinymce/langs/de.js',
   		menubar: false,
		selector:'textarea'
	});
</script>

<form method="POST" action="index.php?&mode=messages&action=success">

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Neue Nachricht</h3>
	</div>
	<div class="panel-body">
		<div class="row">
 			<div class="col-md-6">
 				<div class="input-group">
					<span class="input-group-addon">an</span>
					<span class="form-control">
					<?php
						$_query = "SELECT * FROM users ORDER BY username ASC";
						$_result = mysql_query($_query) or die(mysql_error());
						$_dropdown = '<select class="form-control" name="receiver">';
						while($_row = mysql_fetch_assoc($_result)) {
							if ($_row[id] != $_SESSION["user"]["id"]) {
								$_dropdown .= "\r\n<option value='{$_row['id']}'>{$_row['username']}</option>";
							}
						}
						$_dropdown .= "\r\n</select>";
						echo $_dropdown;
						?>
					</span>
				</div>
 			</div>
		</div>
		</br>
		<div class="row">
 			<div class="col-md-12">
 				<div class="input-group">
					<span class="input-group-addon">Betreff</span>
					<input type="text" class="form-control" name="subject" placeholder="Betreff">
				</div>
			</div>
		</div>
		</br>
		<div class="row">
 			<div class="col-md-12">
				<textarea name="message"></textarea>
			</div>
		</div>
		</br>
		<div class=row>
			<div class="col-md-12">
				<input type='submit' name='submit' class="btn btn-primary pull-right" value='abschicken'>
			</div>
		</div>
	</div>
</div>

</form>

<?php } ?>