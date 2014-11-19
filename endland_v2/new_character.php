<div id="tab_div">
	<ul id="tabs" class="nav nav-tabs">
		<li><a href="#charactersheet" data-toggle="tab">Seite 1</a></li>
		<li><a href="#charactersheet2" data-toggle="tab">Seite 2</a></li>
	</ul>
</div>

<div id="pencil">
	&nbsp;
</div>

<div id="dice">
	&nbsp;
</div>

<div class="tab-content">
<div class="tab-pane fade active in" id="charactersheet">
	
	<?php
			if ($_GET["new"] == "true") {
				$_query = "INSERT INTO endland_characters 
							(`id`, `user`, `name`, `race`, `profession`, `ethos`, `talent1`, `talent2`, `talent3`, `figure`, `look`, `sex`, `age`, `size`, `gew`, `rea`, `kun`, `wei`, `gun`, `psr`, `phr`, `ini`, `elem_fire`, `elem_air`, `elem_water`, `elem_earth`, `condition`, `skills`, `skills_value`, `temprament`, `mood`, `will`, `curiosity`, `vanity`, `greediness`, `powerneed`, `vengefulness`, `sexdrive`, `loveneed`, `exp`, `exp_total`, `vp`, `vp_total`, `vr`, `mutation`, `food`, `water`, `equipment`, `notes`)
							VALUES
							(NULL, " . $_SESSION[user][id] . ", '" . $_SESSION[new_character][name] . "', " . $_SESSION[new_character][race] . ", " . $_SESSION[new_character][profession] . ", " . $_SESSION[new_character][ethos] . ", " . $_SESSION[new_character][talent1] . ", " . $_SESSION[new_character][talent2] . ", " . $_SESSION[new_character][talent3] . ", '" . $_SESSION[new_character][figure] . "', '" . $_SESSION[new_character][look] . "', '" . $_SESSION[new_character][sex] . "', " . $_SESSION[new_character][age] . ", " . $_SESSION[new_character][size] . ", " . $_SESSION[new_character][gew] . ", " . $_SESSION[new_character][rea] . ", " . $_SESSION[new_character][kun] . ", " . $_SESSION[new_character][wei] . ", " . $_SESSION[new_character][gun] . ", " . $_SESSION[new_character][psr] . ", " . $_SESSION[new_character][phr] . ", " . $_SESSION[new_character][ini] . ", " . $_SESSION[new_character][elem_fire] . ", " . $_SESSION[new_character][elem_air] . ", " . $_SESSION[new_character][elem_water] . ", " . $_SESSION[new_character][elem_earth] . ", " . $_SESSION[new_character][condition] . ", '" . $_SESSION[new_character][skills] . "', '" . $_SESSION[new_character][skills_value] . "', " . $_SESSION[new_character][temprament] . ", " . $_SESSION[new_character][mood] . ", " . $_SESSION[new_character][will] . ", " . $_SESSION[new_character][curiosity] . ", " . $_SESSION[new_character][vanity] . ", " . $_SESSION[new_character][greediness] . ", " . $_SESSION[new_character][powerneed] . ", " . $_SESSION[new_character][vengefulness] . ", " . $_SESSION[new_character][sexdrive] . ", " . $_SESSION[new_character][loveneed] . ", " . $_SESSION[new_character][exp] . ", " . $_SESSION[new_character][exp_total] . ", " . $_SESSION[new_character][vp] . ", " . $_SESSION[new_character][vp_total] . ", " . $_SESSION[new_character][vr] . ", '" . $_SESSION[new_character][mutation] . "', " . $_SESSION[new_character][food] . ", " . $_SESSION[new_character][water] . ", '" . $_SESSION[new_character][equipment] . "', '" . $_SESSION[new_character][notes] . "')";
				mysql_query($_query);
			}
		
			$_query = "SELECT name FROM endland_professions WHERE id=" . $_SESSION[new_character][profession];
			$_result = mysql_query($_query) or die(mysql_error());
			$_var = mysql_fetch_assoc($_result);
			$_char[profession] = $_var[name];
			
			$_query = "SELECT name FROM endland_races WHERE id=" . $_SESSION[new_character][race];
			$_result = mysql_query($_query) or die(mysql_error());
			$_var = mysql_fetch_assoc($_result);
			$_char[race] = $_var[name];
			
			$_query = "SELECT name FROM endland_ethos WHERE id=" . $_SESSION[new_character][ethos];
			$_result = mysql_query($_query) or die(mysql_error());
			$_var = mysql_fetch_assoc($_result);
			$_char[ethos] = $_var[name];
			
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
			
			$_skills = explode(",", $_SESSION[new_character][skills]);
			$_skills_temp = array();
			foreach ($_skills as $_skill) {
    			$_query = "SELECT name FROM endland_skills WHERE id=" . $_skill;
				$_result = mysql_query($_query) or die(mysql_error());
				$_var = mysql_fetch_assoc($_result);
				array_push($_skills_temp, $_var[name]);
			}
			$_char[skills] = $_skills_temp;
			
			$_char[skills_value] = explode(",", $_SESSION[new_character][skills_value]);
			if (!empty($_POST)) {
				$_SESSION[new_character][name] = mysql_real_escape_string($_POST["name"]);
				$_SESSION[new_character][notes] = mysql_real_escape_string($_POST["notes"]);
			}
			$_char[id] = 0;
			$_char[name] = $_SESSION[new_character][name];
			$_char[figure] = $_SESSION[new_character][figure];
			$_char[look] = $_SESSION[new_character][look];
			$_char[sex] = $_SESSION[new_character][sex];
			$_char[age] = $_SESSION[new_character][age];
			$_char[size] = $_SESSION[new_character][size];
			$_char[gew] = $_SESSION[new_character][gew];
			$_char[rea] = $_SESSION[new_character][rea];
			$_char[kun] = $_SESSION[new_character][kun];
			$_char[wei] = $_SESSION[new_character][wei];
			$_char[gun] = $_SESSION[new_character][gun];
			$_SESSION[new_character][psr] = $_SESSION[new_character][gun] + $_SESSION[new_character][wei];
			$_char[psr] = $_SESSION[new_character][psr];
			$_SESSION[new_character][phr] = ($_SESSION[new_character][gew] + $_SESSION[new_character][rea]) * 2;
			$_char[phr] = $_SESSION[new_character][phr];
			$_SESSION[new_character][ini] = 0;
			$_char[ini] = $_SESSION[new_character][ini];
			$_char[elem_fire] = $_SESSION[new_character][elem_fire];
			$_char[elem_air] = $_SESSION[new_character][elem_air];
			$_char[elem_water] = $_SESSION[new_character][elem_water];
			$_char[elem_earth] = $_SESSION[new_character][elem_earth];
			$_SESSION[new_character][condition] = 10;
			$_char[condition] = $_SESSION[new_character][condition];
			$_char[temprament] = $_SESSION[new_character][temprament];
			$_char[mood] = $_SESSION[new_character][mood];
			$_char[will] = $_SESSION[new_character][will];
			$_char[curiosity] = $_SESSION[new_character][curiosity];
			$_char[vanity] = $_SESSION[new_character][vanity];
			$_char[greediness] = $_SESSION[new_character][greediness];
			$_char[powerneed] = $_SESSION[new_character][powerneed];
			$_char[vengefulness] = $_SESSION[new_character][vengefulness];
			$_char[sexdrive] = $_SESSION[new_character][sexdrive];
			$_char[loveneed] = $_SESSION[new_character][loveneed];
			$_SESSION[new_character][exp] = 0;
			$_char[exp] = $_SESSION[new_character][exp];
			$_SESSION[new_character][exp_total] = 0;
			$_char[exp_total] = $_SESSION[new_character][exp_total];
			$_SESSION[new_character][vp] = 0;
			$_char[vp] = $_SESSION[new_character][vp];
			$_SESSION[new_character][vp_total] = 0;
			$_char[vp_total] = $_SESSION[new_character][vp_total];
			if ($_char[race] == "Humanes") {
				$_SESSION[new_character][vr] = $_SESSION[new_character][phr];
			} else {
				$_SESSION[new_character][vr] = $_SESSION[new_character][phr] + 10;
			}
			$_char[vr] = $_SESSION[new_character][vr];
			$_SESSION[new_character][mutation] = "keine";
			$_char[mutation] = $_SESSION[new_character][mutation];
			$_SESSION[new_character][food] = 5;
			$_char[food] = $_SESSION[new_character][food];
			$_SESSION[new_character][water] = 5;
			$_char[water] = $_SESSION[new_character][water];
			$_SESSION[new_character][equipment] = "keins";
			$_char[equipment] = $_SESSION[new_character][equipment];
			$_char[notes] = $_SESSION[new_character][notes];
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

<?php
	if ($_SESSION["login"] == 1 && $_GET["new"] != "true") {
?>

<div id="create_char">
	<a href="index.php?&mode=endland_v2&endland=new_character&new=true" class="btn btn-success btn-lg btn-block">Charakter erstellen</a>
</div>

<?php
	}
?>