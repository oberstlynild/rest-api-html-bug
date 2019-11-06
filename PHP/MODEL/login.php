<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>

<h2>Login</h2>
<div class='center-div2'>
<form class='theForm' action='' method='post'>
<br><h3>Indtast log in oplysninger.</h3>
    <label>Indtast brugernavn</label>
    <input name='username' type='text' placeholder='Brugernavn'>
    <label>Indtast password</label>
    <input name='password' type='text' placeholder='Password'>
    <label>Indtast database navn</label>
    <input name='dbname' type='text' placeholder='Databasenavn'>
    <label>Indtast server navn (eks. localhost)</label>
    <input name='server' type='text' placeholder='Servernavn'>
    <input class='formButton' type='submit'>
    </form>
    </div>

    <?php
    include 'includes.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // hvis forbindelsen kører.

            try{

                $username = trim($_POST['username']);
                $password = trim($_POST['password']);
                $dbname = trim($_POST['dbname']);
                $servername = trim($_POST['server']);


                // kør funktionen $connectNew for at starte forbindelsen.
                $conn = Functions::connectNew($username, $password, $dbname, $servername);
                if ($conn){
                    echo "Tilsluttet til databasen";
                    header('Refresh: 3; URL=index.php');

                }
                else{
                    //var_dump($username);
                    echo ".'$conn'.";
                }
    
            }
    
            catch(PDOException $e){
                die("<br>ERROR: Could not able to execute $sql. " . $e->getMessage());
            }
    }

?>
    
</body>
</html>