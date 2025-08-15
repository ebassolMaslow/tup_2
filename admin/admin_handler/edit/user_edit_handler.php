<?php
session_start();
include "../../../php_connect/connect.php";

if (isset($_SESSION['id_user'])) {
    $IDuser = $_SESSION['id_user'];
    if ($IDuser === '') {
        unset($IDuser);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST['id_user'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $surname = $_POST['surname'];
    $uname = $_POST['uname'];
    $middlename = $_POST['middlename'];
    $ugroup = $_POST['ugroup'];
    $specialization = $_POST['specialization'];
    $qualification = $_POST['qualification'];
    $course = $_POST['course'];
    $telephone = $_POST['telephone'];
    $job_title = $_POST['job_title'];
    $name_role = $_POST['name_role'];

    if (
        empty($id_user) || empty($login) || empty($email) ||  empty($name_role)
    ) {
        $_SESSION['error_message'] = 'Пожалуйста, заполните все обязательные поля.';
        header("location: ../../user_table.php");
        exit;
    }

    $queryTrack = "UPDATE `user` SET `login` = '$login', `email` = '$email', `surname` = '$surname', `uname` = '$uname', `middlename` = '$middlename', 
    `ugroup` = '$ugroup', `specialization` = '$specialization', `qualification` = '$qualification', `course` = '$course', `telephone` = '$telephone', 
    `job_title` = '$job_title', `id_role` = '$name_role' WHERE `id_user` = '$id_user'";

    $resProject = mysqli_query($connect, $queryTrack) or die(mysqli_error($connect));

    // echo $queryTrack; // Вывод SQL-запроса для отладки

    if ($resProject) {
        $_SESSION['success_message'] = 'Запись успешно изменена';
        header("location: ../../user_table.php");
        exit;
    } else {
        $_SESSION['error_message'] = 'Ошибка при обновлении записи';
        header("location: ../../user_table.php");
        exit;
    }
}