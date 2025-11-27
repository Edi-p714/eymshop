# EymShop - Online-Shop für Kleidung

## Projektbeschreibung

EymShop ist ein Kleiner Online-Shop für Kleidung, der im Rahmen des intoCode-Weiterbildungsprogramms entwickelt wird.

## Projektziele

- Entwicklung einer dynamischen Webseite mit 5-6 Seiten
- Umsetzung einer Benutzerregistrierung und Login-Funktion
- Verwendung einer relationalen Datenbank mit mehreren Tabellen
- Einsatz von SQL-Statements (SELECT, INSERT, UPDATE, DELETE)
- Umsetzung als agiles Web-Projekt mit Sprints (Scrum ansatz)
- Einsatz eines lokalen Servers (MAMP) zur Bereitstellung der Anwendung

## Technologien

- **Frontend:** HTML, CSS
- **Backend:** PHP
- **Datenbank:** MYSQL
- **Server (lokal):** MAMP (Apache, MYSQL)
- **Versionsverwaltung:** Git & GitHub
- **Projektorganisation:** Trello, Scrum (Sprints, Backlog)

## Projektstruktur
```text
/eymshop
├── index.php               # Startseite
├── produkte.php            # Produktübersicht
├── produktdetails.php      # Produktdetailseite
├── warenkorb.php           # Warenkorb
├── login.php               # Login-Seite
├── register.php            # Registrierungsseite
├── bestellung.php          # Bestellübersicht / Checkout
│
├── /includes
│     ├── header.php        # Kopfbereich (HTML-Header)
│     ├── footer.php        # Fußbereich
│     ├── navigation.php    # Navigation / Menü
│     └── db.php            # Datenbankverbindung (MySQL)
│
├── /assets
│     ├── /css
│     │     └── styles.css  # Zentrales Stylesheet
│     └── /images           # Bilder (Produkte, Layout)
│
└── /sql
      └── eymshop.sql       # Datenbankstruktur und Testdaten

## Datenbankmodell (Überblick)
Haupttabellen:
   **benutzer** - speichert registrierte Benutzer
   **kategorien** - Kategorien für Produkte (z.B. Herren, Damen)
   **produkte** - Produktdaten (Name, Marke, Preis, Beschreibungen, Bild)
   **farben** - verfügbare Farben
   **lagerbestand** - Kombination aus Produkt + Farbe + Größe + Menge
   **bestellungen** - Bestellungen eines Benutzers
   **bestellpositionen** - einzelne Positionen innerhalb einer Bestellung

   Die Tabellen sind normalisiert und über Primär - und Fremdschlüssel miteinander verknüpft.

## Rollen im Team
  **Backend & Datenbank:**
     - Datenbankdesign (Tabellen, Beziehungen)
     - PHP-Logik (Login/Registrierung, Warenkorb, Bestellungen)
     - Einbindung der Datenbank in die Seiten (SELECT/INSERT/UPDATE/DELETE)
  **Frontend:**
     - HTML-Struktur für alle Seiten
     - CSS-Design (Layout, Farben, Typografie, Responsivität)
     - Gestaltung von Produkttübersicht, Produktdetails, Formularen und Navigation
  **Installation & Ausführung (MAMP)**
     1. Projektordner Eymshop nach /Applications/MAMP/htdocs/kopieren.
     2. MAMP starten und Apache + MYSQL aktivieren.
     3. Im Browser http://localhost:8888/phpmyadmin öffnen.
     4. Datenbank Eymshop erstellen.
     5. Datei sql/Eymshop.sql in phpMyAdmin importieren.
     6. Im Browser http://localhost:8888/Eymshop/index.php aufrufen.
   **Implementierte Funktionen** 
    - Benutzerregistrierung und Login mit Passwort-Hashing
    - Produktübersichtsseite mit Produktbildern
    - Produktdetailseite mit zusätzlichen Informationen
    - Warenkorb mit Mengensteuerung
    - Bestellübersicht (einfache Order-Struktur)
    - Einbindung von Header, Footer und Navigation über PHP-Includes
  **Agile Arbeitsweise**
    - Planung und Aufgabenverteilung im **Trello-Board**
    - Arbeit in Sprint mit klar definierten Zielen pro Woche
    - Nutzung von Git & GitHub für Versionsverwaltung und Zusammentarbeit
    - Regelmäßige Abstimmung im Team (Daily / Gruppen-Check)
  **Mögliche Erweitungen**
    - Admin-Bereich mit produktverwaltung (CRUD) 
    - Erweiterte Filter- und Suchfunktionen für Produkte
    - Benutzerprofil mit Bestellhistorie
    - Responsives Design für Mobligeräte



