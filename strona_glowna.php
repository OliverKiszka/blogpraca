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
	//echo $kto_id;
	/*if(isset($_POST['utarg'])){
		$sklep = $_POST['sklep'];
		$pracownik = $_POST['pracownik'];
		$data_dnia_sezonowego = $_POST['data_dnia_sezonowego'];
		$utarg = $_POST['utarg'];
		
		$sql = "INSERT INTO utargi (utarg, sklep, pracownik, datautargu, idusera) VALUES ('$utarg', '$sklep','$pracownik','$data_dnia_sezonowego', '$kto_id')";
		if ($polaczenie->query($sql) === TRUE) {
	 	echo '<script type="text/javascript">alert("Pomyślnie dodano utarg!");</script>';
	 	}	
	}*/
	//$data_dnia_sezonowego = $_GET['data_dnia_sezonowego'];
	
	//echo $data_dnia_sezonowego;
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
			<a href="#" class="nav-item nav-link active">Strona Główna</a>
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
<div class="dodajsklep "  id="wybierzDate" style="cursor:pointer;" data-toggle="modal" data-target="#wybierzDateModal" ><p style="cursor:pointer;">Wybierz Datę</p></div>
<div class="dodajsklep add_data"  id="dodajUtarg" style="cursor:pointer;"><p style="cursor:pointer;">Dodaj utarg</p></div>
<!-- data-toggle="modal" data-target="#dodajUtargModal" -->
<!-- <button type="button" class="dodajsklep" data-toggle="modal" data-target="#exampleModal"><p style="cursor:pointer;">
  Launch demo modal
</p>
</button> -->

<!-- Modal example-->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->
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
<!-- Modal dodaj utarg-->
<div class="modal fade bd-example-modal-lg" id="dodajUtargModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		    <div class="modal-header">
				<p class="modal-title" id="exampleModalLabel">Dodawanie utargu</p>
		        <button type="button" class="close close_add_data" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		    </div>
		    
		    <form id="add_form" action="" method="post">
			    <div class="modal-body">
			    	<div class="form-row">
						<div class="col">
						<p>Sklep</p>
				    	<select class="form-control" id="sklep" name="sklep" style="font-size: 2rem">
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
			    		<p>Pracownik</p>
				    	<select class="form-control" id="pracownik" name="pracownik" style="font-size: 2rem">
						<?php
						$sql5 = "SELECT * FROM pracownicy where idusera = '$kto_id'";
						$rezultat_pracownikow = $polaczenie->query($sql5);
						if ($rezultat_pracownikow->num_rows > 0) {
						// output data of each row
						
						while($wiersz_pracownikow = $rezultat_pracownikow->fetch_assoc()) {
							$imie_pracownika = $wiersz_pracownikow["imiepracownika"];
							$nazwisko_pracownika = $wiersz_pracownikow["nazwiskopracownika"];
							$pelna_nazwa = $imie_pracownika." ".$nazwisko_pracownika;
							
						?>
							<option value="<?php echo $pelna_nazwa;?>"><?php echo $pelna_nazwa;?></option>
						<?php
								 }
							} else {
							  echo "
								<p style='font-size:20px;'>Nie masz jeszcze żadnych pracowników !</p>
								";
							}
							
						?>
						</select>
			    		</div>
			    	</div>
			    	<div class="form-row">
						<div class="col">
				    	<p>Data utargu <i class="fa fa-calendar-o"></i></p>
				    	<input type="date" style="font-size: 2rem" name="data_dnia_sezonowego" class="form-control" placeholder="Proszę wybierz datę"  required>
			    		</div>
			    		<div class="col">
			    		<p>Utarg</p>
			    		<div class="input-group mb-2">
				    	<input type="number" style="font-size: 2rem" name="utarg" class="form-control" placeholder="Wpisz utarg" min="0" required>
				    	<div class="input-group-append">
					    	<span class="input-group-text" style="font-size: 2rem">zł</span>
					    </div>
					    <input type="hidden" name="kto_id" value="<?php echo $kto_id; ?>">
					    
				    	</div>
			    		</div>
			    	</div>
			    </div>
			   
			    <div class="modal-footer">
			      <input type="submit"  value="Zatwierdź" class="btn btn-primary" style=""/>
		          <input type="reset" id="reset" value="Anuluj / Resetuj" class="btn btn-danger" style=""/>
		          <button type="button" class="btn btn-secondary close_add_data" data-dismiss="modal">Close</button>
			    </div>

			</form>

		  </div>
	</div>
</div>
<div class="modal fade bd-example-modal-lg" id="edytujUtargModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		    <div class="modal-header">
				<p class="modal-title" id="exampleModalLabel">Edytowanie utargu</p>
		        <button type="button" class="close close_edit_data" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		    </div>
		    
		    <form id="edit_form" method="post">
			    <div class="modal-body">
			    	<div class="form-row">
						<div class="col">
			    		<p>Pracownik</p>
				    	<select class="form-control" id="pracownik" name="pracownik" style="font-size: 2rem">
						<?php
						$sql5 = "SELECT * FROM pracownicy where idusera = '$kto_id'";
						$rezultat_pracownikow = $polaczenie->query($sql5);
						if ($rezultat_pracownikow->num_rows > 0) {
						// output data of each row
						
						while($wiersz_pracownikow = $rezultat_pracownikow->fetch_assoc()) {
							$imie_pracownika = $wiersz_pracownikow["imiepracownika"];
							$nazwisko_pracownika = $wiersz_pracownikow["nazwiskopracownika"];
							$pelna_nazwa = $imie_pracownika." ".$nazwisko_pracownika;
							
						?>
							<option value="<?php echo $pelna_nazwa;?>"><?php echo $pelna_nazwa;?></option>
						<?php
								 }
							} else {
							  echo "
								<p style='font-size:20px;'>Nie masz jeszcze żadnych pracowników !</p>
								";
							}
							
						?>
							
						
						</select>
			    		</div>
			    		<div class="col">
			    		<p>Utarg</p>
			    		<div class="input-group mb-2">
				    	<input type="number" style="font-size: 2rem" id="utarg" name="utarg" class="form-control" value="" placeholder="Wpisz utarg" min="0" required>
				    	<input type="hidden"  id="id_utargu" name="id_utargu" value="">
				    	<input type="hidden"  id="dataget" name="dataget" value="">
				    	<div class="input-group-append">
					    	<span class="input-group-text" style="font-size: 2rem">zł</span>
					    </div>
				    	</div>
			    		</div>
			    	</div>
			    </div>
			   	
			    <div class="modal-footer">
			      <input type="submit"  id="insert" name="insert" value="Zaaktualizuj" class="btn btn-primary" style=""/>
			      <button type="button" class="btn btn-secondary close_edit_data" data-dismiss="modal">Close</button>
			    </div>

			</form>

		  </div>
	</div>
</div>
	<div class="pudelkosklepow">
		



		<div class="row">

			<?php 
				if(isset($_GET['data_dnia_sezonowego'])){
					$dataget = $_GET['data_dnia_sezonowego'];
					$date=date_create($dataget);
					$data_dnia_sezonowego = date_format($date,"d-m-Y");
					$data_next=date('Y-m-d', strtotime($data_dnia_sezonowego .' +1 day'));
					$data_previous=date('Y-m-d', strtotime($data_dnia_sezonowego .' -1 day'));
					
			?>

			<div class="col-lg" style="border: 5px solid black;">
				<a href="strona_glowna.php?data_dnia_sezonowego=<?php echo $data_previous;?>" style="text-decoration: none;">
					<div class="text-center"><h4 style="color:black; cursor:pointer; padding:10px 0 10px 0;"><i class="fa fa-arrow-left"></i> Wczorajszy dzień</h4></div>
				</a>
			</div>
			<div class="col-lg text-center" style="border: 5px solid red;">
				<h4 style="color:black; padding:10px 0 10px 0;">
					<i class="fa fa-arrow-down"></i>
					<?php
					
					echo " Dzisiaj ".$data_dnia_sezonowego;
					
					?>
					<i class="fa fa-arrow-down"></i>
				</h4>
			</div>
			
			<div class="col-lg text-center" style="border: 5px solid black;">
				<a href="strona_glowna.php?data_dnia_sezonowego=<?php echo $data_next;?>" style="text-decoration: none;">
				<h4 style="color:black;   cursor:pointer; padding:10px 0 10px 0;">Jutrzejszy dzień <i class="fa fa-arrow-right"></i></h4>
				</a>
			</div>




			<div id="nowy_utarg" class="row justify-content-around" style="margin-top:20px;">
				<?php
					$sql6 = "SELECT DISTINCT sklep FROM utargi where idusera = '$kto_id' AND datautargu='$dataget' ";
					$rezultat_sklepow_distinct = $polaczenie->query($sql6);
					if ($rezultat_sklepow_distinct->num_rows > 0) {
					// output data of each row
					$iteracja=0;
					while($wiersz_sklepow_distinct = $rezultat_sklepow_distinct->fetch_assoc()) {
					
					$sklep = $wiersz_sklepow_distinct['sklep'];
					
					if($iteracja%2==0) echo'</div><div class="row justify-content-around" style="margin-top:20px;">';
				?>
			
				<div class="col-lg-4" style="background-color: #90EE90; border: 5px solid #6c757d; padding-left:0; padding-right: 0;">

					<div class="text-center" style="background-color: #00BFFF; border: 5px solid #6c757d;">
						<h4 style="color:black; padding:10px 0 10px 0;"> <?php echo $sklep; ?> </h4>
					</div>
					<?php 
					$sql7="SELECT * FROM utargi where idusera = '$kto_id' AND datautargu='$dataget' ";
					$rezultat_utargow = $polaczenie->query($sql7);
					if ($rezultat_utargow->num_rows > 0) {
						while($wiersz_utargow = $rezultat_utargow->fetch_assoc()) {
						$id_utargu=$wiersz_utargow['idutargu'];
						$pracownik=$wiersz_utargow['pracownik'];
						$utarg=$wiersz_utargow['utarg'];
						$sklep2=$wiersz_utargow['sklep'];
							if($sklep2==$sklep){
							?>
							<div style="background-color: #90EE90;">
							<div class="text-center">
								<h4 style="color:black; padding:10px 0 10px 0; margin-bottom:0px;" class="zaaktualizowany_utarg"><?php echo $pracownik; ?> : <?php echo $utarg; ?> zł </h4>
								<input type="button" id='<?php echo $id_utargu; ?>'value="E" name="edit" class="btn btn-info btn-xs edit_data">

								<button id="'.$id_utargu.'" name="usun" class="btn btn-danger btn-xs">U</button>
								

								</div>
							</div>
						<?php
						//data-toggle="modal" data-target="#edytujUtargModal"
							}
						}
					}

					?>
					<!-- <div style="background-color: #90EE90;">
						<div class="text-center">
							<h4 style="color:black; padding:10px 0 10px 0; margin-bottom:0px;"> <?php echo $pracownik; ?> : <?php echo $utarg; ?>zł </h4>
							
						</div>
					</div> -->
					
					<!-- <div style="background-color: #90EE90;">
							<div class="text-center" style="padding:10px 0 10px 0; margin-top:15px;">
								<button id="<?php echo $id_utargu; ?>" name="edytuj" class="btn btn-info btn-xs przycisk_edytuj" style="">E</button>
								<button id="<?php echo $id_utargu; ?>" name="usun" class="btn btn-danger btn-xs przycisk_usun">Usuń</button>
							</div>
					</div> -->
					
				</div>

			
				<?php 
				$iteracja++;
					}
				}else {
					echo "Nie zapisano jeszcze utargów !";
				}
				?>
			
			<?php 
			
			}else{
			?>
			<div class="col-lg text-center">
				<h4> Nie wybrałeś jeszcze dnia! </h4>
			</div>
			<?php 
			}
			?>

		</div>
		


		
			
		
		

	
	</div>
</div>
<script>
	 $(document).ready(function(){

			$(document).on('click', '.edit_data', function(){  
			           var id_utargu = $(this).attr("id");  
			           console.log(id_utargu);
			           
			           $.ajax({  
			                url:"fetch.php",  
			                method:"POST",  
			                data:{id_utargu:id_utargu},  
			                dataType:"json",
			                
			                success:function(data){  
			                       //$('#pracownik_details').html(data);
			                     //$('#pracownik').val(data.pracownik);  
			                     $('#utarg').val(data.utarg);  
			                      //$('.modal-body').html(response);
			                     $('#id_utargu').val(data.idutargu); 
			                     $('#dataget').val(data.datautargu);  
			                     //$('#insert').val("Update");  
			                     $('#edytujUtargModal').modal('show');
			                }  
			           });  
			      });  
			$(document).on('click', '.close_edit_data', function(){  
			         
			           $('#edytujUtargModal').modal('hide');
			           
			      }); 
			$(document).on('click', '.add_data', function(){  
					$('#dodajUtargModal').modal('show');
				});
			$(document).on('click', '.close_add_data', function(){  
			         
			           $('#dodajUtargModal').modal('hide');
			           
			      }); 

 			$('#edit_form').on("submit", function(event){  
            
           
                $.ajax({  
                     url:"zaaktualizuj_utarg.php",  
                     method:"POST",  
                     data:$('#edit_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                          $('#edit_form')[0].reset();  
                          $('#edytujUtargModal').modal('hide');  
                          $('#zaaktualizowany_utarg').html(data);  
                     }  
                });  
            
      });  
 			$('#add_form').on("submit", function(event){  
            
           
                $.ajax({  
                     url:"dodaj_utarg.php",  
                     method:"POST",  
                     data:$('#add_form').serialize(),  
                      
                     success:function(data){  
                          $('#add_form')[0].reset();  
                          $('#dodajUtargModal').modal('hide');  
                          $('#nowy_utarg').html(data);  
                     }  
                });  
            
      });  









	 });  
        


</script>
</body>
</html>
<!--
	<div class="alert alert-success alert-dismissible fade show" role="alert">
	  <strong>Gratulacje!</strong> Udało ci się wysłać e-maila!
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	  	<span aria-hidden="true">&times;</span>
	  </button>
	</div>
	-->