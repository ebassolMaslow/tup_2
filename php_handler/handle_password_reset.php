<?php
session_start();
include "../php_connect/connect.php";

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Проверка существования пользователя с указанным email в базе данных
    $check_user = "SELECT * FROM `user` WHERE `email`= '$email'";
    $result = mysqli_query($connect, $check_user);

    if (mysqli_num_rows($result) > 0) {
        $token = bin2hex(random_bytes(32)); // Генерация случайного токена
        $reset_requested_at = date('Y-m-d H:i:s'); // Получение текущей даты и времени

        $insert_token = "UPDATE `user` SET `reset_token`='$token', `reset_requested_at`='$reset_requested_at' WHERE `email`='$email'";
        $update_result = mysqli_query($connect, $insert_token);

        if ($update_result) {
            $reset_link = "http://localhost/tup/new_password.php?token=$token";
            $to = $email;
            $subject = "Сброс пароля";
            $message = "Для сброса пароля перейдите по ссылке: $reset_link";
            mail($to, $subject, $message);

            $_SESSION['message'] = "Инструкции по сбросу пароля отправлены на ваш email";
            header("location: ../reset_password.php");
            exit();
        } else {
            $_SESSION['message'] = "Ошибка при генерации ссылки для сброса пароля";
            header("location: ../reset_password.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Пользователь с таким email не найден";
        header("location: ../reset_password.php");
        exit();
    }
}