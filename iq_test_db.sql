-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 27 2018 г., 10:01
-- Версия сервера: 10.1.31-MariaDB
-- Версия PHP: 7.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `iq_test_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `level` int(3) NOT NULL DEFAULT '0',
  `using` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `level`, `using`) VALUES
(1, 51, 13),
(2, 58, 12),
(3, 35, 15),
(4, 30, 12),
(5, 44, 15),
(6, 41, 6),
(7, 65, 11),
(8, 54, 16),
(9, 61, 8),
(10, 56, 9),
(11, 52, 11),
(12, 55, 5),
(13, 62, 4),
(14, 32, 9),
(15, 55, 10),
(16, 41, 14),
(17, 34, 20),
(18, 32, 12),
(19, 34, 12),
(20, 34, 14),
(21, 48, 12),
(22, 41, 11),
(23, 43, 12),
(24, 53, 11),
(25, 44, 9),
(26, 33, 6),
(27, 61, 8),
(28, 48, 6),
(29, 67, 12),
(30, 64, 11),
(31, 62, 13),
(32, 40, 17),
(33, 40, 7),
(34, 44, 12),
(35, 30, 19),
(36, 42, 17),
(37, 37, 16),
(38, 46, 11),
(39, 62, 16),
(40, 51, 14),
(41, 69, 12),
(42, 35, 9),
(43, 66, 11),
(44, 55, 13),
(45, 32, 15),
(46, 47, 15),
(47, 41, 13),
(48, 40, 11),
(49, 50, 10),
(50, 46, 18),
(51, 60, 7),
(52, 50, 11),
(53, 60, 12),
(54, 65, 12),
(55, 46, 18),
(56, 42, 11),
(57, 59, 6),
(58, 54, 14),
(59, 64, 14),
(60, 34, 17),
(61, 62, 17),
(62, 58, 22),
(63, 53, 10),
(64, 50, 11),
(65, 68, 10),
(66, 37, 15),
(67, 51, 17),
(68, 69, 12),
(69, 50, 13),
(70, 51, 10),
(71, 32, 7),
(72, 34, 10),
(73, 61, 13),
(74, 51, 13),
(75, 35, 18),
(76, 63, 12),
(77, 34, 9),
(78, 60, 17),
(79, 58, 12),
(80, 39, 5),
(81, 46, 8),
(82, 45, 4),
(83, 57, 11),
(84, 51, 14),
(85, 39, 12),
(86, 56, 9),
(87, 48, 9),
(88, 62, 5),
(89, 56, 9),
(90, 58, 15),
(91, 32, 16),
(92, 34, 10),
(93, 33, 15),
(94, 59, 13),
(95, 68, 7),
(96, 51, 11),
(97, 63, 15),
(98, 60, 10),
(99, 58, 14),
(100, 66, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `tests`
--

CREATE TABLE `tests` (
  `id` int(10) UNSIGNED NOT NULL,
  `iq` int(3) UNSIGNED NOT NULL DEFAULT '0',
  `levelmin` int(3) UNSIGNED NOT NULL DEFAULT '0',
  `levelmax` int(3) UNSIGNED NOT NULL DEFAULT '0',
  `result` int(2) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tests`
--

INSERT INTO `tests` (`id`, `iq`, `levelmin`, `levelmax`, `result`) VALUES
(1, 90, 51, 85, 34),
(2, 90, 52, 89, 36),
(3, 80, 54, 89, 26),
(4, 75, 51, 89, 21),
(5, 86, 51, 89, 34),
(6, 77, 51, 89, 27),
(7, 88, 51, 89, 34),
(8, 88, 51, 88, 37),
(9, 70, 52, 89, 22),
(10, 30, 51, 89, 4),
(11, 78, 51, 89, 26),
(12, 60, 32, 69, 27),
(13, 56, 30, 67, 27);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT для таблицы `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
