 <!DOCTYPE html>
 <html lang="en">

<head>
     <meta charset="UTF-8">
     <title>CRUD</title>
     <meta name="description" content="DESCRIPTION">
     <link rel="stylesheet" href="css/style.css">
     <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
     <title>CRUD</title>
 </head>
 <body>

<?php

try {

// Inkluder alle eksterne filer
include 'PHP/model/includes.php';

// Gem $conn som resultatet af funktionen connect
// Gem $data som resultatet af functionen getAllUsers
$conn = Functions::connect();
$data = Functions::getAllUsers($conn);

// Lav et grid der holder de forskellige kategorier og indsæt med foreach loop fra $data som holder Alle users.
    echo '<h2>CRUD Brugerstyrings system</h2><br>';     
    echo "<div class='grid'> ";
    echo "<div class='holder'><h3>ID</h3>";

    foreach ($data as $row){
    echo "<div class='center'>".$row['id']."</div>";
  }

  echo "</div>"; 

    echo "<div class='holder'><h3>Brugernavn</h3>";
    foreach ($data as $row){
    echo "<div class='center'>".$row['username']."</div>";
    }
    echo "</div>";
    
    echo "<div class='holder'><h3>Email</h3>";
    foreach ($data as $row){
      echo "<div class='center'>".$row['email']."</div>";
    }
    echo "</div>";

    echo "<div class='holder'><h3>Password</h3>";
    foreach ($data as $row){
      echo "<div class='center'>".$row['passwrd']."</div>";
    }
    echo "</div>";

    // Opret to knapper der sender det pågældende $row[id] med til den næste side som keyvalue af ID. 
    echo "<div class='holder'><h3>Rediger</h3>";
    foreach ($data as $row){
      echo "<div><a name='edit' href='../REST-API/PHP/MODEL/updateUser.php?ID=".$row['id']."'><button class='buttonInput'>Rediger</button></a></div>";
    }
    echo "</div>";

    echo "<div class='holder'><h3>Fjern</h3>";
    foreach ($data as $row){
      echo "<div><a name='delete'  href='../REST-API/PHP/MODEL/deleteUser.php?ID=".$row['id']."'><button class='buttonInput'>Fjern</button></a></div>";
    }
    echo" 
    </div></div>";
    echo "<div class='create'> <a name='edit' href='../REST-API/PHP/MODEL/addUser.php'><button class='createButton'>Opret ny bruger</button></a></div>";
    
  }

    catch(PDOException $e)
    { echo "Tilslutningsfejl: " . $e->getMessage();}
    
?>
 </body>

 </html>