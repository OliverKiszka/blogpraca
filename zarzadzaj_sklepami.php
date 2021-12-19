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
		$nazwa_sklepu = $_POST['nazwa_sklepu'];
		if(strlen($nazwa_sklepu)<3 || (strlen($nazwa_sklepu)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_nazwa_sklepu']="Nazwa sklepu musi posiadać od 3 do 20 znaków!";
		}
		//sprawdzanie znakow sklepu - moze uzyc wyrazenia regularnego dla polskich znakow?
		if (ctype_alnum(str_replace(' ', '', $nazwa_sklepu))==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_nazwa_sklepu']="Nazwa sklepu może składać się tylko z liter lub cyfr (bez polskich znaków na razie :( )";
		}
		if($wszystko_OK==true){
			$sql = "INSERT INTO sklepy (nazwasklepu, idusera) VALUES ('$nazwa_sklepu', '$kto_id')";
			if ($polaczenie->query($sql) === TRUE) {
	  			echo '<script type="text/javascript">alert("Pomyślnie dodano sklep!");</script>';
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
				<a href="zarzadzaj_sklepami.php" class="nav-item nav-link active">Zarządzaj sklepami</a>
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
	<!-- Tutaj jest modal -->
	<div class="dodajsklep"  id="dodSkl" style="cursor:pointer;"><p style="cursor:pointer;">Dodaj sklep</p></div>
	


	<!-- <div class="pudelkosklepow">
		<p>Nie masz jeszcze żadnych sklepów !</p>
	</div> -->

	<div id="mojDodModal" class="modal">

	  <!-- Modal content -->
	  <div class="modal-content">
	    <div class="modal-header">
	    	<p>Dodawanie sklepu</p>
	      <span class="close">&times;</span>
	    </div>
	    <!-- dodawanie sklepu -->
	    <form action="zarzadzaj_sklepami.php" method="post">
		    <div class="modal-body">
		    	<p>Nazwa sklepu</p>
		    	<input type="text" name="nazwa_sklepu" class="form-control" placeholder="Proszę wpisz nazwę sklepu"  required>
		    	<?php
					if(isset($_SESSION['e_nazwa_sklepu']))
					{
						echo '<p style="color:red;">'.$_SESSION['e_nazwa_sklepu'].'</p>';
						unset($_SESSION['e_nazwa_sklepu']);
					}
				?>
		    </div>
		   
		    <div class="modal-footer">
		      <input type="submit" name="submit"  value="Dodaj sklep" class="btn btn-primary" style=""/>
	          <input type="reset" id="reset" value="Anuluj / Resetuj" class="btn btn-danger" style=""/> 
		    </div>
		</form>
	  </div>
	</div>
		
	
	
		<div class="pudelkosklepow">

			<!-- Wyswietlanie sklepow -->
			<?php
				$sql3 = "SELECT * FROM sklepy where idusera = '$kto_id'";
			$rezultat_sklepow = $polaczenie->query($sql3);
			if ($rezultat_sklepow->num_rows > 0) {
			  // output data of each row
				//modal target itp
			  while($wiersz_sklepow = $rezultat_sklepow->fetch_assoc()) {
			    $id_sklepu = $wiersz_sklepow["idsklepu"];
				$nazwa_sklepu = $wiersz_sklepow["nazwasklepu"];
			?>
		   
		    
		    <div class='sklep' style="float:left;">
				<div class='nazwasklepu'><b style='font-size: 24px;'><?php echo $nazwa_sklepu; ?></b></div>
				
				

				<div class='przycisk_edytuj'>
					<form action="edycja_sklepu.php" method="post">
					
						<input type="hidden" name="id_sklepu" value="<?php echo $id_sklepu; ?>">
						<button type='submit' name="submit" class='btn btn-info btn-xs'>Edytuj</button>
					</form>
				</div>
				<div class='przycisk_usun'>
					<form action="usuwanie_sklepu.php" method="post">
					
						<input type="hidden" name="id_sklepu" value="<?php echo $id_sklepu; ?>">
						<button type='submit' name="submit" class='btn btn-danger btn-xs'>Usuń</button>
					</form>
				</div>
			</div>
			 
			<!-- Modal edytowanie 
			<div class="modal fade" id="modal_update<?php /* echo $nazwa_sklepu; */?>" aria-hidden="true">
				
				<div class="modal-content">
					<div class="modal-header">
						<p>Edytowanie sklepu</p>
						<span id="close" class="close">&times;</span>
					</div>
					<form action="edytuj_sklep.php" method="POST">
						
						<div class="modal-body">
							<input type='hidden' id="getID" name="getID" value='<?php /* echo $id_sklepu; */?>'>
							<p>Nazwa sklepu</p>
							<input type="text" name="edytuj_nazwe_sklepu" id="" class="form-control" value="<?php /* echo $nazwa_sklepu; */ ?>" required="">
						</div>
						<div class="modal-footer">
							<input type="submit" id="submit" name="submit"  value="Tak" class="btn btn-danger">
							<button type="button" class="btn btn-primary" data-dismiss="modal">Nie</button>
						</div>
					</form>
				</div>-->
				
	
			
			
			
		<?php 
			
		  }
		} else {
		  echo "
			<p style='font-size:20px;'>Nie masz jeszcze żadnych sklepów !</p>
			";
		}
		$polaczenie->close();
		?>
		<div style="clear:both;"></div>
		</div>
		
		
		<!-- Modal usuwanie 
		<div id="mojUsunModal" class="modal">
				<div class="modal-content">
				    <div class="modal-header">
				    	<p>Usuwanie sklepu</p>
				      <span id="close2" class="close">&times;</span>
				    </div>
					<div class="modal-body">
					    <p>Czy na pewno chcesz usunąć <?php /* echo $nazwa_sklepu; */ ?>?</p>
					</div>
					<div class="modal-footer">
                  		<a type="button" class="btn btn-danger" href="usun_sklep.php">Tak</a>
						<button type="button" class="btn btn-primary" id="nieUsun">Nie</button>
					</div>
				</div>
		</div>-->

	<script>
	// Get the modal
	var modal = document.getElementById("mojDodModal");

	// Get the button that opens the modal
	var btn = document.getElementById("dodSkl");

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