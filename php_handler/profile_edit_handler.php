<?php
session_start();
include "../php_connect/connect.php";

// Проверка существования сессии пользователя
if (isset($_SESSION['id_user'])) {
    $IDuser = $_SESSION['id_user'];
    if ($IDuser === '') {
        unset($IDuser);
    }
}

// Обработка остальных данных из формы
$qualification = isset($_POST['qualification']) ? $_POST['qualification'] : '';
$ugroup = isset($_POST['ugroup']) ? $_POST['ugroup'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
$specialization = isset($_POST['specialization']) ? $_POST['specialization'] : '';
$surname = isset($_POST['surname']) ? $_POST['surname'] : '';
$course = isset($_POST['course']) ? $_POST['course'] : '';
$uname = isset($_POST['uname']) ? $_POST['uname'] : '';
$login = isset($_POST['login']) ? $_POST['login'] : '';
$middlename = isset($_POST['middlename']) ? $_POST['middlename'] : '';

// Очистка и обновление данных пользователя
$ugroup = trim($_POST['ugroup']);
$email = trim($_POST['email']);
$qualification = trim($_POST['qualification']);
$telephone = trim($_POST['telephone']);
$specialization = trim($_POST['specialization']);
$surname = trim($_POST['surname']);
$course = trim($_POST['course']);
$uname = trim($_POST['uname']);
$login = trim($_POST['login']);
$middlename = trim($_POST['middlename']);

$queryuser = "UPDATE `user` SET 
    `ugroup` = '$ugroup', 
    `email` = '$email', 
    `qualification` = '$qualification', 
    `telephone` = '$telephone', 
    `specialization` = '$specialization', 
    `surname` = '$surname', 
    `course` = '$course', 
    `uname` = '$uname', 
    `login` = '$login', 
    `middlename` = '$middlename' 
    WHERE `id_user` = '$IDuser'";

// Выполнение запроса к базе данных
$resCreateUser = mysqli_query($connect, $queryuser) or die(mysqli_error($connect));

// Проверка успешности обновления данных и перенаправление на страницу профиля
if ($resCreateUser) {
    $_SESSION['success_message'] = 'Данные успешно изменены';
    header("location: ../profile.php");
    exit();
}

header("location: ../profile.php");