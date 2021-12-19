<?php

	session_start();
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	

	require_once "connect.php";
	$nazwa_edytowanego_sklepu= $_POST['nazwa_edytowanego_sklepu'];
	$id_edytowanego_sklepu=$_POST['id_edytowanego_sklepu'];
	echo $nazwa_edytowanego_sklepu;
	echo $id_edytowanego_sklepu;
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	if ($polaczenie->connect_error) {
  	die("Polaczenie nieudane: " . $polaczenie->connect_error);
	}
	
	$sql = "UPDATE sklepy SET nazwasklepu='$nazwa_edytowanego_sklepu' WHERE idsklepu='$id_edytowanego_sklepu'";

	if ($polaczenie->query($sql) === TRUE) {
	  echo "Record updated successfully";
	} else {
	  echo "Error updating record: " . $polaczenie->error;
	}

	$polaczenie->close();
	header('Location: zarzadzaj_sklepami.php');

?>