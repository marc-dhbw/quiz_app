<?php
session_start();
require_once '../src/auth.php';

$error = '';

/*  TODO:
    Überprüfen Sie hier die eingegeben Login-Daten aus dem Formular indem Sie auth.php nutzen
    - Holen Sie sich die Daten aus dem Formular
    - Rufen Sie die Funktion zur Authentifizierung mit den eingebenen Werten auf
    - Wenn true, loggen Sie den Nutzer ein und leiten ihn weiter zur dashbaord.php
    - Sonst zeigen Sie eine Fehlermeldung an
*/

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize the input values
    $username = ($_POST['username']) ?? '';
    $password = ($_POST['password']) ?? '';

    // Call the authentication function
    if (auth($username, $password)) {
        // Authentication successful
        $_SESSION['user'] = $username; // Store the username in the session

        // Redirect the user to the dashboard
        header('Location: dashboard.php',true,301);
        exit;
    } else {
        // Authentication failed, set the error message
        $error = 'Invalid username or password.';
    }
}
$pageTitle = 'Login';
include 'templates/header.php';



?>
<main>
    <h2>Login</h2>
    <form method="POST">
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
    </form>

    <form method="POST" action="<?=($_SERVER['PHP_SELF'])?>">


    </form>

</main>

<?php
include 'templates/footer.php';
?>
