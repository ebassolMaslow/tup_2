<?php
session_start();
include "../../../php_connect/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверяем, был ли передан идентификатор роли
    if (!isset($_POST['id_role'])) {
        $_SESSION['error_message'] = 'Не передан идентификатор роли';
        header("location: ../../role_table.php");
        exit;
    }

    // Проверяем, были ли переданы данные для обновления
    if (!isset($_POST['name_role']) || empty($_POST['name_role'])) {
        $_SESSION['error_message'] = 'Поле "Наименование роли" не может быть пустым';
        header("location: ../../role_table.php");
        exit;
    }

    // Получаем данные из формы
    $id_role = $_POST['id_role'];
    $name_role = $_POST['name_role'];
    if ($id_role == ""){
        $_SESSION['error_message'] = 'Необходимо выбрать запись';
        header("location: ../../role_table.php");
        exit();
    }
    // Выполняем запрос на обновление записи
    $queryTrack = "UPDATE `role` SET `name_role` = '$name_role' WHERE `id_role` = '$id_role'";
    addslashes($queryTrack);
    $resProject = mysqli_query($connect, $queryTrack) or die(mysqli_error($connect));

    if ($resProject) {
        $_SESSION['success_message'] = 'Запись успешно изменена';
    }
    
    header("location: ../../role_table.php");
    exit;
}