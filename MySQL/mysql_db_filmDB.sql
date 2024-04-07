-- Adminer 4.8.1 MySQL 8.2.0 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `movies`;
CREATE TABLE `movies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(512) COLLATE utf8mb4_czech_ci NOT NULL,
  `author` varchar(512) COLLATE utf8mb4_czech_ci NOT NULL,
  `description` varchar(1024) COLLATE utf8mb4_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

INSERT INTO `movies` (`id`, `name`, `author`, `description`) VALUES
(1,	'Horizont udalosti',	'Paul W.S. Anderson',	'V roce 2015 byla na Měsíci založena první stálá kolonie. V roce 2032 začínala těžba nerostných surovin na Marsu. V roce 2040 se moderní kosmická loď Horizont události vydala k hranicím sluneční soustavy. Za planetou Neptun zmizela beze stopy. Šlo o nejhorší vesmírnou katastrofu v historii. Po sedmi letech však opět vyslala signál, z něhož se podařilo rozluštit několik znepokojivých slov.'),
(2,	'Krotitelé duchů',	'Ivan Reitman',	'Nachystejte se na komediální klasiku! Když se doktoři Venkman (Bill Murray), Stantz (Dan Aykroyd) a Spengler (Harold Ramis) z katedry parapsychologie nenadále ocitnou na dlažbě, rozhodnou se vydat na cestu lovců duchů - nevábných a občas poněkud drzých potvor. Sotva otevřou dveře, už se jim hrnou první zakázky'),
(3,	'Návrat do budoucnosti',	'Robert Zemeckis',	'V kultovním sci-fi filmu Návrat do budoucnosti se hlavní hrdina Marty ocitne díky vynálezu svého kamaráda, šíleného doktora Emmetta Browna v minulosti. Stroj času je zabudovaný v legendárním autě Delorean, který ho přenese do roku 1955, kdy se jeho rodiče teprve coby středoškoláci seznamovali. Martymu se náhodou povede narušit časové kontinuum a pak musí svou chybu napravit, aby se vůbec v budoucnosti narodil.');

-- 2024-04-07 21:52:16
