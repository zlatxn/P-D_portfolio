<main class="admin-container">
    <div class="container">
        <h1>Projekt bearbeiten</h1>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?php echo sanitize($_SESSION['error']); unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <a href="index.php?page=admin" class="btn">← Abbrechen</a>
        <br><br>

        <?php if (isset($project) && $project): ?>
        
        <form action="index.php?page=edit&id=<?php echo $project['id']; ?>" method="POST" class="admin-form">
            
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
                <?php if(!empty($project['image_path'])): ?>
                    <small>Aktuell: <?php echo sanitize($project['image_path']); ?></small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="description">Beschreibung</label>
                <textarea name="description" id="description" rows="5" class="form-control"><?php echo sanitize($project['description']); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-lg">Änderungen speichern</button>
        </form>
        <?php else: ?>
            <p>Projekt wurde nicht gefunden.</p>
        <?php endif; ?>
    </div>
</main>