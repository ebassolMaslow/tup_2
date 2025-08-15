<?php
session_start();

include "../php_connect/connect.php";

if (isset($_SESSION['id_user'])) {
    $IDuser = $_SESSION['id_user'];
    if (isset($_POST['answer']) && !empty($_POST['answer'])) {
        if (isset($_POST['question_id']) && !empty($_POST['question_id'])) {
            $questionId = mysqli_real_escape_string($connect, $_POST['question_id']);
            $answer = mysqli_real_escape_string($connect, $_POST['answer']);
            
            $query = "UPDATE `question` SET `answer` = '$answer', `question_status` = 'Посмотреть ответ' WHERE `id_question` = '$questionId'";
            $resUpdateQuestion = mysqli_query($connect, $query);

            if ($resUpdateQuestion) {
                header("location: ../admin/profile_admin.php");
                exit;
            } else {
                echo "Error updating question: " . mysqli_error($connect);
            }
        } else {
            echo "Answer is empty";
        }
    } else {
        echo "User ID is not set";
    }
} else {
    echo "Идентификатор вопроса пуст";
}