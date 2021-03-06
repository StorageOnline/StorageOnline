-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 23 2018 г., 18:30
-- Версия сервера: 5.7.16
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `storageonline`
--

-- --------------------------------------------------------

--
-- Структура таблицы `counterparties`
--

CREATE TABLE `counterparties` (
  `id` int(11) NOT NULL,
  `type` int(3) NOT NULL COMMENT 'Тип ( 1 - покупатель или 2 - поставщик)',
  `name` varchar(255) DEFAULT NULL COMMENT 'Наименование',
  `tel` varchar(13) NOT NULL COMMENT 'Контактный номер телефона',
  `email` varchar(255) NOT NULL COMMENT 'Контактный email'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `counterparties`
--

INSERT INTO `counterparties` (`id`, `type`, `name`, `tel`, `email`) VALUES
(1, 1, 'ООО \"Рога и Копыта\"', '+380930000000', 'roga@gmail.com'),
(2, 2, 'ООО \"Ольвия\"', '+380670000000', 'olvia@gmail.com'),
(3, 1, 'АТБмаркет', '+380660000000', 'atb@gmail.com');

-- --------------------------------------------------------

--
-- Структура таблицы `incoming_invoices`
--

CREATE TABLE `incoming_invoices` (
  `id` int(11) NOT NULL,
  `incoming_payment_order_id` int(11) DEFAULT NULL COMMENT 'Id приходного ордера',
  `product_id` int(11) DEFAULT NULL COMMENT 'id товара',
  `price` int(11) DEFAULT NULL COMMENT 'Цена товара на момент создания накладной',
  `quantity` int(11) DEFAULT NULL COMMENT 'Количество товара'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `incoming_invoices`
--

INSERT INTO `incoming_invoices` (`id`, `incoming_payment_order_id`, `product_id`, `price`, `quantity`) VALUES
(1, 1, 21, 200, 103),
(2, 1, 27, 20, 10),
(93, 22, 21, 60, 3),
(95, 24, 21, 20, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `incoming_payment_orders`
--

CREATE TABLE `incoming_payment_orders` (
  `id` int(11) NOT NULL,
  `counterparty_id` int(11) NOT NULL COMMENT 'контрагент',
  `sum` int(11) NOT NULL COMMENT 'сумма накладной',
  `quantity` int(11) NOT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `incoming_payment_orders`
--

INSERT INTO `incoming_payment_orders` (`id`, `counterparty_id`, `sum`, `quantity`, `updated_at`, `created_at`) VALUES
(1, 2, 220, 113, '2018-02-04', '2018-01-30'),
(22, 2, 60, 3, '2018-02-04', '2018-02-04'),
(24, 2, 20, 1, '2018-02-09', '2018-02-09');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_02_21_095759_create_sessions_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `outgoing_invoices`
--

CREATE TABLE `outgoing_invoices` (
  `id` int(11) NOT NULL,
  `outgoing_payment_order_id` int(11) DEFAULT NULL COMMENT 'Id расходного ордера',
  `product_id` int(11) DEFAULT NULL COMMENT 'id товара',
  `price` int(11) DEFAULT NULL COMMENT 'Цена товара на момент создания накладной',
  `quantity` int(11) DEFAULT NULL COMMENT 'Количество товара'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `outgoing_invoices`
--

INSERT INTO `outgoing_invoices` (`id`, `outgoing_payment_order_id`, `product_id`, `price`, `quantity`) VALUES
(96, 4, 21, 60, 3),
(97, 4, 23, 40, 2),
(98, 4, 26, 100, 2),
(99, 4, 27, 20, 1),
(100, 5, 21, 80, 4),
(101, 6, 26, 50, 1),
(102, 6, 27, 20, 1),
(103, 6, 23, 20, 1),
(104, 6, 21, 40, 2),
(105, 7, 27, 20, 1),
(106, 7, 26, 50, 1),
(107, 7, 23, 60, 3),
(108, 8, 28, 20, 1),
(109, 8, 26, 50, 1),
(110, 8, 23, 40, 2),
(111, 8, 21, 20, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `outgoing_payment_orders`
--

CREATE TABLE `outgoing_payment_orders` (
  `id` int(11) NOT NULL,
  `counterparty_id` int(11) NOT NULL COMMENT 'контрагент',
  `sum` int(11) NOT NULL COMMENT 'сумма накладной',
  `quantity` int(11) NOT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `outgoing_payment_orders`
--

INSERT INTO `outgoing_payment_orders` (`id`, `counterparty_id`, `sum`, `quantity`, `updated_at`, `created_at`) VALUES
(4, 3, 220, 8, '2018-02-04', '2018-02-04'),
(5, 1, 80, 4, '2018-02-04', '2018-02-04'),
(6, 1, 130, 5, '2018-02-04', '2018-02-04'),
(7, 3, 130, 5, '2018-02-04', '2018-02-04'),
(8, 3, 130, 5, '2018-02-21', '2018-02-21');

-- --------------------------------------------------------

--
-- Структура таблицы `prices`
--

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `prices`
--

INSERT INTO `prices` (`id`, `product_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 23, 22, '2018-02-23 06:09:58', '2018-02-23 06:09:58'),
(5, 27, 22, '2018-02-23 06:50:05', '2018-02-23 06:50:05'),
(6, 27, 20, '2018-02-23 07:10:25', '2018-02-23 07:10:25'),
(13, 23, 20, '2018-02-23 10:03:29', '2018-02-23 10:03:29'),
(14, 23, 50, '2018-02-23 10:03:36', '2018-02-23 10:03:36'),
(15, 23, 55, '2018-02-23 10:03:41', '2018-02-23 10:03:41'),
(16, 23, 40, '2018-02-23 10:03:46', '2018-02-23 10:03:46'),
(17, 27, 25, '2018-02-23 10:04:43', '2018-02-23 10:04:43'),
(18, 27, 24, '2018-02-23 10:04:51', '2018-02-23 10:04:51');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(13) DEFAULT NULL COMMENT 'штрих код',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `quantity`, `price`, `deleted_at`) VALUES
(21, 'Слива', '00001', 107, 20, '2018-02-21 10:11:27'),
(23, 'Груша', '00002', 1, 40, NULL),
(26, 'Абрикос', '00003', 100, 50, '2018-02-21 10:10:03'),
(27, 'Персик', '00005', 10, 24, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '3',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role_id`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', 1, '$2y$10$hdjht6bAAPiH0ZM80d/YRe5PqSNzbcuQiEuEfttuZZAqUetWPx6Xq', 'MHutT29ZWpcPCRDDn3v75Ksv1y8QJsRuQadCQilrVx8eneZKJmtYM4er6rdt', '2018-01-25 19:20:29', '2018-01-25 19:20:29');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `counterparties`
--
ALTER TABLE `counterparties`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `incoming_invoices`
--
ALTER TABLE `incoming_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `incoming_payment_orders`
--
ALTER TABLE `incoming_payment_orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `outgoing_invoices`
--
ALTER TABLE `outgoing_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `outgoing_payment_orders`
--
ALTER TABLE `outgoing_payment_orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `counterparties`
--
ALTER TABLE `counterparties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `incoming_invoices`
--
ALTER TABLE `incoming_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT для таблицы `incoming_payment_orders`
--
ALTER TABLE `incoming_payment_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `outgoing_invoices`
--
ALTER TABLE `outgoing_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT для таблицы `outgoing_payment_orders`
--
ALTER TABLE `outgoing_payment_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
