<?php
$isAdmin = false;

/**
 * INDEX.PHP - ROUTER
 * 
 * Der zentrale Einstiegspunkt
 * Leitet alle Anfragen an die richtige Controller-Methode
*/
require_once 'config.php';
require_once 'controllers/ProjectController.php';

// Bestimme welche Seite angefordert wurde
$page = $_GET['page'] ?? 'home';

// Erstelle Controller-Instanz
$controller = new ProjectController($db);

// Bestimme welche View geladen wird
$view = '';


switch ($page) {
    case 'projects':
        // Zeige alle Projekte
        $pageTitle = 'Projekte';
        $view = $controller->index();
        break;

    case 'project':
        // Zeige einzelnes Projekt-Detail
        $pageTitle = 'Projekt';
        $view = $controller->show();
        break;

    case 'admin':
        // Admin Dashboard mit allen Projekten
        $pageTitle = 'Admin';
        $result = $controller->admin();
        if (is_array($result)) {
            $view = $result['view'];
            $projects = $result['data']; // <--- HIER landet die Variable endlich im Dashboard!
        } else {
            // Fallback (falls du den Controller noch nicht gespeichert hast)
            $view = $result;
            $projects = [];
        }
        $isAdmin = true;
        break;

    case 'create':
        // Neues Projekt erstellen
        $pageTitle = 'Projekt Erstellen';
        $view = $controller->create();
        $isAdmin = true;
        break;

    case 'edit':
        // Projekt bearbeiten
        $pageTitle = 'Projekt Bearbeiten';
        $result = $controller->edit();
        $view = $result['view'];
        $project = $result['data'];
        $isAdmin = true;
        break;

    case 'delete':
        // Projekt löschen
        $pageTitle = 'Projekt Löschen';
        $controller->delete();
        break;

    case 'home':
    default:
        // Homepage
        $pageTitle = 'Portfolio by Daniela und Patryk';
        $view = 'views/home.php';
}
include 'views/header.php';

// VIEW LADEN
if (file_exists($view)) {
    require_once $view;
} else {
    echo "Fehler: View nicht gefunden: " . htmlspecialchars($view);
}

include 'views/footer.php';
