-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 03-12-2025 a las 10:49:28
-- Versión del servidor: 8.0.40
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Eymshop`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `benutzer`
--

CREATE TABLE `benutzer` (
  `benutzer_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `passwort` varchar(255) NOT NULL,
  `erstellt_am` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `benutzer`
--

INSERT INTO `benutzer` (`benutzer_id`, `name`, `email`, `passwort`, `erstellt_am`) VALUES
(1, 'Edi', 'edi.pruebas14@gmail.com', '$2y$10$Ji/twBz9tHki2hL/v3ZnGOK2X0.dhBLoondL/fxHiZemV3q0luI72', '2025-11-29 20:16:58'),
(2, 'Elver', 'elvertest@gmail.com', '$2y$10$jpUOWaIYhR2QyBZCtYIgkOo4TAqHm.lvCSX4wXIRf2yXfuIVxmVx.', '2025-11-29 20:27:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bestellpositionen`
--

CREATE TABLE `bestellpositionen` (
  `positions_id` int NOT NULL,
  `bestell_id` int NOT NULL,
  `produkt_id` int NOT NULL,
  `menge` int NOT NULL,
  `stueckpreis` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bestellungen`
--

CREATE TABLE `bestellungen` (
  `bestell_id` int NOT NULL,
  `benutzer_id` int NOT NULL,
  `gesamtpreis` decimal(10,2) NOT NULL,
  `erstellt_am` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `farben`
--

CREATE TABLE `farben` (
  `farb_id` int NOT NULL,
  `farbe` varchar(50) NOT NULL,
  `farbcode` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `farben`
--

INSERT INTO `farben` (`farb_id`, `farbe`, `farbcode`) VALUES
(1, 'Blau', '#0000FF'),
(2, 'Rot', '#FF0000'),
(3, 'Schwarz', '#000000'),
(4, 'Weiß', '#FFFFFF'),
(5, 'Grün', '#00FF00'),
(6, 'Grau', '#808080'),
(7, 'Beige', '#F5F5DC'),
(8, 'Navy', '#000080'),
(9, 'Rosa', '#FFC0CB'),
(10, 'Braun', '#A52A2A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groessen`
--

CREATE TABLE `groessen` (
  `groessen_id` int NOT NULL,
  `groesse` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `groessen`
--

INSERT INTO `groessen` (`groessen_id`, `groesse`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL'),
(5, 'XXL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kategorien`
--

CREATE TABLE `kategorien` (
  `kategorie_id` int NOT NULL,
  `kategoriename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `kategorien`
--

INSERT INTO `kategorien` (`kategorie_id`, `kategoriename`) VALUES
(1, 'Herren'),
(2, 'Damen'),
(3, 'Mädchen');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lagerbestand`
--

CREATE TABLE `lagerbestand` (
  `lager_id` int NOT NULL,
  `produkt_id` int NOT NULL,
  `farb_id` int NOT NULL,
  `groessen_id` int NOT NULL,
  `verfuegbare_menge` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `lagerbestand`
--

INSERT INTO `lagerbestand` (`lager_id`, `produkt_id`, `farb_id`, `groessen_id`, `verfuegbare_menge`) VALUES
(1, 1, 1, 2, 20),
(2, 1, 1, 3, 15),
(3, 2, 3, 2, 18),
(4, 2, 3, 4, 12),
(5, 3, 6, 3, 10),
(6, 3, 6, 4, 8),
(7, 4, 1, 1, 10),
(8, 4, 1, 2, 14),
(9, 5, 8, 3, 9),
(10, 5, 8, 4, 7),
(11, 6, 3, 1, 12),
(12, 6, 3, 2, 16),
(13, 7, 7, 2, 14),
(14, 7, 7, 3, 10),
(15, 8, 1, 2, 15),
(16, 8, 1, 3, 11),
(17, 9, 6, 3, 9),
(18, 9, 6, 4, 7),
(19, 10, 5, 1, 20),
(20, 10, 5, 2, 18),
(21, 11, 4, 2, 25),
(22, 11, 4, 3, 20),
(23, 12, 2, 2, 18),
(24, 12, 2, 3, 15),
(25, 13, 5, 3, 14),
(26, 13, 5, 4, 10),
(27, 14, 3, 4, 12),
(28, 14, 3, 5, 8),
(29, 15, 8, 2, 16),
(30, 15, 8, 3, 12),
(31, 16, 9, 1, 15),
(32, 16, 9, 2, 12),
(33, 17, 4, 1, 14),
(34, 17, 4, 2, 11),
(35, 18, 9, 2, 13),
(36, 18, 9, 3, 9),
(37, 19, 5, 1, 12),
(38, 19, 5, 2, 10),
(39, 20, 1, 1, 11),
(40, 20, 1, 2, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produktbilder`
--

CREATE TABLE `produktbilder` (
  `bild_id` int NOT NULL,
  `produkt_id` int NOT NULL,
  `bild_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produkte`
--

CREATE TABLE `produkte` (
  `produkt_id` int NOT NULL,
  `kategorie_id` int NOT NULL,
  `produktname` varchar(150) NOT NULL,
  `markenname` varchar(100) DEFAULT NULL,
  `kurzbeschreibung` varchar(255) DEFAULT NULL,
  `produktbeschreibung` text,
  `preis` decimal(10,2) NOT NULL,
  `hauptbild` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `produkte`
--

INSERT INTO `produkte` (`produkt_id`, `kategorie_id`, `produktname`, `markenname`, `kurzbeschreibung`, `produktbeschreibung`, `preis`, `hauptbild`) VALUES
(1, 1, 'Herren Slim Fit Jeans Dunkelblau', 'UrbanDenim', 'Schmale Jeans aus Baumwolle', 'Moderne Herren-Slim-Fit-Jeans in Dunkelblau, perfekt für Alltag und Büro.', 59.90, 'assets/images/herren_jeans_slim_dunkelblau.jpg'),
(2, 1, 'Herren Regular Jeans Schwarz', 'ClassicDenim', 'Klassische schwarze Jeans', 'Zeitlose Herrenjeans in Schwarz mit geradem Schnitt und hohem Tragekomfort.', 69.90, 'assets/images/herren_jeans_regular_schwarz.jpg'),
(3, 1, 'Herren Relaxed Jeans Grau', 'StreetWearCo', 'Lockere graue Jeans', 'Bequeme Relaxed-Fit-Jeans für einen lässigen Streetwear-Look.', 54.90, 'assets/images/herren_jeans_relaxed_grau.jpg'),
(4, 1, 'Herren Jeans Hellblau', 'BlueLine', 'Helle Jeans für den Alltag', 'Leichte Herrenjeans in Hellblau, ideal für Frühling und Sommer.', 49.90, 'assets/images/herren_jeans_hellblau.jpg'),
(5, 1, 'Herren Stretch Jeans Navy', 'UrbanDenim', 'Elastische Jeans in Navy', 'Angenehme Stretch-Jeans in Navy mit schmalem Bein.', 79.90, 'assets/images/herren_jeans_stretch_navy.jpg'),
(6, 2, 'Damen Stoffhose Schwarz', 'CityStyle', 'Elegante schwarze Stoffhose', 'Leichte Damen-Stoffhose in Schwarz, ideal fürs Büro.', 39.90, 'assets/images/damen_stoffhose_schwarz.jpg'),
(7, 2, 'Damen Chinohose Beige', 'CityStyle', 'Bequeme Chino in Beige', 'Moderne Damen-Chinohose in Beige mit schmalem Bein.', 49.90, 'assets/images/damen_chino_beige.jpg'),
(8, 2, 'Damen High Waist Jeans Blau', 'EymFashion', 'High-Waist Jeans', 'Figurbetonte High-Waist-Jeans in klassischem Blau.', 59.90, 'assets/images/damen_highwaist_jeans_blau.jpg'),
(9, 2, 'Damen Business Hose Grau', 'OfficeLine', 'Business-Hose in Grau', 'Elegante graue Hose für Business- und formelle Anlässe.', 54.90, 'assets/images/damen_business_hose_grau.jpg'),
(10, 2, 'Damen Leggings Dunkelgrün', 'ActiveFit', 'Bequeme Leggings', 'Elastische Damen-Leggings in Dunkelgrün für Freizeit und Sport.', 29.90, 'assets/images/damen_leggings_dunkelgruen.jpg'),
(11, 1, 'Herren T-Shirt Weiß Basic', 'EymBrand', 'Weißes Basic-T-Shirt', 'Klassisches weißes Herren-T-Shirt aus weicher Baumwolle.', 14.90, 'assets/images/herren_tshirt_weiss_basic.jpg'),
(12, 1, 'Herren T-Shirt Rot mit Logo', 'SportLine', 'Rotes T-Shirt mit Frontlogo', 'Sportliches rotes T-Shirt mit dezentem Brustlogo.', 24.90, 'assets/images/herren_tshirt_rot_logo.jpg'),
(13, 1, 'Herren T-Shirt Grün Sport', 'ActiveFit', 'Grünes Sport-T-Shirt', 'Atmungsaktives T-Shirt in Grün, ideal für Training und Alltag.', 19.90, 'assets/images/herren_tshirt_gruen_sport.jpg'),
(14, 1, 'Herren T-Shirt Schwarz Oversize', 'StreetWearCo', 'Oversize T-Shirt Schwarz', 'Modernes Oversize-T-Shirt in Schwarz mit weitem Schnitt.', 29.90, 'assets/images/herren_tshirt_schwarz_oversize.jpg'),
(15, 1, 'Herren T-Shirt Navy Streifen', 'BlueLine', 'Gestreiftes T-Shirt', 'Navy T-Shirt mit feinen weißen Streifen, maritimer Look.', 22.90, 'assets/images/herren_tshirt_navy_streifen.jpg'),
(16, 3, 'Mädchen T-Shirt Rosa Herz', 'KidsDream', 'Rosa T-Shirt mit Herz', 'Süßes Mädchen-T-Shirt in Rosa mit Herz-Print.', 12.90, 'assets/images/maedchen_tshirt_rosa_herz.jpg'),
(17, 3, 'Mädchen T-Shirt Weiß Einhorn', 'KidsDream', 'Weißes T-Shirt mit Einhorn', 'Mädchen-T-Shirt in Weiß mit buntem Einhorn-Motiv.', 14.90, 'assets/images/maedchen_tshirt_weiss_einhorn.jpg'),
(18, 3, 'Mädchen T-Shirt Rosa Sterne', 'KidsDream', 'Rosa T-Shirt mit Sternen', 'Bequemes T-Shirt in Rosa mit kleinen Sternen.', 11.90, 'assets/images/maedchen_tshirt_rosa_sterne.jpg'),
(19, 3, 'Mädchen T-Shirt Grün Flower', 'KidsNature', 'Grünes T-Shirt mit Blumen', 'Mädchen-T-Shirt in Grün mit Blumen-Print.', 13.90, 'assets/images/maedchen_tshirt_gruen_flower.jpg'),
(20, 3, 'Mädchen T-Shirt Blau Smile', 'KidsFun', 'Blaues T-Shirt mit Smile-Print', 'Leichtes T-Shirt in Blau mit Smile-Grafik auf der Front.', 11.50, 'assets/images/maedchen_tshirt_blau_smile.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`benutzer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `bestellpositionen`
--
ALTER TABLE `bestellpositionen`
  ADD PRIMARY KEY (`positions_id`),
  ADD KEY `fk_position_bestellung` (`bestell_id`),
  ADD KEY `fk_position_produkt` (`produkt_id`);

--
-- Indices de la tabla `bestellungen`
--
ALTER TABLE `bestellungen`
  ADD PRIMARY KEY (`bestell_id`),
  ADD KEY `fk_bestellung_benutzer` (`benutzer_id`);

--
-- Indices de la tabla `farben`
--
ALTER TABLE `farben`
  ADD PRIMARY KEY (`farb_id`);

--
-- Indices de la tabla `groessen`
--
ALTER TABLE `groessen`
  ADD PRIMARY KEY (`groessen_id`);

--
-- Indices de la tabla `kategorien`
--
ALTER TABLE `kategorien`
  ADD PRIMARY KEY (`kategorie_id`);

--
-- Indices de la tabla `lagerbestand`
--
ALTER TABLE `lagerbestand`
  ADD PRIMARY KEY (`lager_id`),
  ADD KEY `fk_lager_produkt` (`produkt_id`),
  ADD KEY `fk_lager_farbe` (`farb_id`),
  ADD KEY `fk_lager_groesse` (`groessen_id`);

--
-- Indices de la tabla `produktbilder`
--
ALTER TABLE `produktbilder`
  ADD PRIMARY KEY (`bild_id`),
  ADD KEY `fk_produktbilder_produkt` (`produkt_id`);

--
-- Indices de la tabla `produkte`
--
ALTER TABLE `produkte`
  ADD PRIMARY KEY (`produkt_id`),
  ADD KEY `fk_produkte_kategorie` (`kategorie_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `benutzer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `bestellpositionen`
--
ALTER TABLE `bestellpositionen`
  MODIFY `positions_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bestellungen`
--
ALTER TABLE `bestellungen`
  MODIFY `bestell_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `farben`
--
ALTER TABLE `farben`
  MODIFY `farb_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `groessen`
--
ALTER TABLE `groessen`
  MODIFY `groessen_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `kategorien`
--
ALTER TABLE `kategorien`
  MODIFY `kategorie_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `lagerbestand`
--
ALTER TABLE `lagerbestand`
  MODIFY `lager_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `produktbilder`
--
ALTER TABLE `produktbilder`
  MODIFY `bild_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `produkte`
--
ALTER TABLE `produkte`
  MODIFY `produkt_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bestellpositionen`
--
ALTER TABLE `bestellpositionen`
  ADD CONSTRAINT `fk_position_bestellung` FOREIGN KEY (`bestell_id`) REFERENCES `bestellungen` (`bestell_id`),
  ADD CONSTRAINT `fk_position_produkt` FOREIGN KEY (`produkt_id`) REFERENCES `produkte` (`produkt_id`);

--
-- Filtros para la tabla `bestellungen`
--
ALTER TABLE `bestellungen`
  ADD CONSTRAINT `fk_bestellung_benutzer` FOREIGN KEY (`benutzer_id`) REFERENCES `benutzer` (`benutzer_id`);

--
-- Filtros para la tabla `lagerbestand`
--
ALTER TABLE `lagerbestand`
  ADD CONSTRAINT `fk_lager_farbe` FOREIGN KEY (`farb_id`) REFERENCES `farben` (`farb_id`),
  ADD CONSTRAINT `fk_lager_groesse` FOREIGN KEY (`groessen_id`) REFERENCES `groessen` (`groessen_id`),
  ADD CONSTRAINT `fk_lager_produkt` FOREIGN KEY (`produkt_id`) REFERENCES `produkte` (`produkt_id`);

--
-- Filtros para la tabla `produktbilder`
--
ALTER TABLE `produktbilder`
  ADD CONSTRAINT `fk_produktbilder_produkt` FOREIGN KEY (`produkt_id`) REFERENCES `produkte` (`produkt_id`);

--
-- Filtros para la tabla `produkte`
--
ALTER TABLE `produkte`
  ADD CONSTRAINT `fk_produkte_kategorie` FOREIGN KEY (`kategorie_id`) REFERENCES `kategorien` (`kategorie_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
