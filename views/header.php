<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo isset ($pageTitle) ? $pageTitle : 'Portfolio by Daniela und Patryk'; ?>

    </title>
</head>

<body>
    <header class="header">
        <nav class="nav">
            <div class="logo">Portfolio</div>
            <ul class="nav-links">
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="index.php?page=projects">Projekte</a></li>
                <li><a href="index.php?page=admin">Admin</a></li>
            </ul>

        </nav>
    </header>