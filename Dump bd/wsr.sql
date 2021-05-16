-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 16 2021 г., 14:16
-- Версия сервера: 5.7.29
-- Версия PHP: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `wsr`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL COMMENT 'Название'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Тестовая');

-- --------------------------------------------------------

--
-- Структура таблицы `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `status` varchar(256) DEFAULT 'Новая' COMMENT 'Статус',
  `name` varchar(256) NOT NULL COMMENT 'Название',
  `before_img` varchar(256) NOT NULL COMMENT 'Фото до',
  `after_img` varchar(256) DEFAULT NULL COMMENT 'Фото после',
  `why_not` text COMMENT 'Причина отказа',
  `created_at` datetime NOT NULL COMMENT 'Дата создания',
  `created_by` int(11) NOT NULL COMMENT 'Автор',
  `category_id` int(11) NOT NULL COMMENT 'Категория',
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `request`
--

INSERT INTO `request` (`id`, `status`, `name`, `before_img`, `after_img`, `why_not`, `created_at`, `created_by`, `category_id`, `updated_by`) VALUES
(2, 'Новая', '2', 'uploads/1555_oooo.plus.png', '', '', '2021-05-16 12:55:12', 100, 1, 100),
(3, 'Решена', '3', 'uploads/15513104359740.png', '', '', '2021-05-16 13:28:50', 100, 1, 100),
(4, 'Новая', '4', 'uploads/1805_oooo.plus.png', '', '', '2021-05-16 13:54:15', 100, 1, 100),
(5, 'Решена', '6', 'uploads/6533692fa40f7003ebc0664d1c24cfec.jpg', '', '', '2021-05-16 13:54:40', 100, 1, 100);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
