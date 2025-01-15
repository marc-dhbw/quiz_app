<?php
// TODO: Definieren Sie hier eine Funktion zum Aufbau einer Connection zu Ihrer lokalen DB mittels PDO und geben Sie die Connection zurück
//
function getDBConnection() : PDO
{

    $server = "mariadb";
    $dbname = "quiz_db";
    $username = "user";
    $password = "password";

    try {

        $conn = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }catch(PDOException $e){
        die("Verbindung fehlgeschlagen: " . $e->getMessage());
    }
}

?>
