-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 18 2021 г., 12:23
-- Версия сервера: 10.4.22-MariaDB
-- Версия PHP: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `hackathon`
--

-- --------------------------------------------------------

--
-- Структура таблицы `organizations`
--

CREATE TABLE `organizations` (
  `INN` int(11) NOT NULL COMMENT 'Инн организации',
  `Name` text COLLATE utf8_unicode_ci NOT NULL,
  `FullName` text COLLATE utf8_unicode_ci NOT NULL,
  `director` text COLLATE utf8_unicode_ci NOT NULL,
  `OGRN` int(11) NOT NULL,
  `KPP` int(11) NOT NULL,
  `Address` text COLLATE utf8_unicode_ci NOT NULL,
  `OKVED` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tests`
--

CREATE TABLE `tests` (
  `TestID` int(11) NOT NULL,
  `Name` text COLLATE utf8_unicode_ci NOT NULL,
  `Desc` text COLLATE utf8_unicode_ci NOT NULL,
  `Test` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`Test`)),
  `RightAnswers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`RightAnswers`)),
  `AllPoints` int(11) NOT NULL,
  `AfterTestInfo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`AfterTestInfo`)),
  `Img` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `ID` bigint(20) NOT NULL,
  `fio` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `PassData` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `INN` int(11) DEFAULT NULL,
  `Phone` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `BIK` int(11) DEFAULT NULL,
  `KPP` int(11) DEFAULT NULL,
  `Korr` bigint(20) DEFAULT NULL,
  `Rasch` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `ApiKey` text COLLATE utf8_unicode_ci NOT NULL,
  `Email` text COLLATE utf8_unicode_ci NOT NULL,
  `Password` text COLLATE utf8_unicode_ci NOT NULL,
  `points` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`ID`, `fio`, `PassData`, `INN`, `Phone`, `BIK`, `KPP`, `Korr`, `Rasch`, `ApiKey`, `Email`, `Password`, `points`) VALUES
(1, 'Жмышенко Валерий Альбертович', '1819 446715\nОтделением №5 МО УФМС по Московской области в городе Москва', 312602678, '+78005553535', 44525000, NULL, 2147483647, '30101810400000000225', '1', 'test@mail.ru', 'c4ca4238a0b923820dcc509a6f75849b', 5000);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `organizations`
--
ALTER TABLE `organizations`
  ADD UNIQUE KEY `INN` (`INN`);

--
-- Индексы таблицы `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`TestID`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`) USING HASH;

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tests`
--
ALTER TABLE `tests`
  MODIFY `TestID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
