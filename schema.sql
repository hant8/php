-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 01 2022 г., 16:21
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mydeal_master`
CREATE DATABASE mydeal_master DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE `mydeal_master`.`projects` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `mydeal_master`.`projects` (`id`, `user_id`, `name`) VALUES
(1, 1, 'Входящие'),
(2, 1, 'Учеба'),
(3, 1, 'Работа'),
(4, 1, 'Домашние дела'),
(5, 2, 'Авто');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `mydeal_master`.`tasks` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `project_id` int NOT NULL,
  `name` varchar(32) NOT NULL,
  `date` varchar(50) DEFAULT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `file` varchar(50) DEFAULT NULL,
  `date_register` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `mydeal_master`.`tasks` (`id`, `user_id`, `project_id`, `name`, `date`, `completed`, `file`, `date_register`) VALUES
(1, 1, 3, 'Собеседование в IT компании', '2022-09-05', 0, NULL, '2022-09-01 15:24:54'),
(2, 1, 3, 'Выполнить тестовое задание', '2022-09-05', 0, NULL, '2022-09-01 15:24:54'),
(3, 1, 2, 'Сделать задание первого раздела', '2022-09-06', 1, NULL, '2022-09-01 15:24:54'),
(4, 1, 1, 'Встреча с другом', '2022-09-03', 0, NULL, '2022-09-01 15:24:54'),
(5, 1, 4, 'Купить корм для кота', NULL, 0, NULL, '2022-09-01 15:24:54'),
(6, 1, 4, 'Заказать пиццу', NULL, 0, NULL, '2022-09-01 15:24:54');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `mydeal_master`.`users` (
  `id` int NOT NULL,
  `name` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_register` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `mydeal_master`.`users` (`id`, `name`, `email`, `password`, `date_register`) VALUES
(1, 'Владислав', 'nortung1@bk.ru', '$2y$10$mcwm.CgO.FLZKdUix9xT9.TmXOQtAXXGqrI75eB6bYMoNZG3dDIKm', '2022-09-01 15:24:54'),
(2, 'Александр', 'nortung2@bk.ru', '$2y$10$mcwm.CgO.FLZKdUix9xT9.TmXOQtAXXGqrI75eB6bYMoNZG3dDIKm', '2022-09-01 15:25:32');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `projects`
--
ALTER TABLE `mydeal_master`.`projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `projects_index` (`name`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `mydeal_master`.`tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `tasks_index` (`name`,`date`,`completed`,`file`),
  ADD FULLTEXT KEY `name` (`name`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `mydeal_master`.`users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `users_index` (`name`,`email`,`password`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `mydeal_master`.`projects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `mydeal_master`.`tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `mydeal_master`.`users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `projects`
--
ALTER TABLE `mydeal_master`.`projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `mydeal_master`.`tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


