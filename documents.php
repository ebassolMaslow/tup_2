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
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="scss/main.css">
    <title>Документы | Технологический университет программирования</title>
    <link rel="shortcut icon" href="./images/svg/shortcut_icon.svg" type="image/svg">
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
                    <li><a class="main-menu_active" href="./documents.php">документы</a></li>
                    <li><a class="main-menu_item" href="./profile.php">
                            <svg width="25" height="28" viewBox="0 0 25 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.5 2.77778C11.2108 2.77778 9.97431 3.28993 9.06268 4.20156C8.15104 5.1132 7.63889 6.34964 7.63889 7.63889C7.63889 8.92813 8.15104 10.1646 9.06268 11.0762C9.97431 11.9878 11.2108 12.5 12.5 12.5C13.7892 12.5 15.0257 11.9878 15.9373 11.0762C16.849 10.1646 17.3611 8.92813 17.3611 7.63889C17.3611 6.34964 16.849 5.1132 15.9373 4.20156C15.0257 3.28993 13.7892 2.77778 12.5 2.77778ZM4.86111 7.63889C4.86111 5.61293 5.66592 3.66995 7.09849 2.23738C8.53106 0.804809 10.474 0 12.5 0C14.526 0 16.4689 0.804809 17.9015 2.23738C19.3341 3.66995 20.1389 5.61293 20.1389 7.63889C20.1389 9.66485 19.3341 11.6078 17.9015 13.0404C16.4689 14.473 14.526 15.2778 12.5 15.2778C10.474 15.2778 8.53106 14.473 7.09849 13.0404C5.66592 11.6078 4.86111 9.66485 4.86111 7.63889ZM0 23.6111C0 21.7693 0.731645 20.003 2.03398 18.7006C3.33632 17.3983 5.10266 16.6667 6.94444 16.6667H18.0556C19.8973 16.6667 21.6637 17.3983 22.966 18.7006C24.2684 20.003 25 21.7693 25 23.6111V27.7778H0V23.6111ZM6.94444 19.4444C5.83938 19.4444 4.77957 19.8834 3.99817 20.6648C3.21676 21.4462 2.77778 22.506 2.77778 23.6111V25H22.2222V23.6111C22.2222 22.506 21.7832 21.4462 21.0018 20.6648C20.2204 19.8834 19.1606 19.4444 18.0556 19.4444H6.94444Z" fill="black" />
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

    <h1 class="documents__title">Документы</h1>

    <div class="documents__pdf_rules">
        <div class="container">
            <div class="documents__pdf_buttons">
                <button class="documents__pdf_btn pdf_btn_margin_first"><svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.30769 10V9.23077H1.53846V10H2.30769ZM8.46154 10V9.23077H7.69231V10H8.46154ZM8.46154 16.1538H7.69231V16.9231H8.46154V16.1538ZM19.2308 5.38461H20V5.06615L19.7754 4.84L19.2308 5.38461ZM14.6154 0.769231L15.16 0.224615L14.9338 0H14.6154V0.769231ZM2.30769 10.7692H3.84615V9.23077H2.30769V10.7692ZM3.07692 16.9231V13.0769H1.53846V16.9231H3.07692ZM3.07692 13.0769V10H1.53846V13.0769H3.07692ZM3.84615 12.3077H2.30769V13.8462H3.84615V12.3077ZM4.61538 11.5385C4.61538 11.7425 4.53434 11.9381 4.39008 12.0824C4.24582 12.2266 4.05017 12.3077 3.84615 12.3077V13.8462C4.45819 13.8462 5.04516 13.603 5.47794 13.1702C5.91072 12.7375 6.15385 12.1505 6.15385 11.5385H4.61538ZM3.84615 10.7692C4.05017 10.7692 4.24582 10.8503 4.39008 10.9945C4.53434 11.1388 4.61538 11.3344 4.61538 11.5385H6.15385C6.15385 10.9264 5.91072 10.3395 5.47794 9.90668C5.04516 9.4739 4.45819 9.23077 3.84615 9.23077V10.7692ZM7.69231 10V16.1538H9.23077V10H7.69231ZM8.46154 16.9231H10V15.3846H8.46154V16.9231ZM12.3077 14.6154V11.5385H10.7692V14.6154H12.3077ZM10 9.23077H8.46154V10.7692H10V9.23077ZM12.3077 11.5385C12.3077 10.9264 12.0646 10.3395 11.6318 9.90668C11.199 9.4739 10.612 9.23077 10 9.23077V10.7692C10.204 10.7692 10.3997 10.8503 10.5439 10.9945C10.6882 11.1388 10.7692 11.3344 10.7692 11.5385H12.3077ZM10 16.9231C10.612 16.9231 11.199 16.6799 11.6318 16.2472C12.0646 15.8144 12.3077 15.2274 12.3077 14.6154H10.7692C10.7692 14.8194 10.6882 15.0151 10.5439 15.1593C10.3997 15.3036 10.204 15.3846 10 15.3846V16.9231ZM13.8462 9.23077V16.9231H15.3846V9.23077H13.8462ZM14.6154 10.7692H18.4615V9.23077H14.6154V10.7692ZM14.6154 13.8462H16.9231V12.3077H14.6154V13.8462ZM1.53846 7.69231V2.30769H0V7.69231H1.53846ZM18.4615 5.38461V7.69231H20V5.38461H18.4615ZM2.30769 1.53846H14.6154V0H2.30769V1.53846ZM14.0708 1.31385L18.6862 5.92923L19.7754 4.84L15.16 0.224615L14.0708 1.31385ZM1.53846 2.30769C1.53846 2.10368 1.61951 1.90802 1.76376 1.76376C1.90802 1.61951 2.10368 1.53846 2.30769 1.53846V0C1.69565 0 1.10868 0.243131 0.675908 0.675907C0.243131 1.10868 0 1.69565 0 2.30769H1.53846ZM0 18.4615V20.7692H1.53846V18.4615H0ZM2.30769 23.0769H17.6923V21.5385H2.30769V23.0769ZM20 20.7692V18.4615H18.4615V20.7692H20ZM17.6923 23.0769C18.3043 23.0769 18.8913 22.8338 19.3241 22.401C19.7569 21.9682 20 21.3813 20 20.7692H18.4615C18.4615 20.9732 18.3805 21.1689 18.2362 21.3132C18.092 21.4574 17.8963 21.5385 17.6923 21.5385V23.0769ZM0 20.7692C0 21.3813 0.243131 21.9682 0.675908 22.401C1.10868 22.8338 1.69565 23.0769 2.30769 23.0769V21.5385C2.10368 21.5385 1.90802 21.4574 1.76376 21.3132C1.61951 21.1689 1.53846 20.9732 1.53846 20.7692H0Z" fill="white" />
                    </svg><a href="./pdfs/Правила_внутреннего_распорядка.pdf" class="documents__pdf_btn_link" target="_blank">Правила внутреннего распорядка</a></button>
                <button class="documents__pdf_btn pdf_btn_margin_second"><svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.30769 10V9.23077H1.53846V10H2.30769ZM8.46154 10V9.23077H7.69231V10H8.46154ZM8.46154 16.1538H7.69231V16.9231H8.46154V16.1538ZM19.2308 5.38461H20V5.06615L19.7754 4.84L19.2308 5.38461ZM14.6154 0.769231L15.16 0.224615L14.9338 0H14.6154V0.769231ZM2.30769 10.7692H3.84615V9.23077H2.30769V10.7692ZM3.07692 16.9231V13.0769H1.53846V16.9231H3.07692ZM3.07692 13.0769V10H1.53846V13.0769H3.07692ZM3.84615 12.3077H2.30769V13.8462H3.84615V12.3077ZM4.61538 11.5385C4.61538 11.7425 4.53434 11.9381 4.39008 12.0824C4.24582 12.2266 4.05017 12.3077 3.84615 12.3077V13.8462C4.45819 13.8462 5.04516 13.603 5.47794 13.1702C5.91072 12.7375 6.15385 12.1505 6.15385 11.5385H4.61538ZM3.84615 10.7692C4.05017 10.7692 4.24582 10.8503 4.39008 10.9945C4.53434 11.1388 4.61538 11.3344 4.61538 11.5385H6.15385C6.15385 10.9264 5.91072 10.3395 5.47794 9.90668C5.04516 9.4739 4.45819 9.23077 3.84615 9.23077V10.7692ZM7.69231 10V16.1538H9.23077V10H7.69231ZM8.46154 16.9231H10V15.3846H8.46154V16.9231ZM12.3077 14.6154V11.5385H10.7692V14.6154H12.3077ZM10 9.23077H8.46154V10.7692H10V9.23077ZM12.3077 11.5385C12.3077 10.9264 12.0646 10.3395 11.6318 9.90668C11.199 9.4739 10.612 9.23077 10 9.23077V10.7692C10.204 10.7692 10.3997 10.8503 10.5439 10.9945C10.6882 11.1388 10.7692 11.3344 10.7692 11.5385H12.3077ZM10 16.9231C10.612 16.9231 11.199 16.6799 11.6318 16.2472C12.0646 15.8144 12.3077 15.2274 12.3077 14.6154H10.7692C10.7692 14.8194 10.6882 15.0151 10.5439 15.1593C10.3997 15.3036 10.204 15.3846 10 15.3846V16.9231ZM13.8462 9.23077V16.9231H15.3846V9.23077H13.8462ZM14.6154 10.7692H18.4615V9.23077H14.6154V10.7692ZM14.6154 13.8462H16.9231V12.3077H14.6154V13.8462ZM1.53846 7.69231V2.30769H0V7.69231H1.53846ZM18.4615 5.38461V7.69231H20V5.38461H18.4615ZM2.30769 1.53846H14.6154V0H2.30769V1.53846ZM14.0708 1.31385L18.6862 5.92923L19.7754 4.84L15.16 0.224615L14.0708 1.31385ZM1.53846 2.30769C1.53846 2.10368 1.61951 1.90802 1.76376 1.76376C1.90802 1.61951 2.10368 1.53846 2.30769 1.53846V0C1.69565 0 1.10868 0.243131 0.675908 0.675907C0.243131 1.10868 0 1.69565 0 2.30769H1.53846ZM0 18.4615V20.7692H1.53846V18.4615H0ZM2.30769 23.0769H17.6923V21.5385H2.30769V23.0769ZM20 20.7692V18.4615H18.4615V20.7692H20ZM17.6923 23.0769C18.3043 23.0769 18.8913 22.8338 19.3241 22.401C19.7569 21.9682 20 21.3813 20 20.7692H18.4615C18.4615 20.9732 18.3805 21.1689 18.2362 21.3132C18.092 21.4574 17.8963 21.5385 17.6923 21.5385V23.0769ZM0 20.7692C0 21.3813 0.243131 21.9682 0.675908 22.401C1.10868 22.8338 1.69565 23.0769 2.30769 23.0769V21.5385C2.10368 21.5385 1.90802 21.4574 1.76376 21.3132C1.61951 21.1689 1.53846 20.9732 1.53846 20.7692H0Z" fill="white" />
                    </svg><a href="./pdfs/instruktsia_po_pravilam_bezopasnosti_dlya_uchaschikhsya.pdf" class="documents__pdf_btn_link" target="_blank">Правила безопасности</a></button>
            </div>
        </div>
    </div>
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
    <h2 class="documents__request">Заказ справок</h2>
    <section class="documents__request_reference">
        <div class="container">
            <div class="documents__div_request_reference">
                <form action="./php_handler/documents_request_form_handler.php" onsubmit="return validateForm()" class="documnets_request_form" method="post" id="documnets_request_form">
                    <label class="label_input_auth">Почта</label>
                    <div class="div_input">
                        <input type="email" class="input_form" name="email" id="email" placeholder="ivanov@mail.ru" autocomplete="off" required="required" minlength="4" maxlength="50">
                    </div>
                    <label class="label_input_auth">Фамилия студента</label>
                    <div class="div_input">
                        <input type="text" class="input_form" name="surname_docs" id="surname_docs" placeholder="Ваша фамилия" autocomplete="off" required="required" minlength="1" maxlength="80">
                    </div>
                    <label class="label_input_auth">Имя студента</label>
                    <div class="div_input">
                        <input type="text" class="input_form" name="name_docs" id="name_docs" placeholder="Ваше имя" autocomplete="off" required="required" minlength="1" maxlength="80">
                    </div>
                    <label class="label_input_auth">Отчество студента (если его нет, написать слово ”нет”)</label>
                    <div class="div_input">
                        <input type="text" class="input_form" name="middlename_docs" id="middlename_docs" placeholder="Ваше отчество" autocomplete="off" required="required" minlength="1" maxlength="80">
                    </div>
                    <label class="label_input_auth">Дата рождения студента</label>
                    <div class="div_input">
                        <input type="text" class="input_form" name="date_docs" id="date_docs" placeholder="Дата рождения студента" autocomplete="off" required="required" minlength="10" maxlength="10">
                    </div>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            // Применяем маску ввода для даты
                            $('#date_docs').mask('0000-00-00', {
                                placeholder: "гггг-мм-дд"
                            });

                            // Инициализируем плагин jQuery Validate для формы
                            $('#documnets_request_form').validate({
                                errorElement: 'label', // изменяем элемент для отображения сообщения об ошибке
                                errorClass: 'error', // добавляем класс к элементам с ошибкой
                                rules: {
                                    date_docs: {
                                        dateISO: true
                                    },
                                    email: {
                                        email: true
                                    },
                                },
                                messages: {
                                    date_docs: {
                                        required: "Обязательное поле для заполнения",
                                        dateISO: "Введите корректную дату в формате ГГГГ-ММ-ДД",
                                        minlength: "Введите не менее 10 символов"
                                    },
                                    email: {
                                        required: "Введите корректный адрес электронной почты",
                                        email: "Введите корректный адрес электронной"
                                    },
                                    surname_docs: {
                                        required: "Обязательное поле для заполнения"
                                    },
                                    name_docs: {
                                        required: "Обязательное поле для заполнения"
                                    },
                                    middlename_docs: {
                                        required: "Обязательное поле для заполнения"
                                    },
                                    group_docs: {
                                        required: "Обязательное поле для заполнения",
                                        minlength: "Введите не менее 4 символов"
                                    },
                                }
                            });
                        });
                    </script>

                    <label class="label_input_auth">Группа студента</label>
                    <div class="div_input">
                        <input type="text" class="input_form" name="group_docs" id="group_docs" placeholder="Группа студента" autocomplete="off" required minlength="4" maxlength="20">
                    </div>
                    <div class="radio_document">
                        <p class="label_input_auth">Выберите какой документ вам нужен</p>

                        <div class="radio_input_doc">
                            <input type="radio" id="document1" name="document_type" id="document_type" value="Справка в военный комиссариат (приложение 4)" class="input_radio" checked>
                            <label for="document1">Справка в военный комиссариат (приложение 4)</label><br>
                        </div>
                        <div class="radio_input_doc">
                            <input type="radio" id="document2" name="document_type" id="document_type" value="Справка в организацию (например, МФЦ и другие)" class="input_radio" required>
                            <label for="document2">Справка в организацию (например, МФЦ и другие)</label><br>
                        </div>
                        <div class="radio_input_doc">
                            <input type="radio" id="document3" name="document_type" id="document_type" value="Справка на работу родителю" class="input_radio" required>
                            <label for="document3">Справка на работу родителю</label><br>
                        </div>
                        <div class="radio_input_doc">
                            <input type="radio" id="document4" name="document_type" id="document_type" value="Справка на работу студенту" class="input_radio" required>
                            <label for="document4">Справка на работу студенту</label><br>
                        </div>
                        <div class="radio_input_doc">
                            <input type="radio" id="document5" name="document_type" id="document_type" value="Копия лицензии, заверенная руководителем" class="input_radio" required>
                            <label for="document5">Копия лицензии, заверенная руководителем</label><br>
                        </div>
                        <div class="radio_input_doc">
                            <input type="radio" id="document6" name="document_type" id="document_type" value="Копия аккредитации, заверенная руководителем" class="input_radio" required>
                            <label for="document6">Копия аккредитации, заверенная руководителем</label><br>
                        </div>
                    </div>
                    <input type="submit" name="submit" class="submit" value="Заказать документы">
                </form>
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

    <script src="./js/ham_menu.js"></script>
</body>

</html>