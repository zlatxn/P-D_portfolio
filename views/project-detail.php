   <!-- ==================== PROJEKTE ÜBERSICHT ==================== -->
<?php
// 1. LOGIK: Projekt anhand der ID aus der URL laden
if (isset($_GET['id'])) {
    $stmt = $db->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $project = $stmt->fetch();

    // Falls ID falsch ist oder Projekt nicht existiert -> Zurück zur Liste
    if (!$project) {
        header('Location: index.php?page=projekte');
        exit;
    }
} else {
    // Keine ID angegeben -> Zurück zur Liste
    header('Location: index.php?page=projekte');
    exit;
}
?>
<main class="project-detail-page">
    <div class="container">
        
        <div class="action-bar">
            <a href="index.php?page=projekte" class="btn btn-secondary">← Zurück zur Übersicht</a>
        </div>

        <article class="project-full">
            
            <header class="detail-header">
                <h1><?php echo sanitize($project['title']); ?></h1>
                <div class="meta-info">
                    <small><?php echo date('d.m.Y', strtotime($project['created_at'])); ?></small>
                </div>
            </header>

            <?php if (!empty($project['image_path'])): ?>
                <div class="detail-image">
                    <img src="<?php echo sanitize($project['image_path']); ?>" alt="<?php echo sanitize($project['title']); ?>">
                </div>
            <?php endif; ?>

            <div class="detail-description">
                <?php 
                    // nl2br sorgt dafür, dass Zeilenumbrüche aus dem Textfeld erhalten bleiben
                    echo nl2br(sanitize($project['description'])); 
                ?>
            </div>

        </article>

    </div>
</main>