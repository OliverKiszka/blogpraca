<?php

	session_start();

	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	} 
 //fetch.php  
 require_once "connect.php";
 $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
 $sklep=$_POST["sklep"];
 $utarg=$_POST["utarg"];
 $pracownik=$_POST["pracownik"];
 $data_dnia_sezonowego=$_POST["data_dnia_sezonowego"];
 $kto_id=$_POST["kto_id"];

 if(isset($sklep))  
 {  
	$sql = "INSERT INTO utargi (utarg, sklep, pracownik, datautargu, idusera) VALUES ('$utarg', '$sklep','$pracownik','$data_dnia_sezonowego', '$kto_id')";
	$polaczenie->query($sql);
      //$sql = "UPDATE utargi set utarg='$utarg', pracownik='$pracownik' WHERE idutargu = '$id_utargu'";  
      //$rezultat = $polaczenie->query($sql); 
      
	      
	      //echo json_encode($wiersz);  
	      //header("Location: strona_glowna.php?data_dnia_sezonowego=$dataget");
	  	
 	
 }  /*
	$sql2 = "SELECT * FROM utargi WHERE id = '".$_POST["id_utargu"]."'";
	$rezultat = $polaczenie->query($sql2);
	if ($rezultat->num_rows > 0) {
  	// output data of each row
		while($wiersz = $rezultat->fetch_assoc()) {
			$kto_id = $wiersz["id"];
		}
	} else {
	  echo "0 results";
	}*/
 
?>