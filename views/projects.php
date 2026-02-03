   <!-- ==================== PROJEKTE ÜBERSICHT ==================== -->
    <main class="projects-page">
        <div class="container">
            <h1>Meine Projekte</h1>
            <p class="intro-text">Hier sind einige Projekte, an denen ich gearbeitet habe.</p>

            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-success">
                    <?php echo sanitize($_SESSION['message']); unset($_SESSION['message']); ?>
                </div>
            <?php endif; ?>

            <!-- PROJEKTE GRID -->
            <div class="projects-grid">
                <?php foreach ($projects as $p): ?>
                    <article class="project-card">
                        <div class="project-image">
                            <img src="<?php echo sanitize($p['image_path']); ?>" alt="<?php echo sanitize($p['title']); ?>">
                        </div>
                        <div class="project-content">
                            <h2><?php echo sanitize($p['title']); ?></h2>
                            <p><?php echo sanitize(substr($p['description'], 0, 150)) . '...'; ?></p>
                            <a href="index.php?page=project&id=<?php echo $p['id']; ?>" class="btn btn-primary">Details</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <?php if (empty($projects)): ?>
                <div class="empty-state">
                    <p>Noch keine Projekte vorhanden.</p>
                    <a href="index.php?page=admin" class="btn btn-primary">Projekt hinzufügen</a>
                </div>
            <?php endif; ?>
        </div>
    </main>