# EymShop – Studentischer Online-Shop für Kleidung 🛍️  
Abschlussprojekt – intoCODE / Hochschule Hannover

EymShop ist ein moderner, dynamischer Webshop für Kleidung, entwickelt im Rahmen des InterGeeks-Weiterbildungsprogramms an der Hochschule Hannover.  
Der Fokus des Projekts lag auf **PHP-Backend-Logik**, **MySQL-Datenbankdesign**, **Sitzungsverwaltung**, **responsivem Frontend** und der Anwendung agiler Methoden.

---

## 🎯 Projektziele

- Entwicklung einer dynamischen und datenbankgestützten Webanwendung.  
- Umsetzung eines realistischen E-Commerce-Workflows: Produktanzeige → Detailansicht → Warenkorb → Bestellung.  
- Einsatz einer **normalisierten relationalen Datenbank** (mehrere Tabellen, Beziehungen, Fremdschlüssel).  
- Sichere Datenverarbeitung über **Prepared Statements** und **password_hash**.  
- Nutzung agiler Arbeitsmethoden (Scrum, Kanban, Daily-Standups).  
- Implementierung einer **intelligenten DB-Verbindung**, die automatisch lokale Umgebungen (Mac/Windows) erkennt.

---

## 🛠️ Technologien

**Frontend:**  
- HTML5  
- CSS3 (Flexbox und Grid)  
- JavaScript (für Interaktionen & Bestätigungen)

**Backend:**  
- PHP 8 (prozedural mit modularer Struktur)  
- Session Handling (`$_SESSION`)

**Datenbank:**  
- MySQL / MariaDB  
- SQL (Prepared Statements, Joins, Insert, Select, Delete)

**Tools & Umgebung:**  
- MAMP (macOS) / XAMPP (Windows)  
- phpMyAdmin  
- Git & GitHub  
- Trello (Kanban-Board)

---

## 📂 Projektstruktur

```text
/eymshop
├── /public
│   ├── index.php              # Startseite
│   ├── produkte.php           # Produktübersicht
│   ├── produktdetails.php     # Detailansicht (mit Bild, Beschreibung, Farbe)
│   ├── warenkorb.php          # Warenkorb (Add/Remove, Summen)
│   ├── bestellung.php         # Bestellung abschließen
│   ├── danke.php              # Bestellbestätigung
│   ├── login.php              # Benutzer-Login
│   ├── register.php           # Registrierung
│   ├── impressum.php          # Rechtliches
│   └── datenschutz.php        # Datenschutz
│
├── /includes
│   ├── header.php             # Navigation
│   ├── footer.php             # Footer
│   ├── navigation.php         # Menü
│   ├── db.php                 # Auto-Umgebungswahl (Mac/Win)
│   └── functions.php          # Warenkorb-Logik, Helper-Funktionen
│
├── /assets
│   ├── /css                   # Styling
│   └── /images                # Produktbilder
│
└── /sql
    └── eymshop.sql            # Datenbankexport

🗄️ Datenbankmodell (Kurzüberblick)

Die Anwendung basiert auf einer normalisierten relationalen Struktur, die folgende Tabellen umfasst:
	•	benutzer – Login-Daten, gehashte Passwörter
	•	produkte – Produktname, Preis, Beschreibung, Bilder
	•	kategorien – Gruppierung der Produkte
	•	farben – verfügbare Farbvarianten
	•	groessen – verfügbare Größen
	•	lagerbestand – Produkt + Variante + Menge
	•	bestellungen – Kopf einer Bestellung
	•	bestellpositionen – Artikel, Preis, Menge (historische Speicherung)

Diese Struktur reduziert Redundanz und ermöglicht saubere Abfragen.

🚀 Implementierte Funktionen

🧑‍💻 Benutzerverwaltung
	•	Registrierung (mit password_hash())
	•	Login mit Validierung
	•	Session-Verwaltung für Benutzer und Warenkorb
	•	Profilansicht (Basisdaten)

🛒 Shop-Funktionen
	•	Produktübersicht aus der Datenbank
	•	Dynamische Detailseite mit Bild, Preis, Beschreibung, Farben
	•	Warenkorb:
	•	Produkt hinzufügen
	•	Produkt entfernen
	•	automatische Summenberechnung
	•	Bestellung abschließen mit Speicherung in der Datenbank
	•	Bestellbestätigungsseite

🧠 Technische Highlights
	•	db.php erkennt automatisch das lokale System (Mac oder Windows)
→ Probiert Ports 3306 und 8889 nacheinander
	•	Sicherheitsaspekte:
	•	Prepared Statements
	•	Session-basiertes Cart-System
	•	Modularer Aufbau durch wiederverwendbare Includes

🎨 Design & UX
	•	Responsives Layout
	•	Optimierte Navigation
	•	Konsistenter Farbcode & Schatteneffekte
	•	Überarbeiteter Footer
	•	Rechtliche Seiten: Impressum + Datenschutz

⚙️ Installation & Ausführung
	1.	Repository in den Webserver-Ordner klonen:
	•	macOS → /Applications/MAMP/htdocs/
	•	Windows → C:/xampp/htdocs/
	2.	Datenbank anlegen und Import durchführen:
	•	eymshop.sql in phpMyAdmin importieren.
	3.	Keine weitere Konfiguration nötig:
Die Datei db.php erkennt automatisch:
	•	XAMPP (Port 3306)
	•	MAMP (Port 8889)
	4.	Projekt starten:
	•	macOS → http://localhost:8888/eymshop/public/index.php
	•	Windows → http://localhost/eymshop/public/index.php

🔧 Bekannte Einschränkungen
	•	Aktuell kein Admin-Bereich zur Produktverwaltung.
	•	Keine Live-Suche oder Filter nach Größe/Farbe.
	•	Logik für Varianten im Warenkorb ist vereinfacht gehalten.

🔮 Zukünftige Verbesserungen
	•	Admin-Dashboard (CRUD für Produkte).
	•	Suchfunktion + Filter (Farbe, Größe, Kategorie).
	•	Bestellhistorie für Benutzer.
	•	Erweiterte Validierung und Fehlermeldungen.
	•	Produktvarianten direkt auswählbar (Dropdowns).

👥 Projektteam

EymShop Team – Hochschule Hannover (InterGeeks)

(Optionale Ergänzung: Vornamen, falls gewünscht)

© Rechtliches

Dieses Projekt wurde ausschließlich zu Lernzwecken erstellt.
Es findet keine kommerzielle Nutzung statt.

