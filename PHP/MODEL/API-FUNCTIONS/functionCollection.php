<?php


function readAllUsers() {
	require('conf.php');

	$sql = "SELECT * FROM users";

	$result = $conn->query($sql);

	$data = $result->fetchAll();

	foreach($data as $row) {
		echo json_encode($row);
		echo "\n";
	}
	$conn=null;
}

function readSingleUser() {
	require('conf.php');

	$recievedId = $_GET['id'];

	$sql = "SELECT * FROM users WHERE id='$recievedId'";

	$result = $conn->query($sql);

	$data = $result->fetchAll();

	if (!$data) {
		echo json_encode(['response'=>'No user with that ID']);
	}
	else {
		foreach($data as $row) {
			echo json_encode($row);
		}
	}
	$conn=null;

}

function addUser() {
	require('conf.php');

	$recievedDecodedBody=json_decode(file_get_contents("php://input"));
	var_dump ($recievedDecodedBody);

}

function deleteUser() {

}

function editUser() {

}


?>