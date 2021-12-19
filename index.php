<?php

	session_start();

	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: strona_glowna.php');
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
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="signup-form">
		<form action="zaloguj.php" method="post">
			<h2>Seaside App</h2>
			<p class="hint-text">Zaloguj się</p>
			<div class="form-group">
				<input type="text" class="form-control" name="login" placeholder="Login">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="haslo" placeholder="Hasło">
			</div>
			<?php
			if(isset($_SESSION['blad']))
			{
				echo $_SESSION['blad'];
			}
			?>
			<div class="form-group">
				<button type="submit" class="btn btn-success btn-lg btn-block">Zaloguj się</button>
			</div>

			<div class="text-center">Nie pamiętasz hasła? <a href="nie_pamietam_hasla.php">Zresetuj hasło</a></div>
		</form>

		<div class="text-center">Nie masz konta? <a href="rejestracja.php">Zarejestruj się teraz</a></div>
		
	</div>
</body>
</html>