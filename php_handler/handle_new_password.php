<?php
session_start();
include "../php_connect/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = isset($_POST['new_password']) ? mysqli_real_escape_string($connect, $_POST['new_password']) : '';
    $confirmPassword = isset($_POST['confirm_password']) ? mysqli_real_escape_string($connect, $_POST['confirm_password']) : '';

    if ($newPassword !== '' && $newPassword === $confirmPassword) {
        $token = isset($_POST['reset_token']) ? mysqli_real_escape_string($connect, $_POST['reset_token']) : '';

        $checkTokenQuery = "SELECT id_user, password FROM user WHERE reset_token = '$token' AND reset_requested_at > DATE_SUB(NOW(), INTERVAL 1 DAY)";
        $tokenResult = mysqli_query($connect, $checkTokenQuery);

        if ($tokenResult && mysqli_num_rows($tokenResult) > 0) {
            $row = mysqli_fetch_assoc($tokenResult);
            $userID = $row['id_user'];
            $hashedPassword = $row['password'];

            if (password_verify($newPassword, $hashedPassword)) {
                $_SESSION['message'] = 'Новый пароль не может быть таким же, как старый пароль';
                header("location: ../new_password.php");
                exit();
            }

            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $updatePasswordQuery = "UPDATE user SET `password`='$hashedPassword', reset_token=NULL WHERE id_user='$userID'";
            $result = mysqli_query($connect, $updatePasswordQuery);

            if ($result) {
                $_SESSION['success_message'] = 'Пароль успешно изменен';
                header("location: ../index_auth.php");
                exit();
            } else {
                $_SESSION['message'] = 'Ошибка при обновлении пароля';
                header("location: ../new_password.php");
                exit();
            }
        } else {
            $_SESSION['message'] = 'Неверный или просроченный токен сброса пароля';
            header("location: ../new_password.php");
            exit();
        }
    } else {
        $_SESSION['message'] = 'Пустой токен или пароли не совпадают';
        header("location: ../new_password.php");
        exit();
    }
}