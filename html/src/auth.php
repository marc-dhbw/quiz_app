<?php
/*  TODO: Definieren Sie hier eine Funktion zur Authentifizierung des Nutzers mit Benutzername und Passwort.
    - Bauen Sie hierfür eine Verbindung zur Datenbank auf (Nutzung von db.php)
    - Holen Sie sich aus der Datenbank den Passwort-Hash zum angegebenen Nutzer und vergleichen diesen mit dem eingegebenen Hash
    Hinweis: Denken Sie an prepared Statements!
    Wenn Hashes übereinstimmen, true zurückgeben
    Andernfalls false zurückgeben
*/

require_once '../src/db.php';

function auth($username,$password) : bool {
    $conn = getDBConnection();

    $stmt = $conn->prepare("SELECT password_hash FROM users WHERE name = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC); 

    return $user && hash_equals($user['password_hash'], hash('sha256',$password));
    
}

?>
