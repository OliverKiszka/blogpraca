<?php

	session_start();
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	

	require_once "connect.php";
	
	$imie_pracownika= $_POST['imie_pracownika'];
	$nazwisko_pracownika=$_POST['nazwisko_pracownika'];
	$stanowisko= $_POST['stanowisko'];
	$data_zatrudnienia= $_POST['data_zatrudnienia'];
	
	echo $imie_pracownika;
	echo $nazwisko_pracownika;
	echo $stanowisko;
	echo $data_zatrudnienia;
	
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	if ($polaczenie->connect_error) {
  	die("Polaczenie nieudane: " . $polaczenie->connect_error);
	}
	
	

	$polaczenie->close();
	header('Location: pracownicy.php');

?>