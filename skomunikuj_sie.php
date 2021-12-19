<?php

	session_start();

	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}

	if (isset($_SESSION['dzialanie']) && $_SESSION['dzialanie']==true)
	{
		echo '<script type="text/javascript">alert("Email został wysłany pomyślnie!");</script>';
		unset($_SESSION['dzialanie']);
	}
	if (isset($_SESSION['dzialanie']) && $_SESSION['dzialanie']==false)
	{
		echo '<script type="text/javascript">alert("Błąd w wysłaniu! Spróbuj ponownie później");</script>';
		unset($_SESSION['dzialanie']);
	}



	$kto = $_SESSION['user'];

	require_once "connect.php";
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	if ($polaczenie->connect_error) {
  	die("Polaczenie nieudane: " . $polaczenie->connect_error);
	}
	$sql2 = "SELECT id from uzytkownicy where user = '$kto'";
	$rezultat = $polaczenie->query($sql2);
	if ($rezultat->num_rows > 0) {
  	// output data of each row
		while($wiersz = $rezultat->fetch_assoc()) {
			$kto_id = $wiersz["id"];
		}
	} else {
	  echo "0 results";
	}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
	<title>Hello there</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda+One">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style2.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-xl navbar-light bg-light">
	<a href="#" class="navbar-brand"><i class="fa fa-money"></i>Seaside<b>App</b></a>
	<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
		<span class="navbar-toggler-icon"></span>
	</button>
	<!-- Collection of nav links, forms, and other content for toggling -->
	<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
		<div class="navbar-nav">
			<a href="strona_glowna.php" class="nav-item nav-link">Strona Główna</a>
			<a href="o_mnie.php" class="nav-item nav-link">O mnie</a>
			<!-- <div class="nav-item dropdown">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Services</a>
				<div class="dropdown-menu">
					<a href="#" class="dropdown-item">Web Design</a>
					<a href="#" class="dropdown-item">Web Development</a>
					<a href="#" class="dropdown-item">Graphic Design</a>
					<a href="#" class="dropdown-item">Digital Marketing</a>
				</div>
			</div> -->
			<a href="statystyki.php" class="nav-item nav-link">Statystyki</a>
			<a href="pracownicy.php" class="nav-item nav-link">Pracownicy</a>
			<a href="zarzadzaj_sklepami.php" class="nav-item nav-link">Zarządzaj sklepami</a>
			<a href="skomunikuj_sie.php" class="nav-item nav-link active">Skomunikuj się</a>
		</div>
		<!-- <form class="navbar-form form-inline">
			<div class="input-group search-box">								
				<input type="text" id="search" class="form-control" placeholder="Search by Name">
				<span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
			</div>
		</form> -->
		<div class="navbar-nav ml-auto" >
			<!-- <a href="#" class="nav-item nav-link notifications"><i class="fa fa-bell-o"></i><span class="badge">1</span></a>
			<a href="#" class="nav-item nav-link messages"><i class="fa fa-envelope-o"></i><span class="badge">10</span></a></a> -->
			<div class="nav-item dropdown" style="margin-right: 47px;">
				<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action"><img src="1.png" class="avatar" alt="Avatar"> <?php echo $_SESSION['user'] ?> <b class="caret"></b></a>
				<div class="dropdown-menu">
					<a href="moj_profil.php" class="dropdown-item"><i class="fa fa-user-o"></i> Mój profil</a></a>
					<a href="kalendarz.php" class="dropdown-item"><i class="fa fa-calendar-o"></i> Kalendarz</a></a>
					<a href="ustawienia.php" class="dropdown-item"><i class="fa fa-sliders"></i> Ustawienia</a></a>
					<div class="dropdown-divider"></div>
					<a href="wyloguj.php" class="dropdown-item"><i class="material-icons">&#xE8AC;</i> Wyloguj się</a></a>
				</div>
			</div>
		</div>
	</div>
</nav>
	<div class="pudelko" >
		<div class="powitanie" style="background-color: #5cb85c"> 
		<form method="POST" action="wyslij_email.php">
			<div class="form-row">
				<div class="col">
					<label class="col-form-label-lg">Nazwa</label>
					<input type="text" name="nazwa" class="form-control" placeholder="Nazwa">
				</div>
				<div class="col">
					<label class="col-form-label-lg">Do kogo</label>

					<select type="text" name="dokogo" class="form-control">
						<?php
						$sql4 = "SELECT * FROM pracownicy where idusera = '$kto_id'";
						$rezultat_pracownikow = $polaczenie->query($sql4);
						if ($rezultat_pracownikow->num_rows > 0) {
						// output data of each row
						
						while($wiersz_pracownikow = $rezultat_pracownikow->fetch_assoc()) {
							$email_pracownika = $wiersz_pracownikow["emailpracownika"];
						?>
							<option value="<?php echo $email_pracownika;?>"><?php echo $email_pracownika;?></option>
						<?php
								 }
								}
						?>
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="col">
					<label class="col-form-label-lg">Temat</label>
					<input type="text" name="temat" class="form-control" placeholder="Temat">
				</div>
				<div class="col">
					<label class="col-form-label-lg">Hasło</label>
					<input type="password" name="haslo" class="form-control" placeholder="Twoje hasło">

				</div>
			</div>
			<div class="form-row">
				<div class="col">
					<label class="col-form-label-lg">Wiadomość</label>
					<textarea type="text" name="wiadomosc" class="form-control" rows="3" placeholder="Twoja wiadomość"></textarea>
				</div>
			</div>
			<?php
						$email_usera = $_SESSION['email'];
						
						
						?>
						
			<input type="hidden" name="email_usera" value='<?php echo $email_usera; ?>'>






			<div class="text-center" style="margin-top: 10px;">

			<input type ="submit" class="btn btn-primary btn-lg col-md-4" value="Wyślij">
			</div>
			
			</div>
		</form>
			
		
		
	</div>

</body>
</html>