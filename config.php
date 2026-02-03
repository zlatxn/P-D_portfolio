<?php

/**
 * DATENBANK CREDENTIALS
 * Diese Werte müssen evtl. angepasst werden
 */
define('DB_HOST', 'db');
define('DB_USER', 'root');
define('DB_PASS', 'root');              // Euer MySQL-Passwort
define('DB_NAME', 'portfolio_db');
define('DB_PORT', 3306);            // Standard MySQL Port

// SESSION STARTEN
// Hier gestartet und auf allen Seiten eingebunden
session_start();
include 'views/header.php';
include 'views/footer.php';

// FEHLERBEHANDLUNG
// Für uns in der Entwicklung
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// =======================
// PDO DATENBANKVERBINDUNG
// =======================

/**
 * PDO CONNECTION - DATA SOURCE NAME (DSN)
 * 
 * STRUKTUR:
 * mysql:host=localhost;dbname=database;charset=utf8mb4
 * 
 * ERKLÄRUNG:
 * - mysql: = Datenbanktyp (könnte auch postgresql:, sqlite: sein)
 * - host=localhost = Server-Adresse
 * - dbname=portfolio_db = Datenbank-Name
 * - charset=utf8mb4 = Zeichensatz (für Umlaute, Emojis, etc.)
 */
$dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4';

/**
 * PDO OPTIONS
 * 
 * ATTR_ERRMODE => ERRMODE_EXCEPTION:
 * - PDO wirft Exceptions statt nur Fehler zu setzen
 * - Besseres Error Handling mit try-catch
 * 
 * ATTR_DEFAULT_FETCH_MODE => FETCH_ASSOC:
 * - Datensätze als assoziatives Array zurückgeben
 * - Nicht als numerisches Array oder Objekt
 * 
 * ATTR_EMULATE_PREPARES => false:
 * - Echte Prepared Statements verwenden
 * - Maximale Sicherheit gegen SQL-Injection
 */
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    /**
     * PDO VERBINDUNG ERSTELLEN
     * 
     * new PDO(dsn, username, password, options)
     * 
     * BEISPIEL:
     * $db = new PDO('mysql:host=localhost;dbname=test', 'root', '', $options);
     */
    $db = new PDO($dsn, DB_USER, DB_PASS, $options);

    /**
     * INITIALISIERUNGSBEFEHLE
     * 
     * SET NAMES utf8mb4:
     * - Sichert, dass alle Zeichen korrekt verarbeitet werden
     * - Notwendig für deutsche Umlaute, Emojis, etc.
     */
    $db->exec("SET NAMES utf8mb4");
} catch (PDOException $e) {
    /**
     * FEHLERBEHANDLUNG
     * 
     * Wenn die Verbindung fehlschlägt, fangen wir die Exception
     * und zeigen eine aussagekräftige Fehlermeldung
     * 
     * In PRODUKTION würde man das verstecken!
     */
    die('Datenbankverbindung fehlgeschlagen: ' . $e->getMessage());
}

// HILFSFUNKTIONEN

/**
 * FUNKTION: sanitize($input)
 * 
 * ZWECK: Schützt vor XSS-Angriffen
 * 
 * ERKLÄRUNG:
 * htmlspecialchars() konvertiert HTML-Zeichen:
 * - < wird zu &lt;
 * - > wird zu &gt;
 * - " wird zu &quot;
 * - & wird zu &amp;
 * 
 * WICHTIG:
 * Dies ist für OUTPUT (HTML)
 * Prepared Statements kümmern sich um INPUT (Datenbank)
 * 
 * VERWENDUNG:
 * Immer bei echo/print HTML-Ausgabe!
 * echo sanitize($projekt['title']);
 */
function sanitize($input)
{
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}

/**
 * FUNKTION: redirect($url)
 * 
 * ZWECK: Leitet den Browser um
 * 
 * ERKLÄRUNG:
 * - header('Location: ...') sendet HTTP-Redirect
 * - exit() stoppt das Skript danach
 * 
 * WICHTIG:
 * Kein HTML vor header() erlaubt!
 * 
 * VERWENDUNG:
 * redirect('index.php?page=admin');
 */
function redirect($url)
{
    header('Location: ' . $url);
    exit();
}
