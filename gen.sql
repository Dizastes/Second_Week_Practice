-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 03 2024 г., 14:04
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gen`
--

-- --------------------------------------------------------

--
-- Структура таблицы `agreement`
--

CREATE TABLE `agreement` (
  `id` int NOT NULL,
  `type_id` int NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `agreement`
--

INSERT INTO `agreement` (`id`, `type_id`, `created_at`, `updated_at`) VALUES
(22, 2, '2024-05-03', '2024-05-03');

-- --------------------------------------------------------

--
-- Структура таблицы `characteristics`
--

CREATE TABLE `characteristics` (
  `id` int NOT NULL,
  `charact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `characteristics`
--

INSERT INTO `characteristics` (`id`, `charact`) VALUES
(1, 'Находчивость'),
(2, 'Своевременность'),
(3, 'Командная работа'),
(4, 'Пунктуальность'),
(5, 'Упорство'),
(6, 'Стрессоустойчивость'),
(7, 'Внимательность'),
(8, 'Любознательность'),
(9, 'Инициативность');

-- --------------------------------------------------------

--
-- Структура таблицы `direction`
--

CREATE TABLE `direction` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `institute_id` int NOT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `director_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `direction`
--

INSERT INTO `direction` (`id`, `name`, `code`, `institute_id`, `updated_at`, `created_at`, `director_id`) VALUES
(2, 'Программная инженерия', '09-03-04', 2, '2024-05-03', '2024-05-03', 20);

-- --------------------------------------------------------

--
-- Структура таблицы `director`
--

CREATE TABLE `director` (
  `id` int NOT NULL,
  `post` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  `user_id` int NOT NULL,
  `responsibillity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `director`
--

INSERT INTO `director` (`id`, `post`, `updated_at`, `created_at`, `user_id`, `responsibillity`) VALUES
(20, 'Сосущий', '2024-05-03', '2024-05-03', 3, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `dir_res`
--

CREATE TABLE `dir_res` (
  `id` int NOT NULL,
  `director_id` int NOT NULL,
  `respons_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `institute`
--

CREATE TABLE `institute` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `institute`
--

INSERT INTO `institute` (`id`, `name`, `updated_at`, `created_at`) VALUES
(2, 'Инженерная школа цифровых технологий', '2024-05-03', '2024-05-03');

-- --------------------------------------------------------

--
-- Структура таблицы `orderr`
--

CREATE TABLE `orderr` (
  `id` int NOT NULL,
  `number` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `pract_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orderr`
--

INSERT INTO `orderr` (`id`, `number`, `date`, `created_at`, `updated_at`, `pract_id`) VALUES
(17, '52', '2024-04-29', '2024-05-03', '2024-05-03', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `place`
--

CREATE TABLE `place` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` text NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `place`
--

INSERT INTO `place` (`id`, `name`, `address`, `city`, `created_at`, `updated_at`) VALUES
(15, 'Югорский Государственный Университет', 'Чехова 16', 'Ханты-Мансийск', '2024-05-03', '2024-05-03');

-- --------------------------------------------------------

--
-- Структура таблицы `pract`
--

CREATE TABLE `pract` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `type_id` int NOT NULL,
  `view_id` int NOT NULL,
  `place_id` int DEFAULT NULL,
  `date_begin` date NOT NULL,
  `date_end` date NOT NULL,
  `order_id` int DEFAULT NULL,
  `director_id` int DEFAULT NULL,
  `director_ugu_id` int DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `director_pr_id` int DEFAULT NULL,
  `director_or_id` int DEFAULT NULL,
  `year` int NOT NULL,
  `agreement_id` int DEFAULT NULL,
  `money` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `pract`
--

INSERT INTO `pract` (`id`, `name`, `type_id`, `view_id`, `place_id`, `date_begin`, `date_end`, `order_id`, `director_id`, `director_ugu_id`, `created_at`, `updated_at`, `director_pr_id`, `director_or_id`, `year`, `agreement_id`, `money`) VALUES
(6, 'Производственная', 4, 1, 15, '2024-05-01', '2024-05-03', 17, 20, 20, '2024-05-03', '2024-05-03', 20, 20, 2024, 22, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `pract_characteristic`
--

CREATE TABLE `pract_characteristic` (
  `id` int NOT NULL,
  `pract_id` int NOT NULL,
  `characteristic_id` int NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `pract_characteristic`
--

INSERT INTO `pract_characteristic` (`id`, `pract_id`, `characteristic_id`, `updated_at`, `created_at`) VALUES
(61, 15, 1, '2024-05-03', '2024-05-03'),
(62, 15, 2, '2024-05-03', '2024-05-03'),
(63, 15, 3, '2024-05-03', '2024-05-03'),
(64, 15, 4, '2024-05-03', '2024-05-03'),
(65, 15, 5, '2024-05-03', '2024-05-03'),
(66, 15, 6, '2024-05-03', '2024-05-03'),
(67, 15, 7, '2024-05-03', '2024-05-03'),
(68, 15, 8, '2024-05-03', '2024-05-03');

-- --------------------------------------------------------

--
-- Структура таблицы `pract_group`
--

CREATE TABLE `pract_group` (
  `id` int NOT NULL,
  `pract_id` int NOT NULL,
  `group_id` int NOT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `pract_group`
--

INSERT INTO `pract_group` (`id`, `pract_id`, `group_id`, `updated_at`, `created_at`) VALUES
(5, 6, 3, '2024-05-03', '2024-05-03');

-- --------------------------------------------------------

--
-- Структура таблицы `pract_problem`
--

CREATE TABLE `pract_problem` (
  `id` int NOT NULL,
  `pract_id` int NOT NULL,
  `problem_id` int NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `pract_problem`
--

INSERT INTO `pract_problem` (`id`, `pract_id`, `problem_id`, `updated_at`, `created_at`) VALUES
(26, 15, 1, '2024-05-03', '2024-05-03'),
(27, 15, 2, '2024-05-03', '2024-05-03'),
(28, 15, 4, '2024-05-03', '2024-05-03');

-- --------------------------------------------------------

--
-- Структура таблицы `pract_remark`
--

CREATE TABLE `pract_remark` (
  `id` int NOT NULL,
  `pract_id` int NOT NULL,
  `remark_id` int NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `pract_remark`
--

INSERT INTO `pract_remark` (`id`, `pract_id`, `remark_id`, `updated_at`, `created_at`) VALUES
(17, 15, 4, '2024-05-03', '2024-05-03');

-- --------------------------------------------------------

--
-- Структура таблицы `pract_student`
--

CREATE TABLE `pract_student` (
  `id` int NOT NULL,
  `pract_id` int NOT NULL,
  `student_id` int NOT NULL,
  `volume_id` int DEFAULT NULL,
  `mark` int DEFAULT NULL,
  `reason_id` int DEFAULT NULL,
  `complete` tinyint(1) DEFAULT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  `status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `tasks` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `pract_student`
--

INSERT INTO `pract_student` (`id`, `pract_id`, `student_id`, `volume_id`, `mark`, `reason_id`, `complete`, `updated_at`, `created_at`, `status`, `tasks`) VALUES
(15, 6, 3, 4, 5, NULL, 1, '2024-05-03', '2024-05-03', 'Подтверждено', '234,234,234');

-- --------------------------------------------------------

--
-- Структура таблицы `problem`
--

CREATE TABLE `problem` (
  `id` int NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `problem`
--

INSERT INTO `problem` (`id`, `name`) VALUES
(1, 'оперативно'),
(2, 'легко'),
(3, 'с трудом'),
(4, 'креативно'),
(1, 'оперативно'),
(2, 'легко'),
(3, 'с трудом'),
(4, 'креативно');

-- --------------------------------------------------------

--
-- Структура таблицы `reasons`
--

CREATE TABLE `reasons` (
  `id` int NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `reasons`
--

INSERT INTO `reasons` (`id`, `name`) VALUES
(2, 'Декрет'),
(3, 'Академический отпуск'),
(5, 'Семейные обстоятельства'),
(6, 'Болезнь'),
(7, 'Суд'),
(2, 'Декрет'),
(3, 'Академический отпуск'),
(5, 'Семейные обстоятельства'),
(6, 'Болезнь'),
(7, 'Суд');

-- --------------------------------------------------------

--
-- Структура таблицы `remarks`
--

CREATE TABLE `remarks` (
  `id` int NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `remarks`
--

INSERT INTO `remarks` (`id`, `remarks`) VALUES
(1, 'не посещал занятия'),
(2, 'не справлялся на с поставленными задачами'),
(3, 'вызывал конфликты'),
(4, 'нет'),
(1, 'не посещал занятия'),
(2, 'не справлялся на с поставленными задачами'),
(3, 'вызывал конфликты'),
(4, 'нет');

-- --------------------------------------------------------

--
-- Структура таблицы `responsillities`
--

CREATE TABLE `responsillities` (
  `id` int NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `responsillities`
--

INSERT INTO `responsillities` (`id`, `name`) VALUES
(0, 'Руководитель от ВУЗа'),
(1, 'Руководитель от предприятия'),
(2, 'Руководитель от организации'),
(3, 'Руководителя практики'),
(0, 'Руководитель от ВУЗа'),
(1, 'Руководитель от предприятия'),
(2, 'Руководитель от организации'),
(3, 'Руководителя практики');

-- --------------------------------------------------------

--
-- Структура таблицы `student`
--

CREATE TABLE `student` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `group_id` int NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `student`
--

INSERT INTO `student` (`id`, `user_id`, `group_id`, `created_at`, `updated_at`) VALUES
(3, 4, 3, '2024-05-03', '2024-05-03');

-- --------------------------------------------------------

--
-- Структура таблицы `student_group`
--

CREATE TABLE `student_group` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `course` int DEFAULT NULL,
  `direction_id` int NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `student_group`
--

INSERT INTO `student_group` (`id`, `name`, `course`, `direction_id`, `created_at`, `updated_at`) VALUES
(3, '1521б', 2, 2, '2024-05-03', '2024-05-03');

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `id` int NOT NULL,
  `task` text NOT NULL,
  `date` date NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  `pract_student_id` int NOT NULL,
  `pract_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `type_agreement`
--

CREATE TABLE `type_agreement` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `type_agreement`
--

INSERT INTO `type_agreement` (`id`, `name`) VALUES
(1, 'Долгосрочный'),
(2, 'Короткосрочный'),
(1, 'Долгосрочный'),
(2, 'Короткосрочный');

-- --------------------------------------------------------

--
-- Структура таблицы `type_pract`
--

CREATE TABLE `type_pract` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `type_pract`
--

INSERT INTO `type_pract` (`id`, `name`) VALUES
(1, 'Научно-исследовательская'),
(2, 'Производственная'),
(3, 'Технологическая'),
(4, 'Ознакомительная'),
(5, 'Преддипломная'),
(1, 'Научно-исследовательская'),
(2, 'Производственная'),
(3, 'Технологическая'),
(4, 'Ознакомительная'),
(5, 'Преддипломная');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `first_name` text NOT NULL,
  `second_name` text NOT NULL,
  `third_name` text NOT NULL,
  `role` int NOT NULL DEFAULT '0',
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `second_name`, `third_name`, `role`, `login`, `password`, `updated_at`, `created_at`) VALUES
(3, 'Никита', 'Заболотин', 'Сергеевич', 2, 'Inkashi', '$2y$12$ex8bVCc1jQjKZKtFzM6XCeIihL8L8v3n6J.cL/YKMz1Fr70niH0k.', '2024-05-03', '2024-05-03'),
(4, 'Михаил', 'Максимчук', 'Юрьевич', 0, 'lollipop', '$2y$12$ekDMFyWjUyJiO9x2j6hb0.oOtBCr7gOpMzhg3qW0xda8WGjRBSkBm', '2024-05-03', '2024-05-03');

-- --------------------------------------------------------

--
-- Структура таблицы `view_pract`
--

CREATE TABLE `view_pract` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `view_pract`
--

INSERT INTO `view_pract` (`id`, `name`) VALUES
(1, 'Учебная'),
(2, 'Производственная'),
(1, 'Учебная'),
(2, 'Производственная');

-- --------------------------------------------------------

--
-- Структура таблицы `volume`
--

CREATE TABLE `volume` (
  `id` int NOT NULL,
  `volume` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `volume`
--

INSERT INTO `volume` (`id`, `volume`) VALUES
(1, 'в полном объеме'),
(2, 'частично'),
(3, 'не выполнена'),
(4, 'успешно'),
(1, 'в полном объеме'),
(2, 'частично'),
(3, 'не выполнена'),
(4, 'успешно');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `agreement`
--
ALTER TABLE `agreement`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `characteristics`
--
ALTER TABLE `characteristics`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `direction`
--
ALTER TABLE `direction`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dir_res`
--
ALTER TABLE `dir_res`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `institute`
--
ALTER TABLE `institute`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orderr`
--
ALTER TABLE `orderr`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pract`
--
ALTER TABLE `pract`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pract_characteristic`
--
ALTER TABLE `pract_characteristic`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pract_group`
--
ALTER TABLE `pract_group`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pract_problem`
--
ALTER TABLE `pract_problem`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pract_remark`
--
ALTER TABLE `pract_remark`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pract_student`
--
ALTER TABLE `pract_student`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `student_group`
--
ALTER TABLE `student_group`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `agreement`
--
ALTER TABLE `agreement`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `direction`
--
ALTER TABLE `direction`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `director`
--
ALTER TABLE `director`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `institute`
--
ALTER TABLE `institute`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `orderr`
--
ALTER TABLE `orderr`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `place`
--
ALTER TABLE `place`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `pract`
--
ALTER TABLE `pract`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `pract_characteristic`
--
ALTER TABLE `pract_characteristic`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT для таблицы `pract_group`
--
ALTER TABLE `pract_group`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `pract_problem`
--
ALTER TABLE `pract_problem`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `pract_remark`
--
ALTER TABLE `pract_remark`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `pract_student`
--
ALTER TABLE `pract_student`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `student`
--
ALTER TABLE `student`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `student_group`
--
ALTER TABLE `student_group`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
