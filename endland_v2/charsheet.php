<?php
	if (!empty($_POST)) {
		$_character_id = $_POST[character];
	} else {
		$_character_id = $_GET[character];
	}
?>

<div id="pencil">
	&nbsp;
</div>

<div id="dice">
	&nbsp;
</div>

<div id="tab_div">
	<ul id="tabs" class="nav nav-tabs">
		<li><a href="#charactersheet" data-toggle="tab">Seite 1</a></li>
		<li><a href="#charactersheet2" data-toggle="tab">Seite 2</a></li>
	</ul>
</div>

<div class="tab-content">
<div class="tab-pane fade active in" id="charactersheet">
	
	<?php
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
	?>
	<div id="sheethead">
		<div id="logo">
		</div>
		
		<div id="general">
			<table class="fullsize">
				<tr class="line">
					<td class="header">Name</td>
					<td colspan="3"><?php echo $_char[name]; ?></td>
				</tr>
				<tr class="line">
					<td class="header">Rasse</td>
					<td width="40%"><?php echo $_char[race]; ?></td>
					<td class="header">Geschlecht&nbsp;&nbsp;</td>
					<td><?php echo $_char[sex]; ?></td>
				</tr>
				<tr class="line">
					<td class="header">Gesinnung</td>
					<td><?php echo $_char[ethos]; ?></td>
					<td class="header">Alter</td>
					<td><?php echo $_char[age]; ?> Jahre</td>
				</tr>
				<tr class="line">
					<td class="header">Berufung</td>
					<td><?php echo $_char[profession]; ?></td>
					<td class="header">Gr&ouml;&szlig;e</td>
					<td><?php echo $_char[size]; ?> mm</td>
				</tr>
				<tr class="line">
					<td class="header">Naturtalente&nbsp;&nbsp;</td>
					<td colspan="3"><?php echo $_char[talent1] . ", " . $_char[talent2] . ", " . $_char[talent3]; ?></td>
				</tr>
				<tr class="line">
					<td class="header">Statur</td>
					<td colspan="3"><?php echo $_char[figure]; ?></td>
				</tr>
				<tr class="line">
					<td class="header">Aussehen</td>
					<td colspan="3"><?php echo $_char[look]; ?></td>
				</tr>
			</table>
		</div>
	</div>
	
	<div id="virtue">
		<div class="wheel">
			<?php echo "<img src='endland_v2/images/virtue_" . $_char[gew] .".png'></br>"; ?>
			<strong>Gewalt</strong>
		</div>
		<div class="wheel">
			<?php echo "<img src='endland_v2/images/virtue_" . $_char[rea] .".png'></br>"; ?>
			<strong>Reaktion</strong>
		</div>
		<div class="wheel">
			<?php echo "<img src='endland_v2/images/virtue_" . $_char[kun] .".png'></br>"; ?>
			<strong>K&uuml;nste</strong>
		</div>
		<div class="wheel">
			<?php echo "<img src='endland_v2/images/virtue_" . $_char[wei] .".png'></br>"; ?>
			<strong>Weisheit</strong>
		</div>
		<div class="wheel">
			<?php echo "<img src='endland_v2/images/virtue_" . $_char[gun] .".png'></br>"; ?>
			<strong>Gunst</strong>
		</div>
		<div id="psrphr">
			<em>Weisheit + Gunst</em>
			<table class="simple">
				<tr>
					<td>&nbsp;<strong>PSR</strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_char[psr]; ?></td>
				</tr>
			</table>
			<em>(Gewalt + Reaktion) x 2</em>
			<table class="simple">
				<tr>
					<td>&nbsp;<strong>PHR</strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_char[phr]; ?></td>
				</tr>
			</table>
		</div>
	</div>
	
	<div id="elemental">
		<div class="inline">
			<em>Reaktion* + Gunst + W10</em>
			<table class="simple">
				<tr>
					<td>&nbsp;<strong>Initiative</strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_char[ini]; ?></td>
				</tr>
			</table>
			<small>*effektiv</small>
		</div>
		<div class="wheelelements">
			<?php echo "<img src='endland_v2/images/skills_" . $_char[elem_fire] .".png'></br>"; ?>
			<img src='endland_v2/images/fire.png'>
		</div>
		<div class="wheelelements">
			<?php echo "<img src='endland_v2/images/skills_" . $_char[elem_air] .".png'></br>"; ?>
			<img src='endland_v2/images/air.png'>
		</div>
		<div class="wheelelements">
			<?php echo "<img src='endland_v2/images/skills_" . $_char[elem_water] .".png'></br>"; ?>
			<img src='endland_v2/images/water.png'>
		</div>
		<div class="wheelelements">
			<?php echo "<img src='endland_v2/images/skills_" . $_char[elem_earth] .".png'></br>"; ?>
			<img src='endland_v2/images/earth.png'>
		</div>
	</div>
	
	<div id="skills">
		<?php
			for ($_i = 0; $_i < count($_char[skills]); $_i++) {
				$_query = "SELECT description FROM endland_skills WHERE name='" . $_char[skills][$_i] . "'";
				$_result = mysql_query($_query) or die(mysql_error());
				$_var = mysql_fetch_assoc($_result);
				echo "<div class='wheelsmall'>";				
					echo $_char[skills][$_i] . "&nbsp;<a id='skilllink", $_i, "' href='#' data-trigger='hover' data-content='", $_var[description], "' data-placement='left' title='", $_char[skills][$_i] , " " , $_char[skills_value][$_i], "'><img src='endland_v2/images/skills_" . $_char[skills_value][$_i] . ".png'></a>";
		?>
			<script type="text/javascript">
				$('#skilllink<?php echo $_i;?>').popover({ container: 'body', html: true})
			</script>
		</div>
		<?php
			}
		?>
	</div>
	
	<div id="condition">
		<strong>Verfassung</strong>&nbsp;&nbsp;
		<table class="conditiontable">
			<tr>
				<td><img src='endland_v2/images/condition_x.png'></td>
				<?php
					for ($_i = 0; $_i < $_char[condition]; $_i++) {
						echo "<td class='space'></td>";
						echo "<td class='empty'>&nbsp;</td>";
					}
					for ($_i = 0; $_i < (19 - $_char[condition]); $_i++) {
						echo "<td class='space'></td>";
						echo "<td class='full'>&nbsp;</td>";
					}
				?>
			</tr>
			<tr>
				<td><em>Max</em></td>
				<td class="space"></td>
				<td><em>+8</em></td>
				<td class="space"></td>
				<td><em>+6</em></td>
				<td class="space"></td>
				<td>&nbsp;</td>
				<td class="space"></td>
				<td><em>+4</em></td>
				<td class="space"></td>
				<td>&nbsp;</td>
				<td class="space"></td>
				<td><em>+2</em></td>
				<td class="space"></td>
				<td>&nbsp;</td>
				<td class="space"></td>
				<td>&nbsp;</td>
				<td class="space"></td>
				<td><em>+1</em></td>
				<td class="space"></td>
				<td>&nbsp;</td>
				<td class="space"></td>
				<td>&nbsp;</td>
				<td class="space"></td>
				<td>&nbsp;</td>
				<td class="space"></td>
				<td>&nbsp;</td>
				<td class="space"></td>
				<td>&nbsp;</td>
				<td class="space"></td>
				<td>&nbsp;</td>
				<td class="space"></td>
				<td>&nbsp;</td>
				<td class="space"></td>
				<td>&nbsp;</td>
				<td class="space"></td>
				<td>&nbsp;</td>
				<td class="space"></td>
				<td>&nbsp;</td>
			</tr>
		</table>
	</div>
	
	<div id="target">
		<div id="target-image">
			<?php echo "<img src='endland_v2/images/" . strtolower($_char[race]) . ".png'>"; ?>
		</div>
		
		<div id="target_condition">
			<table class="condition">
				<tr>
					<td class="right">&nbsp;</td>
					<td class="smallcol noborderright"><em>R</em></td>
					<td class="smallcol noborderright"><em>BE</em></td>
					<td class="bigcol"><em>TYP</em></td>
				</tr>
				<tr>
					<td class="right"><em>Kopf&nbsp;</em></td>
					<td class="smallcol">&nbsp;</td>
					<td class="smallcol">&nbsp;</td>
					<td class="bigcol">&nbsp;</td>
				</tr>
				<tr>
					<td class="right noborderbottom"><em>Herz&nbsp;</em></td>
					<td class="smallcol noborderbottom">&nbsp;</td>
					<td class="smallcol noborderbottom">&nbsp;</td>
					<td class="bigcol noborderbottom">&nbsp;</td>
				</tr>
				<tr>
					<td class="right noborderbottom"><em>Rumpf&nbsp;</em></td>
					<td class="smallcol noborderbottom">&nbsp;</td>
					<td class="smallcol noborderbottom">&nbsp;</td>
					<td class="bigcol noborderbottom">&nbsp;</td>
				</tr>
				<tr>
					<td class="right"><em>Geschlecht&nbsp;</em></td>
					<td class="smallcol">&nbsp;</td>
					<td class="smallcol">&nbsp;</td>
					<td class="bigcol">&nbsp;</td>
				</tr>
				<tr>
					<td class="right"><em>Arm&nbsp;</em></td>
					<td class="smallcol">&nbsp;</td>
					<td class="smallcol">&nbsp;</td>
					<td class="bigcol">&nbsp;</td>
				</tr>
					<tr>
					<td class="right"><em>Waffenarm&nbsp;</em></td>
					<td class="smallcol">&nbsp;</td>
					<td class="smallcol">&nbsp;</td>
					<td class="bigcol">&nbsp;</td>
				</tr>
				<tr>
					<td class="right"><em>Bein Rechts&nbsp;</em></td>
					<td class="smallcol">&nbsp;</td>
					<td class="smallcol">&nbsp;</td>
					<td class="bigcol">&nbsp;</td>
				</tr>
				<tr>
					<td class="right"><em>Bein Links&nbsp;</em></td>
					<td class="smallcol">&nbsp;</td>
					<td class="smallcol">&nbsp;</td>
					<td class="bigcol">&nbsp;</td>
				</tr>
				<tr>
					<td class="right">&nbsp;</td>
					<td class="smallcol noborderbottom">&nbsp;</td>
					<td class="smallcol">&nbsp;</td>
					<td class="bigcol noborderbottom"><em>BE Gesamt</em></td>
				</tr>
			</table>
		</div>
	
		<div id="weapons">
			<table width="100%">
				<tr class="line">
					<td align="left"><strong>Bewaffnung + Munition</strong></td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
			</table>
			<div id="weapons_content">
				<?php echo $_char[weapons]; ?>
			</div>
		</div>
	</div>
</div>

<div class="tab-pane fade" id="charactersheet2">
	<div id="mentals">
		<div id="mentalsdetail">
			<table>
				<tr>
					<td><em>Temperament</em></td>
					<td><table class="mentalstable">
							<tr>
								<?php
									for ($_i = 0; $_i < $_char[temprament]; $_i++) {
										echo "<td class='full'>&nbsp;</td>";
									}
									for ($_i = 0; $_i < (10 - $_char[temprament]); $_i++) {
										echo "<td class='empty'>&nbsp;</td>";
									}
								?>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><em>Stimmung</em></td>
					<td><table class="mentalstable">
							<tr>
								<?php
									for ($_i = 0; $_i < $_char[mood]; $_i++) {
										echo "<td class='full'>&nbsp;</td>";
									}
									for ($_i = 0; $_i < (10 - $_char[mood]); $_i++) {
										echo "<td class='empty'>&nbsp;</td>";
									}
								?>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><em>Wille</em></td>
					<td><table class="mentalstable">
							<tr>
								<?php
									for ($_i = 0; $_i < $_char[will]; $_i++) {
										echo "<td class='full'>&nbsp;</td>";
									}
									for ($_i = 0; $_i < (10 - $_char[will]); $_i++) {
										echo "<td class='empty'>&nbsp;</td>";
									}
								?>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><em>Neugier</em></td>
					<td><table class="mentalstable">
							<tr>
								<?php
									for ($_i = 0; $_i < $_char[curiosity]; $_i++) {
										echo "<td class='full'>&nbsp;</td>";
									}
									for ($_i = 0; $_i < (10 - $_char[curiosity]); $_i++) {
										echo "<td class='empty'>&nbsp;</td>";
									}
								?>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><em>Eitelkeit</em></td>
					<td><table class="mentalstable">
							<tr>
								<?php
									for ($_i = 0; $_i < $_char[vanity]; $_i++) {
										echo "<td class='full'>&nbsp;</td>";
									}
									for ($_i = 0; $_i < (10 - $_char[vanity]); $_i++) {
										echo "<td class='empty'>&nbsp;</td>";
									}
								?>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><em>Habsucht</em></td>
					<td><table class="mentalstable">
							<tr>
								<?php
									for ($_i = 0; $_i < $_char[greediness]; $_i++) {
										echo "<td class='full'>&nbsp;</td>";
									}
									for ($_i = 0; $_i < (10 - $_char[greediness]); $_i++) {
										echo "<td class='empty'>&nbsp;</td>";
									}
								?>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><em>Machtbed&uuml;rfnis</em></td>
					<td><table class="mentalstable">
							<tr>
								<?php
									for ($_i = 0; $_i < $_char[powerneed]; $_i++) {
										echo "<td class='full'>&nbsp;</td>";
									}
									for ($_i = 0; $_i < (10 - $_char[powerneed]); $_i++) {
										echo "<td class='empty'>&nbsp;</td>";
									}
								?>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><em>Rachsucht</em></td>
					<td><table class="mentalstable">
							<tr>
								<?php
									for ($_i = 0; $_i < $_char[vengefulness]; $_i++) {
										echo "<td class='full'>&nbsp;</td>";
									}
									for ($_i = 0; $_i < (10 - $_char[vengefulness]); $_i++) {
										echo "<td class='empty'>&nbsp;</td>";
									}
								?>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><em>Geschlechtstrieb</em>&nbsp;&nbsp;</td>
					<td><table class="mentalstable">
							<tr>
								<?php
									for ($_i = 0; $_i < $_char[sexdrive]; $_i++) {
										echo "<td class='full'>&nbsp;</td>";
									}
									for ($_i = 0; $_i < (10 - $_char[sexdrive]); $_i++) {
										echo "<td class='empty'>&nbsp;</td>";
									}
								?>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><em>Liebesbed&uuml;rfnis</em></td>
					<td><table class="mentalstable">
							<tr>
								<?php
									for ($_i = 0; $_i < $_char[loveneed]; $_i++) {
										echo "<td class='full'>&nbsp;</td>";
									}
									for ($_i = 0; $_i < (10 - $_char[loveneed]); $_i++) {
										echo "<td class='empty'>&nbsp;</td>";
									}
								?>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
		
		<div id="exp">
			<em>EP</em>
			<table class="simple">
				<tr>
					<td>&nbsp;<?php echo $_char[exp]; ?></td>
				</tr>
			</table>
			<em>EP gesamt</em>
			<table class="simple">
				<tr>
					<td>&nbsp;<?php echo $_char[exp_total]; ?></td>
				</tr>
			</table>
		</div>
	</div>
	<div id="mutations">
		<div id="mutationslist">
			<table width="100%">
				<tr class="line">
					<td align="left"><strong>Mutationen</strong></td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
			</table>
			<div id="mutations_content">
				<?php echo $_char[mutation]; ?>
			</div>
		</div>
		
		<div id="vp">
			<em>VP</em>
			<table class="simple">
				<tr>
					<td>&nbsp;<?php echo $_char[vp]; ?></td>
				</tr>
			</table>
			<em>VP gesamt</em>
			<table class="simple">
				<tr>
					<td>&nbsp;<?php echo $_char[vp_total]; ?></td>
				</tr>
			</table>
			<em>VR (PHR / PHR + 10)</em>
			<table class="simple">
				<tr>
					<td>&nbsp;<?php echo $_char[vr]; ?></td>
				</tr>
			</table>
		</div>
		
		<div id="rations">
			<strong>Rationen Nahrung</strong></br>
			<table class="mentalstable">
				<tr>
					<?php
						for ($_i = 0; $_i < $_char[food]; $_i++) {
							echo "<td class='full'>&nbsp;</td>";
						}
						for ($_i = 0; $_i < (10 - $_char[food]); $_i++) {
							echo "<td class='empty'>&nbsp;</td>";
						}
					?>
				</tr>
			</table></br>
			<strong>Rationen Wasser</strong></br>
			<table class="mentalstable">
				<tr>
					<?php
						for ($_i = 0; $_i < $_char[water]; $_i++) {
							echo "<td class='full'>&nbsp;</td>";
						}
						for ($_i = 0; $_i < (10 - $_char[water]); $_i++) {
							echo "<td class='empty'>&nbsp;</td>";
						}
					?>
				</tr>
			</table>
		</div>
	</div>
	<div id="inventar">
		<div id="inventarlist">
			<table width="100%">
				<tr class="line">
					<td align="left"><strong>Ausr&uuml;stung / Besitz</strong></td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
			</table>
			<div id="equipment_content">
				<?php echo $_char[equipment]; ?>
			</div>
		</div>
		<div id="notes">
			<table width="100%">
				<tr class="line">
					<td align="left"><strong>Notizen</strong></td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
				<tr class="line">
					<td>&nbsp;</td>
				</tr>
			</table>
			<div id="notes_content">
				<?php echo $_char[notes]; ?>
			</div>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('#tabs').tab();
    });
</script>  