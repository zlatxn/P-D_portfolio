<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Portfolio by Daniela und Patryk'; ?>
    </title>
    <link rel="stylesheet" href="css/style.css">
    <?php echo $isAdmin ? "<link rel='stylesheet' href='css/admin.css'>" : "" ; ?>
</head>

<body>
    <footer>
    <header class="header">
        <nav class="nav">
            <div class="logo">Portfolio</div>
            <ul class="nav-links">
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="index.php?page=projects" class="active">Projekte</a></li>
                <li><a href="index.php?page=admin" class="active">Admin</a></li>
            </ul>
            
        </nav>
    </header>