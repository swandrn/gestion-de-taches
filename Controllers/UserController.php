<?php

class UserController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function showLoginForm() {
        // Affiche le formulaire de connexion
        include 'views/login.php';
    }

    public function showRegisterForm() {
        // Affiche le formulaire d'inscription
        include 'views/register.php';
    }

    public function register() {
        // Inscription de l'utilisateur
        $nom = $_POST['username'];
        $email = $_POST['email'];
        $mot_de_passe = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $query = $this->db->prepare('INSERT INTO users (nom, email, mot_de_passe) VALUES (?, ?, ?)');
        $query->execute([$nom, $email, $mot_de_passe]);

        header('Location: index.php?action=login');
        exit();
    }

    public function login() {
        // Connexion de l'utilisateur
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $query->execute([$email]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: index.php');
            exit();
        } else {
            echo "Email ou mot de passe incorrect.";
        }
    }

    public function logout() {
        // Déconnexion de l'utilisateur
        session_destroy();
        header('Location: index.php');
        exit();
    }
}
?>
