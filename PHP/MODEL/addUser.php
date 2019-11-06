<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <title>CRUD</title>
</head>
<body>
<h2>Ny Bruger</h2>
<div class="center-div2">
<form class="theForm" action="" method="post">
        <label for="username">Brugernavn:</label>
        <input placeholder="indtast brugernavn" type="text" name="username" id="username">
        <label for="password">Password:</label>
        <input placeholder="indtast password" type="text" name="password" id="password">
        <label for="emailaddress">Email:</label>
        <input placeholder="indtast email" type="text" name="email" id="email">
    <input class="formButton" type="submit" value="Opret bruger">
</form>
</body>
</html>
<?php

include 'includes.php';

// kør funktionen $conn for at starte forbindelsen.
$conn = Functions::connect();

// hvis forbindelsen kører.
if ($conn){

    try{

    // hvis serveren modtager en post request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // sæt variablerne til at være hvad der er i form felterne
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    
    // hvis alle felter er udfyldt (tjekkes med isset funktion).
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])){
        
        // kør funktionen addNewUser med de gemte variabler og gem dens return som $error variablen.
        $error = Functions::addNewUser($conn, $username, $email, $password);
        
        // hvis $error er tom, så vis at brugeren er tilføjet til databasen
        if ($error == ""){
        echo "<br><div class='center-div1' >Brugeren: ".$username." tilføjet til databasen.";
        echo "<div class='center-div1' style='margin-top: -50px;'><a href='../../index.php'><button class='buttonInput havartiOst' style='margin-top: 15%;margin-bottom: 5%;'>Tilbage til start</button></a></div></div>";
        }
        // hvis ikke $error er tom så vis $error
        else {
            echo "<br><div class='center-div1' >".$error."";
            echo "<div class='center-div1' style='margin-top: -50px;'><a href='../../index.php'><button class='buttonInput havartiOst' style='margin-top: 15%;margin-bottom: 5%;'>Tilbage til start</button></a></div></div>";
           
        }
    }
}

    else{
        echo "<br><div class='center-div1' >Indtast nye brugeroplysninger.";
        echo "<div class='center-div1' style='margin-top: -20px;'><a href='../../index.php'><button class='buttonInput havartiOst' style='margin-top: 15%;margin-bottom: 5%;'>Tilbage til start</button></a></div></div>";
        
    }
}

 catch(PDOException $e){
    die("<br>ERROR: Could not able to execute $sql. " . $e->getMessage());}
}
?>
</div>
</body>
</html>
