<?php
// start a session
session_start();

if (isset($_SESSION['teacher'])) { // basicinfo exist in session // from handle login
    $user = $_SESSION['teacher']; // get basicinfo from session
} else {
    header('Location: index.php'); // redirect to the login page.
}
?>

