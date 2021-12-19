<?php

    session_start();

    if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
    {
        header('Location: strona_glowna.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Bootstrap Simple Registration Form</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>
<body>
<div class="signup-form">
    <form action="" method="post">
		<h2>Reset hasła</h2>
		<p class="hint-text">Możesz zresetować swoje hasło tutaj</p>
        
        <div class="form-group">
        	<input type="email" class="form-control" name="email" placeholder="Email">
        </div>
		
	 
       
		<div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block">Zresetuj hasło</button>
        </div>
    </form>
	<div class="text-center">Hasło ci się przypomniało? <a href="index.php">Powrót</a></div>
</div>
</body>
</html>