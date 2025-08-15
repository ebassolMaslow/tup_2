-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 31 2024 г., 16:35
-- Версия сервера: 5.7.39-log
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tup`
--

-- --------------------------------------------------------

--
-- Структура таблицы `documents`
--

CREATE TABLE `documents` (
  `id_documents` int(11) NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uname` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `ugroup` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `documents`
--

INSERT INTO `documents` (`id_documents`, `email`, `surname`, `uname`, `middlename`, `birthday`, `ugroup`, `document_type`, `id_user`) VALUES
(27, 'pavlova_alisa5322@gmail.com', 'Павлова', 'Алиса', 'Александровна', '2001-10-02', 'ВД2024-3', 'Справка на работу студенту', 43),
(28, 'agafon-ee22@gmai.com', 'Агафонов', 'Лев ', 'Алексеевич', '1998-12-18', 'БД2024-1', 'Справка на работу родителю', 44),
(29, 'anna_stolb2345@gmail.com', 'Столбова', 'Анна', 'Алексеевна', '2003-12-22', 'ВД2024-3', 'Справка на работу родителю', 45),
(30, 'anna_stolb2345@gmail.com', 'Столбова', 'Анна', 'Алексеевна', '2003-12-22', 'ВД2024-3', 'Справка на работу студенту', 45),
(31, 'shapovala323@gmail.com', 'Шаповалов', 'Константин', 'Романович', '2005-03-18', 'ВД2024-3', 'Справка в военный комиссариат (приложение 4)', 46),
(32, 'Gorbacheeev-dmail@gmail.com', 'Горбачев', 'Мирон', 'Маркович', '2001-09-22', 'ВД2024-3', 'Справка в военный комиссариат (приложение 4)', 47),
(35, 'isip_a.yu.maslikov@mpt.ru', 'Масликов', 'Александр', 'Юрьевич', '2004-01-01', 'Вд44', 'Справка на работу родителю', 50);

-- --------------------------------------------------------

--
-- Структура таблицы `question`
--

CREATE TABLE `question` (
  `id_question` int(11) NOT NULL,
  `question_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` varchar(600) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qtime` datetime NOT NULL,
  `question_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `question`
--

INSERT INTO `question` (`id_question`, `question_text`, `answer`, `email`, `qtime`, `question_status`, `id_user`) VALUES
(43, 'Здравствуйте, у меня есть вопрос по поводу одежды, можно ли носить шорты в техникуме? и есть ли где-то список разрешенной и запрещённой одежды?', NULL, 'pavlova_alisa5322@gmail.com', '2024-05-11 13:41:49', 'Ожидается ответ', 43),
(44, 'Можно привезти документы в октябре я их просто потерял', NULL, 'agafon-ee22@gmai.com', '2024-05-11 13:55:20', 'Ожидается ответ', 44),
(45, 'Здравствуйте, а в универе есть кулеры?', NULL, 'anna_stolb2345@gmail.com', '2024-05-11 14:10:08', 'Ожидается ответ', 45),
(46, 'Предоставляет ли университет общежития студентам?', NULL, 'anna_stolb2345@gmail.com', '2024-05-11 14:20:47', 'Ожидается ответ', 45),
(47, 'Есть ли какие то льготы для студентов?', NULL, 'shapovala323@gmail.com', '2024-05-11 14:34:57', 'Ожидается ответ', 46),
(48, 'Здравствуйте могут ли заявку в военкомат делать быстрее?', NULL, 'Gorbacheeev-dmail@gmail.com', '2024-05-11 14:52:02', 'Ожидается ответ', 47),
(49, 'Вопросов много', 'Отлично', 'isip_a.yu.maslikov@mpt.ru', '2024-05-29 14:52:08', 'Посмотреть ответ', 50);

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `name_role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id_role`, `name_role`) VALUES
(1, 'Администратор'),
(2, 'Пользователь');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_photo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uname` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middlename` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ugroup` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialization` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qualification` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_title` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_role` int(11) DEFAULT NULL,
  `reset_token` varchar(85) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_requested_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id_user`, `login`, `profile_photo`, `email`, `password`, `surname`, `uname`, `middlename`, `ugroup`, `specialization`, `qualification`, `course`, `telephone`, `job_title`, `id_role`, `reset_token`, `reset_requested_at`) VALUES
(42, 'admin', '663f43f52b908_изображение_2024-05-11_130956281.png', 'moriah75@gmail.com', '$2y$10$2emqkeNuSP85vF6hlrpdJeYxOt17DnBz/QFEFtTp/I/qy3mbfsihG', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'a', '+7 (999) 999-99-99', 'Админ', 1, NULL, NULL),
(43, 'pavlova_alisa', '663f45074988c_изображение_2024-05-11_131429652.png', 'pavlova_alisa5322@gmail.com', '$2y$10$m8LKuTJmeJoxB4jAb0Uwlukcqyv1V9YqSPrZujuzaDm/IPZzKPFrS', 'Павлова', 'Алиса', 'Александровна', 'ВД2024-3', '09.07', 'Веб-дизайнер', '1', '+7 (905) 909-42-73', 'Студент', 2, NULL, NULL),
(44, 'agafonoff', '663f4680a9afe_изображение_2024-05-11_132048129.png', 'agafon-ee22@gmai.com', '$2y$10$OlvZNjNm9dMXC16ik0Gm/uwcL9BSavdGUPn8SbRmFDQ5A0HYZJNxK', 'Агафонов', 'Лев', 'Алексеевич', 'БД2024-1', '09.03', 'базы данных', '1', '+7 (905) 403-44-54', 'Студент', 2, 'a951bbccb9ee16643b7b58c7675041bf513c2a27ab2e894a84b7c4e58f7ed6c1', '2024-05-25 19:07:52'),
(45, 'anna_stolb', '663f4710d600e_изображение_2024-05-11_132311890.png', 'isip_a.yu.maslikov@gmail.com', '$2y$10$lveyZv8r8W60OtselIqTV.N8E8.6rEnZNJ1SfPw1pnzEilagQHiem', 'Столбова', 'Анна', 'Алексеевна', 'ВД2024-3', '09.07', 'Веб-дизайнер', '1', '+7 (905) 132-83-13', 'Студент', 2, '3bd4ac1b71d07327ff200a1fe77f3dd52c72c5221907725c92114a725ad89ab2', '2024-05-11 16:59:26'),
(46, 'shapovala3', '663f47ee8d163_изображение_2024-05-11_132653615.png', 'shapovala323@gmail.com', '$2y$10$/HySOCIolcjNPlY8IJHSm.CbJtkd6bTt.r.ZGM17CAL8PQeawh6SC', 'Шаповалов', 'Константин', 'Романович', 'ВД2024-3', '09.07', 'Веб-дизайнер', '1', '+7 (905) 808-19-02', 'Студент', 2, '66da1d643c75b17777f67a7763ebd09f33521dafb8b84eb83865c1d46b99bf22', '2024-05-11 16:58:08'),
(47, 'Gorbacheeev', '663f4aac43877_изображение_2024-05-11_133835479.png', 'Gorbacheeev-dmail@gmail.com', '$2y$10$fGD7bYiuhNRCr38swWftze/BgA3RghwxIX6qH43yEp8ktqy3z/ezi', 'Горбачев', 'Мирон', 'Маркович', 'ВД2024-3', '09.07', 'Веб-дизайнер', '1', '+7 (905) 798-14-21', 'Студент', 2, NULL, NULL),
(50, 'SashaMU', '665716b0b8977_2000x1333_1569238_[www.ArtFile.ru].jpg', 'isip_a.yu.maslikov@mpt.ru', '$2y$10$2teYrmbG5qMxTklOIDNL9upAoA4QVyMFjodIWVn1ViyvoQy4YQ/me', 'Масликов', 'александр', 'юревьич', 'Вд44', '1111', '1111', '1', '+7 (903) 537-12-81', 'Студент', 2, NULL, '2024-05-29 14:52:59');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id_documents`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id_question`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `user_ibfk_1` (`id_role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `documents`
--
ALTER TABLE `documents`
  MODIFY `id_documents` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `question`
--
ALTER TABLE `question`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ограничения внешнего ключа таблицы `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE SET NULL ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
