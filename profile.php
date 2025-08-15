<?php
session_start();

include "./php_connect/connect.php";

if (isset($_SESSION['id_user'])) {
    $IDuser = $_SESSION['id_user'];
    if ($IDuser === '') {
        unset($IDuser);
    }
}

if (!isset($_SESSION['id_user'])) {
    header("Location: ./index_auth.php");
    exit;
}

$qInfoUser = "SELECT * FROM user WHERE id_user='$IDuser'";
addslashes($qInfoUser);
$resInfoUser = mysqli_query($connect, $qInfoUser) or die(mysqli_error($connect));
$InfoUser = mysqli_fetch_object($resInfoUser);

if (isset($IDuser)) {
    $query_access = "SELECT * FROM `user`, `role` role WHERE id_user = '$IDuser' AND user.id_role = role.id_role";
    addslashes($query_access);
    $res_access = mysqli_query($connect, $query_access);
    $row_access = mysqli_fetch_object($res_access);
    $roles = $row_access->name_role;
} else {
    $_SESSION['message'] = 'Доступ закрыт для неавторизованных пользователях!';
    header("location: ./index-auth.php");
}

// Обработка отправленной формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Проверка наличия файла и его загрузки
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['photo']['tmp_name'];
        $file_name = $_FILES['photo']['name'];
        // Создание уникального имени файла
        $new_file_name = uniqid() . "_" . $file_name;
        // Папка для сохранения фотографии
        $upload_dir = "./profile_images/";
        // Удаление предыдущей фотографии пользователя
        $existing_photo = $InfoUser->profile_photo;
        if ($existing_photo !== null && file_exists($upload_dir . $existing_photo)) {
            unlink($upload_dir . $existing_photo);
        }
        // Сохранение фотографии на сервере
        move_uploaded_file($file_tmp, $upload_dir . $new_file_name);
        // Обновление поля profile_photo в таблице user
        $sql = "UPDATE user SET profile_photo = '$new_file_name' WHERE id_user = '$IDuser'";
        if ($connect->query($sql) === TRUE) {
            // Перенаправление на страницу профиля
            header("Location: ./profile.php");
            exit(); // Убедитесь, что дальнейшее выполнение скрипта прекращено
        } else {
            echo "Ошибка: " . $sql . "<br>" . $connect->error;
        }
    } else {
        echo "Ошибка при загрузке файла";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="scss/main.css">
    <title>Профиль студента | Технологический университет программирования</title>
    <link rel="shortcut icon" href="./images/svg/shortcut_icon.svg" type="image/svg">
    <meta name="robots" content="noindex">
</head>

<body>
    <header>
        <div class="container_header">
            <nav>
                <ul class="main-menu">
                    <li>
                        <a class="main-menu_item logo" href="./index.php"><img src="./images/svg/logo52px.svg" alt="логотип">туп</a>
                    </li>
                    <li><a class="main-menu_item" href="./students.php">студентам</a></li>
                    <li><a class="main-menu_item" href="./help_and_support.php">помощь и поддержка</a></li>
                    <li><a class="main-menu_item" href="./documents.php">документы</a></li>
                    <li><a class="main-menu_item" href="./profile.php">
                            <svg width="25" height="28" viewBox="0 0 25 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.5 2.77778C11.2108 2.77778 9.97431 3.28993 9.06268 4.20156C8.15104 5.1132 7.63889 6.34964 7.63889 7.63889C7.63889 8.92813 8.15104 10.1646 9.06268 11.0762C9.97431 11.9878 11.2108 12.5 12.5 12.5C13.7892 12.5 15.0257 11.9878 15.9373 11.0762C16.849 10.1646 17.3611 8.92813 17.3611 7.63889C17.3611 6.34964 16.849 5.1132 15.9373 4.20156C15.0257 3.28993 13.7892 2.77778 12.5 2.77778ZM4.86111 7.63889C4.86111 5.61293 5.66592 3.66995 7.09849 2.23738C8.53106 0.804809 10.474 0 12.5 0C14.526 0 16.4689 0.804809 17.9015 2.23738C19.3341 3.66995 20.1389 5.61293 20.1389 7.63889C20.1389 9.66485 19.3341 11.6078 17.9015 13.0404C16.4689 14.473 14.526 15.2778 12.5 15.2778C10.474 15.2778 8.53106 14.473 7.09849 13.0404C5.66592 11.6078 4.86111 9.66485 4.86111 7.63889ZM0 23.6111C0 21.7693 0.731645 20.003 2.03398 18.7006C3.33632 17.3983 5.10266 16.6667 6.94444 16.6667H18.0556C19.8973 16.6667 21.6637 17.3983 22.966 18.7006C24.2684 20.003 25 21.7693 25 23.6111V27.7778H0V23.6111ZM6.94444 19.4444C5.83938 19.4444 4.77957 19.8834 3.99817 20.6648C3.21676 21.4462 2.77778 22.506 2.77778 23.6111V25H22.2222V23.6111C22.2222 22.506 21.7832 21.4462 21.0018 20.6648C20.2204 19.8834 19.1606 19.4444 18.0556 19.4444H6.94444Z" fill="#5C45EA" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <?php
                        session_start();

                        if (isset($_SESSION['id_user'])) {
                            echo "<a class=\"main-menu_item_exit\" href=\"./php_handler/exit.php\">
                            <svg id=\"exitIcon\" width=\"30\" height=\"33\" viewBox=\"0 0 30 33\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                                <path d=\"M10.6667 5.61106H9.22222C5.81767 5.61106 4.11467 5.61106 3.05733 6.66839C2 7.72573 2 9.42873 2 12.8333V20.0555C2 23.4601 2 25.1616 3.05733 26.2204C4.11467 27.2777 5.81767 27.2777 9.22222 27.2777H10.6667M10.6667 8.46528C10.6667 5.15317 10.6667 3.49639 11.6879 2.59073C12.7091 1.68506 14.2706 1.95661 17.3934 2.50117L20.759 3.08906C24.217 3.69139 25.946 3.99328 26.973 5.2615C28 6.53117 28 8.36561 28 12.0359V20.8543C28 24.5232 28 26.3576 26.9744 27.6273C25.946 28.8955 24.2156 29.1974 20.7576 29.8012L17.3949 30.3876C14.272 30.9322 12.7106 31.2037 11.6893 30.2981C10.6667 29.3924 10.6667 27.7356 10.6667 24.4235V8.46528Z\" stroke=\"black\" stroke-width=\"3\" />
                                <path d=\"M15 15V17.8889\" stroke=\"black\" stroke-width=\"3\" stroke-linecap=\"round\" />
                            </svg>
                        </a>";
                        }
                        ?>
                    </li>
                    <li>
                        <div class="off-screen-menu">
                            <div class="div_ham_menu">
                                <a href="./">главная</a>
                                <a href="./students.php">студентам</a>
                                <a href="./help_and_support.php">помощь и поддержка</a>
                                <a href="./documents.php">документы</a>
                                <?php
                                session_start();

                                if (isset($_SESSION['id_user'])) {
                                    echo "<a class=\"main-menu_item_exit\" href=\"./php_handler/exit.php\">Выйти</a>";
                                }
                                ?>
                                <a href="./profile.php">профиль</a>
                            </div>
                        </div>
                        <div class="ham-menu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <h1 class="profile__title">Ваши данные</h1>

    <?php
    if (isset($roles)) {
        if ($roles == 'Администратор') {
            echo "<a class=\"admin_path\" href='./admin/profile_admin.php'>Войти в административную панель</a>";
        }
    }
    ?>
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
    <section class="profile__section">
        <div class="profile__container">
            <div class="profile__div_data">
                <div class="profile__photo_and_edit">
                    <div class="profile__photo">
                        <a class="profile__img_photo_profile"><img class="profile__img_photo_profile" src="./profile_images/<?php echo $InfoUser->profile_photo . '?' . rand(); ?>"></a>
                    </div>
                    <div class="profile__edit">
                        <h2 class="profile__edit_title_text">Данные изменились?</h2>
                        <button class="profile__edit_btn"><a href="./profile_edit.php" class="profile__edit_btn_link">Изменить данные</a></button>
                    </div>
                </div>
                <div class="profile__student_data">
                    <div class="profile__university_data">
                        <ul>
                            <li>
                                <p class="profile__university_data_text_left">Должность</p>
                            </li>
                            <li>
                                <p class="profile__university_data_text_left">Группа</p>
                            </li>
                            <li>
                                <p class="profile__university_data_text_left">Квалификация</p>
                            </li>
                            <li>
                                <p class="profile__university_data_text_left">Специальность</p>
                            </li>
                            <li>
                                <p class="profile__university_data_text_left">Курс</p>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <p class="profile__university_data_text_right"><?php echo isset($InfoUser->job_title) ? $InfoUser->job_title : "Нет_данных"; ?></p>
                            </li>
                            <li>
                                <p class="profile__university_data_text_right"><?php echo isset($InfoUser->ugroup) ? $InfoUser->ugroup : "Нет_данных"; ?></p>
                            </li>
                            <li>
                                <p class="profile__university_data_text_right"><?php echo isset($InfoUser->qualification) ? $InfoUser->qualification : "Нет_данных"; ?></p>
                            </li>
                            <li>
                                <p class="profile__university_data_text_right"><?php echo isset($InfoUser->specialization) ? $InfoUser->specialization : "Нет_данных"; ?></p>
                            </li>
                            <li>
                                <p class="profile__university_data_text_right"><?php echo isset($InfoUser->course) ? $InfoUser->course : "Нет_данных"; ?></p>
                            </li>
                        </ul>
                    </div>
                    <div class="profile__student_data_div">
                        <ul>
                            <li>
                                <p class="profile__university_data_text_left">Логин</p>
                            </li>
                            <li>
                                <p class="profile__university_data_text_left">Email</p>
                            </li>
                            <li>
                                <p class="profile__university_data_text_left">Телефон</p>
                            </li>
                            <li>
                                <p class="profile__university_data_text_left">Фамилия</p>
                            </li>
                            <li>
                                <p class="profile__university_data_text_left">Имя</p>
                            </li>
                            <li>
                                <p class="profile__university_data_text_left">Отчетство</p>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <p class="profile__student_data_div_text_right"><?php echo isset($InfoUser->login) ? $InfoUser->login : "Нет_данных"; ?></p>
                            </li>
                            <li>
                                <p class="profile__student_data_div_text_right"><?php echo isset($InfoUser->email) ? $InfoUser->email : "Нет_данных"; ?></p>
                            </li>
                            <li>
                                <p class="profile__student_data_div_text_right"><?php echo isset($InfoUser->telephone) ? $InfoUser->telephone : "Нет_данных"; ?></p>
                            </li>
                            <li>
                                <p class="profile__student_data_div_text_right"><?php echo isset($InfoUser->surname) ? $InfoUser->surname : "Нет_данных"; ?></p>
                            </li>
                            <li>
                                <p class="profile__student_data_div_text_right"><?php echo isset($InfoUser->uname) ? $InfoUser->uname : "Нет_данных"; ?></p>
                            </li>
                            <li>
                                <p class="profile__student_data_div_text_right"><?php echo isset($InfoUser->middlename) ? $InfoUser->middlename : "Нет_данных"; ?></p>
                            </li>
                        </ul>
                    </div>
                    <div class="profile__password_div">
                        <ul>
                            <li>
                                <p class="profile__university_data_text_left">Пароль</p>
                            </li>
                            <li>
                                <p class="profile__university_data_text_right">************</p>
                            </li>
                        </ul>
                        <div class="profile__forgot_password">
                            <p class="profile__forgot_password_text profile__edit_title_text">Забыли пароль?</p>
                            <button class="profile__edit_btn "><a href="./reset_password.php" class="profile__edit_btn_link">Сменить пароль</a></button>
                        </div>
                    </div>
                    <div class="profile__status_question_div">
                        <p class="profile__university_data_text_left profile__status_question_text">Статус ваших вопросов</p>
                        <ul>
                            <li>
                                <p class="profile__university_data_text_left">Вопросы</p>
                            </li>
                            <li>
                                <p class="profile__university_data_text_left">Статус ответа</p>
                            </li>
                        </ul>
                        <div class="profile__ul_answers">
                            <!-- <p class="profile__university_data_text">Вопрос 1</p>
                            <p class="profile__university_data_text">Ожидается ответ</p> -->
                            <?php
                            $qInfoFavorite = "SELECT * FROM question, user WHERE question.id_user = user.id_user AND user.id_user = {$_SESSION['id_user']}";
                            addslashes($qInfoFavorite);
                            $resInfoFavorite = mysqli_query($connect, $qInfoFavorite) or die(mysqli_error($connect));
                            while ($InfoFavorite = mysqli_fetch_object($resInfoFavorite)) {
                                echo "<div class=\"profile__question_anser_body\" onmouseover=\"showText(this,'$InfoFavorite->question_text')\" onmouseout=\"hideText(this)\">";
                                echo "<p class=\"profile__university_data_text\">Вопрос $InfoFavorite->id_question</p>";

                                // Проверяем значение question_status
                                if ($InfoFavorite->question_status === 'Посмотреть ответ') {
                                    echo "<a class=\"profile__university_data_text_with_answer\" onclick=\"showAnswer('$InfoFavorite->id_question')\">$InfoFavorite->question_status</a>";
                                } else {
                                    echo "<p class=\"profile__university_data_text\">$InfoFavorite->question_status</p>";
                                }

                                echo "</div>";
                            }

                            ?>

                            <div class="questionText_block" id="questionText"></div>

                            <div class="modal_answer" id="answerModal">
                                <div class="modal-content-answer">
                                    <span class="close_answer" onclick="closeModal()">&times;</span>
                                    <div id="answerContent"></div>
                                </div>
                            </div>

                            <script>
                                function showText(element, text) {
                                    document.getElementById('questionText').innerHTML = text;
                                    document.getElementById('questionText').style.display = 'block';
                                }

                                function hideText(element) {
                                    document.getElementById('questionText').innerHTML = '';
                                    document.getElementById('questionText').style.display = 'none';
                                }

                                function showAnswer(questionId) {
                                    // Отправляем AJAX-запрос на сервер для получения ответа по ID вопроса
                                    var xhr = new XMLHttpRequest();
                                    xhr.onreadystatechange = function() {
                                        if (xhr.readyState === 4 && xhr.status === 200) {
                                            var answerText = xhr.responseText;
                                            document.getElementById('answerContent').innerHTML = answerText;
                                            document.getElementById('answerModal').style.display = 'block';
                                        }
                                    };
                                    xhr.open('GET', './php_handler/get_answer.php?questionId=' + questionId, true);
                                    xhr.send();
                                }

                                function closeModal() {
                                    document.getElementById('answerContent').innerHTML = '';
                                    document.getElementById('answerModal').style.display = 'none';
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container_footer">
            <div class="div_footer">
                <div class="footer_left">
                    <h4>Остались вопросы? Задавайте</h4>
                    <button><a href="./help_and_support.php">задать вопрос</a></button>
                    <p>ТУП - Технологический Университет Программирования</p>
                </div>
                <div class="footer_right">
                    <p>+7 485 917 95 27, +7 977 428 63 33 - <span>Деканат</span></p>
                    <p>+7 977 488 63 70 - <span>Приёмная комиссия</span></p>
                    <div class="socials">
                        <a href="https://vk.com" target="_blank"><img src="./images/svg/vk70px.svg" alt="вк" class="social_img"></a>
                        <a href="https://t.me/Telegram" target="_blank"><img src="./images/svg/tg70px.svg" alt="телеграмм" class="social_img"></a>
                        <a href="https://web.whatsapp.com" target="_blank"><img src="./images/svg/whatsapp70px.svg" alt="вассап" class="social_img"></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <form method="post" enctype="multipart/form-data" class="modal_update_photo" id="modal_update_photo">
        <div class="modal-content-photo ">
            <span class="close">&times;</span>
            <p class="modal_update_photo__title">Загрузка новой фотографии</p>
            <div class="div_upload_new">
                <img id="uploadedImage" class="cropped_img_profile" />
                <label for="photoUpload" class="custom-file-upload">
                    Выберите файл
                </label>
                <input type="file" name="photo" id="photoUpload" accept="image/*" style="display: none;">

                <input type="submit" value="Обновить фото" class="submit_upload" />
            </div>
            <p class="modal_update_photo__subtitle">Если у вас возникают проблемы с загрузкой, попробуйте выбрать фотографию меньшего размера.</p>
        </div>
    </form>
    <script src="./js/ham_menu.js"></script>
    <script src="./js/modal_update_photo.js"></script>

</body>

</html>