<?php
//Forbindelses oplysninger
$dbhost = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbName = "USER_DB";

//DSN data
$dbdsn = "mysql:host=".$dbhost.";dbname=".$dbName;

//Indstillinger
$pdooptions = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES => false,];

//Variabel til forbindelse
$conn = new PDO($dbdsn, $dbusername, $dbpassword, $pdooptions);
?>

