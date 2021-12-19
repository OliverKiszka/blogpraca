<?php

	session_start();
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	$kto = $_SESSION['user'];
	
	$id_edytowanego_pracownika= $_POST['id_pracownika'];
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
	

	$stmt = $polaczenie->prepare( "SELECT * FROM pracownicy WHERE idpracownika=?");
	$stmt->bind_param("i", $id_edytowanego_pracownika);
	$stmt->execute();

	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
    	$imie_pracownika=$row['imiepracownika'];
    	$nazwisko_pracownika=$row['nazwiskopracownika'];
    	$email_pracownika=$row['emailpracownika'];
    	$stanowisko=$row['stanowisko'];
    	$data_zatrudnienia=$row['datazatrudnienia'];

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
		<form action="edytuj.php" method="post">
			<h1>Podaj nowe imię pracownika</h1>
			<p>Twoje aktualne imie:<b> <?php echo $imie_pracownika;?></b></p>
			<div class="form-group">
				<input type="hidden" class="form-control" name="id_edytowanego_pracownika" value="<?php echo $id_edytowanego_pracownika; ?>">
				<input type="text" class="form-control" name="imie_edytowanego_pracownika">
			</div>
			<h1>Podaj nowe nazwisko pracownika</h1>
			<p>Twoje aktualne nazwisko:<b> <?php echo $nazwisko_pracownika;?></b></p>
			<div class="form-group">
				
				<input type="text" class="form-control" name="nazwisko_edytowanego_pracownika">
			</div>
			<h1>Podaj nowy email pracownika</h1>
			<p>Twój aktualny email:<b> <?php echo $email_pracownika;?></b></p>
			<div class="form-group">
				
				<input type="text" class="form-control" name="email_edytowanego_pracownika">
			</div>
			<h1>Podaj nowe stanowisko pracownika</h1>
			<p>Twoje aktualne stanowisko:<b> <?php echo $stanowisko;?></b></p>
			<div class="form-group">
				<select class="form-control" id="stanowisko" name="stanowisko">
				<?php
						$sql4 = "SELECT * FROM sklepy where idusera = '$kto_id'";
						$rezultat_sklepow = $polaczenie->query($sql4);
						if ($rezultat_sklepow->num_rows > 0) {
						// output data of each row
						
						while($wiersz_sklepow = $rezultat_sklepow->fetch_assoc()) {
							$nazwa_sklepu = $wiersz_sklepow["nazwasklepu"];
							
						?>
						<option value="<?php echo $nazwa_sklepu;?>"><?php echo $nazwa_sklepu;?></option>
				<!-- <input type="text" class="form-control" name="nazwa_edytowanego_pracownika"> -->
						<?php
								 }
							} else {
							  echo "
								<p style='font-size:20px;'>Nie masz jeszcze żadnych sklepów !</p>
								";
							}
							
						?>
							
							
						</select>
			</div>
			<h1>Podaj nową datę zatrudnienia</h1>
			<p>Twoja aktualna data zatrudnienia:<b> <?php echo $data_zatrudnienia;?></b></p>
			<div class="form-group">
				
				<input type="date" class="form-control" name="data_edytowanego_pracownika">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success btn-lg btn-block">Zatwierdź zmiane</button>
				<a href="pracownicy.php" class="btn btn-primary btn-lg btn-block" >Anuluj</a>
			</div>

			
		</form>

		
		
	</div>
</body>
</html>