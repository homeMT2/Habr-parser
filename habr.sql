-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Ноя 23 2017 г., 15:30
-- Версия сервера: 5.6.35
-- Версия PHP: 7.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `habr`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `tag_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tag`
--

INSERT INTO `tag` (`id`, `tag_name`) VALUES
(388, 'спортивное программирование'),
(389, 'russian ai cup'),
(390, 'визуализация данных'),
(391, 'выступление'),
(392, 'лаборатория данных'),
(393, 'raycasting'),
(394, 'бросание лучей'),
(395, 'вывод графики'),
(396, '3D'),
(397, 'псевдо 3D'),
(398, 'canvas'),
(399, 'ит-град'),
(400, 'mongodb'),
(401, 'базы данных'),
(402, 'postgresql'),
(403, 'plpgsql'),
(404, 'pgbouncer'),
(405, 'php'),
(406, 'deploy'),
(407, 'облака'),
(408, 'виртуальная инфраструктура'),
(409, 'виртуализация'),
(410, 'хостинг'),
(411, 'ит-инфраструктура'),
(412, 'хранение данных'),
(413, 'даталайн'),
(414, 'dataline'),
(415, 'университеты dataline'),
(416, 'семинары'),
(417, 'ит-образование'),
(418, 'ios development'),
(419, 'swift 4'),
(420, 'стенфордские курсы'),
(421, 'Stanford CS 193 P'),
(422, 'JavaScript'),
(423, 'React'),
(424, 'разработка'),
(425, 'webpack'),
(426, 'webpack 2'),
(427, 'tree-shaking'),
(428, 'typescript'),
(429, 'flow'),
(430, 'google closure compiler'),
(431, 'babel'),
(432, 'java'),
(433, 'vertx'),
(434, 'spring'),
(435, 'rest api'),
(436, 'symfony'),
(437, 'symfony-flex'),
(438, 'tutorial'),
(439, 'bitfury'),
(440, 'exonum'),
(441, 'python'),
(442, 'blockchain'),
(443, 'блокчейн'),
(444, 'английский'),
(445, 'изучение языков'),
(446, 'изучение иностранных языков'),
(447, 'HolyJS'),
(448, 'конференция'),
(449, 'dueros'),
(450, 'распознавание речи'),
(451, 'heisenbug'),
(452, 'heisenbug2017moscow'),
(453, 'тестирование'),
(454, 'testing'),
(455, 'software testing'),
(456, 'qa'),
(457, 'qa automation'),
(458, 'manual testing'),
(459, 'python 3.5'),
(460, 'tornado'),
(461, 'я пиарюсь'),
(462, 'atlassian'),
(463, 'meetup'),
(464, '1cloud'),
(465, 'iaas'),
(466, 'безопасность облака'),
(467, 'никто не читает теги'),
(468, 'учебный процесс в it'),
(469, 'selenium'),
(470, 'selenium-webdriver'),
(471, 'selenium-ide'),
(472, 'selenium-grid'),
(473, 'docker'),
(474, 'sap'),
(475, 'hana'),
(476, 'oracle'),
(477, 'abap'),
(478, 'hasso'),
(479, 's/4 hana'),
(480, 's/4hana'),
(481, 'mail.ru'),
(482, 'highloadcup'),
(483, 'чемпионат'),
(484, 'highload'),
(485, 'программирование'),
(486, 'backend'),
(487, 'администрирование'),
(488, 'аглоритмы');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=489;