Structure du dossier : 

- Classes/
    - GestionnaireDeTaches.php
    - Tache.php
    - Utilisateur.php
- Models/
    - UserModel.php # Contient les méthodes pour interagir avec la table users.
    - TaskModel.php # Contient les méthodes pour interagir avec la table taches.
- config/
    - bdd.php           # Configuration de la connexion à la base de données
- controllers/
    - UserController.php # Contrôleur pour la gestion des utilisateurs
    - TaskController.php # Contrôleur pour la gestion des tâches
- views/
    - header.php        # En-tête de la page
    - footer.php        # Pied de page
    - login.php         # Formulaire de connexion
    - register.php      # Formulaire d'inscription
    - dashboard.php     # Tableau de bord des tâches
    - add_task.php      # Formulaire pour ajouter une tâche
    - edit_task.php     # Formulaire pour modifier une tâche
- index.php             # Point d'entrée principal de l'application


Les fonctionnalités (dans les controllers)

Igit push origin master
nscription : Les nouveaux utilisateurs peuvent s'inscrire en fournissant leur nom, email et mot de passe.
Connexion : Les utilisateurs inscrits peuvent se connecter avec leur email et mot de passe.
Ajout de tâches : Les utilisateurs connectés peuvent ajouter de nouvelles tâches.
Modification de tâches : Les utilisateurs peuvent modifier leurs tâches existantes.
Suppression de tâches : Les utilisateurs peuvent supprimer leurs tâches.
Déconnexion : Les utilisateurs peuvent se déconnecter de l'application.