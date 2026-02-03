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

        return 'views/admin/dashboard.php';
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
        // ID aus URL auslesen
        $id = $_GET['id'] ?? null;

        if (!$id) {
            redirect('index.php?page=admin');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Änderungen speichern
            $result = $this->project->update($id, $_POST);

            if ($result['success']) {
                $_SESSION['message'] = $result['message'];
                redirect('index.php?page=admin');
            } else {
                $_SESSION['error'] = $result['message'];
            }
        }

        // Projekt-Daten für Formular laden
        $result = $this->project->getById($id);
        $project = $result['success'] ? $result['data'] : null;

        return 'views/admin/edit.php';
    }

    /**
     * Projekt löschen
     * GET /index.php?page=delete&id=1
     */
    public function delete()
    {
        // ID aus URL auslesen
        $id = $_GET['id'] ?? null;

        if (!$id) {
            redirect('index.php?page=admin');
        }

        // Projekt löschen
        $result = $this->project->delete($id);

        if ($result['success']) {
            $_SESSION['message'] = $result['message'];
        } else {
            $_SESSION['error'] = $result['message'];
        }

        redirect('index.php?page=admin');
    }
   
}
