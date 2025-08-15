<?php
session_start();
include "../php_connect/connect.php";

if (isset($_POST['submit'])) {
    if (isset($_POST['login'])) {
        $login = $_POST['login'];
        if ($login === '') {
            unset($login);
        }
    }

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        if ($email === '') {
            unset($email);
        }
    }

    if (isset($_POST['password'])) {
        $password = $_POST['password'];
        if ($password === '') {
            unset($password);
        }
    }

    if (isset($_POST['confirmpassword'])) {
        $confirmpassword = $_POST['confirmpassword'];
        if ($confirmpassword === '') {
            unset($confirmpassword);
        }
    }

    if (isset($_POST['h-captcha-response'])) {
        $recapcha = $_POST['h-captcha-response'];

        if (!$recapcha) {
            $_SESSION['message'] = 'Пожалуйста, подтвердите, что вы не робот';
            header("location: ../index_reg.php");
            exit();
        } else {
            $secretKey = 'ES_143389a39e094b118fcd942f81622ab5';
            $url = 'https://hcaptcha.com/siteverify?secret=' . $secretKey . '&response=' . $recapcha;
            $response = file_get_contents($url);
            $responseKey = json_decode($response, true);

            if ($responseKey['success']) {

                $login = trim($_POST['login']);
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
                $confirmpassword = trim($_POST['confirmpassword']);

                $hash = password_hash($password, PASSWORD_DEFAULT);

                $check_login_user = "SELECT * FROM `user` WHERE login = '$login'";
                $result_check = mysqli_query($connect, $check_login_user);
                $check_login = mysqli_fetch_array($result_check);

                if (!empty($check_login['id_user'])) {
                    $_SESSION['message'] = 'Данный логин уже занят';
                    header("location: ../index_reg.php");
                    exit();
                } else {
                    $reg_user = "INSERT INTO `user` (login, email, password, id_role, profile_photo, job_title, course) VALUES ('$login', '$email', '$hash','2','default.jpg','Студент','1')";
                    if (password_verify($confirmpassword, $hash)) {
                        $result = mysqli_query($connect, $reg_user);
                        if ($result) {
                            header("location: ../index_auth.php");
                            exit();
                        } else {
                            $_SESSION['message'] = 'Ошибка регистрации';
                            header("location: ../index_reg.php");
                            exit();
                        }
                    } else {
                        $_SESSION['message'] = 'Пароль и подтверждение пароля не совпадают';
                        header("location: ../index_reg.php");
                        exit();
                    }
                }
            } else {
                $_SESSION['message'] = 'Ошибка проверки hCaptcha';
                header("location: ../index_reg.php");
                exit();
            }
        }
    }
}
