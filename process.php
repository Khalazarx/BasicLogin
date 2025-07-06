<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check_username = "admin";
    $check_password = "darkside";

    if ($username == $check_username && $password == $check_password) {
        echo "<script>alert('Login Berhasil!'); window.location.href='index.php';</script>";
        session_start();
        $_SESSION['username'] = $username;
        exit();
    } else {
        echo "<script>alert('Login Gagal!'); window.location.href='login.php';</script>";
        exit();
    }
        header("Location: login.php");
        exit();
    }

?>

