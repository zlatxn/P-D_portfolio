<?php
// 1. Config laden (stellt die Verbindung $db her)
require_once 'config.php'; 

// 2. Wurde das Formular abgeschickt?
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // SQL-Statement
    // Wir schreiben nur in title, description und image_path.
    // Die Zeitstempel füllt MySQL automatisch mit NOW().
    $sql = "INSERT INTO projects (title, description, image_path, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())";
    
    $stmt = $db->prepare($sql);

    try {
        $stmt->execute([
            $_POST['title'],        // Im HTML: <input name="title">
            $_POST['description'],  // Im HTML: <textarea name="description">
            $_POST['image_path']    // Im HTML: <input name="image_path"> (oder Dateiname)
        ]);
        
        echo "Projekt erfolgreich gespeichert!";
        
        // Optional: Zurück zur Admin-Seite leiten
        // redirect('index.php?page=admin');

    } catch (PDOException $e) {
        echo "Fehler beim Speichern: " . $e->getMessage();
    }
}
?>
<div class="form-wrapper">
    <h2>Neues Projekt anlegen</h2>

<form action="index.php?page=create" method="POST">
    
    <label>Titel:</label>
    <input type="text" name="title" required>
    
    <label>Beschreibung:</label>
    <textarea name="description"></textarea>
    
    <label>Bild-Pfad:</label>
    <input type="text" name="image_path">

    <button type="submit">Speichern</button>

</form>
</div>
