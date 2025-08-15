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

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../scss/main.css">
    <title>Таблица роль</title>
    <meta name="robots" content="noindex">
    <link rel="shortcut icon" href="../images/svg/shortcut_icon.svg" type="image/svg">
</head>

<body>
    <header>
        <div class="container_table_header">
            <nav>
                <ul class="main-menu">
                    <li>
                        <a class="main-menu_item logo" href="./profile_admin.php"><img src="../images/svg/logo52px.svg" alt="логотип">туп</a>
                    </li>
                    <li><a class="main-menu_item" href="../profile.php">на сайт</a></li>
                    <li><a class="main-menu_item" href="./documents_table.php">документы</a></li>
                    <li><a class="main-menu_item" href="./profile_admin.php">вопросы</a></li>
                    <li><a class="main-menu_active" href="./role_table.php">роли</a></li>
                    <li><a class="main-menu_item" href="./user_table.php">пользователи</a></li>
                    <li>
                        <?php
                        if (isset($_SESSION['id_user'])) {
                            echo "<a class=\"exit_table\" href=\"../php_handler/exit.php\">
                            <svg id=\"exitIcon\" width=\"30\" height=\"33\" viewBox=\"0 0 30 33\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                <path d=\"M10.6667 5.61106H9.22222C5.81767 5.61106 4.11467 5.61106 3.05733 6.66839C2 7.72573 2 9.42873 2 12.8333V20.0555C2 23.4601 2 25.1616 3.05733 26.2204C4.11467 27.2777 5.81767 27.2777 9.22222 27.2777H10.6667M10.6667 8.46528C10.6667 5.15317 10.6667 3.49639 11.6879 2.59073C12.7091 1.68506 14.2706 1.95661 17.3934 2.50117L20.759 3.08906C24.217 3.69139 25.946 3.99328 26.973 5.2615C28 6.53117 28 8.36561 28 12.0359V20.8543C28 24.5232 28 26.3576 26.9744 27.6273C25.946 28.8955 24.2156 29.1974 20.7576 29.8012L17.3949 30.3876C14.272 30.9322 12.7106 31.2037 11.6893 30.2981C10.6667 29.3924 10.6667 27.7356 10.6667 24.4235V8.46528Z\" stroke=\"black\" stroke-width=\"3\" />
                                <path d=\"M15 15V17.8889\" stroke=\"black\" stroke-width=\"3\" stroke-linecap=\"round\" />
                            </svg>
                        </a>";
                        }
                        ?>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <h1 class="tables_title">Таблица «роли»</h1>
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
    <div class="container_admin">
        <h2 class="add_table_title">Добавление записи</h2>
        <form action="./admin_handler/add/role_add_handler.php" class="role_table__form" method="post" id="role_table__form">
            <div class="div_input_div">
                <label class="label_input_auth">Наименование роли</label>
                <div class="div_input">
                    <input type="text" class="input_form" name="name_role" placeholder="Наименование роли" autocomplete="off" required="required" minlength="4" maxlength="50">
                    <input type="hidden" name="id_role" value="<?php echo $id_role; ?>">
                </div>
            </div>
            <input type="submit" name="submit" class="submit submit_height" value="Добавить запись">
        </form>
        <table class="table_top">
            <tr>
                <th>id_role</th>
                <th>name_role</th>
            </tr>
            <?php
            if (isset($_GET['id_role'])) {
                $trackD = $_GET['id_role'];
                $qDeleteTrack = "DELETE FROM `role` WHERE id_role='$trackD'";

                // Проверка наличия зависимых записей
                $qCheckDependencies = "SELECT COUNT(*) FROM `user` WHERE id_role='$trackD'";
                $resCheckDependencies = mysqli_query($connect, $qCheckDependencies);
                $row = mysqli_fetch_row($resCheckDependencies);
                $dependencyCount = $row[0];

                if ($dependencyCount > 0) {
                    // Зависимые записи существуют, выводим сообщение об ошибке
                    $_SESSION['error_message'] = 'Невозможно удалить роль, так как на нее ссылаются другие записи в таблице user.';
                    header("location: ./role_table.php");
                } else {
                    // Нет зависимых записей, выполняем удаление
                    $resDeleteTrack = mysqli_query($connect, $qDeleteTrack);
                    if ($resDeleteTrack) {
                        $_SESSION['success_message'] = "Запись успешно удалена.";
                        header("location: ./role_table.php");
                    } else {
                        // Возникла другая ошибка при удалении
                        $_SESSION['error_message'] = "Ошибка при удалении записи: " . mysqli_error($connect);
                    }
                }
            }

            $qInfoFavorite = "SELECT * FROM `role`";
            addslashes($qInfoFavorite);
            $resInfoFavorite = mysqli_query($connect, $qInfoFavorite) or die(mysqli_error($connect));
            while ($InfoFavorite = mysqli_fetch_object($resInfoFavorite)) {

                echo "
            <tr>
                <td class=\"td_id\">$InfoFavorite->id_role</td>
                <td class=\"td_question\">$InfoFavorite->name_role</td>
                <td class=\"td_submit td_padding del_btn\">
                    <a href=\"?id_role=$InfoFavorite->id_role\" onclick=\"return confirm('Вы уверены, что хотите удалить запись с id $InfoFavorite->id_role ?');\">
                        <svg width=\"35\" height=\"28\" viewBox=\"0 0 35 28\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                            <path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M12.2884 3.38709H28.2258C29.1241 3.38709 29.9856 3.74395 30.6208 4.37915C31.2561 5.01435 31.6129 5.87587 31.6129 6.77419V20.3226C31.6129 21.2209 31.2561 22.0824 30.6208 22.7176C29.9856 23.3528 29.1241 23.7096 28.2258 23.7096H12.2884C11.7806 23.7095 11.2792 23.5952 10.8215 23.3752C10.3638 23.1551 9.96147 22.8349 9.64423 22.4384L4.05552 15.4542C3.62236 14.9134 3.38633 14.2412 3.38633 13.5484C3.38633 12.8555 3.62236 12.1833 4.05552 11.6426L9.64423 4.65838C9.96099 4.2624 10.3626 3.94259 10.8195 3.72256C11.2764 3.50252 11.7768 3.38788 12.2839 3.38709H12.2884ZM6.99778 2.54258C7.6325 1.74912 8.43758 1.10861 9.3534 0.668484C10.2692 0.228358 11.2723 -0.000110188 12.2884 3.98667e-08H28.2258C30.0224 3.98667e-08 31.7455 0.713707 33.0159 1.98411C34.2863 3.25452 35 4.97756 35 6.77419V20.3226C35 22.1192 34.2863 23.8422 33.0159 25.1126C31.7455 26.383 30.0224 27.0967 28.2258 27.0967H12.2884C11.2723 27.0968 10.2692 26.8684 9.3534 26.4283C8.43758 25.9881 7.6325 25.3476 6.99778 24.5542L1.41133 17.57C0.497756 16.4287 0 15.0103 0 13.5484C0 12.0864 0.497756 10.6681 1.41133 9.52676L6.99778 2.54258ZM16.4387 7.83547C16.1177 7.53633 15.6931 7.37347 15.2543 7.38121C14.8156 7.38895 14.397 7.56669 14.0867 7.87697C13.7764 8.18726 13.5987 8.60587 13.5909 9.04461C13.5832 9.48336 13.746 9.90798 14.0452 10.229L17.3645 13.5484L14.0452 16.8677C13.8788 17.0228 13.7453 17.2097 13.6528 17.4175C13.5602 17.6252 13.5104 17.8495 13.5064 18.0769C13.5024 18.3043 13.5443 18.5301 13.6294 18.741C13.7146 18.9519 13.8414 19.1434 14.0022 19.3043C14.163 19.4651 14.3546 19.5919 14.5654 19.677C14.7763 19.7622 15.0022 19.804 15.2296 19.8C15.457 19.796 15.6812 19.7462 15.889 19.6537C16.0967 19.5611 16.2837 19.4277 16.4387 19.2613L19.7581 15.9419L23.0774 19.2613C23.2325 19.4277 23.4194 19.5611 23.6272 19.6537C23.8349 19.7462 24.0592 19.796 24.2866 19.8C24.514 19.804 24.7398 19.7622 24.9507 19.677C25.1616 19.5919 25.3532 19.4651 25.514 19.3043C25.6748 19.1434 25.8016 18.9519 25.8867 18.741C25.9719 18.5301 26.0137 18.3043 26.0097 18.0769C26.0057 17.8495 25.9559 17.6252 25.8634 17.4175C25.7708 17.2097 25.6374 17.0228 25.471 16.8677L22.1516 13.5484L25.471 10.229C25.7701 9.90798 25.933 9.48336 25.9252 9.04461C25.9175 8.60587 25.7398 8.18726 25.4295 7.87697C25.1192 7.56669 24.7006 7.38895 24.2618 7.38121C23.8231 7.37347 23.3985 7.53633 23.0774 7.83547L19.7581 11.1548L16.4387 7.83547Z\" fill=\"#C31010\" />
                        </svg>
                    </a>
                </td>
                <td class=\"td_submit td_padding edit_btn\">
                    <svg width=\"29\" height=\"29\" viewBox=\"0 0 29 29\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                        <path d=\"M11.0733 13.3194C10.5993 13.794 10.333 14.4374 10.333 15.1082V18.6663H13.9134C14.5842 18.6663 15.2286 18.3997 15.7036 17.9247L26.2587 7.36407C26.4937 7.12909 26.6802 6.85011 26.8074 6.54306C26.9346 6.23602 27 5.90692 27 5.57457C27 5.24221 26.9346 4.91312 26.8074 4.60607C26.6802 4.29903 26.4937 4.02004 26.2587 3.78506L25.2157 2.74205C24.9807 2.50681 24.7016 2.32019 24.3944 2.19286C24.0873 2.06554 23.758 2 23.4255 2C23.093 2 22.7637 2.06554 22.4565 2.19286C22.1494 2.32019 21.8703 2.50681 21.6353 2.74205L11.0733 13.3194Z\" stroke=\"black\" stroke-width=\"3\" stroke-linecap=\"round\" stroke-linejoin=\"round\" />
                        <path d=\"M26.9989 14.4997C26.9989 20.3925 26.9989 23.3382 25.1684 25.1687C23.3379 26.9992 20.3908 26.9992 14.4994 26.9992C8.60665 26.9992 5.66095 26.9992 3.83047 25.1687C2 23.3382 2 20.3912 2 14.4997C2 8.60695 2 5.66125 3.83047 3.83078C5.66095 2.00031 8.60804 2.00031 14.4994 2.00031\" stroke=\"black\" stroke-width=\"3\" stroke-linecap=\"round\" stroke-linejoin=\"round\" />
                    </svg>
                </td>
            </tr> 
            ";
            }
            ?>

        </table>
        <h2 class="add_table_title">Изменение записи</h2>
        <form action="./admin_handler/edit/role_edit_handler.php" class="role_table__form ca_margin" method="post" id="role_table__form_edit">
            <div class="div_input_div">
                <label class="label_input_auth">id_role</label>
                <div class="div_input">
                    <input type="text" class="input_form" readonly name="id_role" placeholder="id_role" autocomplete="off" required minlength="4" maxlength="50" value="<?php echo isset($InfoFavorite->id_role) ? $InfoFavorite->id_role : ""; ?>">
                </div>
            </div>
            <div class="div_input_div">
                <label class="label_input_auth">Наименование роли</label>
                <div class="div_input">
                    <input type="text" class="input_form" name="name_role" placeholder="Наименование роли" autocomplete="off" required="required" minlength="4" maxlength="50" value="<?php echo isset($InfoFavorite->name_role) ? $InfoFavorite->name_role : ""; ?>">
                </div>
            </div>
            <input type="submit" name="submit" class="submit submit_height" value="Изменить запись">
        </form>
    </div>

    <!-- <script src="../js/modal_table_update.js"></script> -->

</body>

<script>
    document.querySelectorAll('.edit_btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var row = this.closest('tr');
            var nameRole = row.querySelector('.td_question').innerText;
            var idRole = row.querySelector('.td_id').innerText;

            document.querySelector('#role_table__form_edit input[name="name_role"]').value = nameRole;
            document.querySelector('#role_table__form_edit input[name="id_role"]').value = idRole;
        });
    });

    document.querySelectorAll('.edit_btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var formEdit = document.getElementById('role_table__form_edit');
            formEdit.scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>

</html>