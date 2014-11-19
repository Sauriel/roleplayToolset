<?php
	# mit Datenbank verbinden
	include("config/conect_db.php");
	SESSION_START();
	
	$_mode = $_GET["mode"];
	
	if ($_GET["logout"] == true) {
		session_destroy();
		header("location:" . substr($_SERVER['REQUEST_URI'], 0, count($_SERVER['REQUEST_URI']) - 13));
		exit();
	}
	
	if (strpos($_SERVER['REQUEST_URI'],'index.php') !== false) {
		$_url = $_SERVER['REQUEST_URI'];
	} else {
		$_url = $_SERVER['REQUEST_URI'] . "index.php";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
 
		<title>The Roleplay Toolset</title>
		
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="../../assets/js/html5shiv.js"></script>
			<script src="../../assets/js/respond.min.js"></script>
		<![endif]-->
 
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
			<script src="//code.jquery.com/jquery.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
			<script src="js/bootstrap.min.js"></script>
			
			<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
			
		<link href="css/style.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<?php
			
			if ($_mode == "endland_v2") {
				if ($_SESSION[current][name] != "Endland v2") {
					$_SESSION[current][url] = "index.php?&mode=endland_v2";
					$_SESSION[current][name] = "Endland v2";
				}
				include("endland_v2/endland.php");
			} elseif ($_mode == "characters") {
				if ($_SESSION[current][name] != "Charaktere") {
					$_SESSION[current][url] = "index.php?&mode=characters";
					$_SESSION[current][name] = "Charaktere";
				}
				include("characters.php");
			} elseif ($_mode == "change_character") {
				if ($_SESSION[current][name] != "Charaktere") {
					$_SESSION[current][url] = "index.php?&mode=characters";
					$_SESSION[current][name] = "Charaktere";
				}
				include("change_character.php");
			} elseif ($_mode == "messages") {
				if ($_SESSION[current][name] != "Nachrichten") {
					$_SESSION[current][url] = "index.php?&mode=messages";
					$_SESSION[current][name] = "Nachrichten";
				}
				include("messages.php");
			}  else {
				unset($_SESSION[current]);
				include("roleplay_shelf.php");
			}
		
			if (!empty($_POST["submit"]) && $_SESSION["login"] == 0) {
				# MySQL Injections vorbeugen
				$_username = mysql_real_escape_string($_POST["username"]);
				$_password = mysql_real_escape_string($_POST["password"]);

				# Befehl für die MySQL Datenbank
				$_query = "SELECT * FROM users WHERE
							username='$_username' AND
							password=md5('$_password') AND
 							active=1
	 					LIMIT 1";

		 		$_result = mysql_query($_query) or die(mysql_error());
				$_anzahl = @mysql_num_rows($_result);

				# Ueberpruefen ob ein passender User in der Datenbank gefunden wurde
				if ($_anzahl > 0) {
	
			 		# In der Session merken, dass der User eingeloggt ist
			 		$_SESSION["login"] = 1;
	
			 		# Datenbank Eintrag wird in der Session gespeichert
			 		$_SESSION["user"] = mysql_fetch_array($_result);

			 		# Last login wird gesetzt
			 		$_query = "UPDATE users SET last_login=NOW()
								WHERE id=".$_SESSION["user"]["id"];
			 		mysql_query($_query);
 	 		
 				} else {
 	 				// echo "Die Logindaten sind nicht korrekt.<br>";
 			 	}
 			 }
		?>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">The Roleplay Toolset</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<?php
					if (!empty($_SESSION[current][name])) {
						echo "<ul class='nav navbar-nav'>";
						echo "<li><p class='navbar-text'>&frasl;&nbsp;</p></li>";
						echo "<li><a href='" . $_SESSION[current][url] . "'>" . $_SESSION[current][name] . "</a></li>";
						echo "</ul>";
					}
				?>
				
				<ul class="nav navbar-nav navbar-right">
					<?php
						if ($_SESSION["login"] == 1) {
								
						$_query = "SELECT * FROM messages WHERE receiver='" . $_SESSION["user"]["id"] . "' AND new=1";
						$_result = mysql_query($_query) or die(mysql_error());
						$_number_of_new_messages = @mysql_num_rows($_result);
					?>
					<li><p class="navbar-text">Angemeldet als: <?php echo $_SESSION["user"]["username"]; ?></p></li>
					<li class="dropdown">
						<?php
						if ($_number_of_new_messages != 0) {
							echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown'>Men&uuml;&nbsp;&nbsp;<span class='label label-success'>" . $_number_of_new_messages . "</span> <b class='caret'></b></a>";
						} else {
							echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown'>Men&uuml; <b class='caret'></b></a>";
						}
						?>
						<ul class="dropdown-menu">
							<?php
								echo "<li><a href='#'>Profil</a></li>";
								
								if ($_number_of_new_messages != 0) {
									echo "<li><a href='index.php?&mode=messages'>Nachrichten<span class='label label-success pull-right'>" . $_number_of_new_messages . "</span></a></li>";
								} else {
									echo "<li><a href='index.php?&mode=messages'>Nachrichten</a></li>";
								}
								
								$_query = "SELECT * FROM endland_characters WHERE user=" . $_SESSION["user"]["id"];
								$_result = mysql_query($_query) or die(mysql_error());
								$_number_of_characters = @mysql_num_rows($_result);
								
								if ($_number_of_characters != 0) {
									echo "<li><a href='index.php?&mode=characters'>Charaktere<span class='label label-default pull-right'>" . $_number_of_characters . "</span></a></li>";
								} else {
									echo "<li class='disabled'><a href='#'>Charaktere</a></li>";
								}
								
								if ($_SESSION["user"]["admin"] == 1) {
									echo "<li class='divider'></li>";
									echo "<li><a href='#'>Admin Dashboard</a></li>";
									
									$_query = "SELECT * FROM users WHERE active=0";
									$_result = mysql_query($_query) or die(mysql_error());
									$_number_of_new_users = @mysql_num_rows($_result);
									
									if ($_number_of_new_users > 0) {
										echo "<li><a href='#'>Neue User<span class='badge  pull-right'>" . $_number_of_new_users . "</span></a></li>";
									}
								}
							?>
    						<li class="divider"></li>
							<li><a href="<?php echo $_url; ?>&logout=true">abmelden</a></li>
						</ul>
					</li>
					<?php
						} else {
					?>
					<form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>" class="navbar-form navbar-left .form-inline" role="login">
						<div class="form-group">
							<label class="sr-only" for="username">Username</label>
							<input type="text" name="username" class="form-control" id="username" placeholder="username">
						</div>
						<div class="form-group">
							<label class="sr-only" for="password">Passwort</label>
							<input type="password" name="password" class="form-control" id="password" placeholder="Passwort">
						</div>
						<input type="submit" name="submit" class="btn btn-default" value="login">
					</form>
					<li><a href="<?php echo $_url; ?>&register=true">Registrieren</a></li>
					<?php
						}
					?>
				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>
		
		<?php
			if ($_GET["register"] == true) {
				if (empty($_POST["submit"]) && $_SESSION["login"] == 0) {
		?>
		
		<div id="overlaybg">
			&nbsp;
		</div>
		
		<div id="overlay">
			<form method="POST" action="<?php echo substr($_SERVER['REQUEST_URI'], 0, count($_SERVER['REQUEST_URI']) - 15); ?>&register=true">
				<div class="panel panel-primary">
					<div class="panel-heading">Bei "The Roleplay Toolset" registrieren</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-addon">Username</span>
									<input type="text" name="username" class="form-control" placeholder="Username">
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-addon">eMail</span>
									<input type="email" name="email" class="form-control" placeholder="eMail">
								</div>
							</div>
						</div>
						</br>
						<div class="row">
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-addon">Passwort</span>
									<input type="passwort" name="password" class="form-control" placeholder="Passwort">
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-addon">Passwort wiederholen</span>
									<input type="passwort2" name="password2" class="form-control" placeholder="Passwort wiederholen">
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-8">
					</div>
					<div class="col-md-4" align="right">
						<input type="submit" name="submit" class="btn btn-primary" value="registrieren">
					</div>
				</div>
			</form>
			</br>
		</div>
		
		<?php
				} elseif (!empty($_POST["submit"]) && $_SESSION["login"] == 0) {
					$_username = mysql_real_escape_string($_POST["username"]);
					$_password = mysql_real_escape_string($_POST["password"]);
					$_password2 = mysql_real_escape_string($_POST["password2"]);
					$_email = mysql_real_escape_string($_POST["email"]);
					
					$_checkifuserexists = mysql_query("SELECT * FROM users WHERE
						username='$_username'
			 		LIMIT 1");

			 		$_anzahl = @mysql_num_rows($_checkifuserexists);
			 		
					if (empty($_username) || empty($_password) || empty($_password2) || empty($_email)) {
						$_var = "<div class='alert alert-danger'>Es wurden nicht alle Daten eingegeben!</div>";
						$_var2 = "<a class='btn btn-primary' href='" . $_SERVER['REQUEST_URI'] . "'>zur&uumlck</a>";		
					} elseif (!empty($_password) && ($_password != $_password2))	{
						$_var = "<div class='alert alert-danger'>Die Passw&ouml;rter stimmen nicht &uuml;berein!</div>";
						$_var2 = "<a class='btn btn-primary' href='" . $_SERVER['REQUEST_URI'] . "'>zur&uumlck</a>";		
					} elseif ($_anzahl > 0) {
						$_var = "<div class='alert alert-danger'>Der User existiert bereits!</div>";
						$_var2 = "<a class='btn btn-primary' href='" . $_SERVER['REQUEST_URI'] . "'>zur&uumlck</a>";		
					} else {
						# Befehl für die MySQL Datenbank
						mysql_query("INSERT INTO `users` (`id`, `username`, `password`, `email`, `active`, `last_login`, `admin`, `deleted`)
										VALUES (NULL, '$_username', md5('$_password'), '$_email', '0', '', '0', '0')");
						$_var = "<div class='alert alert-success'>Du hast dich erfolgreich beim Roleplay Toolset angemeldet. Ein Administrator wird sich die Daten angucken und dich dann freischalten. Du erh&auml;lst dann eine eMail.</div>";
						$_var2 = "<a class='btn btn-primary' href='" . substr($_SERVER['REQUEST_URI'], 0, count($_SERVER['REQUEST_URI']) - 15) . "'>Ok</a>";		
					}
		?>
		
		<div id="overlaybg">
			&nbsp;
		</div>
		
		<div id="overlay">
			<div class="panel panel-primary">
				<div class="panel-heading">Registrieren erfolgreich</div>
				<div class="panel-body">
					<?php echo $_var; ?>
				</div>
			</div>

			<div class="row">
				<div class="col-md-8">
				</div>
				<div class="col-md-4" align="right">
					<?php echo $_var2; ?>
				</div>
			</div>
		</br>
		</div>
		
		<?php
				}
			}
		?>
		
	</body>
</html>