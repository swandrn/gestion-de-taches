<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/darkmode.css" rel="stylesheet" id="dark-mode-css" disabled>
    <script src="Js/script.js"></script>
    <title>Gesti Tache</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">
            <img src="img/logoTacheTic.png" alt="Logo TâcheTic">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item switch-container">
                    <label class="switch">
                        <input type="checkbox" id="darkModeToggle">
                        <span class="slider round"></span>
                    </label>
                </li>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=logout">Se déconnecter</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=login">Se connecter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=register">S'inscrire</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
