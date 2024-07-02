<?php
// Classe qui représente un utilisateur
class Utilisateur {
    // Propriétés de l'utilisateur
    private $id;
    private $nom;
    private $email;
    private $mot_de_passe;

    // Constructeur pour initialiser un nouvel utilisateur
    public function __construct($nom, $email, $mot_de_passe) {
        $this->nom = $nom;
        $this->email = $email;
        // Hachage du mot de passe pour des raisons de sécurité
        $this->mot_de_passe = password_hash($mot_de_passe, PASSWORD_BCRYPT);
    }

    // Getters pour accéder aux propriétés
    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
    public function getEmail() { return $this->email; }

    // Setters pour modifier les propriétés
    public function setId($id) { $this->id = $id; }
    public function setNom($nom) { $this->nom = $nom; }
    public function setEmail($email) { $this->email = $email; }
    
    // Setter pour modifier le mot de passe, avec hachage
    public function setMotDePasse($mot_de_passe) { 
        $this->mot_de_passe = password_hash($mot_de_passe, PASSWORD_BCRYPT); 
    }

    // Méthode pour vérifier le mot de passe
    public function verifierMotDePasse($mot_de_passe) {
        // Vérifie si le mot de passe donné correspond au mot de passe haché
        return password_verify($mot_de_passe, $this->mot_de_passe);
    }
}
?>

