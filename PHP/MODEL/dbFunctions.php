<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php

include 'includes.php';

class Functions
    {

    // Funktion til at tilslutte til databasen (HER SKAL DU ÆNDRE VARIABLER FOR AT TILSLUTTE TIL DIN EGEN DB)
    public static function connect(){
        $database = new DB();
        $conn = $database->Connect("root", "", "USER_DB", "localhost");
        return $conn;
    }

    public static function connectNew($username, $password, $dbname, $server){
        
        try {
        if (!$username = '' && !$password = '' && !$dbname = '' && !$server = ''){
            
            $usernameInfo = $username;
            $passwordInfo = $password;
            $dbnameInfo = $dbname;
            $serverInfo = $server;

            $database = new DB();
        
        $conn = $database->Connect($usernameInfo, $passwordInfo, $dbnameInfo, $serverInfo);
        var_dump($usernameInfo, $passwordInfo, $dbnameInfo, $serverInfo);

        
        return $conn;
        }
        else{
            $conn = "Kan ikke forbinde til database. Tjek log in oplysninger og prøv igen";
            var_dump($usernameInfo, $passwordInfo, $dbnameInfo, $serverInfo);
            return $conn;
        
        }
    }

    catch(PDOException $e){
        die("<br>ERROR: Could not able to execute $sql. " . $e->getMessage());
    }
}

   
    // Funktion til at få alle brugere ud af databasen
    public static function getAllUsers($conn){
    
        //Return all users
        $res = $conn->query('SELECT * FROM Users');
        $data = $res->fetchAll();
        return $data;
        }

    // Funktion til at få alt om en enkelt bruger defineret af ID
    public static function getAllById($conn, $dataID){
       
        $res = $conn->query("SELECT * FROM Users WHERE id= $dataID");
        $data = $res->fetchAll();
        return $data;    
    }

    // Funktion til at få et bestemt username defineret af ID
    public static function getUsernameById($conn, $dataID){
       
        $res = $conn->query("SELECT username FROM Users WHERE id= $dataID");
        $data = $res->fetchAll();
        return $data;    
    }

    // Funktion til at få en bestemt email defineret af ID
    public static function getEmailById($conn, $dataID){
       
        $res = $conn->query("SELECT email FROM Users WHERE id= $dataID");
        $data = $res->fetchAll();
        return $data;    
    }

    // Funktion til at få et bestemt password defineret af ID
    public static function getPasswordById($conn, $dataID){
       
        $res = $conn->query("SELECT passwrd FROM Users WHERE id= $dataID");
        $data = $res->fetchAll();
        return $data;    
    }

    // Funktion til at ændre en bestemt bruger defineret af ID, med nyt navn, email og password. 
    public static function setUserById($conn, $dataID, $name, $email, $password){
        // QUERY MED NAMED PLACEHOLDERS
        $sql = "UPDATE Users SET username = :username, email = :email, passwrd = :passwrd WHERE id= $dataID";
            
        $statement = $conn->prepare($sql);
        $statement->execute(array(':email' => $email, ':passwrd' => $password, ':username' => $name));
    }

    // Funktion til at slette en bestemt bruger defineret af ID
    public static function deleteUserById($conn, $dataID){
        $conn->query("DELETE FROM Users WHERE id = $dataID");
    }

    // Funktion til at tilføje ny bruger med variablerne brugernavn, email og password. 
    // Returnerer desuden en error besked hvis ikke alle felter er udfyldt for at undgå "empty entries". 
    public static function addNewUser($conn, $username, $email, $password){
         // Create prepared statement
        $sql = "INSERT INTO Users (username, email, passwrd) VALUES (:username_var, :email_var, :password_var)";
        $stmt = $conn->prepare($sql);

            // Bind parameters to statement
            $stmt->bindParam(':username_var', $username);
            $stmt->bindParam(':email_var', $email);
            $stmt->bindParam(':password_var', $password);

            if (!$username == "" && !$email == "" && !$password == ""){
                $stmt->execute();
            }
            else{
                $errormsg = "<h3>Der opstod en fejl - husk at udfylde alle felter</h3>";
                return $errormsg;
            }
    }
}  
?>
    
</body>
</html>

