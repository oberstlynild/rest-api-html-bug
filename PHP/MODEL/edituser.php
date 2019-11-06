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
            if (empty($_POST["username"])) {
                $nameErr = "Brugernavn skal udfyldes";
            } 
        
            if (empty($_POST["email"])) {
                $emailErr = "Email skal udfyldes";
            } 
    
            if (empty($_POST["password"])) {
                $passErr = "Password skal udfyldes";
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

//Edit Page:

//"Form med data fra bruger valgt." 
include 'db.php';

// Create a new instance of DB and Connect with user test and pass 1234.
  $database = new DB();
  $conn = $database->Connect("test", 1234, "USER_DB", "localhost");

// Server
$dataID = $_GET['ID'];

try {

    // HVIS DE 3 INPUTS ER INDTASTET
    $res = $conn->query("SELECT username FROM Users WHERE id= $dataID");
    $data = $res->fetchAll();
    foreach($data as $row){ 
        echo "<div class='center-div1'>Brugeren med navnet: ".$row['username']." redigeres</div>";   
        }
    
      
    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"])){
            echo "<div class='center-div1'>
            <h3>Udfyld alle felter for at redigere bruger</h3>
            <a href='../../index.php'>
            <button class='buttonInput havartiOst'>Tilbage til start</button>
            </a></div>";
        }
    
        // echo "Opdater bruger med navnet:".
        else
        {  
        // HER SÆTTER VI VARIABLERNE TIL AT VÆRE DET VI MODTAGER I INPUTS'NE
            $name = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // QUERY MED NAMED PLACEHOLDERS
            $sql = "UPDATE Users SET username = :username, email = :email, passwrd = :passwrd WHERE id= $dataID";
            
    $statement = $conn->prepare($sql);
    $statement->execute(array(':email' => $email, ':passwrd' => $password, ':username' => $name));
        
           foreach($data as $row){ 
            echo "<div class='center-div1'>Brugeren med navnet: ".$row['username']." er opdateret</div>";   
            }
        echo "<div class='center-div1'><a href='../../index.php'><button class='buttonInput havartiOst'>Tilbage til start</button></a></div></div>";

    
        }
    }
}


catch(PDOException $e)
{ echo "Tilslutningsfejl: " . $e->getMessage();
    echo "<div class='center' style='margin: 5%;'>Fejl - Alle felter skal udfyldes</div>";
    echo "<div class='center-div1'><a href='../../index.php'><button class='buttonInput havartiOst'>Tilbage til start</button></a></div></div>";

}
  
?>
</div>

</body>
</html>

