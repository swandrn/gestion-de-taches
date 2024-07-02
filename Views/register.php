<?php include 'header.php'; ?>

<div class="container">
    <h2>Inscription</h2>
    <form action="index.php?action=register" method="POST">
        <div class="form-group">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
    <p>Déjà inscrit ? <a href="index.php?action=login">Connectez-vous ici</a></p>
</div>

<?php include 'footer.php'; ?>
