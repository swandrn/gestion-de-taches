<?php include 'header.php'; ?>

<div class="container">
    <h1>Connexion</h1>
    <form action="index.php?action=login" method="POST">
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary" id ="btnConnecter">Se connecter</button>
    </form>
    <p>Pas encore inscrit ? <a href="index.php?action=register">Inscrivez-vous ici</a></p>
</div>

<?php include 'footer.php'; ?>