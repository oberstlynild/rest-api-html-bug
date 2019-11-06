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
    <?php
    // Gem error checking variabler som tomme
    $nameErr = "";
    $passErr = "";
    $emailErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // hvis felterne brugernavn, email eller password er tomme så mind brugeren om at udfylde dem
        if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"])){
            
            if (empty($_POST["username"])){
                $nameErr = "Husk at udfylde brugernavn";}
            if (empty($_POST["email"])){
                $emailErr = "Husk at udfylde email";}
            if (empty($_POST["password"])){
                $passErr = "Husk at udfylde password";}
        }
    }
?>

<h2>Rediger Bruger</h2>
<div class="center-div2">
    <form class="theForm" action="" method="post">

    <label for="username">Brugernavn</label> 
    <input placeholder="indtast brugernavn" type="text" name="username">
    <span class="error"><?php echo $nameErr;?></span>

    <label for="password">Password</label> 
    <input placeholder="indtast password" type="text" name="password">
    <span class="error"><?php echo $passErr;?></span>
        <br>

    <label for="email">Email</label> 
    <input placeholder="indtast email" type="text" name="email">
    <span class="error"><?php echo $emailErr;?></span>
        <br>

<input class="formButton" type="submit" value="Rediger bruger">
</form>

<?php

include 'includes.php';

// Gem id i $dataID med $_GET
$dataID = $_GET['ID'];

try {
    
    //Opret forbindelse med funktionen connect()
    //Gem brugernavnet på det pågældene id i variablen $data
    $conn = Functions::connect();
    $data = Functions::getUsernameById($conn, $dataID);

    // Informer om hvilken bruger der redigeres

    
    // hvis serveren har fået en POST request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // hvis felterne brugernavn, email eller password er tomme så mind brugeren om at udfylde dem
        if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"])){
            
            foreach($data as $row){ 
                echo "<div class='center-div1'>Brugeren med navnet: ".$row['username']." redigeres</div>";   
                }
            echo "<div class='center-div1'>
            <h3>Udfyld alle felter for at redigere bruger</h3>
            <a href='../../index.php'>
            <button class='buttonInput havartiOst'>Tilbage til start</button>
            </a></div>";
        }
    

        // ellers hvis ikke, så sæt $name, $email og $password til at være hvad der er i input felterne
        else
        {  
            $name = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            // kør funktionen setUserById med variablerne vi satte før, samt $conn og $dataID da de er påkrævet af funktionen.
            Functions::setUserById($conn, $dataID, $name, $email, $password);
        
            // vis at brugeren er opdateret.
            foreach($data as $row){ 
            echo "<div class='center-div1'>Brugeren med navnet: ".$row['username']." er opdateret</div>";   
            }
            echo "<div class='center-div1'><a href='../../index.php'><button class='buttonInput havartiOst'>Tilbage til start</button></a></div></div>";
        }
    }
    // hvis serveren ikke har modtaget en post request så vis tilbage knappen som det eneste.
    else{
        foreach($data as $row){ 
            echo "<div class='center-div1'>Brugeren med navnet: ".$row['username']." redigeres</div>";   
            }
            echo "<div class='center-div1'><a href='../../index.php'><button class='buttonInput havartiOst'>Tilbage til start</button></a></div></div>";
        }
    }



catch(PDOException $e)
{ echo "Tilslutningsfejl: " . $e->getMessage();
}
  
?>
</div>

</body>
</html>

