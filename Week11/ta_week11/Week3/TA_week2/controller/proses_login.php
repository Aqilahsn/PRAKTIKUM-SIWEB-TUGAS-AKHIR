<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if ($username == "admin" && $password == "admin123") {

    $_SESSION['login'] = true;
    $_SESSION['user']  = $username;

    if (isset($_POST['remember'])) {
        setcookie('username', $username, time() + 3600, "/");
    } else {
        setcookie('username', '', time() - 3600, "/");
    }

    header("Location: ../index.html");
    exit;

} else {
    header("Location: ../login.php?error=Username atau password salah!");
    exit;
}
?>