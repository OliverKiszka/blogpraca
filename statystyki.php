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

	
	$sql = "SELECT id from uzytkownicy where user = '$kto'";
	$rezultat = $polaczenie->query($sql);
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
	<link rel="stylesheet" href="style3.css">

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</head>
<body style="background: #63738a;">
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
			<a href="statystyki.php" class="nav-item nav-link  active">Statystyki</a>
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
<div class="dodajsklep "  id="wybierzDate" style="cursor:pointer;" data-toggle="modal" data-target="#wybierzDateModal" ><p style="cursor:pointer;">Wybierz Datę</p></div>
<!-- Modal wybierz date-->
<div class="modal fade bd-example-modal-lg" id="wybierzDateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		    <div class="modal-header">
				<p class="modal-title" id="exampleModalLabel">Wybieranie daty</p>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		    </div>
		    
		    <form action="" method="get">
			    <div class="modal-body">
			    	<p>Wybierz dzień sezonowy, klikając na ikonkę kalendarza <i class="fa fa-calendar-o"></i></p>
			    	<input type="date" style="font-size: 2rem" name="data_dnia_sezonowego" class="form-control" placeholder="Proszę wybierz datę"  required>
			    	
			    </div>
			   
			    <div class="modal-footer">
			      <input type="submit"  value="Zatwierdź" class="btn btn-primary" style=""/>
		          <input type="reset" id="reset" value="Anuluj / Resetuj" class="btn btn-danger" style=""/> 
			    </div>
			</form>

		  </div>
	</div>
</div>
	<div class="pudelko" style="margin-top:0;">
		 
			<?php
					if(isset($_GET['data_dnia_sezonowego'])){
					$dataget = $_GET['data_dnia_sezonowego'];
					$date=date_create($dataget);
					$data_dnia_sezonowego = date_format($date,"d-m-Y");
					$miesiac=date("M",strtotime($data_dnia_sezonowego));
				?>
				<fieldset class="border p-3">
					<legend class="w-auto px-2">Statystyki dzienne</legend>
				<h2>Wybrana data: <b><?php echo $data_dnia_sezonowego;?></b></h2>
				
				<?php
				$sql2="SELECT max(utarg) AS najlepszy_utarg FROM `utargi` where idusera = '$kto_id' AND datautargu='$dataget' ";
					$rez2 = $polaczenie->query($sql2);
					if ($rez2->num_rows > 0) {
						while($wiersz2 = $rez2->fetch_assoc()) {
						$najlepszy_utarg=$wiersz2['najlepszy_utarg'];
					}
				}
				?>
				<?php
				$sql3="SELECT * FROM `utargi` where idusera = '$kto_id' AND datautargu='$dataget' and utarg='$najlepszy_utarg' ";
					$rez3 = $polaczenie->query($sql3);
					if ($rez3->num_rows > 0) {
						while($wiersz3 = $rez3->fetch_assoc()) {
						$kto_najlepszy_utarg=$wiersz3['pracownik'];
					}
				}
				?>
				<h2>Najlepszy utarg: <b><?php if(isset($najlepszy_utarg))echo $najlepszy_utarg."zł"; else echo "Brak";?></b> Wykonany przez: <b> <?php if(isset($kto_najlepszy_utarg))echo $kto_najlepszy_utarg; else echo "Brak";?></b></h2>
				<?php
				$sql5="SELECT round(avg(utarg),2) as srednia_utargow FROM `utargi` where idusera = '$kto_id' AND datautargu='$dataget'";
					$rez5 = $polaczenie->query($sql5);
					if ($rez5->num_rows > 0) {
						while($wiersz5 = $rez5->fetch_assoc()) {
						$srednia_utargow=$wiersz5['srednia_utargow'];
					}
				}
				?>
				<h2>Średni utarg z dnia: <b><?php if(isset($srednia_utargow))echo $srednia_utargow."zł"; else echo "Brak";?></b></h2>

				<?php
				$sql4="SELECT sum(utarg) AS suma_utargow FROM `utargi` where idusera = '$kto_id' AND datautargu='$dataget' ";
					$rez4 = $polaczenie->query($sql4);
					if ($rez4->num_rows > 0) {
						while($wiersz4 = $rez4->fetch_assoc()) {
						$suma_utargow=$wiersz4['suma_utargow'];
					}
				}
				?>
				<h2>Suma utargów z tego dnia: <b><?php if(isset($suma_utargow))echo $suma_utargow."zł"; else echo "Brak";?></b></h2>
				
				</fieldset>
				<fieldset class="border p-3">
					<legend class="w-auto px-2">Statystyki miesięczne</legend>

					<h2>Wybrany miesiąc: 
						<b>
							<?php 
							if($miesiac=="Jan"){$miesiac="Styczeń";$numer="1";}
							elseif($miesiac=="Feb"){$miesiac="Luty";$numer="2";}
							elseif($miesiac=="Mar"){$miesiac="Marzec";$numer="3";}
							elseif($miesiac=="Apr"){$miesiac="Kwiecień";$numer="4";}
							elseif($miesiac=="May"){$miesiac="Maj";$numer="5";}
							elseif($miesiac=="Jun"){$miesiac="Czerwiec";$numer="6";}
							elseif($miesiac=="Jul"){$miesiac="Lipiec";$numer="7";}
							elseif($miesiac=="Aug"){$miesiac="Sierpień";$numer="8";}
							elseif($miesiac=="Sep"){$miesiac="Wrzesień";$numer="9";}
							elseif($miesiac=="Oct"){$miesiac="Październik";$numer="10";}
							elseif($miesiac=="Nov"){$miesiac="Listopad";$numer="11";}
							elseif($miesiac=="Dec"){$miesiac="Grudzień";$numer="12";}

							echo $miesiac;
							
							?>	
						</b>
					</h2>
					<?php
				$sql2="SELECT max(utarg) AS najlepszy_utarg FROM `utargi` where idusera = '$kto_id' AND month(datautargu)='$numer'";
					$rez2 = $polaczenie->query($sql2);
					if ($rez2->num_rows > 0) {
						while($wiersz2 = $rez2->fetch_assoc()) {
						$najlepszy_utarg=$wiersz2['najlepszy_utarg'];
					}
				}
				?>
				<?php
				$sql3="SELECT * FROM `utargi` where idusera = '$kto_id' AND month(datautargu)='$numer' and utarg='$najlepszy_utarg' ";
					$rez3 = $polaczenie->query($sql3);
					if ($rez3->num_rows > 0) {
						while($wiersz3 = $rez3->fetch_assoc()) {
						$kto_najlepszy_utarg=$wiersz3['pracownik'];
					}
				}
				?>
				<h2>Najlepszy utarg: <b><?php if(isset($najlepszy_utarg))echo $najlepszy_utarg."zł"; else echo "Brak";?></b> Wykonany przez: <b> <?php if(isset($kto_najlepszy_utarg))echo $kto_najlepszy_utarg; else echo "Brak";?></b></h2>
				<?php
				$sql5="SELECT round(avg(utarg),2) as srednia_utargow FROM `utargi` where idusera = '$kto_id' AND month(datautargu)='$numer'";
					$rez5 = $polaczenie->query($sql5);
					if ($rez5->num_rows > 0) {
						while($wiersz5 = $rez5->fetch_assoc()) {
						$srednia_utargow=$wiersz5['srednia_utargow'];
					}
				}
				?>
				<h2>Średni utarg z miesiąca: <b><?php if(isset($srednia_utargow))echo $srednia_utargow."zł"; else echo "Brak";?></b></h2>

				<?php
				$sql4="SELECT sum(utarg) AS suma_utargow FROM `utargi` where idusera = '$kto_id' AND month(datautargu)='$numer' ";
					$rez4 = $polaczenie->query($sql4);
					if ($rez4->num_rows > 0) {
						while($wiersz4 = $rez4->fetch_assoc()) {
						$suma_utargow=$wiersz4['suma_utargow'];
					}
				}
				?>
				<h2>Suma utargów z tego miesiąca: <b><?php if(isset($suma_utargow))echo $suma_utargow."zł"; else echo "Brak";?></b></h2>

				</fieldset>

			<?php
				}else{
					echo "<b>Wybierz datę z którego chcesz wyliczyć statystyki</b>";
				}
			?>
		
			
		
	</div>

</body>
</html>