<?php
session_start();
include "../../../php_connect/connect.php";

if (isset($_SESSION['id_user'])) {
    $IDuser = $_SESSION['id_user'];
    if ($IDuser === '') {
        unset($IDuser);
    }
}

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

if (isset($_POST['surname'])) {
    $surname = $_POST['surname'];
    if ($surname === '') {
        unset($surname);
    }
}

if (isset($_POST['uname'])) {
    $uname = $_POST['uname'];
    if ($uname === '') {
        unset($uname);
    }
}

if (isset($_POST['middlename'])) {
    $middlename = $_POST['middlename'];
    if ($middlename === '') {
        unset($middlename);
    }
}

if (isset($_POST['ugroup'])) {
    $ugroup = $_POST['ugroup'];
    if (strlen($ugroup) > 10) {
        $_SESSION['error_message'] = "Максимальное количество символов 10";
        header("location: ../profile_edit.php");
    } else {
        $ugroup = $ugroup;
    }
}

if (isset($_POST['specialization'])) {
    $specialization = $_POST['specialization'];
    if ($specialization === '') {
        unset($specialization);
    }
}

if (isset($_POST['qualification'])) {
    $qualification = $_POST['qualification'];
    if (strlen($qualification) > 15) {
        $_SESSION['error_message'] = "Максимальное количество символов 15";
        header("location: ../profile_edit.php");
    } else {
        $qualification = $qualification;
    }
}

if (isset($_POST['course'])) {
    $course = $_POST['course'];
    if ($course === '') {
        unset($course);
    }
}

if (isset($_POST['telephone'])) {
    $telephone = $_POST['telephone'];
    if ($telephone === '') {
        unset($telephone);
    }
}

if (isset($_POST['job_title'])) {
    $job_title = $_POST['job_title'];
    if ($job_title === '') {
        unset($job_title);
    }
}

if (isset($_POST['name_role'])) {
    $name_role = $_POST['name_role'];
    if ($name_role === '') {
        unset($name_role);
    }
}

$login = trim($_POST['login']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$confirmpassword = trim($_POST['confirmpassword']);

$hash = password_hash($password, PASSWORD_DEFAULT);
$surname = trim($_POST['surname']);
$uname = trim($_POST['uname']);
$middlename = trim($_POST['middlename']);
$ugroup = trim($_POST['ugroup']);
$specialization = trim($_POST['specialization']);
$qualification = trim($_POST['qualification']);
$course = trim($_POST['course']);
$telephone = trim($_POST['telephone']);
$job_title = trim($_POST['job_title']);
$name_role = trim($_POST['name_role']);

$check_login_user = "SELECT * FROM `user` WHERE login = '$login'";
$result_check = mysqli_query($connect, $check_login_user);
$check_login = mysqli_fetch_array($result_check);

if (!empty($check_login['id_user'])) {
    $_SESSION['message'] = 'Данный логин уже занят';
    header("location: ../../user_table.php");
    exit();
} else {
    if (password_verify($confirmpassword, $hash)) {
        $query = "INSERT INTO `user` (`login`,`email`,`password`,`surname`,`uname`,`middlename`,`ugroup`,`specialization`,`qualification`,`course`,`telephone`,`job_title`,`id_role`) VALUES ";
        $query .= "('$login',";
        $query .= $email ? "'$email'," : "NULL,";
        $query .= $hash ? "'$hash'," : "NULL,";
        $query .= $surname ? "'$surname'," : "NULL,";
        $query .= $uname ? "'$uname'," : "NULL,";
        $query .= $middlename ? "'$middlename'," : "NULL,";
        $query .= $ugroup ? "'$ugroup'," : "NULL,";
        $query .= $specialization ? "'$specialization'," : "NULL,";
        $query .= $qualification ? "'$qualification'," : "NULL,";
        $query .= $course ? "'$course'," : "NULL,";
        $query .= $telephone ? "'$telephone'," : "NULL,";
        $query .= $job_title ? "'$job_title'," : "NULL,";
        $query .= $name_role ? "'$name_role')" : "NULL)";

        $result = mysqli_query($connect, $query);
        if ($result) {
            $_SESSION['success_message'] = 'Запись успешно добавлена';
            header("location: ../../user_table.php");
            exit;
        } else {
            $_SESSION['error_message'] = 'Ошибка при добавлении записи: ' . mysqli_error($connect);
            header("location: ../../user_table.php");
            exit;
        }
    } else {
        $_SESSION['error_message'] = 'Пароль и подтверждение пароля не совпадают';
        header("location: ../../user_table.php");
        exit;
    }
}
if ($result) {
    $_SESSION['success_message'] = 'Запись успешно добавлена';
} else {
    $_SESSION['error_message'] = 'Ошибка при добавлении записи: ' . mysqli_error($connect);
}

header("location: ../../user_table.php");
exit;