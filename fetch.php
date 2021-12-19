<?php

	/*session_start();

	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	} */
 //fetch.php  
 //$connect = mysqli_connect("localhost", "root", "", "praca");  
 $polaczenie = new mysqli("localhost", "root", "", "praca");
 $id_utargu=$_POST["id_utargu"];
 //echo $id_utargu;
 if(isset($id_utargu))  
 {  
      $sql = "SELECT * FROM utargi WHERE idutargu = '$id_utargu'";  
      $rezultat = $polaczenie->query($sql); 
      if ($rezultat->num_rows >0) {
	      while($wiersz = $rezultat->fetch_array()){  
	      echo json_encode($wiersz);  
	      
	  	}
 	}
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