
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

try {

include 'includes.php';

// Få fat i det pågældende ID ved hjælp af $_GET.
$dataID = $_GET['ID'];

// Kør funktionerne connect og getAllByID
// connect opretter forbindelse til databasen
// getAllById henter alt data fra brugeren med det pågældende id.
$conn = Functions::connect();
$data = Functions::getAllById($conn, $dataID);

// Hvis brugeren trykker "bekræft" tjekker isset om confirmed er sat.
if (isset($_GET['confirmed']))
{
    // Er den sat bliver confirmed gemt som en var.
    $confirmed = $_GET['confirmed'];

    // hvis confirmed er true kører funktionen deleteUserById og UI bliver opdateret.
    if ($confirmed){
        Functions::deleteUserById($conn, $dataID);
        echo "<h3 class='center'>Brugeren er fjernet fra databasen</h3>";
        echo "<div class='center-div2'><a href='../../index.php'><button class='buttonInput havartiOst'>Tilbage til start</button></a></div>";
    }
}

// Så længe brugeren ikke trykker "bekræft".
else{

    // View kode
    echo "<div class='center-div2'><h2>Bekræft sletning</h2>";
    echo "<p class='center'>Er du sikker på at du vil slette: ";
    foreach ($data as $row){
        
        echo ($row['username']);
    }

    echo " ?</p>
    <br><br>"; 

    // view kode til at vise hvem du er ved at slette
    echo "<div><h2>Brugernavn</h2>";
    foreach ($data as $row){
        echo '<div class="center">';
        echo ($row['username']);
        echo '</div>';
    }
    
    echo "</div><div><h2>Email</h2>";
    foreach ($data as $row){
        echo '<div class="center">';
        echo ($row['email']);
        echo '</div>';
    }

    echo "</div><div><h2>Password</h2>";
    foreach ($data as $row){
        echo '<div class="center">';
        echo ($row['passwrd']);
        echo '</div>';
    }

    echo "</div>";

    // Opretter en knap med endnu en variable i url'en. Confirmed=true bliver først sat når brugeren trykker. 
    echo "<div class='create3'><a class='center-div1' name='delete' href='deleteUser.php?ID=".$row['id']."&confirmed=true'><button class='buttonInput2 havartiOst'>Fjern bruger</button></a></div>";
    echo "<div class='center-div1'><a href='../../index.php'><button class='buttonInput havartiOst'>Tilbage til start</button></a></div></div>";

    }
}

    catch(PDOException $e)
    { echo "Tilslutningsfejl: " . $e->getMessage();}
      

?>
</body>
</html>