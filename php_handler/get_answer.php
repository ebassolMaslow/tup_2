<?php

session_start();

include "../php_connect/connect.php";
// Получаем questionId из запроса
$questionId = $_GET['questionId'];

// Выполняем SQL-запрос для получения ответа из базы данных
$qGetAnswer = "SELECT answer FROM question WHERE id_question = $questionId";
$resGetAnswer = mysqli_query($connect, $qGetAnswer) or die(mysqli_error($connect));

// Возвращаем текст ответа в качестве ответа на запрос
if ($row = mysqli_fetch_assoc($resGetAnswer)) {
  echo $row['answer'];
} else {
  echo 'Ответ не найден';
}