<?php

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
        $view = $controller->index();
        break;

    case 'project':
        // Zeige einzelnes Projekt-Detail
        $view = $controller->show();
        break;

    case 'admin':
        // Admin Dashboard mit allen Projekten
        $view = $controller->admin();
        break;

    case 'create':
        // Neues Projekt erstellen
        $view = $controller->create();
        break;

    case 'edit':
        // Projekt bearbeiten
        $view = $controller->edit();
        break;

    case 'delete':
        // Projekt löschen
        $controller->delete();
        break;

    case 'home':
    default:
        // Homepage
        $view = 'views/home.php';
}

// VIEW LADEN
if (file_exists($view)) {
    require_once $view;
} else {
    echo "Fehler: View nicht gefunden: " . htmlspecialchars($view);
}
