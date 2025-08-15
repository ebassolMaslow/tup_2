<?php
session_start();

include "../php_connect/connect.php";

if (isset($_SESSION['id_user'])) {
    $IDuser = $_SESSION['id_user'];
    if ($IDuser === '') {
        unset($IDuser);
    }
}

if (empty($_POST['question_text'])) {
    // Если поле вопроса пустое, добавьте здесь код для отображения сообщения об ошибке
    header("location: ../help_and_support.php?error=empty_question");
    exit;
}

// Получение данных из формы
$question_text = $_POST['question_text'];
$email = $_POST['email'];
$qtime = date("Y-m-d H:i:s");

$stmt = $connect->prepare("INSERT INTO question (question_text, email, qtime, question_status, id_user) VALUES (?, ?, ?, ?, ?)");
$status = 'Ожидается ответ';
$stmt->bind_param("ssssi", $question_text, $email, $qtime, $status, $IDuser);

if ($stmt->execute()) {
    // Вопрос успешно добавлен
    // Добавим код для отображения сообщения об успешном добавлении вопроса
    $_SESSION['success_message'] = "Ваш вопрос отправлен, вам ответят в течение дня!";
    header("location: ../help_and_support.php?success=question_added");
    exit;
} else {
    // Альтернативное сообщение, если сохранение в базу данных не удалось
    $_SESSION['error_message'] = "Ошибка при отправке вопроса, может слишком много символов?";
    header("location: ../help_and_support.php?error=question_not_added");
    exit;
}

// Закрытие подготовленного запроса и соединения с базой данных
$stmt->close();
$connect->close();

header("location: ../help_and_support.php");