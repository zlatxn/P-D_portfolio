<?php

/**
 * 
 * Der Controller ist der Vermittler zwischen Model und View
 * Hier passiert die Business-Logik
 */

require_once 'models/Project.php';

class ProjectController
{
    private $project;

    public function __construct($database)
    {
        $this->project = new Project($database);
    }

    /**
     * Alle Projekte anzeigen
     * GET /index.php?page=projects
     */
    public function index()
    {
        // Model aufrufen um alle Projekte zu holen
        $result = $this->project->getAll();
        $projects = $result['success'] ? $result['data'] : [];

        // View laden
        return 'views/projects.php';
    }

    /**
     * Einzelnes Projekt anzeigen
     * GET /index.php?page=project&id=1
     */
    public function show()
    {
        // ID aus URL auslesen
        $id = $_GET['id'] ?? null;

        if (!$id) {
            redirect('index.php?page=projects');
        }

        // Project aus DB laden
        $result = $this->project->getById($id);
        $project = $result['success'] ? $result['data'] : null;

        // View laden
        return 'views/project-detail.php';
    }

    /**
     * Admin Dashboard - zeigt alle Projekte
     * GET /index.php?page=admin
     */
    public function admin()
    {
        // Alle Projekte für Übersicht holen
        $result = $this->project->getAll();
        $projects = $result['success'] ? $result['data'] : [];

        return [
            'view' => 'views/admin/dashboard.php',
            'data' => $projects
        ];
    }

    /**
     * Neues Projekt erstellen
     * GET /index.php?page=create = Formular anzeigen
     * POST /index.php?page=create = Formular verarbeiten
     */
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Formulardaten verarbeiten
            $result = $this->project->create($_POST);

            if ($result['success']) {
                $_SESSION['message'] = $result['message'];
                redirect('index.php?page=admin');
            } else {
                $_SESSION['error'] = $result['message'];
            }
        }

        return 'views/admin/create.php';
    }

    /**
     * Projekt bearbeiten
     * GET /index.php?page=edit&id=1 = Formular mit Daten anzeigen
     * POST /index.php?page=edit&id=1 = Änderungen speichern
     */
    public function edit()
    {
        // 1. ID prüfen
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = "Keine ID übergeben!";
            redirect('index.php?page=admin');
        }

        // 2. Speichern (POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // ... (Dieser Teil bleibt gleich wie vorher) ...
            $result = $this->project->update($id, $_POST);
            if ($result['success']) {
                $_SESSION['message'] = "Gespeichert!";
                redirect('index.php?page=admin');
            } else {
                $_SESSION['error'] = $result['message'];
            }
        }

        // 3. Daten laden (GET)
        $result = $this->project->getById($id);

        if ($result['success']) {
            $projectData = $result['data'];
        } else {
            $_SESSION['error'] = "Projekt nicht gefunden!";
            redirect('index.php?page=admin');
        }

        // --- HIER IST DIE ÄNDERUNG ---
        // Wir geben nicht nur den Pfad zurück, sondern auch die Daten!
        return [
            'view' => 'views/admin/edit.php',
            'data' => $projectData
        ];
    }

    /**
     * Projekt löschen
     * GET /index.php?page=delete&id=1
     */
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $_SESSION['error'] = "Keine ID zum Löschen gefunden.";
            redirect('index.php?page=admin');
        }

        // Löschen im Model aufrufen
        $result = $this->project->delete($id);

        if ($result['success']) {
            $_SESSION['message'] = "Projekt gelöscht.";
        } else {
            $_SESSION['error'] = "Fehler beim Löschen: " . $result['message'];
        }

        redirect('index.php?page=admin');
    }
}
