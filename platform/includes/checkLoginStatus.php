<?php
// start a session
session_start();

if (isset($_SESSION['user'])) { // basicinfo exist in session // from handle login
    $user = $_SESSION['user']; // get basicinfo from session
} else {
    header('Location: login.php'); // redirect to the login page.
}
?>

