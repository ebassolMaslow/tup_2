<?php
session_start();

include "../php_connect/connect.php";

if (isset($_SESSION['id_user'])) {
    $IDuser = $_SESSION['id_user'];
    if ($IDuser === '') {
        unset($IDuser);
    }
}

if (isset($IDuser)) {
    $query_access = "SELECT * FROM user, role WHERE id_user = '$IDuser' AND user.id_role = role.id_role";
    addslashes($query_access);
    $res_access = mysqli_query($connect, $query_access);
    $row_access = mysqli_fetch_object($res_access);

    $role_name = $row_access->name_role;

    if ($role_name !== 'Администратор') {
        $_SESSION['error_message'] = 'Доступ есть только у администраторов';
        header("location: ../index.php");
        exit();
    }
}

if (isset($_GET['id_question'])) {
    $trackD = $_GET['id_question'];
    $qDeleteTrack = "DELETE FROM `question` WHERE id_question='$trackD'";
    addslashes($qDeleteTrack);
    $resDeleteTrack = mysqli_query($connect, $qDeleteTrack);

    if ($resDeleteTrack) {
        $_SESSION['success_message'] = 'Запись успешно удалена';
        header("location: ./profile_admin.php");
        exit();
    } else {
        $_SESSION['error_message'] = 'Ошибка при удалении записи';
        header("location: ./profile_admin.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../scss/main.css">
    <title>Профиль Администратора</title>
    <meta name="robots" content="noindex">
    <link rel="shortcut icon" href="../images/svg/shortcut_icon.svg" type="image/svg">
</head>

<body>
    <header>
        <div class="container_header_admin">
            <nav>
                <ul class="main-menu">
                    <li>
                        <a class="main-menu_item logo" href="./profile_admin.php"><img src="../images/svg/logo52px.svg" alt="логотип">туп</a>
                    </li>
                    <li><a class="main-menu_item" href="../profile.php">на сайт</a></li>
                    <li><a class="main-menu_item" href="./role_table.php">к таблицам</a></li>

                    <?php
                    session_start();

                    if (isset($_SESSION['id_user'])) {
                        echo "<a class=\"main-menu_item_exit\" href=\"../php_handler/exit.php\">
                            <svg id=\"exitIcon\" width=\"30\" height=\"33\" viewBox=\"0 0 30 33\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                <path d=\"M10.6667 5.61106H9.22222C5.81767 5.61106 4.11467 5.61106 3.05733 6.66839C2 7.72573 2 9.42873 2 12.8333V20.0555C2 23.4601 2 25.1616 3.05733 26.2204C4.11467 27.2777 5.81767 27.2777 9.22222 27.2777H10.6667M10.6667 8.46528C10.6667 5.15317 10.6667 3.49639 11.6879 2.59073C12.7091 1.68506 14.2706 1.95661 17.3934 2.50117L20.759 3.08906C24.217 3.69139 25.946 3.99328 26.973 5.2615C28 6.53117 28 8.36561 28 12.0359V20.8543C28 24.5232 28 26.3576 26.9744 27.6273C25.946 28.8955 24.2156 29.1974 20.7576 29.8012L17.3949 30.3876C14.272 30.9322 12.7106 31.2037 11.6893 30.2981C10.6667 29.3924 10.6667 27.7356 10.6667 24.4235V8.46528Z\" stroke=\"black\" stroke-width=\"3\" />
                                <path d=\"M15 15V17.8889\" stroke=\"black\" stroke-width=\"3\" stroke-linecap=\"round\" />
                            </svg>
                        </a>";
                    }

                    ?>

                </ul>
            </nav>
        </div>
    </header>
    <div class="margin_top_q">
        <?php
        session_start();
        if (isset($_SESSION['success_message'])) {
            echo "<div class='success-message'>" . $_SESSION['success_message'] . "</div>";
            unset($_SESSION['success_message']); // Удаление сообщения после его показа
        }
        if (isset($_SESSION['error_message'])) {
            echo "<div class='error-message'>" . $_SESSION['error_message'] . "</div>";
            unset($_SESSION['error_message']); // Удаление сообщения после его показа
        }
        ?>
    </div>
    <div class="container_admin">
        <table class="profile_admin_top">
            <tr>
                <th>id</th>
                <th>Вопрос</th>
                <th>Ответ на вопрос</th>
                <th>Кто задал вопрос</th>
                <th>Дата и время вопроса</th>
            </tr>
            <?php
            $qInfoFavorite = "SELECT * FROM question, user WHERE question.id_user = user.id_user";
            addslashes($qInfoFavorite);
            $resInfoFavorite = mysqli_query($connect, $qInfoFavorite) or die(mysqli_error($connect));
            while ($InfoFavorite = mysqli_fetch_object($resInfoFavorite)) {

                echo "
        <tr>
            <td class=\"td_id\">$InfoFavorite->id_question</td>
            <td class=\"td_question\">$InfoFavorite->question_text</td>
            <td class=\"td_question\">$InfoFavorite->answer</td>
            <td class=\"td_email\">Почта: $InfoFavorite->email Пользователь:$InfoFavorite->login</td>
            <td class=\"td_email\">$InfoFavorite->qtime</td>
            <td class=\"td_submit\"><a href=\"../answer_page.php?id=$InfoFavorite->id_question\" class=\"submit_table\">Ответить</a></td>
            <td class=\"td_submit td_padding del_btn\">
            <a href=\"?id_question=$InfoFavorite->id_question\" onclick=\"return confirm('Вы уверены, что хотите удалить запись с id $InfoFavorite->id_question ?');\">
                <svg width=\"35\" height=\"28\" viewBox=\"0 0 35 28\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                    <path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M12.2884 3.38709H28.2258C29.1241 3.38709 29.9856 3.74395 30.6208 4.37915C31.2561 5.01435 31.6129 5.87587 31.6129 6.77419V20.3226C31.6129 21.2209 31.2561 22.0824 30.6208 22.7176C29.9856 23.3528 29.1241 23.7096 28.2258 23.7096H12.2884C11.7806 23.7095 11.2792 23.5952 10.8215 23.3752C10.3638 23.1551 9.96147 22.8349 9.64423 22.4384L4.05552 15.4542C3.62236 14.9134 3.38633 14.2412 3.38633 13.5484C3.38633 12.8555 3.62236 12.1833 4.05552 11.6426L9.64423 4.65838C9.96099 4.2624 10.3626 3.94259 10.8195 3.72256C11.2764 3.50252 11.7768 3.38788 12.2839 3.38709H12.2884ZM6.99778 2.54258C7.6325 1.74912 8.43758 1.10861 9.3534 0.668484C10.2692 0.228358 11.2723 -0.000110188 12.2884 3.98667e-08H28.2258C30.0224 3.98667e-08 31.7455 0.713707 33.0159 1.98411C34.2863 3.25452 35 4.97756 35 6.77419V20.3226C35 22.1192 34.2863 23.8422 33.0159 25.1126C31.7455 26.383 30.0224 27.0967 28.2258 27.0967H12.2884C11.2723 27.0968 10.2692 26.8684 9.3534 26.4283C8.43758 25.9881 7.6325 25.3476 6.99778 24.5542L1.41133 17.57C0.497756 16.4287 0 15.0103 0 13.5484C0 12.0864 0.497756 10.6681 1.41133 9.52676L6.99778 2.54258ZM16.4387 7.83547C16.1177 7.53633 15.6931 7.37347 15.2543 7.38121C14.8156 7.38895 14.397 7.56669 14.0867 7.87697C13.7764 8.18726 13.5987 8.60587 13.5909 9.04461C13.5832 9.48336 13.746 9.90798 14.0452 10.229L17.3645 13.5484L14.0452 16.8677C13.8788 17.0228 13.7453 17.2097 13.6528 17.4175C13.5602 17.6252 13.5104 17.8495 13.5064 18.0769C13.5024 18.3043 13.5443 18.5301 13.6294 18.741C13.7146 18.9519 13.8414 19.1434 14.0022 19.3043C14.163 19.4651 14.3546 19.5919 14.5654 19.677C14.7763 19.7622 15.0022 19.804 15.2296 19.8C15.457 19.796 15.6812 19.7462 15.889 19.6537C16.0967 19.5611 16.2837 19.4277 16.4387 19.2613L19.7581 15.9419L23.0774 19.2613C23.2325 19.4277 23.4194 19.5611 23.6272 19.6537C23.8349 19.7462 24.0592 19.796 24.2866 19.8C24.514 19.804 24.7398 19.7622 24.9507 19.677C25.1616 19.5919 25.3532 19.4651 25.514 19.3043C25.6748 19.1434 25.8016 18.9519 25.8867 18.741C25.9719 18.5301 26.0137 18.3043 26.0097 18.0769C26.0057 17.8495 25.9559 17.6252 25.8634 17.4175C25.7708 17.2097 25.6374 17.0228 25.471 16.8677L22.1516 13.5484L25.471 10.229C25.7701 9.90798 25.933 9.48336 25.9252 9.04461C25.9175 8.60587 25.7398 8.18726 25.4295 7.87697C25.1192 7.56669 24.7006 7.38895 24.2618 7.38121C23.8231 7.37347 23.3985 7.53633 23.0774 7.83547L19.7581 11.1548L16.4387 7.83547Z\" fill=\"#C31010\" />
                </svg>
            </a>
        </td>
        </tr> 
";
            }
            ?>

        </table>
    </div>

</body>

</html>