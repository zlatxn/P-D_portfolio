<?php
// Logik: Speichern, wenn Formular abgesendet wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $img = $_POST['image_path'];

    // SQL Insert
    $sql = "INSERT INTO projects (title, description, image_path, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())";
    $stmt = $db->prepare($sql);

    try {
        $stmt->execute([$title, $desc, $img]);
        $_SESSION['message'] = "Projekt erfolgreich erstellt!";
        // Redirect zur Admin-Übersicht
        header('Location: index.php?page=admin'); 
        exit;
    } catch (PDOException $e) {
        $error = "Fehler beim Speichern: " . $e->getMessage();
    }
}
?>

<main class="admin-container">
    <div class="container">
        <h1>Neues Projekt erstellen</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-error">
                <?php echo sanitize($error); ?>
            </div>
        <?php endif; ?>

        <a href="index.php?page=admin" class="btn">← Zurück zur Übersicht</a>
        <br><br>

        <form action="index.php?page=create" method="POST" class="admin-form">
            
            <div class="form-group">
                <label for="title">Titel des Projekts</label>
                <input type="text" name="title" id="title" required class="form-control" placeholder="z.B. Mein cooles Webdesign">
            </div>

            <div class="form-group">
                <label for="image_path">Bild-Pfad (Dateiname)</label>
                <input type="text" name="image_path" id="image_path" class="form-control" placeholder="z.B. projekt1.jpg">
            </div>

            <div class="form-group">
                <label for="description">Beschreibung</label>
                <textarea name="description" id="description" rows="5" class="form-control" placeholder="Beschreibe dein Projekt..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-lg">Projekt speichern</button>
        </form>
    </div>
</main>