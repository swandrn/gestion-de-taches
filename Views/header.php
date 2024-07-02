<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Gesti Tache</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Gesti Tache</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=add_task">Ajouter une tâche</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=logout">Se déconnecter</a>
                </li>
            <?php else: ?>
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

