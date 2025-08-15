<?php

session_start();

include "../php_connect/connect.php";

if (isset($_POST['login'])) {
    $login = $_POST['login'];
    if ($login === '') {
        unset($login);
    }
}

if (isset($_POST['password'])) {
    $password = $_POST['password'];
    if ($password === '') {
        unset($password);
    }
}

$login = trim($_POST['login']);
$password = trim($_POST['password']);

$stmt = mysqli_prepare($connect, "SELECT * FROM `user` WHERE `login`= ?");
mysqli_stmt_bind_param($stmt, "s", $login);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$info_user = mysqli_fetch_array($result, MYSQLI_ASSOC);

if (empty($info_user['id_user']) || !password_verify($password, $info_user['password'])) {
    $_SESSION['message'] = "Неправильный логин или пароль";
    header("location: ../index_auth.php");
} else {
    $_SESSION['login'] = $info_user['login'];
    $_SESSION['id_user'] = $info_user['id_user'];
    if (empty($info_user['secret_key'])) {
        header("location: ../profile.php");
    } else {
        header("location: ../index_auth.php");
    }
}
