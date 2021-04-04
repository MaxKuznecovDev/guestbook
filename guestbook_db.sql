-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 04 2021 г., 21:15
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `guestbook_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `ID_COMMENT` int NOT NULL,
  `ID_USER` int NOT NULL,
  `text` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`ID_COMMENT`, `ID_USER`, `text`, `data`) VALUES
(1, 3, 'Классика игрового жанра. Space Invaders 2500 очков))', '15.01.2021 18:50:28'),
(4, 4, 'Такие были 80-е, мы играли как могли. Передаю привет всем ветеранам движения! SI-3400, S-700', '16.01.2021 20:56:23'),
(5, 5, 'Прекрасная возможность вспомнить молодость и поиграть в игрушки, в которые играл 20+ лет назад.', '21.01.2021 02:03:26'),
(6, 6, 'Совершенно отличная ламповая реализация той самой домашней атмосферы, в которой многие из нас впервые познакомились с играми)', '02.02.2021 14:06:02'),
(7, 4, 'Полностью согласен с Анатолием! ', '09.02.2021 21:08:33'),
(8, 3, 'Улучшил свой рекорд Space Invaders на 1600 очков - теперь 4100!', '14.02.2021 23:10:42'),
(9, 7, 'Эх .... как это было давно ! Но никогда не поздно вернуться в то самое время, когда не было забот и хлопот!', '19.02.2021 15:45:49'),
(10, 8, 'Я конечно не застал эти игры, но мне понравилось.', '25.02.2021 21:16:29');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `login`, `password`) VALUES
(3, 'Иван', 'ivan@mail.ru', 'Ivan', 'BVWzvZ'),
(4, 'Валерий', 'valera@mail.ru', 'valera', 'BVlM4l'),
(5, 'Оксана', 'oksana@mail.ru', 'oksana', 'nJD6ND'),
(6, 'Анатолий', 'Tolya@mail.ru', 'tolya', 'kvvzaW'),
(7, 'Иннокентий ', 'kesha@mail.ru', 'kesha', ' Ns5eYF'),
(8, 'Дмитрий', 'dima@mail.ru', 'dima', 'ylBHMz');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`ID_COMMENT`),
  ADD KEY `ID_USER` (`ID_USER`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `ID_COMMENT` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
