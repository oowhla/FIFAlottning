<!DOCTYPE html>
<html>
<head>

	<!-- Hanterar scaling till mobila enheter -->
	<meta charset="iso-8859-1">
	
	<!-- <script src="js/javascript.js"></script> -->
	<link rel="stylesheet" type="text/css" href="src/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="include/stylesheet.css">

	<title> Lottning för FIFA</title>
</head>

<?php 
	require_once 'core/init.php';
?>

<body>
	<script src="src/bootstrap/js/bootstrap.js"></script>
	<div class="logo">
		<div class="container">
			<a href="index.php">
				<img src="./img/header.jpg" width="101%">
			</a>
		</div>
	</div>
	<nav class="navbar navbar-custom">
		<div class="container">
			<div class="navbar">
				<ul class="nav navbar-nav">
					<li id="beräkning"><a href="index.php">Lottning</a></li>
					<li id="resultat"><a href="resultat.php">Resultat</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li id="beräkning"><a href="admin.php">För in resultat</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		

	<script src="src/bootstrap/js/bootstrap.js"></script>

		<?php


	$messages = array (

'success' => "<div class='alert alert-success alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
            <strong> ",

 'danger' => "<div class='alert alert-danger alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
            <strong>  ",

    'end' => "</strong> </div>"

  
    ); 

	?> 


