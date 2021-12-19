<?php

	session_start();

	if (!isset($_SESSION['udana_rejestracja']))
	{
		header('Location: index.php');
		exit();
	}
	else
	{
		unset($_SESSION['udana_rejestracja']);
	}
	//usuwanie zmiennych pamietajacych wartowsci wpisane do formularza
	if(isset($_SESSION['fr_imie'])) unset($_SESSION['fr_imie']);
	if(isset($_SESSION['fr_nazwisko'])) unset($_SESSION['fr_nazwisko']);
	if(isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
	
	if(isset($_SESSION['fr_regulamin'])) unset($_SESSION['fr_regulamin']);

	//usuwanie bledow rejestracji
	if(isset($_SESSION['e_imie'])) unset($_SESSION['e_imie']);
	if(isset($_SESSION['e_nazwisko'])) unset($_SESSION['e_nazwisko']);
	if(isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
	if(isset($_SESSION['e_haslo'])) unset($_SESSION['e_haslo']);
	if(isset($_SESSION['e_regulamin'])) unset($_SESSION['e_regulamin']);
	if(isset($_SESSION['e_bot'])) unset($_SESSION['e_bot']);

?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Bootstrap Simple Registration Form</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="signup-form">
   	<form action="" method="post">
		<h2>Muchas gracias!</h2>
		<p class="hint-text">Możesz się już zalogować na swoje nowe konto</p>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block"><a href="index.php" style="color: white;">Powrót do logowania</a></button>
        </div>
    </form>
	</div>
	
<?php
	if(isset($_SESSION['blad']))
	{
		echo $_SESSION['blad'];
	}
?>

</body>
</html>