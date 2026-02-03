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
        $view = $controller->admin();
        break;

    case 'create':
        // Neues Projekt erstellen
        $pageTitle = 'Projekt Erstellen';
        $view = $controller->create();
        break;

    case 'edit':
        // Projekt bearbeiten
        $pageTitle = 'Projekt Bearbeiten';
        $view = $controller->edit();
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
include 'views/footer.php';

// VIEW LADEN
if (file_exists($view)) {
    require_once $view;
} else {
    echo "Fehler: View nicht gefunden: " . htmlspecialchars($view);
}
