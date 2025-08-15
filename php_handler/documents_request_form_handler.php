<?php
session_start();

include "../php_connect/connect.php";

if (isset($_SESSION['id_user'])) {
    $IDuser = $_SESSION['id_user'];
    if ($IDuser === '') {
        unset($IDuser);
    }
}

// Получение данных из формы
$email = $_POST['email'];
$surname_docs = $_POST['surname_docs'];
$name_docs = $_POST['name_docs'];
$middlename_docs = $_POST['middlename_docs'];
$date_docs = $_POST['date_docs'];
$group_docs = $_POST['group_docs'];
$document_type = $_POST['document_type'];

if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date_docs)) {
    $_SESSION['error_message'] = "Неверный формат даты. Пожалуйста, введите дату в формате ГГГГ-ММ-ДД.";
    header("location: ../documents.php?error=invalid_date_format");
    exit;
}

// Подготовленный запрос для добавления данных в таблицу "documents"
$stmt = $connect->prepare("INSERT INTO documents (email, surname, uname, middlename, birthday, ugroup, document_type, id_user) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssi", $email, $surname_docs, $name_docs, $middlename_docs, $date_docs, $group_docs, $document_type, $IDuser);

// Выполнение подготовленного запроса
if ($stmt->execute()) {
    $_SESSION['success_message'] = "Документы заказаны";
    header("location: ../documents.php?success=referenc _added");
    exit;
} else {
    $_SESSION['error_message'] = "Ошибка при отправке формы";
    header("location: ../documents.php?error=reference_not_added");
    exit;
}

// Закрытие подготовленного запроса и соединения с базой данных
$stmt->close();
$connect->close();

header("location: ../documents.php");