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

    // Выполняем запрос на обновление записи
    $query = "INSERT INTO `role` (`name_role`) VALUES ('$name_role')";
    $result = mysqli_query($connect, $query);

    if ($result) {
        $_SESSION['success_message'] = 'Запись успешно добавлена';
    } else {
        $_SESSION['error_message'] = 'Ошибка при добавлении записи: ' . mysqli_error($connect);
    }

    header("location: ../../role_table.php");
    exit;
}
?>