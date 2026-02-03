<?php
// 1. Logik: UPDATE durchführen (Wenn Button gedrückt wurde)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $img = $_POST['image_path'];

    $sql = "UPDATE projects SET title = ?, description = ?, image_path = ?, updated_at = NOW() WHERE id = ?";
    $stmt = $db->prepare($sql);

    try {
        $stmt->execute([$title, $desc, $img, $id]);
        $_SESSION['message'] = "Projekt erfolgreich aktualisiert!";
        header('Location: index.php?page=admin');
        exit;
    } catch (PDOException $e) {
        $error = "Fehler beim Update: " . $e->getMessage();
    }
}

// 2. Logik: Daten LADEN (Wenn Seite aufgerufen wird)
if (isset($_GET['id'])) {
    $stmt = $db->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $project = $stmt->fetch();

    if (!$project) {
        die("Projekt nicht gefunden!");
    }
} else {
    // Falls keine ID da ist (und auch kein POST), leiten wir um
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php?page=admin');
        exit;
    }
}
?>

<main class="admin-container">
    <div class="container">
        <h1>Projekt bearbeiten</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-error">
                <?php echo sanitize($error); ?>
            </div>
        <?php endif; ?>

        <a href="index.php?page=admin" class="btn">← Abbrechen</a>
        <br><br>

        <?php if (isset($project)): ?>
        <form action="index.php?page=edit" method="POST" class="admin-form">
            
            <input type="hidden" name="id" value="<?php echo $project['id']; ?>">

            <div class="form-group">
                <label for="title">Titel</label>
                <input type="text" name="title" id="title" required class="form-control" 
                       value="<?php echo sanitize($project['title']); ?>">
            </div>

            <div class="form-group">
                <label for="image_path">Bild-Pfad</label>
                <input type="text" name="image_path" id="image_path" class="form-control" 
                       value="<?php echo sanitize($project['image_path']); ?>">
            </div>

            <div class="form-group">
                <label for="description">Beschreibung</label>
                <textarea name="description" id="description" rows="5" class="form-control"><?php echo sanitize($project['description']); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-lg">Änderungen speichern</button>
        </form>
        <?php endif; ?>
    </div>
</main>