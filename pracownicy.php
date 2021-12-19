<?php

	session_start();

	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
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

	if(isset($_POST['submit'])){
		$wszystko_OK=true;
		$imie_pracownika = $_POST['imie_pracownika'];
		$nazwisko_pracownika = $_POST['nazwisko_pracownika'];
		$stanowisko= $_POST['stanowisko'];
		$data_zatrudnienia= $_POST['data_zatrudnienia'];
		$email_pracownika=$_POST['email_pracownika'];


		if(strlen($imie_pracownika)<3 || (strlen($imie_pracownika)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_imie_pracownika']="Imie pracownika musi posiadać od 3 do 20 znaków!";
		}
		//sprawdzanie znakow imienia - moze uzyc wyrazenia regularnego dla polskich znakow?
		if (ctype_alpha($imie_pracownika)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_imie_pracownika']="Imie pracownika może składać się tylko z liter (bez polskich znaków na razie :( )";
		}
		
		if(strlen($nazwisko_pracownika)<3 || (strlen($nazwisko_pracownika)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_nazwisko_pracownika']="Nazwisko pracownika musi posiadać od 3 do 20 znaków!";
		}
		//sprawdzanie znakow imienia - moze uzyc wyrazenia regularnego dla polskich znakow?
		if (ctype_alpha($nazwisko_pracownika)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_nazwisko_pracownika']="Nazwisko pracownika może składać się tylko z liter (bez polskich znaków na razie :( )";
		}
		$email_safe= filter_var($email_pracownika,FILTER_SANITIZE_EMAIL);

		if((filter_var($email_safe,FILTER_VALIDATE_EMAIL)==false) || ($email_safe!=$email_pracownika))
		{
			$wszystko_OK=false;
			$_SESSION['e_email_pracownika']="Podaj poprawny adres e-mail";
		}
		
		if($wszystko_OK==true){
			$sql = "INSERT INTO pracownicy (imiepracownika,nazwiskopracownika,stanowisko,datazatrudnienia,idusera,emailpracownika) VALUES ('$imie_pracownika','$nazwisko_pracownika','$stanowisko','$data_zatrudnienia', '$kto_id','$email_pracownika')";
			if ($polaczenie->query($sql) === TRUE) {
	  			echo '<script type="text/javascript">alert("Pomyślnie dodano pracownika!");</script>';
			} else {
	  			echo "Error: " . $sql . "<br>" . $polaczenie->error;
			}
		}
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
	<link rel="stylesheet" href="style3.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
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
			<a href="pracownicy.php" class="nav-item nav-link active">Pracownicy</a>
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
<div class="dodajsklep"  id="dodPrac"><p>Dodaj pracownika</p></div>
	


	<!-- <div class="pudelkosklepow">
		<p>Nie masz jeszcze żadnych pracownikow !</p>
	</div> -->

	<div id="mojDodModal" class="modal">

	  <!-- Modal content -->
	  <div class="modal-content">
	    <div class="modal-header">
	    	<p>Dodawanie pracownika</p>
	      <span class="close">&times;</span>
	    </div>
	    <!-- dodawanie pracownika -->
	    <form action="pracownicy.php" method="post">
		    <div class="modal-body">
			
				<div class="form-row">
					<div class="col">
					<p>Imię pracownika</p>
					<input type="text" name="imie_pracownika" class="form-control" placeholder="Proszę wpisz imię pracownika"  required>
					<?php
					if(isset($_SESSION['e_imie_pracownika']))
					{
						echo '<p style="color:red;">'.$_SESSION['e_imie_pracownika'].'</p>';
						unset($_SESSION['e_imie_pracownika']);
					}
					?>
					</div>
					<div class="col">
					<p>Nazwisko pracownika</p>
					<input type="text" name="nazwisko_pracownika" class="form-control" placeholder="Proszę wpisz nazwisko pracownika"  required>
					<?php
					if(isset($_SESSION['e_nazwisko_pracownika']))
					{
						echo '<p style="color:red;">'.$_SESSION['e_nazwisko_pracownika'].'</p>';
						unset($_SESSION['e_nazwisko_pracownika']);
					}
					?>
					</div>
					
					
				</div>
				
				
				<div class="form-row">
					<div class="col">
						<p>Stanowisko</p>
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
					<div class="col">
					<p>Data zatrudnienia</p>
					<input type="date" name="data_zatrudnienia" class="form-control" placeholder="Proszę wybierz datę zatrudnienia pracownika"  required>
					
					</div>
					
				
				</div>
				<div class="form-row">
					<div class="col">
					<p>Email pracownika</p>
					<input type="email" name="email_pracownika" class="form-control" placeholder="Proszę wpisz email pracownika"  required>
					<?php
					if(isset($_SESSION['e_email_pracownika']))
					{
						echo '<p style="color:red;">'.$_SESSION['e_email_pracownika'].'</p>';
						unset($_SESSION['e_email_pracownika']);
					}
					?>
					</div>
				</div>

		    </div>
		   
		    <div class="modal-footer">
		      <input type="submit" name="submit"  value="Dodaj pracownika" class="btn btn-primary" style=""/>
	          <input type="reset" id="reset" value="Anuluj / Resetuj" class="btn btn-danger" style=""/> 
		    </div>
		</form>
	  </div>
	</div>
	<div class="pudelkosklepow" style="width: 1200px;">
		
	
	
		<table id="table_id" class="display">
			<thead>
				<tr>
					<th>Imię pracownika</th>
					<th>Nazwisko pracownika</th>
					<th>E-mail pracownika</th>
					<th>Stanowisko</th>
					<th>Data zatrudnienia</th>
					<th>Akcja</th>
				</tr>
			</thead>
			<tbody>
				<!-- Wyswietlanie pracownikow -->
				<?php
					$sql3 = "SELECT * FROM pracownicy where idusera = '$kto_id'";
					$rezultat_pracownikow = $polaczenie->query($sql3);
					if ($rezultat_pracownikow->num_rows > 0) {
					// output data of each row
					//modal target itp
					while($wiersz_pracownikow = $rezultat_pracownikow->fetch_assoc()) {
					$id_pracownika = $wiersz_pracownikow["idpracownika"];
					$imie_pracownika = $wiersz_pracownikow["imiepracownika"];
					$nazwisko_pracownika = $wiersz_pracownikow["nazwiskopracownika"];
					$stanowisko = $wiersz_pracownikow["stanowisko"];
					$data_zatrudnienia = $wiersz_pracownikow["datazatrudnienia"];
					$email_pracownika = $wiersz_pracownikow["emailpracownika"];
				?>
					  
				<tr>
					<td><?php echo $imie_pracownika;?></td>
					<td><?php echo $nazwisko_pracownika;?></td>
					<td><?php echo $email_pracownika;?></td>	
					<td><?php echo $stanowisko;?></td>
					<td><?php echo $data_zatrudnienia;?></td>
					<td>
						<form action="edycja_pracownika.php" method="post">
					<input type="hidden" name="id_pracownika" value="<?php echo $id_pracownika; ?>">
					<button class='btn btn-info btn-xs'>Edytuj</button>
				</form>
					<form action="usuwanie_pracownika.php" method="post">
					<input type="hidden" name="id_pracownika" value="<?php echo $id_pracownika; ?>">
					<button class='btn btn-danger btn-xs'>Usuń</button>
					</form>
					</td>
				</tr>
				<?php
					  }
				} else {
				  echo "
					<p style='font-size:20px;'>Nie masz jeszcze żadnych pracownikow !</p>
					";
				}
				$polaczenie->close();
				?>
			</tbody>
			
		</table>
	
	
	
	
	
	</div>



<script>
$(document).ready( function () {
    $('#table_id').DataTable({
		"language":{
			"lengthMenu":"Wyświetl _MENU_ pracowników na stronę",
			"emptyTable": "Nie masz nic w tabeli",
			"info": "Tabela pokazuje _START_ do _END_ z _TOTAL_ wpisów",
			"search": "Wyszukaj:",
			"paginate": {
			"next": "Następna",
			"previous": "Poprzednia"
			},
		}
	});
} );

// Get the modal
	var modal = document.getElementById("mojDodModal");

	// Get the button that opens the modal
	var btn = document.getElementById("dodPrac");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks the button, open the modal 
	btn.onclick = function() {
	  modal.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	  modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	  if (event.target == modal) {
		modal.style.display = "none";
	  }
	}
</script>




</body>
</html>