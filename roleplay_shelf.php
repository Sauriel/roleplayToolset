<div id="wallpaper"></div>

<div id="content">
	<div id="shelf">
		<?php
			$_query = "SELECT * FROM rulesets ORDER BY name ASC";
			$_result = mysql_query($_query) or die(mysql_error());
			while($_book = mysql_fetch_assoc($_result)) {
		?>
		<span class="book">
			<?php
				echo "<a id='booklink", $_book[id], "' href='" . $_book[link] . "' data-trigger='hover' data-content='" . $_book[description] . "' data-placement='bottom' title='" . $_book[name] . "'><img src='images/books/" . $_book[cover] . "'></a>";
			?>
		</span>
 	
		<script type="text/javascript">
			$('#booklink<?php echo $_book[id];?>').popover({ container: 'body', html: true})
		</script>
			
		<?php
			}
		?>
	</div>
 
	<div id="shelf_stand">
		&nbsp;
	</div>
</div>