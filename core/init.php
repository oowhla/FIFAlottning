<?php 

session_start();


// Byt till egen databasserver
$host = 'localhost';

// Byt till eget användarnamn för databasen ovan
$username = 'root';

// Byt till det lösenord som tillhör användarnamnet ovan
$password = '';

// Byt till den relevanta databasen
$database = 'fifa';



$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => $host,
		'username' => $username,
		'password' => $password,
		'database' => $database
		),
	'session' => array(
		'session_name' => 'user'
		)
);

spl_autoload_register(function($class){
	require_once 'classes/' . $class . '.php';
});

require_once 'functions/sanitize.php';