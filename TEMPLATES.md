<!-- views/home.php - HOMEPAGE TEMPLATE -->
<?php require_once 'config.php'; ?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio - [Dein Name]</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- ==================== HEADER ==================== -->
    <header class="header">
        <nav class="navbar">
            <div class="logo">Portfolio</div>
            <ul class="nav-links">
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="index.php?page=projects">Projekte</a></li>
                <li><a href="index.php?page=admin">Admin</a></li>
            </ul>
        </nav>
    </header>

    <!-- ==================== HERO SECTION ==================== -->
    <section class="hero">
        <div class="hero-content">
            <h1>Willkommen zu meinem Portfolio</h1>
            <p class="subtitle">Web Developer & Designer</p>
            <a href="index.php?page=projects" class="btn btn-primary">Meine Projekte ansehen</a>
        </div>
        <div class="hero-image">
            <!-- Optional: Foto einfügen -->
            <img src="/assets/images/profile.jpg" alt="Profilbild" class="profile-img">
        </div>
    </section>

    <!-- ==================== ÜBER MICH ==================== -->
    <section class="about">
        <div class="container">
            <h2>Über mich</h2>
            <p>
                Ich bin ein leidenschaftlicher Web-Entwickler mit Erfahrung in PHP, JavaScript und modernem Web-Design.
                Ich liebe es, kreative und funktionale Websites zu bauen, die Benutzer begeistern.
            </p>
            
            <div class="skills">
                <h3>Meine Fähigkeiten</h3>
                <ul>
                    <li>PHP & MySQL</li>
                    <li>HTML5 & CSS3</li>
                    <li>JavaScript</li>
                    <li>Responsive Design</li>
                    <li>MVC-Pattern</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- ==================== FEATURED PROJECTS ==================== -->
    <section class="featured">
        <div class="container">
            <h2>Ausgewählte Projekte</h2>
            <a href="index.php?page=projects" class="btn btn-secondary">Alle Projekte anzeigen</a>
        </div>
    </section>

    <!-- ==================== FOOTER ==================== -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2026 [Dein Name]. Alle Rechte vorbehalten.</p>
            <div class="social-links">
                <a href="#">GitHub</a>
                <a href="#">LinkedIn</a>
                <a href="#">Email</a>
            </div>
        </div>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>

---

<!-- views/projects.php - PROJEKTLISTE TEMPLATE -->
<?php require_once 'config.php';
require_once 'models/Project.php';
$projectModel = new Project($db);
$result = $projectModel->getAll();
$projects = $result['success'] ? $result['data'] : [];
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projekte - Portfolio</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- ==================== HEADER ==================== -->
    <header class="header">
        <nav class="navbar">
            <div class="logo">Portfolio</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php?page=projects" class="active">Projekte</a></li>
                <li><a href="index.php?page=admin">Admin</a></li>
            </ul>
        </nav>
    </header>

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

    <!-- ==================== FOOTER ==================== -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2026 Portfolio. Alle Rechte vorbehalten.</p>
        </div>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>

---

<!-- views/admin/dashboard.php - ADMIN DASHBOARD TEMPLATE -->
<?php require_once 'config.php';
require_once 'models/Project.php';
$projectModel = new Project($db);
$result = $projectModel->getAll();
$projects = $result['success'] ? $result['data'] : [];
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <!-- ==================== HEADER ==================== -->
    <header class="header">
        <nav class="navbar">
            <div class="logo">Portfolio Admin</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php?page=projects">Projekte</a></li>
                <li><a href="index.php?page=admin" class="active">Admin</a></li>
            </ul>
        </nav>
    </header>

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

    <script src="js/main.js"></script>
</body>
</html>

---

AUFGABEN FÜR TEAMS:

TAG 1:
1. Diese Templates vervollständigen mit eigenem Design
2. CSS in css/style.css schreiben
3. Layout responsive machen
4. Farben und Typografie anpassen

TAG 2:
1. views/projects.php Template verwenden
2. views/project-detail.php schreiben (einzelnes Projekt zeigen)
3. Database mit setup.sql vorbereiten
4. Models/Project.php getAll() und getById() testen

TAG 3:
1. views/admin/dashboard.php verwenden
2. views/admin/create.php schreiben (Form für neues Projekt)
3. views/admin/edit.php schreiben (Form zum bearbeiten)
4. CRUD testen: Create, Read, Update, Delete
