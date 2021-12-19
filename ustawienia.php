<?php

	session_start();

	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
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
			<a href="skomunikuj_sie.php" class="nav-item nav-link">Skomunikuj się</a>
		</div>
		<!-- <form class="navbar-form form-inline">
			<div class="input-group search-box">								
				<input type="text" id="search" class="form-control" placeholder="Search by Name">
				<span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
			</div>
		</form> -->
		<div class="navbar-nav ml-auto">
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
	<div class="pudelko">
		<div class="powitanie"> <h1>Tutaj będzie możliwa konfiguracja swojego konta</h1>
		</div>
		
	</div>

</body>
</html>