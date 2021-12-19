<?php

	session_start();

	if(isset($_POST['email']))
	{
		//udana walidacja tak
		$wszystko_OK=true;
		//sprawdzanie poprawnosci imienia
		$imie=$_POST['imie'];
		$nazwisko=$_POST['nazwisko'];
		//sprawdzenie dlugosci imienia
		if(strlen($imie)<3 || (strlen($imie)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_imie']="Imię musi posiadać od 3 do 20 znaków!";
		}
		//sprawdzanie znakow imienia - moze uzyc wyrazenia regularnego dla polskich znakow?
		if (ctype_alpha($imie)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_imie']="Imię może składać się tylko z liter (bez polskich znaków na razie :( )";
		}
		//sprawdzenie dlugosci nazwiska
		if(strlen($nazwisko)<3 || (strlen($nazwisko)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_nazwisko']="Nazwisko musi posiadać od 3 do 20 znaków!";
		}
		//sprawdzanie znakow nazwiska - moze uzyc wyrazenia regularnego dla polskich znakow?
		if (ctype_alpha($nazwisko)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_nazwisko']="Nazwisko może składać się tylko z liter (bez polskich znaków na razie :( )";
		}
		//sprawdzanie poprawnosci emaila
		$email=$_POST['email'];
		$email_safe= filter_var($email,FILTER_SANITIZE_EMAIL);

		if((filter_var($email_safe,FILTER_VALIDATE_EMAIL)==false) || ($email_safe!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail";
		}

		//sprawdzanie poprawnosci hasła
		$haslo1=$_POST['haslo1'];
		$haslo2=$_POST['haslo2'];
		if((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków";
		}


		if($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Podane hasła nie są identyczne";
		}

		$haslo_hash=password_hash($haslo1, PASSWORD_DEFAULT);
		
		//zaakceptowanie regulaminu
		if (!isset($_POST['regulamin']))
		{
			$wszystko_OK=false;
			$_SESSION['e_regulamin']="Trzeba zaakceptować regulamin";
		}

		//sprawdzanie recaptchy
		$sekret="6LeYORcaAAAAAC-zZRK3Ud2VS_yJNZtcWFo4vTfE";
		$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
		$odpowiedz = json_decode($sprawdz);
		if($odpowiedz->success==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_bot']="Potwierdź, że nie jesteś botem!";
		}

		//zapamietywanie wprowadzonych danych
		$_SESSION['fr_imie']=$imie;
		$_SESSION['fr_nazwisko']=$nazwisko;
		$_SESSION['fr_email']=$email;
		
		if(isset($_POST['regulamin'])) $_SESSION['fr_regulamin']=true;

		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);


		try
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				//czy email juz istnieje?
				$rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE email='$email'");
				if(!$rezultat) throw new Exception($polaczenie->error);

				$ile_takich_maili=$rezultat->num_rows;
				if($ile_takich_maili>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_email']="Istnieje juz konto przypisane do takiego e-mailu";
				}
				//czy imie juz istnieje?
				$rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE user='$imie'");
				if(!$rezultat) throw new Exception($polaczenie->error);

				$ile_takich_imion=$rezultat->num_rows;
				if($ile_takich_imion>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_imie']="Istnieje juz użytkownik o takim imieniu! Podaj inny.";
				}

				if($wszystko_OK==true)
				{
					//dodawanie uzytkownika do bazy
					if($polaczenie->query("INSERT INTO uzytkownicy (user,nazwisko,email,pass) VALUES ('$imie','$nazwisko','$email','$haslo_hash')"))
					{
						$_SESSION['udana_rejestracja']=true;
						header('Location: witamy.php');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
				}
				$polaczenie->close();

			}
		}
		catch(Exception $e)
		{
			echo '<div class="error">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</div>';
			//zakomentowac poniższą linię przed wrzuceniem na hosting
			echo '<br />Informacja developerska:'.$e;
		}
	}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Hello there - zakładasz nowe konto</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	
	<style type="text/css">
		.error
		{
			color: red;

		}
	</style>

</head>
<body>
	<div class="signup-form">
		<form method="post">
			<h2>Zarejestruj się</h2>
			<p class="hint-text">Stwórz swoje konto</p>
			<div class="form-group">
				<div class="row">
					<div class="col">
						<input type="text" class="form-control" value="<?php if(isset($_SESSION['fr_imie'])){echo $_SESSION['fr_imie'];unset($_SESSION['fr_imie']);}?>" placeholder="Imię" name="imie">
					</div>
					<div class="col">
						<input type="text" class="form-control" value="<?php if(isset($_SESSION['fr_nazwisko'])){echo $_SESSION['fr_nazwisko'];unset($_SESSION['fr_nazwisko']);}?>" placeholder="Nazwisko" name="nazwisko">
					</div>
				</div>
			</div>

			<?php
				if(isset($_SESSION['e_imie']))
				{
					echo '<div class="error">'.$_SESSION['e_imie'].'</div>';
					unset($_SESSION['e_imie']);
				}
			?>
			<?php
				if(isset($_SESSION['e_nazwisko']))
				{
					echo '<div class="error">'.$_SESSION['e_nazwisko'].'</div>';
					unset($_SESSION['e_nazwisko']);
				}
			?>

			<div class="form-group">
				<input type="email" class="form-control" value="<?php if(isset($_SESSION['fr_email'])){echo $_SESSION['fr_email'];unset($_SESSION['fr_email']);}?>" placeholder="Email" name="email">
			</div>

			<?php
				if(isset($_SESSION['e_email']))
				{
					echo '<div class="error">'.$_SESSION['e_email'].'</div>';
					unset($_SESSION['e_email']);
				}
			?>

			<div class="form-group">
				<input type="password" class="form-control" name="haslo1" placeholder="Hasło">
			</div>

			<?php
				if(isset($_SESSION['e_haslo']))
				{
					echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
					unset($_SESSION['e_haslo']);
				}
			?>

			<div class="form-group">
				<input type="password" class="form-control" name="haslo2" placeholder="Potwierdź hasło">
			</div>

			<div class="form-group">
				<label class="form-check-label">
					<input type="checkbox" name="regulamin"<?php
					if(isset($_SESSION['fr_regulamin']))
					{
						echo "checked";
						unset($_SESSION['fr_regulamin']);
					}
					?>
					> Akceptuję regulamin
				</label>
			</div>

			<?php
				if(isset($_SESSION['e_regulamin']))
				{
					echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
					unset($_SESSION['e_regulamin']);
				}
			?>
			<div class="form-group">
				<div class="g-recaptcha" data-sitekey="6LeYORcaAAAAAK8V0oXYMYWEkxOmrthNHC0psAVb"></div>
				<?php
					if(isset($_SESSION['e_bot']))
					{
						echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
						unset($_SESSION['e_bot']);
					}
				?>
			</div>
	        <div class="form-group">
	        	<button type="submit" class="btn btn-success btn-lg btn-block">Zarejestruj się teraz</button>
	        </div>
		</form>
		<div class="text-center">Posiadasz konto? <a href="index.php">Zaloguj się</a></div>
	</div>
</body>
</html>