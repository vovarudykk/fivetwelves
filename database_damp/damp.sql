-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 24 2020 г., 23:50
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `check_events`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Музика'),
(2, 'Кіно'),
(3, 'Концерт');

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(1, 'Київ'),
(2, 'Львів'),
(3, 'Вінниця'),
(4, 'Дніпро'),
(5, 'Одеса'),
(6, 'Рівне'),
(7, 'Харків'),
(8, 'Житомир'),
(9, 'Тернопіль'),
(10, 'Ужгород'),
(11, 'Запоріжжя'),
(12, 'Івано-франківськ'),
(13, 'Кропивницький'),
(14, 'Луцьк'),
(15, 'Миколаїв'),
(16, 'Полтава'),
(17, 'Суми'),
(18, 'Херсон'),
(19, 'Хмельницький'),
(20, 'Черкаси'),
(21, 'Чернігів'),
(22, 'Чернівці');

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `id_city` int(11) NOT NULL,
  `id_place` int(11) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL,
  `id_organizer` int(11) NOT NULL,
  `max_visitors` int(11) NOT NULL,
  `photo` varchar(1000) NOT NULL,
  `visiable` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`id`, `name`, `id_city`, `id_place`, `description`, `date`, `id_organizer`, `max_visitors`, `photo`, `visiable`) VALUES
(1, 'Кінофестиваль «Молодість»', 1, 1, 'Кінофестиваль «Молодість» заснований в 1970 році. Спочатку він був лише дводенним оглядом короткометражних фільмів, які були створені студентами кінематографічного факультету Київського державного інституту ім. Карпенко-Карого. Але через 50 років цей фестиваль перетворився на масштабний міжнародний фестиваль та одночасно одну з головних кіноподій України.', '2020-11-20 19:00:00', 3, 1500, 'https://i.ibb.co/ckKYm6k/1.png', 'yes'),
(4, 'O.TORVALD. XV', 1, 3, 'O.TORVALD запрошує друзів на свій особливий день народження. Хоча карантинні заходи і внесли свої корективи, концерт відбудеться в тихому і камерному форматі. У програмі цього вечора - результати кропіткої п\'ятнадцятирічної праці. Гості будуть насолоджуватися не тільки улюбленими хітами, але і маловідомими версіями пісень, акустичним виконанням і несподіваним аранжуванням.', '2021-02-26 20:00:00', 1, 300, 'https://i.ibb.co/b3LgRPW/2.png', 'yes'),
(5, 'MONATIK: MADE WITH LOVE AND RHYTHM', 4, 4, 'Аншлаг на найбільшому стадіоні країни, тур по Західній Європі та Північній Америці... Більш ніж у 10 тисячах людей все ще живуть ті спогади, без перебільшення, неповторні емоції та враження від шоу MONATIK влітку 2019. У цьому році буде ще крутіше.', '2021-05-08 20:00:00', 2, 500, 'https://i.ibb.co/cYZdbvr/3.png', 'yes');

-- --------------------------------------------------------

--
-- Структура таблицы `events_categories_list`
--

CREATE TABLE `events_categories_list` (
  `id` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `events_categories_list`
--

INSERT INTO `events_categories_list` (`id`, `id_event`, `id_category`) VALUES
(5, 1, 2),
(6, 4, 1),
(7, 5, 1),
(8, 5, 3),
(9, 4, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `organizers`
--

CREATE TABLE `organizers` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `id_city` int(11) NOT NULL,
  `private_or_business` enum('private','business') NOT NULL,
  `company` varchar(300) NOT NULL DEFAULT 'private'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `organizers`
--

INSERT INTO `organizers` (`id`, `name`, `id_city`, `private_or_business`, `company`) VALUES
(1, 'O.TORVALD', 2, 'private', 'private'),
(2, 'MOZGI', 1, 'business', 'MOZGI'),
(3, 'Микулін Сергій Валерійович', 1, 'private', 'private');

-- --------------------------------------------------------

--
-- Структура таблицы `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `id_city` int(11) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `places`
--

INSERT INTO `places` (`id`, `name`, `id_city`, `address`) VALUES
(1, 'Співоче поле', 1, 'вул. Лаврська, 31'),
(2, 'ENNIO EVENT SQUARE', 2, 'вул. Джерельна, 22'),
(3, 'StereoPlaza', 1, 'пр-кт Лобановського, 119'),
(4, 'Стадіон Метеор', 4, 'вул. О. Макарова, 27-А'),
(5, 'Палац Спорту', 1, 'пл. Спортивна, 1'),
(6, 'Стадіон Чорноморець', 5, 'вул. Маразлієвська,1');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `review` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `id_event`, `id_user`, `review`) VALUES
(1, 1, 1, 'Отменный фестиваль, который заслужил все окружающую его шумиху. Невероятное количество знаменитостей со всей Украины стекаются сюда на конференции и презентации. С большинством можно познакомится и поговорить (это очень круто!!!). Однозначно рекомендую)'),
(2, 2, 2, 'Я провел чудесный субботний вечер среди замечательных музыкантов. Меня радовали звуки чудесных инструментов и драйв музыкантов, влюбленных в музыку, как в свою профессию и призвание. ');

-- --------------------------------------------------------

--
-- Структура таблицы `sold_tickets`
--

CREATE TABLE `sold_tickets` (
  `id` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sold_tickets`
--

INSERT INTO `sold_tickets` (`id`, `id_event`, `id_user`) VALUES
(4, 5, 10),
(5, 4, 5),
(6, 1, 10),
(7, 1, 11),
(8, 4, 11),
(11, 5, 11);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `id_city` int(11) NOT NULL,
  `user_hash` varchar(50) NOT NULL DEFAULT '''''',
  `user_ip` varchar(20) NOT NULL DEFAULT '0.0.0.0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `name`, `surname`, `id_city`, `user_hash`, `user_ip`) VALUES
(1, 'Tedd_Mosbyy', 'Tedd', 'tedmosby@gmail.com', 'Владимир', 'Рудык', 1, '8b19b5f7a4815294dbedc79082c632f5', '2130706433'),
(2, 'badboy', 'badboy', 'badboy1248@ukr.net', 'Владислав', 'Петренко', 2, '8b19b5f7a4815294dbedc79082c632f5', '2130706433'),
(3, 'ArtemChek', 'ArtemChek', 'Artem@gmail.com', 'Артем', 'Чебан', 1, '8b19b5f7a4815294dbedc79082c632f5', '2130706433'),
(4, 'login', 'password', 'email', 'name', 'surname', 1, '8b19b5f7a4815294dbedc79082c632f5', '2130706433'),
(5, 'vovarudykk', '4e27232546b9e3565b3c63e1d080cd60', 'rudykviv@gmail.com', 'Vova', 'Rudyk', 1, '8b19b5f7a4815294dbedc79082c632f5', '2130706433'),
(6, 'dulebov2000', '2444f9d99872d2aac2c6b9068fc681cc', 'dulebov@ukr.net', 'Илья', 'Дулебов', 1, '44317e17ca068e8d2a44ea5917452e1f', '2130706433'),
(10, 'Admin', '1ada1f2d8a4cd98cc1d28fd6493f3c72', 'admin@fivetwelves.com', 'Admin', 'Adminovich', 1, '82711800b4d0260938e8b602b3026cda', '2130706433'),
(11, 'adminVova', 'a39f0e22b867bac2c17ac7c326a02f69', 'rudykviv@gmail.com', 'Володимир', 'Рудик', 1, 'aadd6b8d5f57e3ed19a56b72ff53d32a', '2130706433');

-- --------------------------------------------------------

--
-- Структура таблицы `users_categories_list`
--

CREATE TABLE `users_categories_list` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_categories_list`
--

INSERT INTO `users_categories_list` (`id`, `id_category`, `id_user`) VALUES
(1, 2, 1),
(2, 1, 1),
(3, 1, 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_city` (`id_city`),
  ADD KEY `id_organizer` (`id_organizer`),
  ADD KEY `id_place` (`id_place`);

--
-- Индексы таблицы `events_categories_list`
--
ALTER TABLE `events_categories_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_ivent` (`id_event`);

--
-- Индексы таблицы `organizers`
--
ALTER TABLE `organizers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_city` (`id_city`);

--
-- Индексы таблицы `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_city` (`id_city`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ivent` (`id_event`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `sold_tickets`
--
ALTER TABLE `sold_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ivent` (`id_event`),
  ADD KEY `sold_tickets_ibfk_2` (`id_user`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_city` (`id_city`);

--
-- Индексы таблицы `users_categories_list`
--
ALTER TABLE `users_categories_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `categoties_list_ibfk_2` (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `events_categories_list`
--
ALTER TABLE `events_categories_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `organizers`
--
ALTER TABLE `organizers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `sold_tickets`
--
ALTER TABLE `sold_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `users_categories_list`
--
ALTER TABLE `users_categories_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`id_city`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `events_ibfk_3` FOREIGN KEY (`id_organizer`) REFERENCES `organizers` (`id`),
  ADD CONSTRAINT `events_ibfk_4` FOREIGN KEY (`id_place`) REFERENCES `places` (`id`);

--
-- Ограничения внешнего ключа таблицы `events_categories_list`
--
ALTER TABLE `events_categories_list`
  ADD CONSTRAINT `events_categories_list_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `events_categories_list_ibfk_2` FOREIGN KEY (`id_event`) REFERENCES `events` (`id`);

--
-- Ограничения внешнего ключа таблицы `organizers`
--
ALTER TABLE `organizers`
  ADD CONSTRAINT `organizers_ibfk_1` FOREIGN KEY (`id_city`) REFERENCES `cities` (`id`);

--
-- Ограничения внешнего ключа таблицы `places`
--
ALTER TABLE `places`
  ADD CONSTRAINT `places_ibfk_1` FOREIGN KEY (`id_city`) REFERENCES `cities` (`id`);

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `sold_tickets`
--
ALTER TABLE `sold_tickets`
  ADD CONSTRAINT `sold_tickets_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `sold_tickets_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_city`) REFERENCES `cities` (`id`);

--
-- Ограничения внешнего ключа таблицы `users_categories_list`
--
ALTER TABLE `users_categories_list`
  ADD CONSTRAINT `users_categories_list_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `users_categories_list_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
