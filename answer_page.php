<?php
session_start();
include "./php_connect/connect.php";
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./scss/main.css">
    <title>Ответ на вопрос</title>
    <meta name="robots" content="noindex">
    <link rel="shortcut icon" href="./images/svg/shortcut_icon.svg" type="image/svg">
</head>

<body>
    <div class="container_answer">
        <?php
        if (isset($_GET['id'])) {
            $questionId = $_GET['id'];

            // Получение информацию о вопросе из базы данных
            $query = "SELECT question.*, user.login, question.email, question.qtime
              FROM question 
              JOIN user ON question.id_user = user.id_user
              WHERE question.id_question = $questionId";
            $result = mysqli_query($connect, $query);
            $question = mysqli_fetch_assoc($result);
        ?>
            <table class="profile_admin_margin">
                <tr>
                    <th>id</th>
                    <th>Вопрос</th>
                    <th>Кто задал вопрос</th>
                    <th>Дата и время вопроса</th>
                </tr>
            <?php

            echo "<form action=\"./php_handler/answer_handler.php\" method=\"post\">";
            echo "<tr>";
            echo "<td class=\"td_id\">" . $question['id_question'] . "</td>";
            echo "<td class=\"td_question\">" . $question['question_text'] . "</td>";
            echo "<td class=\"td_email\">Почта: " . $question['email'] . " Пользователь:" . $question['login'] . "</td>";
            echo "<td class=\"td_email\">" . $question['qtime'] . "</td>";
            echo "</tr>";
            echo "</table>";
            echo "<textarea required class=\"textarea_answer\" placeholder=\"Ответ на вопрос\" name=\"answer\" rows=\"4\" cols=\"50\"></textarea><br>";
            echo "<input type=\"submit\" value=\"Отправить ответ\" class=\"submit_answer\">";
            echo "<input type=\"hidden\" name=\"question_id\" value=\"" . $questionId . "\">";
            echo "</form>";
        } else {
            echo "Идентификатор вопроса не указан";
        }
            ?>

            <a href="./admin/profile_admin.php" class="reset-pass-text back_to_main margin_auto">
                <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 3.55838V0.999379C7.99968 0.801756 7.94087 0.60865 7.83098 0.444396C7.72109 0.280141 7.56504 0.152089 7.3825 0.0763769C7.19996 0.000664301 6.99909 -0.0193211 6.8052 0.0189399C6.61132 0.057201 6.4331 0.151996 6.293 0.291378L0 6.49938L6.293 12.7064C6.38565 12.7996 6.49581 12.8735 6.61715 12.924C6.73848 12.9744 6.86859 13.0004 7 13.0004C7.13141 13.0004 7.26152 12.9744 7.38285 12.924C7.50419 12.8735 7.61435 12.7996 7.707 12.7064C7.79991 12.6136 7.87361 12.5034 7.92389 12.382C7.97416 12.2607 8.00003 12.1307 8 11.9994V9.51038C10.75 9.57838 13.755 10.0764 16 13.4994V12.4994C16 7.86638 12.5 4.05638 8 3.55838Z" fill="black" />
                </svg>вернуться к таблице ответа на вопрос</a>
    </div>
</body>

</html>