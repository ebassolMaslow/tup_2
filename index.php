<?php

session_start();

include "./php_connect/connect.php";

if (isset($_SESSION['id_user'])) {
    $IDuser = $_SESSION['id_user'];
    if ($IDuser === '') {
        unset($IDuser);
    }
}
// echo $IDuser; // Вывод SQL-запроса для отладки
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="scss/main.css">
    <title>Первый курс | Технологический университет программирования</title>
    <meta name="description" content="Добро пожаловать на главную страницу первого курса! Здесь вы найдете информацию о расписании, учебных материалах и актуальных событиях.">
    <meta name="keywords" content="первый курс, учебный год, расписание, учебные материалы, события">
    <link rel="shortcut icon" href="./images/svg/shortcut_icon.svg" type="image/svg">

</head>

<body>
    <header>
        <div class="container_header">
            <nav>
                <ul class="main-menu">
                    <li>
                        <a class="main-menu_item logo logo_active" href="./index.php"><img src="./images/svg/logo52px.svg" alt="логотип">туп</a>
                    </li>
                    <li><a class="main-menu_item" href="./students.php">студентам</a></li>
                    <li><a class="main-menu_item" href="./help_and_support.php">помощь и поддержка</a></li>
                    <li><a class="main-menu_item" href="./documents.php">документы</a></li>
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

    <div class="container">
        <h1 class="hero_title">информация для первокурссников</h1>
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

    <section class="hero-image">
        <div class="container">
            <div class="hero_div">
                <div class="sidebar">
                    <ul>
                        <li><a class="sidebar_element_1440px" href="#section1">Расписание начала учебного года</a></li>
                        <li><a class="sidebar_element_1440px" href="#section2">Помощь для первокурсников</a></li>
                        <li><a class="sidebar_element_1440px" href="#section3">Контакты деканата</a></li>
                        <li><a class="sidebar_icon" href="#section1"><img src="./images/svg/timetable_sidebar.svg" alt="расписание меню слева"></a></li>
                        <li><a class="sidebar_icon" href="#section2"><img src="./images/svg/question_sidebar.svg" alt="вопрос меню слева"></a></li>
                        <li><a class="sidebar_icon" href="#section3"><img src="./images/svg/profile_sidebar.svg" alt="профиль меню слева"></a></li>
                    </ul>
                </div>
                <a><img src="./images/woman_hero.png" alt="фото девушки" class="hero_img"></a>
            </div>
        </div>
    </section>

    <section class="timetable" id="section1">
        <div class="container">
            <div class="div_timetable">
                <h2>Расписание начала учебного года для первокурсников</h2>
                <p class="div_timetable_text">В начале каждого учебного года Институт Дизайна и IT традиционно
                    организует ряд мероприятий,
                    направленных на интеграцию и адаптацию первокурсников. В ходе этих мероприятий у вас будет
                    возможность познакомиться с руководителями программ, администраторами, сотрудниками деканата и
                    тьюторами, а также узнать больше о возможностях для самореализации вне учебной программы Института
                    Дизайна и IT.</p>
                <div class="timetable_table">
                    <div class="events">
                        <div class="event">
                            <div class="event_column">
                                <p class="event_column_regular display_none">Дата</p>
                                <p class="event_column_regular display_none_text dots">Дата:</p>
                                <p class="event_column_bold">31 августа</p>
                            </div>
                            <div class="event_column">
                                <p class="event_column_regular display_none">Время</p>
                                <p class="event_column_regular display_none_text dots">Время:</p>
                                <p class="event_column_regular">10:00 - 14:00</p>
                            </div>
                            <div class="event_column">
                                <p class="event_column_regular display_none">Мероприятие</p>
                                <p class="event_column_regular display_none_text dots">Мероприятие:</p>
                                <p class="event_column_regular ecr_width">Организационное собрание для адаптации
                                    студентов</p>
                            </div>
                            <div class="event_column">
                                <p class="event_column_regular display_none">Аудитория</p>
                                <p class="event_column_regular display_none_text dots">Аудитория:</p>
                                <p class="event_column_regular">208</p>
                            </div>
                        </div>
                        <hr class="timetable_table_hr">
                        <div class="event">
                            <div class="event_column">
                                <p class="event_column_regular display_none_text dots">Дата:</p>
                                <p class="event_column_bold">1 сентября</p>
                            </div>
                            <div class="event_column">
                                <p class="event_column_regular display_none_text dots">Время:</p>
                                <p class="event_column_bold">17:00</p>
                            </div>
                            <div class="event_column">
                                <p class="event_column_regular display_none_text dots">Мероприятие:</p>
                                <p class="event_column_bold ecr_width">Торжественное открытие учебного года</p>
                            </div>
                            <div class="event_column">
                                <p class="event_column_regular display_none_text dots">Аудитория:</p>
                                <p class="event_column_bold ecr_width_width">Онлайн на платформе Webinar</p>
                            </div>
                        </div>
                        <hr class="timetable_table_hr">
                        <div class="event">
                            <div class="event_column">
                                <p class="event_column_regular display_none_text dots">Дата:</p>
                                <p class="event_column_bold">2 сентября</p>
                            </div>
                            <div class="event_column">
                                <p class="event_column_regular display_none_text dots">Время:</p>
                                <p class="event_column_regular">10:00</p>
                            </div>
                            <div class="event_column">
                                <p class="event_column_regular display_none_text dots">Мероприятие:</p>
                                <p class="event_column_regular ecr_width">Тестирование и распределение в группы</p>
                            </div>
                            <div class="event_column">
                                <p class="event_column_regular display_none_text dots">Аудитория:</p>
                                <p class="event_column_regular">Главный вход</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="answers_to_questions" id="section2">
        <div class="container">
            <div class="div_answers_to_questions">
                <h2>Ответы на самые частые вопросы студентов</h2>
                <div class="ATQ_block">
                    <p>Как узнать номер своей академической группы?</p>
                    <p>Узнать номер вашей учебной группы вы можете в специальной таблице.</p>
                </div>
                <div class="ATQ_block">
                    <p>Как заказать справки об обучении?</p>
                    <p>Заказ справок возможен на странице "документы" в специальной форме.</p>
                    <p>Срок подготовки документа – 3-5 рабочих дней, уведомлений о готовности нет. Если вам необходимо,
                        чтобы справку переслали на вашу почту, сделайте соответствующую пометку при формировании заказа.
                    </p>
                </div>
                <div class="ATQ_block">
                    <p>Как проходят занятия физкультурой и что нужно сделать для получения допуска к занятиям?</p>
                    <p>Для участия в занятиях по предмету "Физическая культура" студент должен предоставить заключение
                        (справку) от врача, подтверждающую его принадлежность к медицинской группе здоровья, разрешающую
                        заниматься физической культурой. Это заключение (справку) необходимо обновлять ежегодно и
                        предоставлять на первом учебном занятии на кафедру Физического Воспитания и Здоровья.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="contacts" id="section3">
        <div class="container">
            <div class="div_contacts">
                <h3 class="div_contacts_title">Контакты деканата</h3>
                <p class="div_contacts_subtext"><span>Часы работы: </span>Пн - Пт с 10:00 до 19:00, в субботу с 10:00 до
                    15:00</p>
                <p class="div_contacts_subtext"><span>Email деканата: </span>design-it-institute@dsi.ru</p>
                <p class="div_contacts_subtext"><span>Телефоны:</span></p>
                <p class="div_contacts_subtext">+7 485 917 95 27, +7 977 428 63 33 - <span>Сектор коммуникаций
                        Деканата</span></p>
                <p class="div_contacts_subtext">+7 977 488 63 70 - <span>Сектор расписания</span></p>
                <p class="div_contacts_subtext"><span>Телефоны для заказа пропусков: </span>+7 947 438 63 73, +7 985 488
                    62 75</p>
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

    <script>
        var menuItems = document.querySelectorAll('.sidebar li a');

        menuItems.forEach(function(item) {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                var target = document.querySelector(this.getAttribute('href'));
                window.scrollTo({
                    top: target.offsetTop,
                    behavior: 'smooth'
                });
            });
        });
    </script>

    <script src="./js/ham_menu.js"></script>

</body>

</html>