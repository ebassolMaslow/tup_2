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
    $id_documents = $_POST['id_documents'];
    $email = $_POST['email'];
    $surname = $_POST['surname'];
    $uname = $_POST['uname'];
    $middlename = $_POST['middlename'];
    $birthday = $_POST['birthday'];
    $ugroup = $_POST['ugroup'];
    $document_type = $_POST['document_type'];
    $id_user = $_POST['id_user'];

    $queryTrack = "UPDATE `documents` SET `email` = '$email', `surname` = '$surname', `uname` = '$uname', `middlename` = '$middlename',`birthday` = '$birthday', 
    `ugroup` = '$ugroup', `document_type` = '$document_type', `id_user` = '$id_user' WHERE `id_documents` = '$id_documents'";

    $resProject = mysqli_query($connect, $queryTrack) or die(mysqli_error($connect));

    // echo $queryTrack; // Вывод SQL-запроса для отладки

    if ($resProject) {
        $_SESSION['success_message'] = 'Запись успешно изменена';
        header("location: ../../documents_table.php");
        exit;
    } else {
        $_SESSION['error_message'] = 'Ошибка при обновлении записи';
        header("location: ../../documents_table.php");
        exit;
    }
}
