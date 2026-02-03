    <!-- ==================== ADMIN CONTENT ==================== -->
    <main class="admin-container">
        <div class="container">
            <h1>Admin Dashboard</h1>

            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-success">
                    <?php echo sanitize($_SESSION['message']); unset($_SESSION['message']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?php echo sanitize($_SESSION['error']); unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <a href="index.php?page=create" class="btn btn-primary btn-lg">+ Neues Projekt</a>

            <!-- PROJEKTE TABELLE -->
            <table class="projects-table">
                <thead>
                    <tr>
                        <th>Titel</th>
                        <th>Beschreibung</th>
                        <th>Bild</th>
                        <th>Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projects as $p): ?>
                        <tr>
                            <td class="title"><?php echo sanitize($p['title']); ?></td>
                            <td class="description"><?php echo sanitize(substr($p['description'], 0, 50)) . '...'; ?></td>
                            <td class="image"><?php echo sanitize($p['image_path']); ?></td>
                            <td class="actions">
                                <a href="index.php?page=edit&id=<?php echo $p['id']; ?>" class="btn btn-edit">Bearbeiten</a>
                                <a href="index.php?page=delete&id=<?php echo $p['id']; ?>" class="btn btn-delete" onclick="return confirm('Wirklich löschen?')">Löschen</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php if (empty($projects)): ?>
                <div class="empty-state">
                    <p>Noch keine Projekte vorhanden.</p>
                    <a href="index.php?page=create" class="btn btn-primary">Erstes Projekt erstellen</a>
                </div>
            <?php endif; ?>
        </div>
    </main>