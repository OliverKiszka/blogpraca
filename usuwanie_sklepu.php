<?php

	session_start();
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	
	
	$id_edytowanego_sklepu= $_POST['id_sklepu'];
	
	require_once "connect.php";
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	if ($polaczenie->connect_error) {
  	die("Polaczenie nieudane: " . $polaczenie->connect_error);
	}

	$stmt = $polaczenie->prepare( "SELECT nazwasklepu FROM sklepy WHERE idsklepu=?");
	$stmt->bind_param("i", $id_edytowanego_sklepu);
	$stmt->execute();

	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
    	$nazwa_sklepu=$row['nazwasklepu'];
		
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
		<form action="usun.php" method="post">
			<h1>Jesteś tego pewny?</h1>
			<p>Usuniesz:<b> <?php echo $nazwa_sklepu;?></b></p>
			<div class="form-group">
				<input type="hidden" class="form-control" name="id_edytowanego_sklepu" value="<?php echo $id_edytowanego_sklepu; ?>">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-danger btn-lg btn-block">Usuń sklep</button>
				<a href="zarzadzaj_sklepami.php" class="btn btn-primary btn-lg btn-block" >Anuluj</a>
			</div>

			
		</form>

		
		
	</div>
</body>
</html>