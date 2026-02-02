<?php

class Project
{
    private $db;

    /**
     * KONSTRUKTOR
     * 
     * $pdo = PDO-Verbindung von config.php
     * Wird in dieser Klasse gespeichert
     */
    public function __construct($pdo)
    {
        $this->db = $pdo;
    }


    // READ - DATEN AUSLESEN
    /**
     * Alle Projekte abrufen
     * 
     * PDO mit query() für einfache SELECT ohne User-Input
     * 
     * @return array ['success' => true, 'data' => [...]]
     */
    public function getAll()
    {
        try {
            /**
             * PREPARED STATEMENT MIT PDO
             * 
             * $this->db->query()
             * - Führt SQL-Query direkt aus
             * - NUR für Queries ohne User-Input!
             * - Für User-Input: prepare() + execute()
             */
            $stmt = $this->db->query('
                SELECT id, title, description, image_path 
                FROM projects 
                ORDER BY created_at DESC
            ');

            /**
             * DATEN ABRUFEN
             * 
             * fetchAll(PDO::FETCH_ASSOC):
             * - Holt ALLE Zeilen auf einmal
             * - PDO::FETCH_ASSOC = assoziatives Array
             * - Andere Option: FETCH_OBJ (als Objekt)
             */
            $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return ['success' => true, 'data' => $projects];
        } catch (PDOException $e) {
            /**
             * FEHLERBEHANDLUNG
             * 
             * PDOException wird automatisch geworfen
             * wenn etwas schiefgeht
             * 
             * Mit try-catch können wir darauf reagieren
             */
            return ['success' => false, 'message' => 'Fehler beim Abrufen: ' . $e->getMessage()];
        }
    }

    /**
     * Ein einzelnes Projekt abrufen
     * 
     * Mit Prepared Statement für Sicherheit!
     * 
     * @param int $id Projekt-ID
     * @return array Projekt-Daten
     */
    public function getById($id)
    {
        try {
            /**
             * PREPARED STATEMENT MIT PDO
             * 
             * SCHRITT 1: prepare()
             * - Bereitet SQL vor mit Platzhaltern (:id)
             * - Es wird noch NICHT ausgeführt
             * 
             * SCHRITT 2: execute()
             * - Führt SQL mit Werten aus
             * - Werte sind SICHER (keine SQL-Injection!)
             */
            $stmt = $this->db->prepare('
                SELECT * 
                FROM projects 
                WHERE id = :id
            ');

            /**
             * PARAMETER BINDEN
             * 
             * execute(array):
             * - Übergibt Variablen mit Namen
             * - :id wird durch $id ersetzt
             * - Sicherer als string concatenation!
             * 
             * BEISPIEL:
             * execute([':id' => 5])
             * Resultat: WHERE id = 5
             */
            $stmt->execute([':id' => $id]);

            /**
             * EINE ZEILE ABRUFEN
             * 
             * fetch(PDO::FETCH_ASSOC):
             * - Holt EINE Zeile als Array
             * - Wenn keine Zeile: false
             */
            $project = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$project) {
                return ['success' => false, 'message' => 'Projekt nicht gefunden'];
            }

            return ['success' => true, 'data' => $project];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Fehler: ' . $e->getMessage()];
        }
    }

    // CREATE - NEUE DATEN EINFÜGEN
    /**
     * Neues Projekt erstellen
     * 
     * @param array $data Array mit title, description, image_path
     * @return array Status-Array
     */
    public function create($data)
    {
        try {
            // VALIDIERUNG
            if (empty($data['title']) || empty($data['description']) || empty($data['image_path'])) {
                return ['success' => false, 'message' => 'Alle Felder sind erforderlich'];
            }

            /**
             * INSERT MIT PDO PREPARED STATEMENT
             * 
             * Prepared Statements mit PDO:
             * - Sichere Platzhalter: :title, :description, :image_path
             * - execute() mit assoziativem Array
             * - Alles andere funktioniert gleich
             */
            $stmt = $this->db->prepare('
                INSERT INTO projects (title, description, image_path) 
                VALUES (:title, :description, :image_path)
            ');

            /**
             * EXECUTE MIT WERT-ARRAY
             * 
             * Alle Werte als assoziativer Array:
             * [
             *     ':title' => $data['title'],
             *     ':description' => $data['description'],
             *     ':image_path' => $data['image_path']
             * ]
             */
            $stmt->execute([
                ':title' => $data['title'],
                ':description' => $data['description'],
                ':image_path' => $data['image_path']
            ]);

            /**
             * rowCount() = wie viele Zeilen betroffen?
             * 
             * Nach INSERT/UPDATE/DELETE:
             * - rowCount() > 0 = erfolgreich
             * - rowCount() === 0 = nichts geändert
             */
            if ($stmt->rowCount() > 0) {
                return ['success' => true, 'message' => 'Projekt erstellt'];
            } else {
                return ['success' => false, 'message' => 'Fehler beim Erstellen'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Fehler: ' . $e->getMessage()];
        }
    }

    // UPDATE - DATEN ÄNDERN
    /**
     * Projekt aktualisieren
     * 
     * @param int $id Projekt-ID
     * @param array $data Neue Daten
     * @return array Status-Array
     */
    public function update($id, $data)
    {
        try {
            // Prüfe ob Projekt existiert
            $stmt = $this->db->prepare('SELECT id FROM projects WHERE id = :id');
            $stmt->execute([':id' => $id]);

            if ($stmt->rowCount() === 0) {
                return ['success' => false, 'message' => 'Projekt nicht gefunden'];
            }

            // VALIDIERUNG
            if (empty($data['title']) || empty($data['description']) || empty($data['image_path'])) {
                return ['success' => false, 'message' => 'Alle Felder sind erforderlich'];
            }

            /**
             * UPDATE MIT PDO
             * 
             * Gleich wie INSERT/SELECT, aber mit UPDATE-Syntax
             * Alle Parameter werden sicher verarbeitet
             */
            $stmt = $this->db->prepare('
                UPDATE projects 
                SET title = :title, 
                    description = :description, 
                    image_path = :image_path 
                WHERE id = :id
            ');

            $stmt->execute([
                ':title' => $data['title'],
                ':description' => $data['description'],
                ':image_path' => $data['image_path'],
                ':id' => $id
            ]);

            if ($stmt->rowCount() > 0) {
                return ['success' => true, 'message' => 'Projekt aktualisiert'];
            } else {
                return ['success' => false, 'message' => 'Keine Änderungen'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Fehler: ' . $e->getMessage()];
        }
    }

    // DELETE - DATEN LÖSCHEN
    /**
     * Projekt löschen
     * 
     * @param int $id Projekt-ID
     * @return array Status-Array
     */
    public function delete($id)
    {
        try {
            // Prüfe ob Projekt existiert
            $stmt = $this->db->prepare('SELECT id FROM projects WHERE id = :id');
            $stmt->execute([':id' => $id]);

            if ($stmt->rowCount() === 0) {
                return ['success' => false, 'message' => 'Projekt nicht gefunden'];
            }

            /**
             * DELETE MIT PDO
             * 
             * ACHTUNG: WHERE-Klausel ist WICHTIG!
             * Ohne WHERE würden ALLE Projekte gelöscht!
             * 
             *  DELETE FROM projects; → ALLE weg!
             *  DELETE FROM projects WHERE id = :id; → Nur dieses!
             */
            $stmt = $this->db->prepare('
                DELETE FROM projects 
                WHERE id = :id
            ');

            $stmt->execute([':id' => $id]);

            if ($stmt->rowCount() > 0) {
                return ['success' => true, 'message' => 'Projekt gelöscht'];
            } else {
                return ['success' => false, 'message' => 'Fehler beim Löschen'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Fehler: ' . $e->getMessage()];
        }
    }
}
