-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 12 2014 г., 22:58
-- Версия сервера: 5.5.29
-- Версия PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `zombiqwerty`
--

-- --------------------------------------------------------

--
-- Структура таблицы `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `parent` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `menus`
--

INSERT INTO `menus` (`id`, `title`, `link`, `parent`, `sort`) VALUES
(1, 'Главная', '/', '', 100),
(2, 'Обо мне', '/about', '1', 200),
(3, 'Портфолио', '/portfolio', '1', 300),
(4, 'Контакты', '/contacts', '1', 400);

-- --------------------------------------------------------

--
-- Структура таблицы `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL,
  `preview` int(11) NOT NULL DEFAULT '0',
  `project_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `pictures`
--

INSERT INTO `pictures` (`id`, `path`, `preview`, `project_id`) VALUES
(1, '/uploads/1.jpg', 1, '1'),
(2, '/uploads/2.jpg', 0, '1'),
(3, '/uploads/3.jpg', 0, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `year` int(11) NOT NULL,
  `client` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `year`, `client`, `category`, `link`) VALUES
(1, 'Тестовая работа', 'тесттесттесттесттестт есттесттесттесттесттесттесттесттесттесттесттесттесттесттесттесттесттесттесттес \nттесттесттесттесттесттесттесттест', 2014, 'Тестовый клиент', 'Тест', 'http://test.ru');
