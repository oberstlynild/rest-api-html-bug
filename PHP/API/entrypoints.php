<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require('../MODEL/API-FUNCTIONS/functionCollection.php');



switch($_SERVER['REQUEST_METHOD']) {


	case 'GET':

	if(isset($_GET['id'])) {
		readSingleUser();
	}
	else{
		readAllUsers();
	}
	break;


	case 'POST':
		addUser();
	break;



	case 'PUT':
	break;



	case 'DELETE':
	break;



	default: //Hvis ingen af de andre switch cases er ramt
	echo "default";



}

?>