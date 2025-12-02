-- =========================================
-- EymShop - SQL Datenbankskript
-- Autor: Edi
-- Projekt: Online-Shop (Herren & Damen)
-- =========================================

-- Datenbank löschen (falls exixtiert)
DROP DATABASE IF EXISTS Eymshop;

-- Neu erstellen
CREATE DATABASE Eymshop CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Verwenden
USE Eymshop;

-- =========================================
-- tabellenstruktur
-- =========================================

-- =========================================
-- 1. Kategorien
-- =========================================
CREATE TABLE kategorien (
    kategorie_id INT AUTO_INCREMENT PRIMARY KEY,
    kategoriename VARCHAR(10) NOT NULL
);

-- =========================================
-- 2. Farben
-- =========================================
CREATE TABLE farben (
    farb_id INT AUTO_INCREMENT PRIMARY KEY,
    farbe VARCHAR(50) NOT NULL,
    farbcode VARCHAR(10) NOT NULL
);

-- =========================================
-- 3. Größen
-- =========================================
CREATE TABLE groessen (
    groessen_id INT AUTO_INCREMENT PRIMARY KEY,
    groesse VARCHAR(10) NOT NULL
);

-- =========================================
-- 4. Produkte
-- =========================================
CREATE TABLE produkte (
    produkt_id INT AUTO_INCREMENT PRIMARY KEY,
    kategorie_id INT NOT NULL,
    produktname VARCHAR(100) NOT NULL,
    markenname VARCHAR(100),
    kurzbeschreibung VARCHAR(255),
    produktbeschreibung TEXT,
    preis DECIMAL(10,2) NOT NULL,
    hauptbild VARCHAR(255),
    FOREIGN KEY (kategorie_id) REFERENCES kategorien(kategorie_id)
);

-- =========================================
-- 5. Lagerbestand
-- =========================================
CREATE TABLE lagerbestand (
    lager_id INT AUTO_INCREMENT PRIMARY KEY,
    produkt_id INT NOT NULL,
    farb_id INT NOT NULL,
    groessen_id INT NOT NULL,
    verfuegbare_menge INT NOT NULL DEFAULT 0,
    FOREIGN KEY (produkt_id) REFERENCES produkt(produkt_id),
    FOREIGN KEY (farb_id) REFERENCES farben(farb_id),
    FOREIGN KEY (groessen_id) REFERENCES groessen(groessen_id)
);

-- =========================================
-- 6. Benutzer 
-- =========================================
CREATE TABLE benutzer (
    benutzer_id INT AUTO_INCREMENT PRIMARY KEY,
    vorname VARCHAR(50),
    nachname VARCHAR(50),
    email VARCHAR(100) NOT NULL UNIQUE,
    passwort VARCHAR(255) NOT NULL,
    erstellt_am TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================
-- Besipiel-Daten (INSERTS)
-- =========================================

-- Kategorien (Solo Herren & Damen)
INSERT INTO kategorien (kategoriename) VALUES
('Herren'),
('Damen');

-- Farben
INSERT INTO farben (farbe, farbcode) VALUES
('Blau', '#0000FF'),
('Rot', '#FF0000'),
('Schwarz', '#000000'),
('Weiß', '#FFFFFF'),
('Grün', '#00FF00');

-- Größen
INSERT INTO groessen (groesse) VALUES
('S'),
('M'),
('L'),
('XL'),
('XXL');

-- Produkte (5 Produkte)
INSERT INTO produkte (kategorie_id, produktname, markenname, kurzbeschreibung, produktbeschreibung, preis, hauptbild)
VALUES
(1, 'T-Shirt Blau', 'EymBrand', 'Modernes T-Shirt aus Baumwolle', 'Hochwertiges Herren-T-Shirt in Blau.', 19.99, 'assets/images/tshirt_blau.jpg'),
(1, 'Hemd Schwarz', 'EymBrand', 'Elegantes schwarzes Hemd', 'Atmungsaktives Herren-Hemd für Alltag und Büro.', 29.99, 'assets/images/hemd_schwarz.jpg'),
(1, 'Herren Hoodie Grau', 'EymBrand', 'Warmer Herren-Hoodie', 'Bequemer Kapuzenpullover für Herren.', 34.90, 'assets/images/herren_hoodie_grau.jpg'),
(2, 'Damen Bluse Rot', 'EymFashion', 'Leichte Damenbluse', 'Damenbluse mit langen Ärmeln und elegantem Schnitt.', 24.99, 'assets/images/bluse_rot.jpg'),
(2, 'Damen Kleid Blau', 'EymFashion', 'Sommerkleid', 'Blaues Damenkleid mit leichtem Stoff für den Sommer.', 39.90, 'assets/images/damen_kleid_blau.jpg');

-- Lagerbestand
INSERT INTO lagerbestand (produkt_id, farb_id, groessen_id, verfuegbare_menge) VALUES
(1, 1, 2, 15),
(1, 1, 3, 10),
(2, 3, 2, 8),
(4, 2, 1, 6),
(5, 1, 2, 9);
