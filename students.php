<?php

session_start();

include "./php_connect/connect.php";

if (isset($_SESSION['id_user'])) {
    $IDuser = $_SESSION['id_user'];
    if ($IDuser === '') {
        unset($IDuser);
    }
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="scss/main.css">
    <title>Информация для студентов первого курса | Технологический университет программирования</title>
    <meta name="description" content="Здесь вы найдете полезную информацию для студентов первого курса, включая расписание занятий, актуальные объявления и контактные данные преподавателей.">
    <meta name="keywords" content="информация для студентов, первый курс, расписание, объявления, контакты, преподаватели">
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
                    <li><a class="main-menu_active" href="./students.php">студентам</a></li>
                    <li><a class="main-menu_item" href="./help_and_support.php">помощь и поддержка</a></li>
                    <li><a class="main-menu_item" tem_exit\" href=\"./php_handler/exit.php\">Выйти</a>";
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

    <section class="classroom_overlay"></section>

    <section class="Schedule_of_classes">
        <div class="container_students">
            <h1 class="SOC_title">Расписание занятий/сессии</h1>
            <div class="SOC_cards">
                <div class="SOC_cards_left">
                    <p class="SOC_cards_left_item">Расписание университета</p>
                    <a href="./pdfs/Расписание_занятий_1 курс с 26.01.2024_ИСИП_СЛЕВА.pdf" target="_blank" class="SOC_cards_left_item">Расписание</a>
                    <a href="./pdfs/Расписание экзаменов 2 семестр 40.02.01 Ю 4 курс_СЛЕВА.pdf" class="SOC_cards_left_item" target="_blank">Экзаменционная сессия</a>
                    <a href="./pdfs/Расписание_пересдач_СЛЕВА.pdf" class="SOC_cards_left_item" target="_blank">Расписание пересдач</a>
                    <a href="./pdfs/Система_оценивания_СЛЕВА.pdf" class="SOC_cards_left_item" target="_blank">Система оценивания</a>
                </div>
                <div class="SOC_cards_right">
                    <p class="SOC_cards_right_item">Магистратура</p>
                    <a href="./pdfs/Расписание_занятий_1 курс с 26.01.2024_ВД_СПРАВА.pdf" target="_blank" class="SOC_cards_right_item">Расписание</a>
                    <a href="./pdfs/Расписание экзаменов 2 семестр 09.02.01 Э 4 курс_СПРАВА.pdf" class="SOC_cards_right_item" target="_blank">Экзаменционная сессия</a>
                    <a href="./pdfs/пересдачи_СПРАВА.pdf" class="SOC_cards_right_item" target="_blank">Расписание пересдач для магистратуры</a>
                </div>
            </div>
            <div class="SOC_buttons SOCB_top">
                <a href="./profile.php" class="SOC_buttons_div_item_link">Личный кабинет обучаящегося</a>
                <a href="./help_and_support.php" class="SOC_buttons_div_item_link">Форма обратной связи для <br>вопросов</a>
            </div>
            <div class="SOC_buttons">
                <a href="./documents.php" class="SOC_buttons_div_item_link">Заказать справку об обучении</a>
                <a href="./help_and_support.php" class="SOC_buttons_div_item_link">Инструкции</a>
            </div>
        </div>
    </section>

    <section class="answers_to_questions">
        <div class="container_students">
            <div class="div_answers_to_questions div_answers_to_questions_students">
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

    <section class="events_and_news">
        <div class="container_students">
            <div class="events_and_news_text">
                <p class="EAN_text_events">МЕРОПРИЯТИЯ</p>
                <p class="EAN_text_news">НОВОСТИ</p>
            </div>
            <div class="progress-bar">
                <div class="progress"></div>
            </div>
            <div class="div_events_block">
                <div class="events_block">
                    <p class="events_block_text">Международный экспертный семинар с приглашением зарубежных и российских
                        ученых «Анализ влияния человеческого капитала на технологическое развитие и экономический рост
                        РФ»
                    </p>
                    <p class="events_block_text">07.11.2023</p>
                </div>
                <div class="events_block">
                    <p class="events_block_text">Международный экспертный семинар с приглашением зарубежных и российских
                        ученых «Анализ влияния человеческого капитала на технологическое развитие и экономический рост
                        РФ»
                    </p>
                    <p class="events_block_text">07.11.2023</p>
                </div>
            </div>
            <div class="div_news_block EAT_hidden">
                <div class="events_block">
                    <p class="events_block_text">Повседневная практика показывает, что курс
                         на социально-ориентированный национальный проект
                          обеспечивает актуальность распределения внутренних резервов и ресурсов.
                    </p>
                    <p class="events_block_text">27.02.2024</p>
                </div>
                <div class="events_block">
                    <p class="events_block_text">В своём стремлении повысить качество жизни, 
                        они забывают, что высококачественный прототип будущего проекта 
                        играет определяющее значение для экономической целесообразности принимаемых решений.
                    </p>
                    <p class="events_block_text">01.04.2024</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        function updateTextColor() {
            if (document.querySelector('.progress').classList.contains('progress_news')) {
                document.querySelector('.EAN_text_events').style.color = '#000000';
                document.querySelector('.EAN_text_news').style.color = '#5C45EA';
            } else {
                document.querySelector('.EAN_text_events').style.color = '#5C45EA';
                document.querySelector('.EAN_text_news').style.color = '#000000';
            }
        }

        document.querySelector('.EAN_text_news').addEventListener('click', function() {
            document.querySelector('.div_events_block').style.display = 'none';
            document.querySelector('.div_news_block').style.display = 'flex';
            document.querySelector('.progress').classList.add('progress_news');
            updateTextColor();
        });

        document.querySelector('.EAN_text_events').addEventListener('click', function() {
            document.querySelector('.div_events_block').style.display = 'flex';
            document.querySelector('.div_news_block').style.display = 'none';
            document.querySelector('.progress').classList.remove('progress_news');
            updateTextColor();
        });
    </script>

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