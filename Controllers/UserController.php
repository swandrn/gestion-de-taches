<?php

class UserController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function showLoginForm() {
        include 'views/login.php';
    }

    public function showRegisterForm() {
        include 'views/register.php';
    }

    public function register() {
        $nom = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $mot_de_passe = $_POST['password'] ?? '';

        if (empty($nom) || empty($email) || empty($mot_de_passe)) {
            echo "Tous les champs sont obligatoires.";
            return;
        }

        $mot_de_passe = password_hash($mot_de_passe, PASSWORD_BCRYPT);

        try {
            $query = $this->db->prepare('INSERT INTO users (nom, email, mot_de_passe) VALUES (?, ?, ?)');
            if ($query->execute([$nom, $email, $mot_de_passe])) {
                echo "Inscription réussie.";
                header('Location: index.php?action=login');
                exit();
            } else {
                echo "Erreur lors de l'inscription.";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function login() {
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
        session_destroy();
        header('Location: index.php');
        exit();
    }
}
?>
